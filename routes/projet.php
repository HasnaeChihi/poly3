<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\ProjetController;

Route::get('projet','ProjetController@index');
Route::post('projet/store','ProjetController@store');
Route::post('projet/update','ProjetController@update');
Route::post('projet/edit','ProjetController@edit');
Route::post('projet/delete','ProjetController@delete');
Route::post('projet/show','ProjetController@show');
