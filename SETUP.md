# Puesta en marcha

## Requisitos

- PHP 8.3
- Composer
- Docker Desktop
- Git

## 1. Clonar el repositorio

git clone ...
cd gestion_proveedores

## 2. Instalar dependencias

composer install

## 3. Levantar servicios

docker compose up -d

## 4. Crear base de datos

php bin/console doctrine:database:create --if-not-exists

## 5. Ejecutar migraciones

php bin/console doctrine:migrations:migrate

## 6. Crear usuario administrador

php bin/console app:create-admin admin@example.com admin123

## 7. Generar datos de prueba opcionales

php bin/console app:generar-proveedores 50

## 8. Arrancar aplicacion

php -S localhost:8000 -t public

## 9. Acceder

http://localhost:8000/login
