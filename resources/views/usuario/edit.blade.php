@extends('layouts.admin')
@section('content')
    {{-- Formulario editar --}}
    {!! Form::model($user,['route' => ['usuario.update', $user->id], 'method' => 'PUT']) !!}
    @include('usuario.forms.usr')
    {!! Form::submit('Actualizar',['class'=> 'btn btn-primary']) !!}
    {!! Form::close() !!}

    {{-- Formulario eliminar --}}
    {!! Form::open(['route' => ['usuario.destroy', $user->id], 'method' => 'DELETE']) !!}
        {!! Form::submit('Eliminar',['class'=> 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection