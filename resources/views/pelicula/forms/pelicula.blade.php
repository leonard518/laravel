<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Nombre de la pelicula']) !!}
</div>

<div class="form-group">
    {!! Form::label('elenco', 'Elenco:') !!}
    {!! Form::text('cast', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el elenco']) !!}
</div>

<div class="form-group">
    {!! Form::label('direccion', 'Dirección:') !!}
    {!! Form::text('direction', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el elenco']) !!}
</div>

<div class="form-group">
    {!! Form::label('duracion', 'Duración:') !!}
    {!! Form::text('duration', null, ['class' => 'form-control', 'placeholder' => 'Ingresa la duración']) !!}
</div>

<div class="form-group">
    {!! Form::label('poster', 'Poster:') !!}
    {!! Form::file('path') !!}
</div>

<div class="form-group">
    {!! Form::label('genmero', 'Genero:') !!}
    {!! Form::select('genre_id', $genres) !!}
</div>