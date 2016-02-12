@extends('layouts.admin')
{{-- Mesaje por la sesion --}}
<?php $message = Session::get('message') ?>

@if($message == 'store')
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Usuario creado <strong>Exitosamente!!!</strong>
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
        </tbody>
            @endforeach
    </table>
@endsection