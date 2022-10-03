# Guía para instalar el proyecto
## Version php ^8.0
Desplegado en AWS, http://3.17.14.20/

## Instalación
1. Descarga el repositorio
2. Descromprime la carpeta dentro del directorio donde pueda correr php
3. Renombra la carpeta (Opcional) 
4. Entra a la carpeta desde la terminal `cd directorio/de/la/carpeta`
5. Copia el contenido del archivo `.env.example` a un nuevo archivo llamado `.env`
    * Si estás en Liunx o Mac puedes ejecutar el comando: `cp .env.example .env`
6. Crea una base de datos para el proyecto
7. Modifica las variables de conexión del nuevo archivo `.env` 
    * Define los datos de conexión 
        * DB_DATABASE=
        * DB_USERNAME=
        * DB_PASSWORD=
8. Ejecuta `composer install`
9. Ejecutar `php artisan key:generate`
10. Ejecutar el backup de PostgreSQL que está ubicado en la carpeta Backup, el archivo se llama hotel 
13. Abre la aplicación en el postman o insomnia
14. Accede a `api/v1/login` para ingresar al login y obtener el token, para las peticiones protegidas
    * Email: amir.haley@example.net
    * Password: password
