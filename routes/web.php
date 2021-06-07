<?php

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

Route::get('/', function () {
    // return view('welcome');
    return view('auth/login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');




Route::middleware(['auth:sanctum', 'verified'])->get('/trips', function () {
    return view('driver/trips');
})->name('trips');

Route::middleware(['auth:sanctum', 'verified'])->get('/calendar', function () {
    return view('driver/calendar');
})->name('calendar');

Route::middleware(['auth:sanctum', 'verified'])->get('/email_compose', function () {
    return view('driver/email_compose');
})->name('email_compose');

Route::middleware(['auth:sanctum', 'verified'])->get('/email_inbox', function () {
    return view('driver/email_inbox');
})->name('email_inbox');

Route::middleware(['auth:sanctum', 'verified'])->get('/email_view', function () {
    return view('driver/email_view');
})->name('email_view');

Route::middleware(['auth:sanctum', 'verified'])->get('/index', function () {
    return view('driver/index');
})->name('index');

Route::middleware(['auth:sanctum', 'verified'])->get('/my_earning', function () {
    return view('driver/my_earning');
})->name('my_earning');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile', function () {
    return view('driver/profile');
})->name('profile');

Route::middleware(['auth:sanctum', 'verified'])->get('/route_map', function () {
    return view('driver/route_map');
})->name('route_map');

Route::middleware(['auth:sanctum', 'verified'])->get('/tax_insurance', function () {
    return view('driver/tax_insurance');
})->name('tax_insurance');


Route::middleware(['auth:sanctum', 'verified'])->get('/upcomming_trips', function () {
    return view('driver/upcomming_trips');
})->name('upcomming_trips');
