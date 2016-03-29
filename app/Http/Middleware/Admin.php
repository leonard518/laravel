<?php

namespace Cinema\Http\Middleware;
/* Interfaz Guard, nos va a proporcionar la informacion del usuario que esta actuamente logeado*/
use Illuminate\Contracts\Auth\Guard;
/* Manejo de sesiones */
use Session;
use Closure;
use Illuminate\Support\Facades\Redirect;

class Admin
{
    protected $auth;

    public function __construct(Guard $auth){
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* Validamos que el usuario es igual a uno */
        /* Se podria validar por el tipo de usuario que es lo mas correcto */
        if($this->auth->user()->id != 1){
            Session::flash('message-error', 'Sin Privilegios');
            return redirect()->to('admin');
        }
        return $next($request);
    }
}
