# apiREST
#### Por: Yoangel Eizaga
### **Documentacion de la api: [aqui](https://documenter.getpostman.com/view/13318147/Tzm2Ke2h).**

##### Para poder utilizar este proyecto, debes tener los siguientes requisitos:
1) Debes tener la versión de PHP mayor o igual a la 7.3
para mas información visita la documentación oficial de : 
[Laravel](https://laravel.com/docs/8.x)

2) Debes tener instalado [Composer](https://getcomposer.org/) en tu equipo: 

3) si utilizas windows, puedes descargar el programa git desde [aqui](https://gitforwindows.org/): 

**Si cumples con estos prerequisitos, entonces podrás instalar este proyecto.**


## Instalación

1) Descarga este proyecto o clónalo con el comando: 

    ```sh
    $ git clone git://github.com/EizagaYC/apiREST.git
    ```
2) Instalar las dependencias de php
    ```sh
    $ composer install
    ```
3) Duplicar el archivo ".env.example" y guardarlo como ".env" 
__Si estas con el sistema gitforwindows, o en linux o mac, puedes ejecutar el siguiente comando__

    ```sh
    cp .env.example .env
    ```
4) Generamos el token key del proyecto con el siguiente comando:
    ```sh
    $ php artisan key:generate
    ```
5) Configuramos las variables para la base de datos en el archivo ".env":
    ```sh
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel_api
    DB_USERNAME=root
    DB_PASSWORD=
    ```
6) Ejecutamos las migraciones y los seeders con:
    ```sh
    $ php artisan migrate --seed
    ```
8) Por ultimo ejecuta el servidor 
```sh
$  php artisan serve
```
con esto ya la api estara funcionando.
