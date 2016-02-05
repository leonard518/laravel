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

Route::get('prueba', function(){
    return "Hola desde routes.php";
});

/* Rutas con parametros*/
Route::get('nombre/{nombre}', function($nombre){
    return "Mi nombre es: ".$nombre;
});

/* Rutas con parametros y parametro asignado*/
Route::get('edad/{edad vc ffcv f  fcv bfcv bbfcv b}', function(edad = 20){
    return "Mi edad es: ".edad;
});

Route::get('/', function () {
    return view('welcome');
});
