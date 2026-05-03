<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\GuestController;

// (මෙතන දැනට තියෙන Route::get('/', ...) කේතය මකන්න එපා, ඒක එහෙම්මම තියන්න)

// RSVP වලට අදාළ Routes
Route::post('/rsvp/check', [GuestController::class, 'check']);
Route::post('/rsvp/update', [GuestController::class, 'update']);

// Admin Panel Routes
Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout']);
Route::post('/admin/guest', [AdminController::class, 'storeGuest']);
Route::post('/admin/guest/update/{id}', [AdminController::class, 'updateGuest']);
Route::post('/admin/guest/delete/{id}', [AdminController::class, 'deleteGuest']);