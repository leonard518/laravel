Class-13-b:

## Crear un CRUD - Eliminar Usuarios desde lista.
### Para borrar un registro es necesario ir a la vista de los datos y crear un formulario, como en la rama class-13
### Pero en este caso lo haremos en la vista Usuarios 
Creamos una nueva ruta:  
Route::get('usuario/{id}/destroy', [  
    'uses'  =&gt;  'UsuarioController@destroy',  
    'as'    =&gt;  'usuario.destroy'  
]);  
Nota: No genera conflicto con la otra funcion destroy ya que no usan el mismo metodo este usua el metodo GET y la otra es DELETE

### En la vista index de admin agregar la siguiente linea en la misma etiquera &lt;td&gt;
{!! link_to_route('usuario.destroy', $title = 'Eliminar', $parameters = $user-&gt;id, $attributes = ['class' =&gt; 'btn btn-danger', 'onclick' =&gt; 'return confirm("Seguro en Eliminar?")']) !!}

