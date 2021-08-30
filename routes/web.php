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

Route::get('/', 'PagesController@index');


// Demo routes
Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');
Route::get('/jquerymask', 'PagesController@jQueryMask');
Route::get('/icons/custom-icons', 'PagesController@customIcons');
Route::get('/icons/flaticon', 'PagesController@flaticon');
Route::get('/icons/fontawesome', 'PagesController@fontawesome');
Route::get('/icons/lineawesome', 'PagesController@lineawesome');
Route::get('/icons/socicons', 'PagesController@socicons');
Route::get('/icons/svg', 'PagesController@svg');
Route::get('/form', 'UserManagerController@index');
Route::post('/users/add', 'UserManagerController@store')->name("account.add");
Route::post('/users/edit', 'UserManagerController@edit')->name("account.get");
Route::post('/users/update', 'UserManagerController@update')->name("account.update");
Route::post('/users/show', 'UserManagerController@read')->name("account.show");
Route::post('/users/delete', 'UserManagerController@supprimer')->name("account.delete");
Route::get('/estimerprix', 'EstimerPrixController@index');
Route::post('/projets/add', 'EstimerPrixController@store')->name("prixmdc.add");
Route::post('/projets/edit', 'EstimerPrixController@edit')->name("prixmdc.get");
Route::post('/projets/update', 'EstimerPrixController@update')->name("prixmdc.update");
Route::post('/projets/show', 'EstimerPrixController@read')->name("prixmdc.show");
Route::post('/projets/delete', 'EstimerPrixController@supprimer')->name("prixmdc.delete");

Route::get('/standard', 'CoutConceptionController@index');
Route::post('/couts/add', 'CoutConceptionController@store')->name("cout.add");
Route::post('/couts/edit', 'CoutConceptionController@edit')->name("cout.get");
Route::post('/couts/update', 'CoutConceptionController@update')->name("cout.update");
Route::post('/couts/show', 'CoutConceptionController@read')->name("cout.show");
Route::post('/couts/delete', 'CoutConceptionController@supprimer')->name("cout.delete");



// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
