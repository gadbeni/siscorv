<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/agustinmejia/farmacia/master/public/img/icon.png" width="150"></a></p> -->

# SISCOR

## Requisitos
- Todos los requisitos de [laravel 8](https://laravel.com/docs/8.x/deployment#server-requirements).
- node.js ^14.17.
- npm ^6.14.

## Instalación
```
composer install
cp .env.example .env
php artisan template:install
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data storage bootstrap/cache
```

## Despleigue con docker
```
docker build -t siscor .
docker run -e DB_DATABASE=siscor -e DB_HOST=host.docker.internal -p 8000:8000 -t siscor
```

Nota: Para iniciar el servidor de socket.io debes ejecutar el comando `node server`.