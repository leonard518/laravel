Class-06:

## Manejo de migraciones.
### Crear los atributos de las a crear movie y genre
### Ruta de los archivos:
database/migrations


### Crear relaciones Ejemplo:
$table->integer('user_id')->unsigned();
$table->foreign('user_id')->references('id')->on('users');

### Correr las migraciones
Nota: Antes de corre las migraciones por artisan de debe configurar el archivo .env con la informacion de su servidor de base de datos, la base de datos debe de estar creada.

php artisan migrate

### Utilizar los rollback
Nota: Sirve para volver atras si se comente un error en la base de datos.

php artisan migrate:rollback