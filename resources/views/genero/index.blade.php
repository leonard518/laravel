@extends('layouts.admin')
@section('content')
    @include('genero.modal')
    <div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>¡¡¡Genero Actualizado Exitosamente!!!</strong>
    </div>
    <table class="table">
        <thead>
        <th>Nombre</th>
        <th>Operaciones</th>
        </thead>
        <tbody id="datos"></tbody>
    </table>
@endsection()
@section('scripts')
    {!! Html::script('js/script2.js') !!}
@endsection
