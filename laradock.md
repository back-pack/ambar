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

#### Editar la siguiente linea en laradock/workspace/crontab/laradock

"/var/www/${appname}/artisan" se le agrega el nombre de la app.

#### Deberia quedar asi:

`* * * * * laradock /usr/bin/php /var/www/ambar/artisan schedule:run >> /dev/null 2>&1`

**IMPORTANTE: asegurarse de las line endings del archivo sean LF y no CRLF**

#### Luego ir a la carpeta /laradock y correr el siguiente commando

`docker-compose up -d nginx mysql`

*El mismo comando sirve para levantar laradock*

#### Si se necesita compilar una imagen invidual de Laradock, correr el siguiente comando por ej. para compilar Workspace:

`docker-compose build workspace`

*Se le puede agregar --no-cache para compilar la imagen desde cero*


#### Agregar app dominio local

Editar el archivo de hosts
- En Windows la ruta del archivo es Windows/System32/drivers/etc/hosts
- En Linux la ruta del archivos es /etc/hosts

Agregar la siguiente linea:
`127.0.0.1 ambar.local`

*En Windows ejectura el notepad como administrador*

En la carpeta laradock/nginx/sites copiar laravel.conf.example y renombrar como ambar.local.conf

En el archivo ambar.local.conf reemplazar todas las ocurrencias de la palabra "laravel" por "ambar"
