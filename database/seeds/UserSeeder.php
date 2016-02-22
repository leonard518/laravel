<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
}
