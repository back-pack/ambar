#### Estructura (multiples proyectos)
- Dentro de una carpeta, clonar repo de laradock: git clone https://github.com/laradock/laradock.git
- Dentro de la misma carpeta crear carpeta apps
- Dentro de la carpeta apps clonar el repo ambar

- Copiar laradock/env-example en laradock/.env

#### Editar las siguientes variables en laradock/.env

- APP_CODE_PATH_HOST=../apps
- PHP_VERSION=7.2
- WORKSPACE_TIMEZONE=America/Argentina/Buenos_Aires
- MYSQL_VERSION=5.7

#### Copiar el siguiente archivo laradock/mysql/docker-entrypoint-initdb.d/createdb.sql.example y nombrarlo createdb.sql

`cp laradock/mysql/docker-entrypoint-initdb.d/createdb.sql.example createdb.sql`

#### Editar el archivo y descomentar lineas 19, 20

"#CREATE DATABASE IF NOT EXISTS `dev_db_1` COLLATE 'utf8_general_ci' ;"
"#GRANT ALL ON `dev_db_1`.* TO 'default'@'%' ;"

#### Y reemplazar "dev_db_1" por "ambar"

#### Editar la siguiente linea en laradock/workspace/crontab/laradock

"/var/www/${appname}/artisan" se le agrega el nombre de la app.

#### Deberia quedar asi:

`* * * * * laradock /usr/bin/php /var/www/ambar/artisan schedule:run >> /dev/null 2>&1`

**IMPORTANTE: asegurarse de las line endings del archivo sean LF y no CRLF**

#### Agregar app dominio local

Editar el archivo de hosts
- En Windows la ruta del archivo es Windows/System32/drivers/etc/hosts
- En Linux la ruta del archivos es /etc/hosts

Agregar la siguiente linea:
`127.0.0.1 ambar.test`

*En Windows ejectura el notepad como administrador*

En la carpeta laradock/nginx/sites copiar laravel.conf.example y renombrar como ambar.test.conf

En el archivo ambar.local.conf reemplazar todas las ocurrencias de la palabra "laravel" por "ambar"


#### Luego ir a la carpeta /laradock y correr el siguiente commando

`docker-compose up -d nginx mysql`

*El mismo comando sirve para levantar laradock*

#### Si se necesita compilar una imagen invidual de Laradock, correr el siguiente comando por ej. para compilar Workspace:

`docker-compose build workspace`

*Se le puede agregar --no-cache para compilar la imagen desde cero*

Con laradock funcionando correr el siguiente comando para ingresar al bash de la imagen workspace

`docker-compose exec --user=laradock workspace bash`

Una vez adentro de workspace ingresar a la carpeta ambar

`cd ambar`

Adentro del directorio de la aplicacion generar la APP_KEY de Laravel con el siguiente comando

`php artisan key:generate`

Copiar el archivo .env.example y nombrarlo .env

`cp .env.example .env`

Editar .env y fijarse que los siguientes datos esten de esta manera:

- DB_CONNECTION=mysql
- DB_HOST=mysql
- DB_PORT=3306
- DB_DATABASE=ambar
- DB_USERNAME=default
- DB_PASSWORD=secret
