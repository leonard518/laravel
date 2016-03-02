Class-19:

## Middleware
### Sirve para filtrar las peticiones Http que entran en nuestra app
#### Middleware Auth
#### Declaramos el Middelware desde el controlador FrontController
public function __construct(){  
        $this-&gt;  middleware('auth',['only' =&gt;   'admin']);  
    }  
#### Declaramos el Middelware desde el controlador FrontController
public function __construct()  
    {  
        /* Protegemos el acceso a este controlador*/  
        $this-&gt;  middleware('auth');  
        /* Indicamos los accesos permitidos al usuario */  
        /*$this-&gt;  middleware('admin', ['only' =&gt;   ['create','edit']]);*/  
        $this-&gt;  middleware('admin');  
        /* Filtramo los datos antes de ejecutarse e indicamos encuales metodos seran aplicados */  
        $this-&gt;  beforeFilter('@find', ['only'=&gt;  ['edit', 'update', 'destroy']]);  
    }  

### Cambiamos la ruta del login en el Middleware/Authenticate
return redirect()-&gt;guest('auth/login');  
por   
return redirect()-&gt;guest('/');

### Crear nuestro propio Middleware
php artisan make:middleware Admin
#### Luego de crear el middleware debemos registrar el middleware en el Kernel
'admin' =&gt;   'Cinema\Http\Middleware\Admin',

### Configuramos el middleware Admin
#### Interfaz Guard, nos va a proporcionar la informacion del usuario que esta actuamente logeado
use Illuminate\Contracts\Auth\Guard;
#### Manejo de sesiones
use Session;
#### Creamos un constructor para igualar los valores
protected $auth;  
public function __construct(Guard $auth){  
$this-&gt;auth = $auth;  
}  
#### Validamos que el usuario es igual a uno
public function handle($request, Closure $next)  
{  
    if($this-&gt;  auth-&gt;  user()-&gt;  id != 1){  
        Session::flash('message-error', 'Sin Privilegios');  
        return redirect()-&gt;  to('admin');  
    }  
    return $next($request);  
}  
#### Nota: Se podria validar por el tipo de usuario que es lo mas correcto.

### Agregamos el mensaje al index del admin
@include('alerts.errors')

### Verificamos que el usuario no tenga acceso a todo el contenido
#### En la vista admin del layouts validamos el id del usuario
@if(Auth::user()-&gt;  id == 1)
&lt;  li&gt;  
    &lt;  a href="#"&gt;  &lt;  i class="fa fa-users fa-fw"&gt;  &lt;  /i&gt;   Usuario&lt;  span class="fa arrow"&gt;  &lt;  /span&gt;  &lt;  /a&gt;  
    &lt;  ul class="nav nav-second-level"&gt;  
        &lt;  li&gt;  
            &lt;  a href="{!! URL::to('/usuario/create') !!}"&gt;  &lt;  i class='fa fa-plus fa-fw'&gt;  &lt;  /i&gt;   Agregar&lt;  /a&gt;  
        &lt;  /li&gt;  
        &lt;  li&gt;  
            &lt;  a href="{!! URL::to('/usuario') !!}"&gt;  &lt;  i class='fa fa-list-ol fa-fw'&gt;  &lt;  /i&gt;   Usuarios&lt;  /a&gt;  
        &lt;  /li&gt;  
    &lt;  /ul&gt;  
&lt;  /li&gt;  
@endif