Class-17:

## Optimizando el Proyecto
### Usuariocontroller 
#### Agregamos todos los datos recuperados para la funcion store
public function store(UserCreateRequest $request)  
    {  
        /* Cargar el modelo usaurio */  
        User::create([  
            'name'      => $request['name'],  
            'email'     => $request['email'],  
            'password'  => $request['password']  
        ]);  
        /* Redirecciona a usuario y retornar un mensaje para nosotros */  
        return redirect('/usuario')->with('message','store');  
    }  
por  
public function store(UserCreateRequest $request)  
    {  
        /* Cargar el modelo usaurio */  
        User::create($request->all());  
        /* Redirecciona a usuario y retornar un mensaje para nosotros */  
        return redirect('/usuario')->with('message','store');  
    }  
    
### Creamos un constructor beforeFilters
#### Filtra todo los datos antes que se ejecute algo en el controlador
public function __construct()  
    {  
        $this->beforeFilter('@find', ['only'=>['edit', 'update', 'destroy']]);  
    }  
### Creamos la funcion find que se menciona en el constructor
#### Hacemos uso de la clase Route la cual nos permite obtener los parametros de la ruta
public function find(Route $route){  
        $this->user = User::find($route->getParameter('usuario'));  
    }    
#### Ahora cambiamos los metodos indicados en el beforeFilter
public function edit($id)  
    {  
        $user = User::find($id);  
        return view('usuario.edit', ['user' => $user]);  
    }  
por  
public function edit($id)  
    {  
        return view('usuario.edit', ['user' => $this->user]);  
    }  

public function update(UserUpdateRequest $request, $id)  
    {  
        $user = User::find($id);  
        $user->fill($request->all());  
        $user->save();  

        /* Redirecciona a usuario y retornar un mensaje */  
        Session::flash('message', 'Usuario Editado correctamente');  
        return Redirect::to('/usuario');  
    }  
por  
public function update(UserUpdateRequest $request, $id)  
    {  
        $this->user->fill($request->all());  
        $this->user->save();  
        /* Redirecciona a usuario y retornar un mensaje */  
        Session::flash('message', 'Usuario Editado correctamente');  
        return Redirect::to('/usuario');  
    }  

public function destroy($id)  
    {  
        $user = User::find($id);  
        $user->delete();  
        Session::flash('message', 'Usuario Eliminado correctamente');  
        return Redirect::to('/usuario');  
    }  
por  
public function destroy($id)  
    {  
        $this->user->delete();  
        Session::flash('message', 'Usuario Eliminado correctamente');  
        return Redirect::to('/usuario');  
    }  


### Creamos la alerta success en views/alerts
#### success.blade.php
@if(Session::has('message'))  
    <div class="alert alert-success alert-dismissible" role="alert">  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
        {{Session::get('message')}}  
    </div>  
@endif  

#### Cambiamos el contenido del index de la vista usuario
@extends('layouts.admin')  
@if(Session::has('message'))  
    &lt;div class="alert alert-success alert-dismissible" role="alert"&gt;  
        &lt;button type="button" class="close" data-dismiss="alert" aria-label="Close"&gt;&lt;span aria-hidden="true"&gt;&times;&lt;/span&gt;&lt;/  button&gt;  
        {{Session::get('message')}}  
    &lt;/div&gt;  
@endif  
@section('content')  
    &lt;table class="table"&gt;  
        &lt;thead&gt;  
            &lt;th&gt;Nombre&lt;/th&gt;  
            &lt;th&gt;Correo&lt;/th&gt;  
            &lt;th&gt;Operaciones&lt;/th&gt;  
        &lt;/thead&gt;  
        @foreach($users as $user)  
        &lt;tbody&gt;  
            &lt;td&gt;{{$user-&gt;name}}&lt;/td&gt;  
            &lt;td&gt;{{$user-&gt;email}}&lt;/td&gt;  
            &lt;td&gt;&lt;a href="{{ route('usuario.edit', $user-&gt;id)  }}" class="btn btn-primary"&gt;&lt;span class="fa fa-edit"&gt;&lt;/span&gt;&lt;  /a&gt;&lt;/td&gt;  
        &lt;/tbody&gt;  
            @endforeach  
    &lt;/table&gt;  
    {!! $users-&gt;render() !!}  
@endsection  
por  
@extends('layouts.admin')  
@include('alerts.success')  
@section('content')  
    &lt;table class="table"&gt;  
        &lt;thead&gt;  
            &lt;th&gt;Nombre&lt;/th&gt;  
            &lt;th&gt;Correo&lt;/th&gt;  
            &lt;th&gt;Operaciones&lt;/th&gt;  
        &lt;/thead&gt;  
        @foreach($users as $user)  
        &lt;tbody&gt;  
            &lt;td&gt;{{$user-&gt;name}}&lt;/td&gt;  
            &lt;td&gt;{{$user-&gt;email}}&lt;/td&gt;  
            &lt;td&gt;&lt;a href="{{ route('usuario.edit', $user-&gt;id)  }}" class="btn btn-primary"&gt;&lt;span class="fa fa-edit"&gt;&lt;/span&gt;&lt;  /a&gt;&lt;/td&gt;  
        &lt;/tbody&gt;  
            @endforeach  
    &lt;/table&gt;  
    {!! $users-&gt;render() !!}  
@endsection  

### Cambios en el controlador de usuario
#### Para este caso lo haremos en store
public function store(UserCreateRequest $request)  
    {  
        /* Cargar el modelo usaurio */  
        User::create($request->all());  
        /* Redirecciona a usuario y retornar un mensaje para nosotros */  
        Session::flash('message', 'Usuario Editado correctamente');  
        return redirect('/usuario')->with('message','store');  
    }  
por  
public function store(UserCreateRequest $request)  
    {  
        /* Cargar el modelo usaurio */  
        User::create($request->all());  
        /* Redirecciona a usuario y retornar un mensaje para nosotros */  
        Session::flash('message', 'Usuario Editado correctamente');  
        return Redirect::to('/usuario');    
    }    
