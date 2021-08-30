<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\FamilleController;

Route::get('famille','FamilleController@index');
Route::post('famille/store','FamilleController@store');
Route::post('famille/update','FamilleController@update');
Route::post('famille/edit','FamilleController@edit');
Route::post('famille/delete','FamilleController@delete');
Route::post('famille/show','FamilleController@show');
