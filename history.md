Class-12:

## Crear un CRUD - Actualizar Usuarios.
### Se agrega el link en la tabla de usuario
&lt;td&gt;{!! link_to_route('usuario.edit', $title = 'Editar', $parameters = $user-&gt;id, $attributes = ['class' =&gt; 'btn btn-primary']) !!}&lt;/td&gt;  

### Creamos la vista editar
Ruta: resource/views/usuario/edit.blade.php

### Utilizamos el modelo User de forma global
use Cinema\User;  
Cambiamos la siguiente estructura de codigo:  
$users = \Cinema\User::All(); -&gt; $users = User::All();  
\Cinema\User::create([  
            'name'      =&gt; $request['name'],  
            'email'     =&gt; $request['email'],  
            'password'  =&gt; bcrypt($request['password']),  
        ]);  

User::create([  
            'name'      =&gt; $request['name'],  
            'email'     =&gt; $request['email'],  
            'password'  =&gt; bcrypt($request['password']),  
        ]);  

### Obtenemos los datos del usuario segun $id en el controlador
public function edit($id)  
    {  
        $user = User::find($id);  
        return view('usuario.edit', ['user' =&gt; $user]);  
    }  

### Copiamos el contenido de la vista create y creamos la vista edit
####Cambios:
open -&gt model  
usuario.store -&gt usuario.update  
method =&gt POST -&gt method =&gt PUT    

@extends('layouts.admin')  
@section('content')  
    {!! Form::model($user,['route' =&gt; ['usuario.update', $user-&gt;id], 'method' =&gt; 'PUT']) !!}  
    &lt;div class="form-group"&gt;  
        {!! Form::label('Nombre: ') !!}  
        {!! Form::text('name', null,['class' =&gt; 'form-control', 'placeholder' =&gt; 'Nombre del usuario']) !!}  
    &lt;/div&gt;  
    &lt;div class="form-group"&gt;  
        {!! Form::label('Correo: ') !!}  
        {!! Form::text('email', null,['class' =&gt; 'form-control', 'placeholder' =&gt; 'Correo del usuario']) !!}  
    &lt;/div&gt;  
    &lt;div class="form-group"&gt;  
        {!! Form::label('Password: ') !!}  
        {!! Form::password('password', ['class'=&gt;'form-control', 'placeholder'=&gt;'Password del Usuario']) !!}  
    &lt;/div&gt;  
    {!! Form::submit('Actualizar',['class'=&gt; 'btn btn-primary']) !!}  
    {!! Form::close() !!}  
@endsection  

## Optimizar la vista para no repetir codigo
#### Creamos una nueva carpeta en la vista usuario - forms - usr.blade.php
#### Con el siguiente codigo:
&lt;div class="form-group"&gt;  
        {!! Form::label('Nombre: ') !!}  
        {!! Form::text('name', null,['class' =&gt; 'form-control', 'placeholder' =&gt; 'Nombre del usuario']) !!}  
    &lt;/div&gt;  
    &lt;div class="form-group"&gt;  
        {!! Form::label('Correo: ') !!}  
        {!! Form::text('email', null,['class' =&gt; 'form-control', 'placeholder' =&gt; 'Correo del usuario']) !!}  
    &lt;/div&gt;  
    &lt;div class="form-group"&gt;  
        {!! Form::label('Password: ') !!}  
        {!! Form::password('password', ['class'=&gt;'form-control', 'placeholder'=&gt;'Password del Usuario']) !!}  
    &lt;/div&gt;  

### Cambios en la vista create de usuario
#### Quitamos el codigo blade, pero lo incluimos desde usr.blade.php
@extends('admin.index')  
@section('content')  
    {!! Form::open(['route' =&gt; 'usuario.store', 'method'=&gt;'POST']) !!}  
    @include('usuario.forms.usr')  
    {!! Form::submit('Registrar',['class'=&gt; 'btn btn-primary']) !!}  
    {!! Form::close() !!}  
@endsection()  

### Cambios en la vista edit de usuario
#### Quitamos el codigo blade, pero lo incluimos desde usr.blade.php
@extends('admin.index')  
@section('content')  
    {!! Form::model($user,['route' =&gt; ['usuario.update', $user-&gt;id], 'method' =&gt; 'PUT']) !!}  
    @include('usuario.forms.usr')  
    {!! Form::submit('Actualizar',['class'=&gt; 'btn btn-primary']) !!}  
    {!! Form::close() !!}  
@endsection()  

### Creamos una funcion para seterar el password
Ruta: app/User.php
#### Se utiliza el funcion hash para encriptar el password
 public function setPasswordAttribute($valor){  
        if(!empty($valor)){  
            $this->attributes['password'] = \Hash::make($valor);  
        }  
    }  

### En UsuarioController.php 
#### En la funcion store cambiamos el siguiente codigo:
'password'  =&gt; bcrypt($request['password']) =&gt; 'password'  => $request['password']  


### Para hacer uso del redirect y session
#### Llamamos a los elementos desde el controlador:
Metodo largo:  
use Illuminate\Support\Facades\Redirect;  
use Illuminate\Support\Facades\Session;  
Metodo corto:  
use Session;  
use Redirect;  
Nota: cualquiera de los dos metodos funciona yo hago uso del metodo largo.  


#### En la funcion 'update' agregamos el siguiente codigo:
public function update(Request $request, $id)  
    {  
        $user = User::find($id);  
        $user-&gt;fill($request-&gt;all());  
        $user-&gt;save();  
        /* Redirecciona a usuario y retornar un mensaje */  
        Session::flash('message', 'Usuario deditado correctamente');  
        return Redirect::to('/usuario');  
    }  
    
    
### Modificamos el index
#### Agregamos el mensaje qie pasara por la session
@extends('layouts.admin')
@if(Session::has('message'))
    &lt;div class="alert alert-success alert-dismissible" role="alert"&gt;
    &lt;button type="button" class="close" data-dismiss="alert" aria-label="Close"&gt;&lt;span aria-hidden="true"&gt;&times;&lt;/span&gt;&lt;/button&gt;
    {{Session::get('message')}}
    &lt;/div&gt;
@endif


@section('content')
    &lt;table class="table"&gt;
    &lt;thead&gt;
    &lt;th&gt;Nombre&lt;/th&gt;
    &lt;th&gt;Correo&lt;/th&gt;
    &lt;th&gt;Operaciones&lt;/th&gt;
    &lt;/thead&gt;
    @foreach($users as $user)
        &lt;tbody&gt;
        &lt;td&gt;{{$user-&gt;name}}&lt;/td&gt;
        &lt;td&gt;{{$user-&gt;email}}&lt;/td&gt;
        &lt;td&gt;{!! link_to_route('usuario.edit', $title = 'Editar', $parameters = $user-&gt;id, $attributes = ['class' =&gt; 'btn btn-primary']) !!}&lt;/td&gt;
        &lt;/tbody&gt;
    @endforeach
    &lt;/table&gt;
@endsection
    