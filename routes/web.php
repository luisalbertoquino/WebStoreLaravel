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
    return view('auth/login');
});


Route::get('/home', function () {
    return view('home');
});


Route::get('/login', function () {
    return view('login');
});


Route::get('/about', function () {
    return view('about');
});


Auth::routes();
//Home
Route::get('/home', 'HomeController@index')->name('home');
//Usuarios
Route::get('/user', 'UserController@index');
Route::get('/user/create', 'UserController@create');
Route::get('/user/{user}', 'UserController@show');
Route::post('/user', 'UserController@store');
Route::get('/user/{user}/edit', 'UserController@edit');
Route::patch('/user/{piola}', 'UserController@update');
Route::patch('/user/estado/{user}', 'UserController@estado');
Route::delete('/user/{usuario}', 'UserController@destroy');


 
//Productos 
Route::get('/product', 'ProductController@index');
//Route::resource('/product','ProductController');   //forma rapida
Route::get('/product/create', 'ProductController@create');
Route::get('/product/{productos}', 'ProductController@show');
Route::post('/product', 'ProductController@store');
Route::get('/product/{productos}/edit', 'ProductController@edit');
Route::patch('/product/{producto}', 'ProductController@update');
Route::patch('/product/estado/{productos}', 'ProductController@estado');
Route::delete('/product/{productos}', 'ProductController@destroy');



             
//categorias 
Route::get('/category', 'CategoryController@index');                 //forma manual
Route::get('/category/create', 'CategoryController@create');
Route::get('/category/{categoria}', 'CategoryController@show');
Route::post('/category', 'CategoryController@store');
Route::get('/category/{categoria}/edit', 'CategoryController@edit');
Route::patch('/category/{categoria}', 'CategoryController@update');
Route::patch('/category/estado/{categoria}', 'CategoryController@estado');
Route::delete('/category/{categoria}', 'CategoryController@destroy');


//Ventas
Route::get('/sale', 'SaleController@index');                 //forma manual
Route::get('/sale/create', 'SaleController@create');
Route::get('/sale/{venta}', 'SaleController@show');
Route::post('/sale', 'SaleController@store');
Route::get('/sale/{venta}/edit', 'SaleController@edit');
Route::patch('/sale/{venta}', 'SaleController@update');
Route::patch('/sale/estado/{venta}', 'SaleController@estado');
Route::delete('/sale/{venta}', 'SaleController@destroy');

 
//Compras
Route::get('/shopping', 'ShoppingController@index');                 //forma manual
Route::get('/shopping/create', 'ShoppingController@create');
Route::get('/shopping/{compra}', 'ShoppingController@show');
Route::post('/shopping', 'ShoppingController@store');
Route::get('/shopping/{compra}/edit', 'ShoppingController@edit');
Route::patch('/shopping/{compra}', 'ShoppingController@update');
Route::patch('/shopping/estado/{compra}', 'ShoppingController@estado');
Route::delete('/shopping/{compra}', 'ShoppingController@destroy');

//Clientes
Route::get('/client', 'ClientController@index');                 //forma manual
Route::get('/client/create', 'ClientController@create');
Route::get('/client/{cliente}', 'ClientController@show');
Route::post('/client', 'ClientController@store');
Route::get('/client/{cliente}/edit', 'ClientController@edit');
Route::patch('/client/{cliente}', 'ClientController@update');
Route::patch('/client/estado/{cliente}', 'ClientController@estado');
Route::delete('/client/{cliente}', 'ClientController@destroy');

//documento
Route::get('/document', 'DocumentController@index');                 //forma manual
Route::get('/document/create', 'DocumentController@create');
Route::get('/document/{documento}', 'DocumentController@show');
Route::post('/document', 'DocumentController@store');
Route::get('/document/{documento}/edit', 'DocumentController@edit'); 
Route::patch('/document/{documento}', 'DocumentController@update');
Route::patch('/document/estado/{documento}', 'DocumentController@estado');
Route::delete('/document/{documento}', 'DocumentController@destroy');


//proveedor
Route::get('/provider', 'ProviderController@index');                 //forma manual
Route::get('/provider/create', 'ProviderController@create');
Route::get('/provider/{proveedor}', 'ProviderController@show');
Route::post('/provider', 'ProviderController@store');
Route::get('/provider/{proveedor}/edit', 'ProviderController@edit');
Route::patch('/provider/{proveedor}', 'ProviderController@update');
Route::patch('/provider/estado/{proveedor}', 'ProviderController@estado');
Route::delete('/provider/{proveedor}', 'ProviderController@destroy');
 
Route::get('/Reportes', 'ReportesController@index');
Route::get('/Reportess', 'ReportesController@index2');                 //forma manual
Route::get('/Reportes/create', 'ReportesController@create');
Route::get('/Reportes/{proveedor}', 'ReportesController@show');
Route::post('/Reportes', 'ReportesController@store');
Route::get('/Reportes/{proveedor}/edit', 'ReportesController@edit');
Route::patch('/Reportes/{proveedor}', 'ReportesController@update');
Route::patch('/Reportes/estado/{proveedor}', 'ReportesController@estado');
Route::delete('/Reportes/{proveedor}', 'ReportesController@destroy');
//config
Route::get('/config', function () {
    return view('config/config');
});

//roles
Route::get('/roles', 'rolesController@index');               //forma manual
Route::get('/roles/create', 'rolesController@create');
Route::get('/roles/{rol}', 'rolesController@show');
Route::post('/roles', 'rolesController@store');
Route::get('/roles/{rol}/edit', 'rolesController@edit');
Route::patch('/roles/{rol}', 'rolesController@update');
Route::patch('/roles/estado/{rol}', 'rolesController@estado');
Route::delete('/roles/{rol}', 'rolesController@destroy');




Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
     return "Cache is cleared";
     });