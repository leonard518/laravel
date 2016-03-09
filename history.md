Class-20:

## Crear con Ajax
### Creamos el controlador Genero desde artisan
php artisan make:controller GeneroController  
#### Creamos la ruta en routes.php
Route::resource('genero', 'GeneroController');  

### Creamos las vistas:
#### Creamos las siguientes carpetas en views - genero\form 
#### Creamos el archivo genero.blade.php
&lt;div class="form-group"&gt;  
    {!! Form::label('genre', 'Nombre: ') !!}  
    {!! Form::text('genre', null, ['id'=&gt;'genre', 'class'=&gt;'form-control', 'placeholder'=&gt;'Ingresa el nombre']) !!}  
&lt;/div&gt;  

### Configurar la vista create.blade.php
@extends('layouts.admin')  
    &lt;div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display: none"&gt;
            &lt;button type="button" class="close" data-dismiss="alert" aria-label="Close"&gt;&lt;span aria-hidden="true"&gt;&times;&lt;/span&gt;&lt;/button&gt;
            &lt;strong&gt;Genero Agregado Correctamente.&lt;/strong&gt;
        &lt;/div&gt;
    @section('content')  
        {!! Form::open() !!}  
            @include('genero.form.genero')  
            {!! link_to('#', $title = 'Registrar', $attributes = ['id'=&gt;'registro', 'class'=&gt;'btn btn-primary']) !!}  
        {!! Form::close() !!}  
    @endsection()  


### Creamos el archivo script.js en public\js
### Contenido del archivo
$("#registro").click(function(){  
    var dato = $("#genre").val();  
    var route = "http://localhost:8000/genero";  
    var token = $("#token").val();  

    $.ajax({  
        url:        route,  
        headers:    {'X-CSRF-TOKEN':token},  
        type:       'POST',  
        dataType:   'json',  
        data:       {genre: dato},  

        success:function(){  
            $("#msj-success").fadeIn();  
            $("#genre").val("");  
        }  
    });  
});  

#### Agregamos el link en el layouts de admin
{!! Html::script('js/script.js') !!}


### En el modelo indicamos los elementos que pueden ser insertados
protected $fillable = ['genre'];  


### En el controlador GeneroController se agrega lo siguiente:
#### Indicamos el modelo a usar
use Cinema\Genre;
#### La funcion create indicamos la vista a usar
public function create()  
{  
    return view('genero.create');  
}  
#### La funcion store preguntamos si se hace uso del ajax
public function store(Request $request)  
    {  
        if($request-&gt;ajax()){  
            Genre::create($request-&gt;all());  
            return response()-&gt;json([  
                "mensaje" =&gt; 'Genero Creado'  
            ]);  
        }  
    }  