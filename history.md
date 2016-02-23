Class-14:

## Validaciones.
### Crear form request validation para create y update:
php artisan make:request UserCreateRequest  
php artisan make:request UserUpdateRequest  
Nota: Los archivos estan creados en app/Http/Requests/

### Se debe autorizar el request antes de hacer uso del mismo:
public function authorize()  
    {  
        return true;  
    }  

### Creamos las reglas de validacion para create:
public function rules()  
    {  
        return [  
            'name'      => 'required',  
            'email'     => 'required',  
            'password'  => 'required'  
        ];  
    }  
    
### En el controlador debemos importar el request create
use Cinema\Http\Requests\UserCreateRequest;  

### En el controlador cambiamos el Request:
public function store(Request $request)  
por  
public function store(UserCreateRequest $request)  


### Creamos las reglas de validacion para update:
public function rules()
    {
        return [
            'name'      => 'required',
            'email'     => 'required',
        ];
    }

### En el controlador debemos importar el request create
public function update(Request $request, $id)  
por  
public function update(UserUpdateRequest $request, $id)

### Generar mensaje de error:
#### Creamos una sub-vista que se llame alerts
#### Con el archivo request.blade.php
@if(count($errors) &gt; 0)  
    &lt;div class="alert alert-danger alert-dismissible" role="alert"&gt;  
        &lt;button type="button" class="close" data-dismiss="alert" aria-label="Close"&gt;&lt;span aria-hidden="true"&gt;&times;&lt;/span&gt;&lt;/button&gt;  
        &lt;ul&gt;  
            @foreach($errors-&gt;all() as $error )  
                &lt;li&gt;{!! $error !!}&lt;/li&gt;  
            @endforeach  
        &lt;/ul&gt;  
    &lt;/div&gt;  
@endif  

### Incluimos el alert request en cada vista:
@include('alerts.request')  


### Si queremos agregar varias reglas las separamos con |
#### Ejemplo con las siguientes reglas:
public function rules()  
    {  
        return [  
            'name'      => 'required',  
            // Varias reglas son separadas por |  
            // En este caso decimos que sea unico en la tabla users   
            'email'     => 'required|unique:users',  
            'password'  => 'required'  
        ];  
    }  