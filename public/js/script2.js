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
            tablaDatos.append("<tr><td>"+value.genre+"</td><td><button value="+value.id+" OnClick='Mostrar(this);' class='btn btn-primary' data-toggle='modal' data-target='#myModal'>Editar</button><button class='btn btn-danger' value="+value.id+" OnClick='Eliminar(this);'>Eliminar</button></td></tr>");
        })
    });
};

function Eliminar(btn) {
    var route = "http://localhost:8000/genero/"+btn.value+"";
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

function Mostrar(btn){
    //console.log(btn.value);
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
        data: {genre: dato},
        success: function () {
            Carga();
            $("#myModal").modal('toggle');
            $("#msj-success").fadeIn();
        }
    });
})