# Instrucciones de instalación y despliegue

## En local

#### Debes tener:
- ** PHP 7.4.0 **
- ** PostgreSQL 12 o superior **
- ** Composer **
- ** Cuenta en Amazon S3 **
- ** Cuenta de email **

#### Instalación:

1. Crear un directorio `web/bosstrainer` y nos cambiamos a ese directorio.

2. Ejecutamos los siguientes comandos:
```
~/web/bosstrainer ᐅ git clone https://github.com/HectorGN13/BossTrainer.git .
~/web/bosstrainer ᐅ composer install
~/web/bosstrainer ᐅ ./init --env=Development --overwrite=n
```
3. Cambiar la dirección de correo en `/common/config/params.php`
```
'adminEmail' => 'nueva dirección de correo',
```
4. Crear varias variable de entorno en el archivo `.env`:

    * `MAIL_DRIVER`=smtp
    * `MAIL_HOST`=smtp.gmail.com
    * `MAIL_PORT`=587
    * `MAIL_USERNAME`= direccion del correo del email de la app
    * `MAIL_PASSWORD`= Contraseña de el email de la app
    * `MAIL_ENCRYPTION`=tls
    * `AWS_ACCESS_KEY_ID` = la key de Amazon S3
    * `AWS_SECRET_ACCESS_KEY`= el password de Amazon S3.

5. Creamos la base de datos y las respectivas tablas para hacer funcionar la aplicación:
```
yii migrate
```


## En la nube

#### Requisitos:
- ** Heroku cli **

#### Despliegue:

1.  Hacemos la instalación en local arriba indicada.

2.  Creamos una aplicación en heroku

3. Añadiremos el add-on **Heroku Postgres**

4.  Nos vamos al directorio donde hemos clonado la aplicación y ejecutamos:
```
heroku login
heroku git:remote -a nombre_app_heroku
git push heroku master
heroku run bash
./yii migrate
```
5.  Configuramos las variables de entorno:

-   AWS_ACCESS_KEY_ID: La key de Amazon S3
-   AWS_SECRET_ACCESS_KEY: La clave secreta de Amazon S3
-   MAIL_USERNAME: Dirección de la cuenta de correo
-   MAIL_PASSWORD: Contraseña de la cuenta de correo

6. La aplicación está lista para funcionar