<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// AUTH
Route::post('/auth/login', [UserController::class , 'login']);
Route::post('/auth/logout', [UserController::class , 'logout'])->middleware('auth:sanctum');
Route::get('/auth/me', [UserController::class , 'me'])->middleware('auth:sanctum');

// USER
//Route::get('/users/loans', UserController::class);
Route::apiResource('/users', UserController::class)->only('store');
Route::get('/users', [UserController::class, 'index'])->middleware(['auth:sanctum', 'admin']);
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware(['auth:sanctum', 'admin']);
Route::get('/users/{user}', [UserController::class, 'show'])->middleware('auth:sanctum');
Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth:sanctum');

// LIBRARY
Route::apiResource('/libraries', LibraryController::class)->only('index' , 'show');
Route::get('/libraries/{library}/copies', [LibraryController::class , 'copies']);
Route::get('/libraries/{library}/users', [LibraryController::class , 'users'])->middleware(['auth:sanctum' , 'admin']);
Route::post('/libraries', [LibraryController::class , 'store'])->middleware(['auth:sanctum' , 'admin']);
Route::put('/libraries/{library}', [LibraryController::class , 'update'])->middleware(['auth:sanctum' , 'admin']);
Route::delete('/libraries/{library}', [LibraryController::class , 'destroy'])->middleware(['auth:sanctum' , 'admin']);

// BOOK
Route::apiResource('/books' , BookController::class)->only('index' , 'show');
Route::post('/books', [BookController::class , 'store'])->middleware(['auth:sanctum' , 'admin']);
Route::put('/books/{book}', [BookController::class , 'update'])->middleware(['auth:sanctum' , 'admin']);
Route::delete('/books/{book}', [BookController::class , 'destroy'])->middleware(['auth:sanctum' , 'admin']);

// COPY
Route::apiResource('/copies' , CopyController::class)->only('index' , 'show');
Route::post('/copies', [CopyController::class , 'store'])->middleware(['auth:sanctum' , 'admin']);
Route::put('/copies/{copy}', [CopyController::class , 'update'])->middleware(['auth:sanctum' , 'admin']);
Route::delete('/copies/{copy}', [CopyController::class , 'destroy'])->middleware(['auth:sanctum' , 'admin']);

// AUTHOR
Route::apiResource('/authors' , AuthorController::class)->only('index' , 'show');
Route::post('/authors', [AuthorController::class , 'store'])->middleware(['auth:sanctum' , 'admin']);
Route::put('/authors/{author}', [AuthorController::class , 'update'])->middleware(['auth:sanctum' , 'admin']);
Route::delete('/authors/{author}', [AuthorController::class , 'destroy'])->middleware(['auth:sanctum' , 'admin']);

//Route::post('/validate',  [UserController::class , 'validate']);