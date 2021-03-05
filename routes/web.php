<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontController;
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

// Front Routes
Route::get('/services/{service:slug}/{subservice?}', [FrontController::class, 'service']);
Route::get('/blog/{blog:slug?}', [FrontController::class, 'blog']);
Route::get('/portfolio/{portfolio:slug?}', [FrontController::class, 'portfolio']);
Route::get('/{page?}', [FrontController::class, 'view']);



/****************************************
 * BACKOFFICE ROUTES
 *
 * 
 *****************************************/

Route::get('/backoffice/login', [AdminController::class, 'auth'])->name('admin-login')->middleware('guest');

Route::middleware(['auth', 'admin'])->group(function () {

    //  Service Routes
    Route::get('/backoffice/services/{service?}/{subservice?}', [AdminController::class, 'service']);
    
    // Portfolio Routes
    Route::get('/backoffice/portfolios/{portfolio?}', [AdminController::class, 'portfolio']);
    
    // Contact Routes
    Route::get('/backoffice/contacts/{contact?}', [AdminController::class, 'contact']);
    
    // Contact Routes
    Route::get('/backoffice/posts/{blog?}', [AdminController::class, 'post']);
    
    // Taxonomies Routes
    Route::get('/backoffice/taxonomies', [AdminController::class, 'taxonomies']);
    
    // // Taxonomies Routes
    // Route::get('/backoffice/mailing_list', [AdminController::class, 'mailingList']);
    
    Route::get('/backoffice/{page?}', [AdminController::class, 'view']);

});

Route::middleware(['auth:sanctum', 'verified'])->get('/user/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
