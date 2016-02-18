<div class="form-group">
    {!! Form::label('Nombre: ') !!}
    {!! Form::text('name', null,['class' => 'form-control', 'placeholder' => 'Nombre del usuario']) !!}
</div>
<div class="form-group">
    {!! Form::label('Correo: ') !!}
    {!! Form::text('email', null,['class' => 'form-control', 'placeholder' => 'Correo del usuario']) !!}
</div>
<div class="form-group">
    {!! Form::label('Password: ') !!}
    {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password del Usuario']) !!}
</div>