<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ListingController::class, 'index']);

Route::get('/listing/create', [ListingController::class, 'create'])->middleware('auth');
Route::get('/listing/edit/{listing}', [ListingController::class, 'edit'])->middleware('auth');
Route::put('/listing/{listing}', [ListingController::class, 'update'])->middleware('auth');
Route::post('/listing', [ListingController::class, 'store'])->middleware('auth');
Route::delete('/listing/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

Route::get('/listing/{listing}', [ListingController::class, 'show']);




// Show Register Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
// Show Login Form
Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('login');
// Show Register Form


// Create User
Route::post('/users', [UserController::class, 'store']);
// Logout User
Route::post('/logout', [UserController::class, 'logout']);

// Login User
Route::post('/users/login', [UserController::class, 'postLogin']);


// Route::get('/hello', function () {
//     return response('hello');
// });

// Route::get('/posts/{name}', function ($name) {

//     return $name . ' Post';
// })->where('name', '[a-zA-Z0-9]+');

// Route::get('/search', function (Request $req) {
//     return ($req->name . ' Search ' . $req->city);
// });