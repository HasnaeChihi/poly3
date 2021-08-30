<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\DesignationController;

Route::get('designation','DesignationController@index');
Route::post('designation/store','DesignationController@store')->name('designition.add');
Route::post('designation/update','DesignationController@update')->name('designation.update');
Route::post('designation/edit','DesignationController@edit')->name('designation.get');
Route::post('designation/delete','DesignationController@delete')->name('designation.delete');
Route::post('designation/show','DesignationController@show')->name('designation.show');
