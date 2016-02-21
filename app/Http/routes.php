<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'FrontController@index');
Route::get('contacto', 'FrontController@contacto');
Route::get('reviews', 'FrontController@reviews');
Route::get('admin', 'FrontController@admin');

Route::resource('usuario', 'UsuarioController');
/* Creamos la ruta para borrar el registo */
Route::get('usuario/{id}/destroy', [
    /* Se indica el controlador y el metodo */
    'uses'  =>  'UsuarioController@destroy',
    /* Se indica la ruta*/
    'as'    =>  'usuario.destroy'
    /* No genera conflicto con el otro metodo destroy ya que no usan el mismo metodo */
]);