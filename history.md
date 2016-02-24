Class-16:

## Soft Deleting
### Agregamos la clase a usar en el modelo que se desea usar
#### Modelo User
Agreganos la clase SoftDeletes  
use Illuminate\Database\Eloquent\SoftDeletes;  

Indicamos que haremos uso de la clase SoftDeletes  
use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;  

### Debemos crear la variable deleted_at
#### La cual tendra la informacion de cuando se borro el registro
protected  $dates = ['deleted_at'];  

### Se agrega la columna deleted_at en la tabla users
#### desde artisan
php artisan make:migration add_deleted_to_users_table --table=users  

### Agregamos el campo en la migracion add_deleted_to_users_table
public function up()  
    {  
        Schema::table('users', function (Blueprint $table) {  
            $table->softDeletes();  
        });  
    }  
#### Corremos la migracion con artisan
php artisan migrate

### Modificamos el UsuarioController 
#### El metodo Delete modificamos lo siguiente:
public function destroy($id)  
    {  
        $user = User::find($id);  
        $user->delete();  
        Session::flash('message', 'Usuario Eliminado correctamente');  
        return Redirect::to('/usuario');  
    }  
    
### Si queremos listar los elementos eliminados 
#### En el metodo index modificamos lo siguiente:
public function index()  
    {  
        /* Trae la informa del modelo User solamento los borrados*/  
        $users = User::OnlyTrashed()->paginate(5);  
        return view('usuario.index', compact('users'));  
    }  
    