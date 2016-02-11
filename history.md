Class-09:

## Crear un CRUD - Crear Usuario.
### Crear UsuarioController
php artisan make:controller UsuarioController

### Crear Ruta RESTful para el controlador 
Route::resource('usuario', 'UsuarioController');

### Agregar el componente Laravel Collective 5.1
Url: <https://laravelcollective.com/docs/5.1/html>
#### Agregar en el arreglo Providers:
Collective\Html\HtmlServiceProvider::class,
#### Agregar en el arreglo Aliases:
'Form' => Collective\Html\FormFacade::class,
'Html' => Collective\Html\HtmlFacade::class,

### Agregar style
&lt;link href="css/bootstrap.min.css" rel="stylesheet"&gt;  ===>> {!! Html::style('css/bootstrap.min.css') !!}

### Agregar Script
&lt;script src="js/jquery.min.js"></script&gt;  ===>> {!! Html::script('js/jquery.min.js') !!}

### Crear un formulario con LaravelCollective
@extends('admin.index')
@section('content')
    {!! Form::open(['route' => 'usuario.store', 'method'=>'POST']) !!}
    &lt;div class="form-group"&gt;
        {!! Form::label('Nombre: ') !!}
        {!! Form::text('name', null,['class' => 'form-control', 'placeholder' => 'Nombre del usuario']) !!}
    &lt;/div&gt;
    &lt;div class="form-group">
        {!! Form::label('Correo: ') !!}
        {!! Form::text('email', null,['class' => 'form-control', 'placeholder' => 'Correo del usuario']) !!}
    &lt;/div&gt;
    &lt;div class="form-group"&gt;
        {!! Form::label('Password: ') !!}
        {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password del Usuario']) !!}
    &lt;/div>
    {!! Form::submit('Registrar',['class'=> 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection()

### Uso de Request en el controlador
public function store(Request $request)
    {
        /* Cargar el modelo usaurio */
        \Cinema\User::create([
            'name'      => $request['name'],
            'email'     => $request['email'],
            'password'  => bcrypt($request['password']),
        ]);
        /* Retornar un mensaje para nosotros */
        return "Usuario registrado";
    }

Nota: tener congfigurado el archivo .env