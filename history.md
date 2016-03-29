Class-22:

## Actualizar con Ajax
### Agregamos una sub-vista en el index de genero, el alert de notificaciones y el script2.js
@extends('layouts.admin')  
@section('content')  
    @include('genero.modal')  
    &lt;div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display: none"&gt;  
        &lt;button type="button" class="close" data-dismiss="alert" aria-label="Close"&gt;&lt;span aria-hidden="true"&gt;&times;&lt;/span&gt;&lt;/button&gt;  
        &lt;strong&gt;¡¡¡Genero Actualizado Exitosamente!!!&lt;/strong&gt;  
    &lt;/div&gt;  
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

### Creamos el fomulario para actualizar en genero.form.genero
&lt;div class="form-group"&gt;  
    {!! Form::label('genre', 'Nombre: ') !!}  
    {!! Form::text('genre', null, ['id'=&gt;'genre', 'class'=&gt;'form-control', 'placeholder'=&gt;'Ingresa el nombre']) !!}  
&lt;/div&gt;  

### Creamo el modal para actualizar el genero 
&lt;div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"&gt;  
    &lt;div class="modal-dialog" role="document"&gt;  
        &lt;div class="modal-content"&gt;  
            &lt;div class="modal-header"&gt;  
                &lt;button type="button" class="close" data-dismiss="modal" aria-label="Close"&gt;&lt;span aria-hidden="true"&gt;&times;&lt;/span&gt;&lt;/button&gt;  
                &lt;h4 class="modal-title" id="myModalLabel"&gt;Actualizar Genero&lt;/h4&gt;  
            &lt;/div&gt;  
            &lt;div class="modal-body"&gt;  

                &lt;input type="hidden" name="_token" value="{{ csrf_token() }}" id="token"&gt;  
                &lt;input type="hidden" id="id"&gt;  
                @include('genero.form.genero')  
            &lt;/div&gt;  
            &lt;div class="modal-footer"&gt;  
                {!!link_to('#', $title='Actualizar', $attributes = ['id'=&gt;'actualizar', 'class'=&gt;'btn btn-primary'], $secure = null)!!}  
            &lt;/div&gt;  
        &lt;/div&gt;  
    &lt;/div&gt;  
&lt;/div&gt;  

### Creamos el archivo script2.js
// Preguntamos si el documento esta listo  
$(document).ready(function(){  
   Carga();  
});  

function Carga(){  
    // Id de la tabla index  
    var tablaDatos = $("#datos");  
    // La ruta para acceder a la informacion  
    var route = "http://localhost:8000/generos";  

    // Limpiamos #datos  
    $("#datos").empty();  
    // La peticion ajax method GET, Obtenemos una respuesta  
    $.get(route, function(res){  
        // Recorremos el arreglo res = respuesta  
        $(res).each(function (key, value) {  
            // Listamos los generos recibidos y con append lo agregamos a la tabla  
            tablaDatos.append("&lt;tr&gt;&lt;td&gt;"+value.genre+"&lt;/td&gt;&lt;td&gt;&lt;button value="+value.id+" OnClick='Mostrar(this);' class='btn btn-primary' data-toggle='modal' data-target='#myModal'&gt;Editar&lt;/button&gt;&lt;button class='btn btn-danger' value="+value.id+" OnClick='Eliminar(this);'&gt;Eliminar&lt;/button&gt;&lt;/td&gt;&lt;/tr&gt;");  
        })  
    });  
};  

function Mostrar(btn){    
    var route = "http://localhost:8000/genero/"+btn.value+"/edit";  

    $.get(route, function(res){  
        $('#genre').val(res.genre);  
        $('#id').val(res.id);  
    });  
}  

$('#actualizar').click(function(){  
    var value = $('#id').val();  
    var dato = $('#genre').val();  
    var route = "http://localhost:8000/genero/"+value+"";  
    var token = $('#token').val();  

    $.ajax({  
        url: route,  
        headers: {'X-CSRF-TOKEN': token},  
        type: 'PUT',  
        dataType: 'json',  
        data                                                                    : {genre: dato},  
        success: function () {  
            Carga();  
            $("#myModal").modal('toggle');  
            $("#msj-success").fadeIn();  
        }  
    });  
})  