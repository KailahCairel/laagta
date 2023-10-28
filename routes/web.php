<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialController;


// Facebook Login Route
Route::get('/login/{provider}', [SocialController::class, 'redirectToProvider']);
Route::get('/login/{provider}/callback', [SocialController::class, 'handleProviderCallback']);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/establishments', [App\Http\Controllers\EstablishmentController::class, 'index']);

    Route::get('/establishments/create', [App\Http\Controllers\EstablishmentController::class, 'create']);
    Route::post('/establishments', [App\Http\Controllers\EstablishmentController::class, 'store']);
    
    Route::resource('destinations', App\Http\Controllers\DestinationController::class);
    Route::resource('establishments', App\Http\Controllers\EstablishmentController::class);

    Route::post('/establishment/{establishment}/services', [App\Http\Controllers\EstablishmentController::class, 'storeService'])->name('store.services');
    Route::put('/establishment/{establishment}/services/{service}', [App\Http\Controllers\EstablishmentController::class, 'updateService'])->name('update.services');
    Route::delete('/establishment/{establishment}/services/{service}', [App\Http\Controllers\EstablishmentController::class, 'deleteService'])->name('delete.services');
    
    Route::post('/establishment/{establishment}/rooms', [App\Http\Controllers\EstablishmentController::class, 'storeRoom'])->name('store.rooms');
    Route::put('/establishment/{establishment}/rooms/{room}', [App\Http\Controllers\EstablishmentController::class, 'updateRoom'])->name('update.rooms');
    Route::delete('/establishment/{establishment}/rooms/{room}', [App\Http\Controllers\EstablishmentController::class, 'deleteRoom'])->name('delete.rooms');

    Route::post('/establishment/{establishment}/rides', [App\Http\Controllers\EstablishmentController::class, 'storeRide'])->name('store.rides');
    Route::put('/establishment/{establishment}/rides/{ride}', [App\Http\Controllers\EstablishmentController::class, 'updateRide'])->name('update.rides');
    Route::delete('/establishment/{establishment}/rides/{ride}', [App\Http\Controllers\EstablishmentController::class, 'deleteRide'])->name('delete.rides');

    Route::post('/establishment/{establishment}/cottages', [App\Http\Controllers\EstablishmentController::class, 'storeCottage'])->name('store.cottages');
    Route::put('/establishment/{establishment}/cottages/{cottage}', [App\Http\Controllers\EstablishmentController::class, 'updateCottage'])->name('update.cottages');
    Route::delete('/establishment/{establishment}/cottages/{cottage}', [App\Http\Controllers\EstablishmentController::class, 'deleteCottage'])->name('delete.cottages');

    // Delete service

    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/profile', [App\Http\Controllers\AdminController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [App\Http\Controllers\AdminController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password/update', [App\Http\Controllers\AdminController::class, 'changePassword'])->name('profile.password');
    Route::put('/users/{id}/update-status', [App\Http\Controllers\AdminController::class, 'updateStatus'])->name('update-status'); 

    Route::get('/fetch-users', [App\Http\Controllers\AdminController::class, 'fetchUsers'])->name('fetch-user');

});

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/establishment/{establishment}', [App\Http\Controllers\UserController::class, 'establishment'])->name('establishment');
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password/update', [App\Http\Controllers\UserController::class, 'changePassword'])->name('profile.password');


    Route::post('/process-form', [App\Http\Controllers\UserController::class, 'processForm'])->name('process-form');

});

Route::get('about-us', function() {
    return view('about');
})->name('about');

Route::get('terms-and-condition', function() {
    return view('terms');
})->name('terms');

Route::get('privacy-policy', function() {
    return view('privacy');
})->name('privacy');