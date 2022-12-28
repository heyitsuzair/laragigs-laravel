<?php

use App\Http\Controllers\ListingController;
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

// Show Create List Form
Route::get('/listing/create', [ListingController::class, 'create']);

Route::post('/listing', [ListingController::class, 'store']);

Route::get('/listing/{listing}', [ListingController::class, 'show']);



// Route::get('/hello', function () {
//     return response('hello');
// });

// Route::get('/posts/{name}', function ($name) {

//     return $name . ' Post';
// })->where('name', '[a-zA-Z0-9]+');

// Route::get('/search', function (Request $req) {
//     return ($req->name . ' Search ' . $req->city);
// });