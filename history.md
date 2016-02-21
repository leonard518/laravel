Class-13:

## Crear un CRUD - Eliminar Usuarios.
### Para borrar un registro es necesario ir a la vista d e los datos en este caso lo haremos en la vista Edit
### Duplicamos el fomulario el archivo que daria de la siguiente manera
@extends('layouts.admin')  
@section('content')  
    {{-- Formulario editar --}}  
    {!! Form::model($user,['route' =&gt; ['usuario.update', $user-&gt;id], 'method' =&gt; 'PUT']) !!}  
    @include('usuario.forms.usr')  
    {!! Form::submit('Actualizar',['class'=&gt; 'btn btn-primary']) !!}  
    {!! Form::close() !!}  
    {{-- Formulario eliminar --}}  
    {!! Form::open(['route' =&gt; ['usuario.destroy', $user-&gt;id], 'method' =&gt; 'DELETE']) !!}  
        {!! Form::submit('Eliminar',['class'=&gt; 'btn btn-danger']) !!}  
    {!! Form::close() !!}  
@endsection  


### En el controlador UsurioController hacemos uso del modelo User y psamos el id que estamos recibiendo
public function destroy($id)
    {
        User::destroy($id);
        Session::flash('message', 'Usuario Eliminado correctamente');
        return Redirect::to('/usuario');
    }
    
### Activar las rutas correctar del panel admin
Cambios en el siguiente codigo:  
Enlace agragar:  
&lt;a href="#"&gt;&lt;i class='fa fa-plus fa-fw'&gt;&lt;/i&gt; Agregar&lt;/a&gt;  
&lt;a href="{!! URL::to('/usuario/create') !!}"&gt;&lt;i class='fa fa-plus fa-fw'&gt;&lt;/i&gt; Agregar&lt;/a&gt;
  
Enlace usuarios:    
&lt;a href="#"&gt;&lt;i class='fa fa-list-ol fa-fw'&gt;&lt;/i&gt; Usuarios&lt;/a&gt;  
&lt;a href="{!! URL::to('/usuario') !!}"&gt;&lt;i class='fa fa-list-ol fa-fw'&gt;&lt;/i&gt; Usuarios&lt;/a&gt;     