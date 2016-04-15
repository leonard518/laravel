Class-30:

## Restablecer Password
### Creamos una nueva ruta

### Creamos el link en la vista index

### Creamos la carpeta auth, en la carpeta vista,  agregamos el archivo password.blade.php
### Creamos un archivo password.blade.php, en la carpeta vista emails


### modificamos el siguiente archivo: vendor/laravel/framework/src/Illuminate/Foundation/Auth/ResetsPasswords.php
quitamos la encrytacion ya esta encriptado el password desde el modelo

### modificamos el siguiente archivo: vendor/laravel/framework/src/Illuminate/Foundation/Auth/RedirectsUsers.php
colocamos la ruta que va a redireccionar '/admin'
