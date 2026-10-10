<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// USER
Route::post('/users/login', [UserController::class , 'login']);
Route::get('/users/me', [UserController::class , 'me'])->middleware('auth:sanctum');
Route::delete('/users/deleteSession', [UserController::class , 'logout'])->middleware('auth:sanctum');
//Route::get('/users/loans', UserController::class);
Route::apiResource('/users', UserController::class);

// LIBRARY
Route::apiResource('/libraries', LibraryController::class)->only('index' , 'show');
Route::get('/libraries/{library}/copies', [LibraryController::class , 'copies']);
Route::get('/libraries/{library}/users', [LibraryController::class , 'users'])->middleware(['auth:sanctum' , 'admin']);
Route::post('/libraries', [LibraryController::class , 'store'])->middleware(['auth:sanctum' , 'admin']);
Route::put('/libraries/{library}', [LibraryController::class , 'update'])->middleware(['auth:sanctum' , 'admin']);
Route::delete('/libraries/{library}', [LibraryController::class , 'destroy'])->middleware(['auth:sanctum' , 'admin']);

// BOOK
Route::apiResource('/books' , BookController::class)->only('index' , 'show');
Route::post('/books', [LibraryController::class , 'store'])->middleware(['auth:sanctum' , 'admin']);
Route::put('/books/{book}', [LibraryController::class , 'update'])->middleware(['auth:sanctum' , 'admin']);
Route::delete('/books/{book}', [LibraryController::class , 'destroy'])->middleware(['auth:sanctum' , 'admin']);

// COPY
Route::apiResource('/copies' , CopyController::class);

// AUTHOR
Route::apiResource('/authors' , AuthorController::class);

//Route::post('/validate',  [UserController::class , 'validate']);