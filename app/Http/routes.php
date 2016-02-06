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


/*
 * Ruta Basica
 */

Route::get('prueba', function(){
    return "Hola desde routes.php";
});

/*
 * Ruta Basica con parametro
 *
 * Estrutura:
 * Route: Referencia a clase
 * get: Metodo HTTP
 * 'nombre': Nombre de la url en el navegador
 * '{nombre}': parametro que recibiremos mediante la ruta
 * function($nombre): funcion rebiendo el parametro
 *
 * */

/* Rutas con parametros*/
Route::get('nombre/{nombre}', function($nombre){
    return "Mi nombre es: ".$nombre;
});

/* Rutas con parametros y parametro asignado*/
Route::get('edad2/{edad?}', function($edad = 20){
    return "Mi edad es: ".edad;
});

/*
 * Ruta a controlador
 * 'controlador': Nombre de la url en el navegador
 * 'PruebaController': el controlador
 * @index: el metodo a entrar
 * */
Route::get('controlador', 'PruebaController@index');
Route::get('nombre/{nombre}', 'PruebaController@nombre');

/*
 * Rutas resouce: esta simple ruta crea multiples rutas
 * index, create, store, show, edit,update, destroy.
 */
Route::resource('movie', 'MovieController');
Route::get('/', function () {
    return view('welcome');
});
