Class-13-b:

## Seeders y el componente Faker.
### Instalar el componente Faker
#### Nos diriginos a composer.json en required-dev y actualizamos la version del componente
"fzaninotto/faker": "1.5.*@dev"  
En la terminal colocamos: composer update  
Se actualiza composer  

### Creamos un seeder desde artisan:
php artisan make:seeder UserSeeder    
Nota: Esto nos genera un archivo en database/seeds/UserSeeder

### Uso de Faker
#### Agregamos la clase que vamos usar y le asignamos un alias
use Faker\Factory as Faker;  
#### Creamos el objecto nuevo y metodos a usar
public function run()  
    {  
        /* Agregamos la clase faker */  
        $faker = Faker::create();  

        /* Creamos el ciclo para definir la cantidad de usuarios que deseamos en este caso 30 */  
        for($i = 0; $i &lt; 30; $i++ ){  
            /* Insertamos los campos */  
            DB::table('users')-&gt;insert(array(  
                // En caso de name creamos el nombre y el apellido contatenado  
                'name'      =&gt;  $faker-&gt;firstName.' '.$faker-&gt;lastName,  
                'email'     =&gt;  $faker-&gt;email,  
                'password'  =&gt;  bcrypt('123456')  
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