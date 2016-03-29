Class-23:

## Eliminar con Ajax
### En script2 agregamos el id al boton eliminar funcion cargar
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

#### Agregamos la funcion Eliminar
function Eliminar(btn) {
    var route = "http://localhost:8000/genero/"+value+"";
    var token = $('#token').val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function () {
            Carga();
            $("#msj-success").fadeIn();
        }
    });
}
#### Optimizamos el controlador Genero
##### Verificar las modificaciones en genero controller en la rama