<?php

use App\Livewire\Patient;
use App\Livewire\Technician;
use App\Livewire\Subordinate;
use App\Livewire\Administration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\SubordinateController;
use App\Http\Controllers\AdministrationController;

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

Route::get('/about', function () {
    return view('about');
});
//Auth::routes(['register' => false]);

/**
 * Auth Routes
 */
Auth::routes(['verify' => false,'register'=>false]);


Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    Route::middleware('auth')->group(function () {
        /**
         * Home Routes
         */
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
        /**
         * Role Routes
         */    
        Route::resource('roles', RolesController::class);
        /**
         * Permission Routes
         */    
        Route::resource('permissions', PermissionsController::class);
        /**
         * User Routes
         */
        Route::resource('doctors',DoctorController::class);
        Route::resource('nurses',NurseController::class);
        Route::resource('subs',SubordinateController::class);
        Route::resource('technicians',TechnicianController::class);
        Route::resource('administration',AdministrationController::class);
        Route::resource('patient',PatientController::class);

        Route::group(['prefix' => 'users'], function() {
            Route::get('/', [App\Http\Controllers\UsersController::class, 'index'])->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
        });
    });
});
