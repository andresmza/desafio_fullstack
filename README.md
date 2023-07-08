<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## DESAFÍO FULL STACK

Link de la consigna utilizada para realizar el desafío:

- <a href="https://amobalearning.fra1.cdn.digitaloceanspaces.com/Resources/Prueba%20FullStack%20new.pdf">Consigna</a>



##  REQUISITOS PREVIOS
 
 - <a href="https://www.mysql.com/">MySQL</a>
 - <a href="https://www.php.net/downloads/">PHP 8.1</a>
 - <a href="https://getcomposer.org/">Composer</a>
 - <a href="https://www.apache.org/">APACHE</a>


## DEMO

 - Sistema en producción en un contenedor:

 Acceso: <a href="http://desafiofullstack.ddns.net:8000">Route Calendar</a>

## EJEMPLO

 - Al utilizar en el filtro de fecha el día 11/01/2020 se puede obsevar un caso de ejemplo que contiene todos los estados posibles de una ruta.


## Instalación en entorno local

 - Clonar el repositorio, preferentemente en  ```/var/www/```:
	
	``` sh
	git clone https://github.com/andresmza/desafio_fullstack.git
	```

- Una vez dentro del directorio del proyecto ejecutar los siguientes comandos:

    ``` sh
	composer install
	composer update
    cp .env.example .env
    php artisan key:generate
	```

- Crear la base de datos:

    ``` sh
	CREATE DATABASE calendar;
	```

- Ejecutar las migraciones y seeders:

    ``` sh
	php artisan migrate --seed
	```

- Ejecutar los siguientes comandos:

    ``` sh
	npm install -g npm@8.19.2
    npm run dev
	```


##  Diagrama Entidad Relación

![DER](https://github.com/andresmza/desafio_fullstack/blob/main/public/diagrama_entidad_relacion.png?raw=true)
