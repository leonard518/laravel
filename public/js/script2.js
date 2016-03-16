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
         tablaDatos.append("<tr><td>"+value.genre+"</td><td><button class='btn btn-primary'>Editar</button><button class='btn btn-danger'>Eliminar</button></td></tr>")
      })
   });
});