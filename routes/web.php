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

Route::post('/login','AuthController@login')->name('loginUser');
Route::post('/register','AuthController@register')->name('registerUser');
Route::get('/logout','AuthController@logout')->name('logoutUser');

Route::get('/', 'AppointmentsController@login')->name('login');
Route::get('/home', 'AppointmentsController@index')->name('home');
Route::get('/appointment/detail/{id}', 'AppointmentsController@detail')->name('appointment.detail');
Route::get('/appointment/apply/{username}/{id}', 'AppointmentsController@applyRegistrant')->name('appointment.apply');
Route::get('/appointment/cancel/{username}/{id}', 'AppointmentsController@cancelAppointment')->name('appointment.cancel');
Route::post('/appointment/create', 'AppointmentsController@createAppointment')->name('appointment.create');
Route::post('/appointment/update', 'AppointmentsController@updateAppointment')->name('appointment.update');
Route::get('/appointment/delete', 'AppointmentsController@deleteAppointment')->name('appointment.delete');
Route::get('/appointments', 'AppointmentsController@myAppointment')->name('appointment.user');


Route::get('/create', 'PagesController@createPage')->name('page.create');
Route::get('/update', 'PagesController@updatePage')->name('page.update');
Route::get('/see/registrant', 'PagesController@registrantPage')->name('page.see');