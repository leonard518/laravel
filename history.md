Class-13-extra:

## Mejorar la vista del listado de usuario con iconos y agregar componente Faker.
### Quitaremos la palabra editar y colocamos un icono
{!! link_to_route('usuario.edit', $title = 'Editar', $parameters = $user-&gt;id, $attributes = ['class' =&gt; 'btn btn-primary']) !!}  
Por  
&lt;a href="{{ route('usuario.edit', $user-&gt;id)  }}" class="btn btn-primary"&gt;&lt;span class="fa fa-edit"&gt;&lt;/span&gt;&lt;/a&gt;

## Componente faker
### Instalar el componente Faker
#### Nos diriginos a composer.json en required-dev y actualizamos la version del componente
"fzaninotto/faker": "1.5.*@dev"  
En la terminal colocamos: composer update  
Se actualiza composer  

### Creamos un seeder desde artisan:
php artisan make:seeder UserSeeder  
Esto nos genera un archivo en database/seeds/UserSeeder

### Uso de Faker
#### Agregamos la clase que vamos usar y le asignamos un alias
use Faker\Factory as Faker;  

#### Creamos el objecto nuevo y metodos a usar
public function run()  
    {  
        /* Agregamos la clase faker */  
        $faker = Faker::create();  
        /* Creamos el ciclo para definir la cantidad de usuarios que deseamos en este caso 30 */  
        for($i = 0; $i < 30; $i++){  
            /* Insertamos los campos */  
            \DB::table('users')->insert(array(  
                // En caso de name creamos el nombre y el apellido contatenado  
                'name'      =>  $faker->firstName.' '.$faker->lastName,  
                'email'     =>  $faker->email,  
                'password'  =>  bcrypt('123456')  
            ));  
        }  
    }  

### Ejecutar los seeders
#### Agregamos el seeder en DatabaseSeeder.php
$this->call(UserSeeder::class);  
Luego en consola Ejecutamos el seeder  
php artisan migrate:refresh --seed  

Si deseamnos ejecutar un seeder en particular 
php artisan db:seed --class=UserTableSeeder