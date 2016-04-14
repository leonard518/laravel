Class-29:

## Enviar correos
### Configuramos el archivo config/mail.php
host: smtp.gmail.com
port: 465
from: cuenta@gmail.com
name: nombre
encryption: ssl


### Configuramos el archivo .env
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=cuenta@gmail.com
MAIL_PASSWORD=passwordgmail
MAIL_ENCRYPTION=ssl

### Creamos MailController desde artisan

### Enrutamos el nuevo controlador
#### Editamos la funcion store