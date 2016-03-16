Class-21:

## Leer con Ajax
### Cramos la vista index para genero
@extends('layouts.admin')  
@section('content')  
    &lt;table class="table"&gt;  
        &lt;thead&gt;  
        &lt;th&gt;Nombre&lt;/th&gt;  
        &lt;th&gt;Operaciones&lt;/th&gt;  
        &lt;/thead&gt;  
        &lt;tbody id="datos"&gt;&lt;/tbody&gt;  
    &lt;/table&gt;  
@endsection()  
@section('scripts')  
    {!! Html::script('js/script2.js') !!}  
@endsection  

### Preparacion del ajax para listar los datos:
#### En el layouts admin agregamos una seccion para los scripts
@section('scripts')  
@show  

#### Creamos el archivo js para script2.js
// Preguntamos si el documento esta listo  
$(document).ready(function(){  
   // Id de la tabla index  
   var tablaDatos = $("#datos");  
   // La ruta para acceder a la informacion  
   var route = "http://localhost:8000/generos";  

   // La peticion ajax method GET, Obtenemos una respuesta  
   $.get(route, function(res){  
      // Recorremos el arreglo res = respuesta  
      $(res).each(function (key, value) {  
         // Listamos los generos recibidos con append lo agregamos a la tabla  
         tablaDatos.append("&lt;tr&gt;&lt;td&gt;"+value.genre+"&lt;/td&gt;&lt;td&gt;&lt;button class='btn btn-primary'&gt;Editar&lt;/button&gt;&lt;button class='btn btn-danger'&gt;Eliminar&lt;/button&gt;&lt;/td&gt;&lt;/tr&gt;")   
      })  
   });  
});  

#### Creamos la nueva ruta en routes.php
// La ruta para el ajax  
Route::get('generos', 'GeneroController@listing');  