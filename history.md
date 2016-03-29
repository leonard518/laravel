Class-24:

## Validaciones con Ajax
### Creamos un request nuevo
php artisan make:request GenreRequest

### Autorizamos el request y agregamos la regla
'genre' => 'required'

### Agregamos GenreRequest en el controlador Genero
use Cinema\Http\Requests\GenreRequest;
#### Agregamos el request a la funcion store

### Verificar los cambios en los siguientes archivos:
script.js
script2.js
genero.blade.php
genero/create.blade.php
genero/index.blade.php
