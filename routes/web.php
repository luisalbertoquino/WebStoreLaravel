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

Route::get('/', 'HomeController@index')->name('home');


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
Route::get('/user', 'UserController@index')->middleware('permiso:viewuser,administrador-main'); 
Route::get('/user/create', 'UserController@create')->middleware('permiso:createuser,administrador-main'); 
Route::get('/user/{user}', 'UserController@show')->middleware('permiso:viewuser,administrador-main'); 
Route::post('/user', 'UserController@store')->middleware('permiso:updateuser,administrador-main'); 
Route::get('/user/{user}/edit', 'UserController@edit')->middleware('permiso:updateuser,administrador-main'); 
Route::patch('/user/{piola}', 'UserController@update')->middleware('permiso:updateuser,administrador-main'); 
Route::patch('/user/estado/{user}', 'UserController@estado')->middleware('permiso:updateuser,administrador-main'); 
Route::delete('/user/{usuario}', 'UserController@destroy')->middleware('permiso:downuser,administrador-main'); 


//categorias 
Route::get('/category', 'CategoryController@index')->middleware('permiso:viewcategory,administrador-main');               
Route::get('/category/create', 'CategoryController@create')->middleware('permiso:createcategory,administrador-main'); 
Route::get('/category/{categoria}', 'CategoryController@show')->middleware('permiso:viewcategory,administrador-main'); 
Route::post('/category', 'CategoryController@store')->middleware('permiso:updatecategory,administrador-main'); 
Route::get('/category/{categoria}/edit', 'CategoryController@edit')->middleware('permiso:updatecategory,administrador-main'); 
Route::patch('/category/{categoria}', 'CategoryController@update')->middleware('permiso:updatecategory,administrador-main'); 
Route::patch('/category/estado/{categoria}', 'CategoryController@estado')->middleware('permiso:updatecategory,administrador-main'); 
Route::delete('/category/{categoria}', 'CategoryController@destroy')->middleware('permiso:downcategory,administrador-main'); 
 
//Productos 
//Route::resource('/product','ProductController')->middleware('can:isAdmin');   //forma rapida
Route::get('/product', 'ProductController@index')->middleware('permiso:viewproduct,administrador-main'); 
Route::get('/product/create', 'ProductController@create')->middleware('permiso:createproduct,administrador-main'); 
Route::get('/product/{productos}', 'ProductController@show')->middleware('permiso:viewproduct,administrador-main'); 
Route::post('/product', 'ProductController@store')->middleware('permiso:updateproduct,administrador-main'); 
Route::get('/product/{productos}/edit', 'ProductController@edit')->middleware('permiso:updateproduct,administrador-main'); 
Route::patch('/product/{producto}', 'ProductController@update')->middleware('permiso:updateproduct,administrador-main'); 
Route::patch('/product/estado/{productos}', 'ProductController@estado')->middleware('permiso:updateproduct,administrador-main'); 
Route::delete('/product/{productos}', 'ProductController@destroy')->middleware('permiso:downproduct,administrador-main'); 



//Ventas
Route::get('/sale', 'SaleController@index')->middleware('permiso:viewsale,administrador-main'); 
Route::get('/sale/create', 'SaleController@create')->middleware('permiso:createsale,administrador-main'); 
Route::get('/sale/{venta}', 'SaleController@show')->middleware('permiso:viewsale,administrador-main'); 
Route::post('/sale', 'SaleController@store')->middleware('permiso:updatesale,administrador-main'); 
Route::get('/sale/{venta}/edit', 'SaleController@edit')->middleware('permiso:updatesale,administrador-main'); 
Route::patch('/sale/{venta}', 'SaleController@update')->middleware('permiso:updatesale,administrador-main'); 
Route::patch('/sale/estado/{venta}', 'SaleController@estado')->middleware('permiso:updatesale,administrador-main'); 
Route::delete('/sale/{venta}', 'SaleController@destroy')->middleware('permiso:downsale,administrador-main'); 

 
//Compras
Route::get('/shopping', 'ShoppingController@index')->middleware('permiso:viewpurchase,administrador-main'); 
Route::get('/shopping/create', 'ShoppingController@create')->middleware('permiso:createpurchase,administrador-main'); 
Route::get('/shopping/{compra}', 'ShoppingController@show')->middleware('permiso:viewpurchase,administrador-main'); 
Route::post('/shopping', 'ShoppingController@store')->middleware('permiso:updatepurchase,administrador-main'); 
Route::get('/shopping/{compra}/edit', 'ShoppingController@edit')->middleware('permiso:updatepurchase,administrador-main'); 
Route::patch('/shopping/{compra}', 'ShoppingController@update')->middleware('permiso:updatepurchase,administrador-main'); 
Route::patch('/shopping/estado/{compra}', 'ShoppingController@estado')->middleware('permiso:updatepurchase,administrador-main'); 
Route::delete('/shopping/{compra}', 'ShoppingController@destroy')->middleware('permiso:downpurchase,administrador-main'); 

//Clientes
Route::get('/client', 'ClientController@index')->middleware('permiso:viewcustomer,administrador-main'); 
Route::get('/client/create', 'ClientController@create')->middleware('permiso:createcustomer,administrador-main'); 
Route::get('/client/{cliente}', 'ClientController@show')->middleware('permiso:viewcustomer,administrador-main'); 
Route::post('/client', 'ClientController@store')->middleware('permiso:updatecustomer,administrador-main'); 
Route::get('/client/{cliente}/edit', 'ClientController@edit')->middleware('permiso:updatecustomer,administrador-main'); 
Route::patch('/client/{cliente}', 'ClientController@update')->middleware('permiso:updatecustomer,administrador-main'); 
Route::patch('/client/estado/{cliente}', 'ClientController@estado')->middleware('permiso:updatecustomer,administrador-main'); 
Route::delete('/client/{cliente}', 'ClientController@destroy')->middleware('permiso:downcustomer,administrador-main'); 

//documento
Route::get('/document', 'DocumentController@index')->middleware('permiso:viewdocument,administrador-main'); 
Route::get('/document/create', 'DocumentController@create')->middleware('permiso:createdocument,administrador-main'); 
Route::get('/document/{documento}', 'DocumentController@show')->middleware('permiso:viewdocument,administrador-main'); 
Route::post('/document', 'DocumentController@store')->middleware('permiso:updatedocument,administrador-main'); 
Route::get('/document/{documento}/edit', 'DocumentController@edit')->middleware('permiso:updatedocument,administrador-main'); 
Route::patch('/document/{documento}', 'DocumentController@update')->middleware('permiso:updatedocument,administrador-main'); 
Route::patch('/document/estado/{documento}', 'DocumentController@estado')->middleware('permiso:updatedocument,administrador-main'); 
Route::delete('/document/{documento}', 'DocumentController@destroy')->middleware('permiso:downdocument,administrador-main'); 


//proveedor
Route::get('/provider', 'ProviderController@index')->middleware('permiso:viewsupplier,administrador-main'); 
Route::get('/provider/create', 'ProviderController@create')->middleware('permiso:createsupplier,administrador-main'); 
Route::get('/provider/{proveedor}', 'ProviderController@show')->middleware('permiso:viewsupplier,administrador-main'); 
Route::post('/provider', 'ProviderController@store')->middleware('permiso:updatesupplier,administrador-main'); 
Route::get('/provider/{proveedor}/edit', 'ProviderController@edit')->middleware('permiso:updatesupplier,administrador-main'); 
Route::patch('/provider/{proveedor}', 'ProviderController@update')->middleware('permiso:updatesupplier,administrador-main'); 
Route::patch('/provider/estado/{proveedor}', 'ProviderController@estado')->middleware('permiso:updatesupplier,administrador-main'); 
Route::delete('/provider/{proveedor}', 'ProviderController@destroy')->middleware('permiso:downsupplier,administrador-main'); 
 //reportes
Route::get('/Reportes', 'ReportesController@index')->middleware('permiso:viewreports,administrador-main'); 
Route::get('/Reportess', 'ReportesController@index2')->middleware('permiso:viewreports,administrador-main');                 
Route::get('/Reportes/create', 'ReportesController@create')->middleware('permiso:createreports,administrador-main'); 
Route::get('/Reportes/{proveedor}', 'ReportesController@show')->middleware('permiso:viewreports,administrador-main'); 
Route::post('/Reportes', 'ReportesController@store')->middleware('permiso:updatereports,administrador-main'); 
Route::get('/Reportes/{proveedor}/edit', 'ReportesController@edit')->middleware('permiso:updatereports,administrador-main'); 
Route::patch('/Reportes/{proveedor}', 'ReportesController@update')->middleware('permiso:updatereports,administrador-main'); 
Route::patch('/Reportes/estado/{proveedor}', 'ReportesController@estado')->middleware('permiso:updatereports,administrador-main'); 
Route::delete('/Reportes/{proveedor}', 'ReportesController@destroy')->middleware('permiso:downreports,administrador-main'); 

//config
Route::get('/Bussiness', 'BussinessController@index')->middleware('permiso:operationalvariables,administrador-main'); 
Route::get('/Bussiness2', 'BussinessController@index2')->middleware('permiso:operationalvariables,administrador-main');                 
Route::get('/Bussiness/create', 'BussinessController@create')->middleware('permiso:createreports,administrador-main');
Route::get('/Bussiness2/create', 'BussinessController@create2')->middleware('permiso:createreports,administrador-main');  
Route::get('/Bussiness/{config}', 'BussinessController@show')->middleware('permiso:operationalvariables,administrador-main'); 
Route::post('/Bussiness', 'BussinessController@store')->middleware('permiso:operationalvariables,administrador-main');
Route::post('/Bussiness2', 'BussinessController@store2')->middleware('permiso:operationalvariables,administrador-main');  
Route::get('/Bussiness/{config}/edit', 'BussinessController@edit')->middleware('permiso:operationalvariables,administrador-main'); 
Route::get('/Bussiness2/{config}/edit', 'BussinessController@edit2')->middleware('permiso:operationalvariables,administrador-main'); 
Route::patch('/Bussiness/{config}', 'BussinessController@update')->middleware('permiso:operationalvariables,administrador-main'); 
Route::patch('/Bussiness2/{config}', 'BussinessController@update2')->middleware('permiso:operationalvariables,administrador-main'); 
Route::patch('/Bussiness/estado/{config}', 'BussinessController@estado')->middleware('permiso:operationalvariables,administrador-main'); 
Route::delete('/Bussiness/{config}', 'BussinessController@destroy')->middleware('permiso:operationalvariables,administrador-main'); 
//config
Route::get('/config', function () {
    return view('config/config');
});

//roles
Route::get('/roles', 'rolesController@index')->middleware('permiso:viewrol,administrador-main');           
Route::get('/roles/create', 'rolesController@create')->middleware('permiso:createrol,administrador-main');
Route::get('/roles/{rol}', 'rolesController@show')->middleware('permiso:viewrol,administrador-main');
Route::post('/roles', 'rolesController@store')->middleware('permiso:updaterol,administrador-main');
Route::get('/roles/{rol}/edit', 'rolesController@edit')->middleware('permiso:updaterol,administrador-main');
Route::patch('/roles/{rol}', 'rolesController@update')->middleware('permiso:updaterol,administrador-main');
Route::patch('/roles/estado/{rol}', 'rolesController@estado')->middleware('permiso:updaterol,administrador-main');
Route::delete('/roles/{rol}', 'rolesController@destroy')->middleware('permiso:downrol,administrador-main');


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
     return "Cache is cleared";
     });