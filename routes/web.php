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
    return redirect()->route('provider.create');
});

Route::get('/proveedor/productos', 'ProductsController@indexprod')->name('provider.products');

Route::get('/proveedor/producto', 'ProductsController@createprod')->name('provider.create');

Route::post('/proveedor/nuevo','ProductsController@storeprod');

Route::get('/cliente/productos', 'ProductsController@clientprod')->name('cliente.products');

Route::get('/cliente/compra','ProductsController@editprod')->name('cliente.edit');

Route::get('/cliente/compra/ajax', 'ProductsController@ajaxRequest');

Route::post('/cliente/compra', 'ProductsController@ajaxRequestPost');

Route::get('/cliente/count/ajax', 'ProductsController@ajaxRequestCount');

Route::post('/cliente/count', 'ProductsController@ajaxRequestPostCount');

Route::put('/cliente/pagar','ProductsController@update');
