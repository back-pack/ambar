Dentro de una carpeta, clonar repo de laradock
Dentro de la misma carpeta crear carpeta apps
Dentro de la carpeta apps clonar el repo ambar

Copiar laradock/env-example en laradock/.env

Editar las siguientes variables en laradock/.env

APP_CODE_PATH_HOST=../apps
PHP_VERSION=7.2
WORKSPACE_TIMEZONE=America/Argentina/Buenos_Aires
MYSQL_VERSION=5.7

Editar la siguiente linea en laradock/workspace/crontab/laradock

"/var/www/${appname}/artisan" se le agrega el nombre de la app.

Deberia quedar asi * * * * * laradock /usr/bin/php /var/www/ambar/artisan schedule:run >> /dev/null 2>&1
