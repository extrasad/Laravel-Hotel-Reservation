# Laravel-Hotel-Reservation
Simple system about hotel reservation in Laravel

Para Instalar las dependencias entrar al terminal, ubicarse en el directorio del proyecto y
ejecutar el comando:

"composer install" (Para esto se debe tener composer instalado previamente)

PD: no cerrar terminal la usaremos más tarde

Luego de instalar lass dependencias, si es primera vez que se clona el proyecto dentro de su directorio crear un archivo llamado ".env", contendrá las variables de configuracion para el proyecto(su entorno), colocar el nombre de la base de datos, el nombre del user de la base de datos y su contraseña.

Luego de configurar el archivo .env, irse al gestor de base de datos y crear una base de datos vacia con el nombre que colocamos en nuestro archivo .env.

Después de configurar nuestro entorno, se va al terminal(dentro del proyecto) y ejecutamos los siguientes comandos

"php artisan migrate" (hace las migraciones de los modelos)

"php artisan db:seed" (llena campos en la base de datos, user, roles, entre otros)

"php artisan key:generate" (genera un codigo unico para nuestra app esto es usado más que todo para los deploys pero siempre es importante tenerla)

luego de esto solo toca ir a la url del proyecto

localhost/nombre-de-la-carpeta-del-proyecto/public

Y listo la app estaría rodando.


# Para tomar en consideración

para clonar el repo en su estado actual el comando es el siguiente


git clone -b fixed-dev https://github.com/extrasad/Laravel-Hotel-Reservation.git

O si se está usando Github Desktop, simplemente al hacer clone con la url https://github.com/extrasad/Laravel-Hotel-Reservation.git , 
situarse arriba en donde dice branch, seleccionar la branch fixed-dev y luego darle click a fetch

cada vez que se haga un cambio, hay que hacer pull con el comando

git pull origin fixed-dev

En su defecto cuando se utilize Github Desktop buscar en la interfaz el botón pull, y darle click(situados en la rama fixed-dev)
