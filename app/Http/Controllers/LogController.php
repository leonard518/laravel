<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;
/* Clase LoginRequest, para utilizar las reglas de validacion */
use Cinema\Http\Requests\LoginRequest;
/* Clase Redirect, para rdireccionar */
use Redirect;
/* Clase Session, para manejo de sesioes en la app */
use Session;
/* Clase Auth, el cual autentificara los datos necesarios */
use Auth;

use Cinema\Http\Requests;
use Cinema\Http\Controllers\Controller;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request)
    {
        if(Auth::attempt(
            [
                'email'     => $request['email'],
                'password'  => $request['password']
            ])){
            return Redirect::to('admin');
        }
        Session::flash('message-error', 'Datos incorrectos');
        return Redirect::to('/');
    }

    /* Metodo cerrar sesion */
    public function logout(){
        Auth::logout();
        return Redirect::to('/');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
