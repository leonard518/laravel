Class-07:

## Manejo de Vistas.
### Ruta de las vistas:
resource/views

### Crear una vista debemos crear una ruta
Route::get('/', 'FrontController@index');
Route::get('/contacto', 'FrontController@contacto');
Route::get('/reviews', 'FrontController@reviews');

### Agragar el html de las siguientes vistas en la carpeta "Front" en la raiz del proyecto.
index.html - contacto.html - reviews.html 

### Agragar las siguiente carpetas a la carpeta "public"
Front/css -> public/css
Front/images -> public/images
Front/js -> public/js