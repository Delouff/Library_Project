<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            'name' => ['required', 'string', 'max:100'],
            'firstname' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
            'library_id' => ['required', 'integer', 'max:255'],
        ]);

        $user = User::create($request->all());
        $validate_token = $user->createToken('validate_token');

        return [
            "data" => $user,
            "meta" => [
                "token" => $validate_token->plainTextToken
            ],
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return User::update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = User::findOrFail($id)->delete();
        return response()->json($result);
    }

    public function login(Request $request)
    {

        $user = User::where("email", $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password) /* || !$user->email_verified_at*/) {
            throw new AuthorizationException();
        }

        $token = $user->createToken("validation_token");

        return [
            "data" => $token->plainTextToken
        ];
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
    }

    public function me(Request $request)
    {
        return [
            "data" => $request->user()
        ];
    }

}
