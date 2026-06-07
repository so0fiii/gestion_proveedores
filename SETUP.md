# Puesta en marcha

Guia rapida para preparar y ejecutar el proyecto en local.

## Requisitos

- PHP 8.2 o superior.
- Composer.
- Docker Desktop.
- Git.

## 1. Clonar el repositorio

```bash
git clone URL_DEL_REPOSITORIO
cd gestion_proveedores
```

Si se descarga el proyecto como ZIP desde GitHub, descomprimirlo y entrar en la carpeta del proyecto.

## 2. Instalar dependencias

```bash
composer install
```

El directorio `vendor/` no se incluye en Git, por eso este paso es necesario despues de clonar o descomprimir el proyecto.

## 3. Levantar MySQL y phpMyAdmin

```bash
docker compose up -d
```

Comprobar que los contenedores estan levantados:

```bash
docker compose ps
```

Si el puerto `3306` esta ocupado, cerrar otro servicio MySQL local o modificar el puerto publicado en `compose.override.yaml`.

## 4. Crear la base de datos

```bash
php bin/console doctrine:database:create --if-not-exists
```

## 5. Ejecutar migraciones

```bash
php bin/console doctrine:migrations:migrate
```

## 6. Crear usuario administrador

```bash
php bin/console app:create-admin admin@example.com admin123
```

Se pueden cambiar el correo y la contrasena por otros valores.

## 7. Generar datos de prueba opcionales

```bash
php bin/console app:generar-proveedores 50
```

Este paso es opcional. Sirve para probar el listado, los filtros y la ordenacion con mas datos.

## 8. Arrancar la aplicacion

```bash
php -S localhost:8000 -t public
```

## 9. Acceder a la aplicacion

```text
Login: http://localhost:8000/login
Panel: http://localhost:8000/proveedores
```

## phpMyAdmin

```text
URL:        http://localhost:8081
Servidor:   database
Usuario:    app
Contrasena: app
```

## Comandos de comprobacion

Validar las plantillas Twig:

```bash
php bin/console lint:twig templates
```

Validar la configuracion YAML:

```bash
php bin/console lint:yaml config
```

Ver las rutas disponibles:

```bash
php bin/console debug:router
```

Comprobar los comandos propios:

```bash
php bin/console list app
```

Limpiar cache:

```bash
php bin/console cache:clear
```
