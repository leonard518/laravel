Class-09:

## Crear un CRUD - Leer Usuarios.
### Index UsuarioController
public function index()
    {
        /* Trae la informa del modelo  User*/
        $users = \Cinema\User::All();
        return view('usuario.index', compact('users'));
    }

public function store(Request $request)
    {
        /* Cargar el modelo usaurio */
        \Cinema\User::create([
            'name'      => $request['name'],
            'email'     => $request['email'],
            'password'  => bcrypt($request['password']),
        ]);
        /* Redirecciona a usuario y retornar un mensaje para nosotros */
        return redirect('/usuario')->with('message','store');
    }


### Creamos la vista usuario/index
Ruta:resource/views/usuario/
se crea el archivo index.blade.php

@extends('layouts.admin')
{{-- Mesaje por la sesion --}}
&lt;?php $message = Session::get('message') ?>

@if($message == 'store')
    &lt;div class="alert alert-success alert-dismissible" role="alert">
        &lt;button type="button" class="close" data-dismiss="alert" aria-label="Close">&lt;span aria-hidden="true">&times;&lt;/span>&lt;/button>
        Usuario creado &lt;strong>Exitosamente!!!&lt;/strong>
    &lt;/div>
@endif

@section('content')
    &lt;table class="table">
        &lt;thead>
            &lt;th>Nombre&lt;/th>
            &lt;th>Correo&lt;/th>
            &lt;th>Operaciones&lt;/th>
        &lt;/thead>
        @foreach($users as $user)
        &lt;tbody>
            &lt;td>{{$user->name}}&lt;/td>
            &lt;td>{{$user->email}}&lt;/td>
        &lt;/tbody>
            @endforeach
    &lt;/table>
@endsection

