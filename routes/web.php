<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Group;



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
        Route::post('/signin', 'authenticate')->name('signin');
        Route::get('/logout', 'logout')->name('logout');
    });
// Route for Student ends here


// Route for Centre starts here
Route::prefix('/centre')->name('centre.')
    ->controller(CentreController::class)->group(function () {

        Route::middleware('auth:centre')->group(function () {

            Route::get('/', 'dashboard')->name('index');
            Route::get('/', 'dashboard')->name('dashboard');
            Route::get('/profile', 'profile')->name('profile');
            Route::get('/notification', 'notification')->name('notification');
            Route::get('/viewstudent', 'viewstudent')->name('viewstudents');
            Route::post('/addnotification', 'addnotification')->name('addnotification');
            Route::view('/createnotification', 'centres.createnotification')->name('createnotification');
            Route::view('/404', 'centres.404')->name('404');
        });

        Route::view('/forgotpassword', 'centres.forgot-password')->name('forgotpassword');
        Route::view('/register', 'centres.register')->name('register');
        Route::view('/login', 'centres.login')->name('login');
        Route::post('/signin', 'authenticate')->name('signin');
        Route::post('/signup', 'signup')->name('signup');
        Route::post('/reset', 'reset')->name('reset');
        Route::get('/logout', 'logout')->name('logout');
    });
// Route for Centre ends here


// Route for Admin starts here
Route::prefix('/admin')->name('admin.')
    ->controller(AdminController::class)->group(function () {

        Route::middleware('auth:admin')->group(function () {

            Route::get('/', 'dashboard')->name('index');
            Route::get('/', 'dashboard')->name('dashboard');
            Route::get('/profile', 'profile')->name('profile');
            Route::view('/404', 'admin.404')->name('404');
        });

        Route::view('/forgotpassword', 'admin.forgot-password')->name('forgotpassword');
        Route::view('/register', 'admin.register')->name('register');
        Route::view('/login', 'admin.login')->name('login');
        Route::post('/signin', 'authenticate')->name('signin');
        Route::post('/signup', 'signup')->name('signup');
        Route::post('/reset', 'reset')->name('reset');
        Route::get('/logout', 'logout')->name('logout');
    });
// Route for Admin ends here