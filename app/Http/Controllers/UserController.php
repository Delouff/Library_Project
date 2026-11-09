<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * GET /api/users (admin)
     * Liste paginée des membres.
     */
    public function index()
    {
        $users = User::paginate(20);

        return response()->json([
            'data' => $users->items(),
            'error' => null,
            'meta' => [
                'page' => $users->currentPage(),
                'page_size' => $users->perPage(),
                'total_results' => $users->total(),
            ],
        ], 200);
    }

    /**
     * POST /api/users (public)
     * Inscription d'un nouveau membre.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            'name' => ['required', 'string', 'max:100'],
            'firstname' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
            'library_id' => ['required', 'integer', 'exists:libraries,id'],
        ]);

        $user = User::create($validated);
        $validate_token = $user->createToken('validate_token');

        return response()->json([
            'data' => $user,
            'error' => null,
            'meta' => [
                'token' => $validate_token->plainTextToken,
            ],
        ], 201);
    }

    /**
     * GET /api/users/{user} (connecté)
     * Un membre ne peut voir que son propre compte, sauf s'il est admin.
     */
    public function show(Request $request, User $user)
    {
        $connected = $request->user(); // celui qui fait la requête (grâce à Sanctum)

        if ($connected->id !== $user->id && $connected->role !== 'admin') {
            throw new AuthorizationException(); // → 403
        }

        return $user;
    }

    /**
     * PUT /api/users/{user} (connecté)
     * Un membre ne peut modifier que son propre compte, sauf s'il est admin.
     */
    public function update(Request $request, User $user)
    {
        abort_unless($request->user()->id === $user->id || $request->user()->role === 'admin', 403);

        // "sometimes" : le champ n'est vérifié que s'il est envoyé (modification partielle)
        $validated = $request->validate([
            'email' => ['sometimes', 'email:rfc,dns', Rule::unique('users', 'email')->ignore($user->id)],
            'name' => ['sometimes', 'string', 'max:100'],
            'firstname' => ['sometimes', 'string', 'max:100'],
            'password' => ['sometimes', 'string', 'min:8', 'max:255'],
            'library_id' => ['sometimes', 'integer', 'exists:libraries,id'],
        ]);

        $user->update($validated);

        return response()->json([
            'data' => $user,
            'error' => null,
            'meta' => null,
        ], 200);
    }

    /**
     * DELETE /api/users/{user} (admin)
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'data' => ['message' => 'Utilisateur supprimé'],
            'error' => null,
            'meta' => null,
        ], 200);
    }

    /**
     * POST /api/auth/login
     * Authentifie un utilisateur et renvoie un token Sanctum (format imposé §4.3.1).
     */
    public function login(Request $request)
    {
        // 422 automatique si les champs sont absents ou mal formés
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password) /* || !$user->email_verified_at */) {
            return response()->json([
                'data' => null,
                'error' => [
                    'type' => 'https://bibliotech.fr/invalid-credentials',
                    'title' => 'Identifiants incorrects.',
                    'status' => 401,
                    'detail' => 'Email ou mot de passe incorrect.',
                ],
                'meta' => null,
            ], 401);
        }

        $token = $user->createToken('auth_token');

        return response()->json([
            'data' => [
                'token' => $token->plainTextToken,
                'user' => [
                    'id' => $user->id,
                    'email' => $user->email,
                    'firstname' => $user->firstname,
                    'lastname' => $user->name,
                    'role' => $user->role,
                ],
            ],
            'error' => null,
            'meta' => null,
        ], 200);
    }

    /**
     * POST /api/auth/logout
     * Révoque le token utilisé pour la requête.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'data' => ['message' => 'Déconnexion réussie'],
            'error' => null,
            'meta' => null,
        ], 200);
    }

    /**
     * GET /api/auth/me
     * Renvoie l'utilisateur connecté.
     */
    public function me(Request $request)
    {
        return response()->json([
            'data' => $request->user(),
            'error' => null,
            'meta' => null,
        ], 200);
    }

}
