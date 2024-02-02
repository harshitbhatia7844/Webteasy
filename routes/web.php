<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;



Route::view('/', 'welcome')->name('welcome');

Route::fallback(function () { return view('/404'); });

// Route for Student starts here
Route::prefix('/student')->name('student.')
    ->controller(StudentController::class)->group(function () {

        Route::middleware('auth:student')->group(function () {

            Route::get('/', 'dashboard')->name('index');
            Route::get('/', 'dashboard')->name('dashboard');
            Route::get('/profile', 'profile')->name('profile');
            Route::get('/notification', 'notification')->name('notification');
            Route::view('/404', 'student.404')->name('404');
        });

        Route::view('/login', 'student.login')->name('login');
        Route::view('/forgetpassword', 'student.forget-password')->name('forgetpassword');
        Route::view('/register', 'student.register')->name('register');
        Route::post('/signup', 'signup')->name('signup');
        Route::post('/reset', 'reset')->name('reset');
        Route::post('/signin', 'authenticate')->name('signin');
        Route::get('/logout', 'logout')->name('logout');
    });
// Route for Student ends here

// Route for Admin starts here
Route::prefix('/admin')->name('admin.')
    ->controller(AdminController::class)->group(function () {

        Route::middleware('auth:admin')->group(function () {

            Route::get('/', 'dashboard')->name('index');
            Route::get('/', 'dashboard')->name('dashboard');
            Route::get('/profile', 'profile')->name('profile');
            Route::view('/404', 'admin.404')->name('404');
        });

        Route::view('/login', 'admin.login')->name('login');
        Route::post('/signin', 'authenticate')->name('signin');
        Route::get('/logout', 'logout')->name('logout');
    });
// Route for Admin ends here