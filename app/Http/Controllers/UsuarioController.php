<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;
use Cinema\Http\Requests\UserCreateRequest;
use Cinema\Http\Requests\UserUpdateRequest;
use Cinema\User;
use Cinema\Http\Requests;
use Cinema\Http\Controllers\Controller;
/* Metodo largo */
//use Illuminate\Support\Facades\Redirect;
//use Illuminate\Support\Facades\Session;
/* Metodo corto */
use Session;
use Redirect;
/* Nos permite obtener parametros que se encuentran en nuestras rutas */
use Illuminate\Routing\Route;


class UsuarioController extends Controller
{
    /**
     * beforeFilters va a filtrar antes que se ejecute algo en el controlador
     * se pueden definir los metodos y en cuales quieres que se ejecute
     */
    public function __construct()
    {
        $this->beforeFilter('@find', ['only'=>['edit', 'update', 'destroy']]);
    }
    /*
     * Hacemos uso de la clase Route la cual nos permite obtener los parametros de la ruta
     * */
    public function find(Route $route){
        $this->user = User::find($route->getParameter('usuario'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Trae la informa del modelo User*/
        $users = User::paginate(5);
        return view('usuario.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        /* Cargar el modelo usaurio */
        User::create($request->all());
        /* Redirecciona a usuario y retornar un mensaje para nosotros */
        Session::flash('message', 'Usuario Creado correctamente');
        return Redirect::to('/usuario');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('usuario.edit', ['user' => $this->user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $this->user->fill($request->all());
        $this->user->save();

        /* Redirecciona a usuario y retornar un mensaje */
        Session::flash('message', 'Usuario Editado correctamente');
        return Redirect::to('/usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->delete();
        Session::flash('message', 'Usuario Eliminado correctamente');
        return Redirect::to('/usuario');
    }
}
