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

Route::get('/', 'TestController@welcome');

Route::get('/prueba', function(){
	


	return 'Hola soy una ruta de prueba';
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show'); 
Route::get('/categories/{category}', 'CategoryController@show');

Route::get('/search', 'SearchController@show');

Route::post('/cart', 'CartDetailController@store');
Route::delete('/cart', 'CartDetailController@destroy');

Route::post('/order', 'CartController@update');


Route::middleware(['auth','admin'])->namespace('Admin')->group(function () {
   	Route::get('/admin/products','ProductController@index'); //lista de productos 
	Route::get('/admin/products/create','ProductController@create'); //crear nuevos productos formulario
	Route::post('/admin/products','ProductController@store'); //crear registrar
	Route::get('/admin/products/{id}/edit','ProductController@edit'); //formulario para editar productos
	Route::post('/admin/products/{id}/edit','ProductController@update'); //registrar la edición de productos
	Route::post('/admin/products/{id}/delete','ProductController@destroy'); //formulario para eliminar un producto

	Route::get('admin/products/{id}/images','ImageController@index'); //muestra las imagenes que tiene un producto
	Route::post('admin/products/{id}/images','ImageController@store'); //formulario para agregar imagenes a un producto
	Route::delete('admin/products/{id}/images','ImageController@destroy'); //formulario para eliminar imagenes
	Route::get('admin/products/{id}/images/select/{image}','ImageController@select'); //muestra las imagenes que tiene un producto

	Route::get('/admin/categories','CategoryController@index'); //listado de categorias
	Route::get('/admin/categories/create','CategoryController@create'); //formulario para crear
	Route::post('/admin/categories','CategoryController@store'); //registrar
	Route::get('/admin/categories/{category}/edit','CategoryController@edit'); //formulario para edición
	Route::post('/admin/categories/{category}/edit','CategoryController@update'); //formulario para editar
	Route::post('/admin/categories/{category}/delete','CategoryController@destroy'); //form eliminar

});



// CR
// UD

