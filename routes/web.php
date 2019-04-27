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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/type', 'TypeController', ['middleware' => ['web', 'admin']]);
Route::resource('/room', 'RoomController', ['middleware' => ['web', 'admin']]);
Route::resource('/inventary', 'InventaryController', ['middleware' => ['web', 'admin']]);
Route::group(['prefix' => 'supply', 'middleware' => ['web', 'admin']], function() {
    Route::get('/', 'SupplyController@index')->name('supply.index');
    Route::get('/create', 'SupplyController@create')->name('supply.create');
    Route::post('/create', 'SupplyController@store')->name('supply.store');
    Route::delete('/{supply}/delete', 'SupplyController@destroy')->name('supply.destroy');
});
Route::group(['prefix' => 'user', 'middleware' => ['web', 'admin']], function() {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::post('/create', 'UserController@store')->name('user.store');
    Route::get('/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::patch('/{user}/edit', 'UserController@update')->name('user.update');
    Route::patch('/{user}/change', 'UserController@change')->name('user.change');
    Route::delete('/{user}/delete', 'UserController@destroy')->name('user.destroy');
});
Route::group(['prefix' => 'borrow'], function() {
    Route::get('/', 'BorrowController@index')->name('borrow.index');
    Route::get('/create', 'BorrowController@create')->name('borrow.create');
    Route::post('/create', 'BorrowController@store')->name('borrow.store');
    Route::get('/{borrow}/show', 'BorrowController@show')->name('borrow.show');
    Route::get('/{borrow}/edit', 'BorrowController@edit')->name('borrow.edit');
    Route::patch('/{borrow}/edit', 'BorrowController@update')->name('borrow.update');
    Route::patch('/{borrow}/confirm', 'BorrowController@confirm')->name('borrow.confirm');
    Route::delete('/{borrow}/delete', 'BorrowController@destroy')->name('borrow.destroy');
});
Route::group(['prefix' => 'detail_borrow'], function() {
    Route::post('/create', 'DetailBorrowController@store')->name('detail_borrow.store');
    Route::get('/{detail_borrow}/edit', 'DetailBorrowController@edit')->name('detail_borrow.edit');
    Route::patch('/{detail_borrow}/edit', 'DetailBorrowController@update')->name('detail_borrow.update');
    Route::delete('/{detail_borrow}/delete', 'DetailBorrowController@destroy')->name('detail_borrow.destroy');
    Route::post('/{detail_borrow}/return', 'DetailBorrowController@return')->name('detail_borrow.return');
});
Route::resource('/broken', 'BrokenController', ['middleware' => ['web', 'operator']]);
Route::group(['prefix' => '/report', 'middleware' => ['web', 'admin']], function(){
    Route::get('/', 'ReportController@index')->name('report.index');
    Route::get('/{param}', 'ReportController@generate')->name('report.generate');
});
