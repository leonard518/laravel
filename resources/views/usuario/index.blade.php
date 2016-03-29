@extends('layouts.admin')
    @include('alerts.success')
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
            <td><a href="{{ route('usuario.edit', $user->id)  }}" class="btn btn-primary"><span class="fa fa-edit"></span></a></td>
        </tbody>
            @endforeach
    </table>
    {!! $users->render() !!}
@endsection