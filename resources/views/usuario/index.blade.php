@extends('layouts.admin')
@if(Session::has('message'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('message')}}
    </div>
@endif


@section('content')
    <table class="table">
        <thead>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Operaciones</th>
        </thead>
        @foreach($users as $user)
        <tbody>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                {!! link_to_route('usuario.edit', $title = 'Editar', $parameters = $user->id, $attributes = ['class' => 'btn btn-primary']) !!}
                {!! link_to_route('usuario.destroy', $title = 'Eliminar', $parameters = $user->id, $attributes = ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Seguro en Eliminar?")']) !!}
            </td>
        </tbody>
            @endforeach
    </table>
@endsection