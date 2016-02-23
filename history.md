Class-15:

## Paginacion.
### Crear paginacion
#### Ir al controlador  Usuario
public function index()  
    {  
        /* Trae la informa del modelo  User*/  
        $users = User::All();  
        return view('usuario.index', compact('users'));  
    }  
por  

public function index()  
    {  
        /* Trae la informa del modelo  User*/  
        $users = User::paginate(5);  
        return view('usuario.index', compact('users'));  
    }  
    
### Renderizamos las vistas 
#### Para este caso el index de usuarios
@extends('layouts.admin')
@if(Session::has('message'))
    &lt;div class="alert alert-success alert-dismissible" role="alert"&gt;
        &lt;button type="button" class="close" data-dismiss="alert" aria-label="Close"&gt;&lt;span aria-hidden="true"&gt;&times;&lt;/span&gt;&lt;/button&gt;
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
            &lt;td&gt;&lt;a href="{{ route('usuario.edit', $user-&gt;id)  }}" class="btn btn-primary"&gt;&lt;span class="fa fa-edit"&gt;&lt;/span&gt;&lt;/a&gt;&lt;/td&gt;
        &lt;/tbody&gt;
            @endforeach
    &lt;/table&gt;
    {!! $users-&gt;render() !!}
@endsection