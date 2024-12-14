<?php

use Illuminate\Support\Facades\Route;

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

//auth
Route::group(['namespace' => 'Auth'], function () {
    Route::get('/', 'LoginController@showLoginForm')->name('/');
    Route::get('/login-admin', 'LoginController@showLoginForm')->name('/');
    Route::post('/loginProses', 'LoginController@login')->name('login');
    Route::post('/logout', 'LoginController@logout')->name('logout');
})->middleware('guest');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //Data Karyawan
    Route::prefix('karyawan')->group(function(){
        Route::get('/', 'UserController@index')->name('karyawan');
        Route::get('/create', 'UserController@create')->name('karyawan.create');
        Route::post('/create/save', 'UserController@store')->name('karyawan.store');
        Route::get('/show_data/{id?}', 'UserController@show')->name('karyawan.show');
        Route::get('/edit/{id?}', 'UserController@edit')->name('karyawan.edit');
        Route::put('/edit/save/{id?}', 'UserController@update')->name('karyawan.update');
    });

    //Data Jabatan
    Route::prefix('jabatan')->group(function(){
        Route::get('/', 'JabatanController@index')->name('jabatan');
        Route::get('/create', 'JabatanController@create')->name('jabatan.create');
        Route::post('/create/save', 'JabatanController@store')->name('jabatan.store');
        Route::get('/show_data/{id?}', 'JabatanController@show')->name('jabatan.show');
        Route::get('/edit/{id?}', 'JabatanController@edit')->name('jabatan.edit');
        Route::put('/edit/save/{id?}', 'JabatanController@update')->name('jabatan.update');
    });

    //Data Shift
    Route::prefix('shift-karyawan')->group(function(){
        Route::get('/', 'ShiftController@index')->name('shift');
        Route::get('/create', 'ShiftController@create')->name('shift.create');
        Route::post('/create/save', 'ShiftController@store')->name('shift.store');
        Route::get('/show_data/{id?}', 'ShiftController@show')->name('shift.show');
        Route::get('/edit/{id?}', 'ShiftController@edit')->name('shift.edit');
        Route::put('/edit/save/{id?}', 'ShiftController@update')->name('shift.update');
    });

    //Data Absensi
    Route::prefix('absensi')->group(function(){
        Route::get('/', 'AbsensiController@index')->name('absensi');
        Route::get('/create', 'AbsensiController@create')->name('absensi.create');
        Route::post('/create/save', 'AbsensiController@store')->name('absensi.store');
        Route::get('/show_data/{id?}', 'AbsensiController@show')->name('absensi.show');
        Route::get('/edit/{id?}', 'AbsensiController@edit')->name('absensi.edit');
        Route::put('/edit/save/{id?}', 'AbsensiController@update')->name('absensi.update');
    });
});
