Class-18:

## Autenticacion
### Determianr que driver a utilizar database / eloquent
#### verificar el archivo config/auth.php
#### Database
Se debe indicar que tabla usar:  
'table' => 'users'

#### Eloquent
Se debe indicar que modelo usar:  
'model' => 'eloquent'

### Creamos el controlador LogController
php artisan make:controller LogController

### Creamos el Request LoginRequest
php artisan make:request LoginRequest

### Creamos la ruta para LogController
Route::resource('log', 'LogController');

### En el index redireccionamos el formulario a la ruta de LogController
{!! Form::open(['route' =&gt; 'log.store', 'method'=&gt; 'POST']) !!}  
&lt;div class="form-group"&gt;  
{!! Form::label('correo', 'Correo:') !!}  
{!! Form::email('email', null, ['class' =&gt; 'form-control', 'placeholder' =&gt;'Ingresa tu correo']) !!}  
&lt;/div&gt;  
&lt;div class="form-group"&gt;  
{!! Form::label('contrasena', 'Contraseña:') !!}  
{!! Form::password('password', ['class' =&gt; 'form-control', 'placeholder' =&gt;'Ingresa tu contraseña']) !!}  
&lt;/div&gt;  
{!! Form::submit('Iniciar', ['class' =&gt; 'btn btn-primary']) !!}  
{!! Form::close() !!}  

### LogController 
#### Clases a usar:
#### Clase LoginRequest, para utilizar las reglas de validacion   
use Cinema\Http\Requests\LoginRequest;  
#### Clase Redirect, para rdireccionar   
use Redirect;  
#### Clase Session, para manejo de sesioes en la app   
use Session;  
#### Clase Auth, el cual autentificara los datos necesarios   
use Auth;  

#### Agregamos los parametros a la clase store
public function store(LoginRequest $request)  
{  
    if(Auth::attempt(  
        [  
            'email'     =&gt;   $request['email'],  
            'password'  =&gt;   $request['password']  
        ])){  
        return Redirect::to('admin');  
    }  
    Session::flash('message-error', 'Datos incorrectos');  
    return Redirect::to('/');  
}  

#### Creamos un nuevo alert errors
@if(Session::has('message-error'))  
    &lt;  div class="alert alert-danger alert-dismissible" role="alert"&gt;  
        &lt;  button type="button" class="close" data-dismiss="alert" aria-label="Close"&gt;  &lt;  span aria-hidden="true"&gt;  &times;&lt;  /span&gt;  &lt;  /button&gt;  
        {{Session::get('message-error')}}  
    &lt;  /div&gt;  
@endif  
#### Lo incluimos en el index
@include('alerts.errors')  

### Agregamos el nombre del usuario en el layout admin
{!! Auth::user()-&gt;  name !!}&lt;  i class="fa fa-user fa-fw"&gt;  &lt;  /i&gt;    &lt;  i class="fa fa-caret-down"&gt;  &lt;  /i&gt;  

### Creamos una ruta nueva
Route::get('logout', 'LogController@logout');  

### Creamos el metodo logout en el controlador LogController
public function logout(){  
        Auth::logout();  
        return Redirect::to('/');  
    }  

### Agregamos la ruta en la vista admin para cerrar sesion
&lt;  a href="{!! URL::to('/usuario') !!}"&gt;  &lt;  i class='fa fa-list-ol fa-fw'&gt;  &lt;  /i&gt;   Usuarios&lt;  /a&gt;  

### Agregamos las reglas en LoginRequest
public function rules()  
{  
    return [  
        'email'     =&gt;   'required|email',  
        'password'  =&gt;   'required'  
    ];  
}  

### Agregamos el alert al index 
@include('alerts.request')  