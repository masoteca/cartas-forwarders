<?php

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
    return redirect()->route('home');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    Route::resource('document', 'CartasController')->except(['show']);
    Route::resource('productos', 'Mantenedores\ProductoController')->only(['index', 'create','store']);
    Route::resource('encargados', 'Mantenedores\EncargadoController')->only(['index', 'create','store']);
    Route::get('document/print/{document}', 'PrintsController@printcarta')->name('document.print');
    Route::get('document/etiqueta/{document}', 'EtiquetasController@print')->name('etiquetas.print');
});

