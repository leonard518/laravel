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



class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Trae la informa del modelo  User*/
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
        User::create([
            'name'      => $request['name'],
            'email'     => $request['email'],
            'password'  => $request['password']
        ]);
        /* Redirecciona a usuario y retornar un mensaje para nosotros */
        return redirect('/usuario')->with('message','store');
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
        $user = User::find($id);
        return view('usuario.edit', ['user' => $user]);
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
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();

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
        User::destroy($id);
        Session::flash('message', 'Usuario Eliminado correctamente');
        return Redirect::to('/usuario');
    }
}
