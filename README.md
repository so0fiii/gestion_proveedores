# Gestion de proveedores

Aplicacion Symfony para gestionar proveedores de una empresa. 

## Objetivo

La aplicacion debe permitir al departamento de contabilidad gestionar proveedores:

- Crear proveedores.
- Editar proveedores existentes.
- Listar proveedores.
- Ver el detalle de un proveedor.
- Eliminar proveedores.

Cada proveedor tendra:

- Nombre.
- Correo electronico.
- Telefono de contacto.
- Tipo de proveedor.
- Estado activo o inactivo.
- Fecha de creacion.
- Fecha de ultima actualizacion.

## Stack tecnico

- PHP 8.3.
- Symfony 7.x.
- MySQL 8.
- Doctrine ORM.
- Twig.
- Symfony Forms.
- Symfony Validator.
- Symfony Security.
- Docker Compose.
- phpMyAdmin para desarrollo local.

## Requisitos

- PHP instalado en local o contenedor PHP configurado.
- Composer.
- Docker y Docker Compose.
- Git.

## Entorno de desarrollo

Levantar los servicios:

```bash
docker compose up -d
```

Ver el estado de los contenedores:

```bash
docker compose ps
```

La base de datos se expone en:

```text
127.0.0.1:3306
```

phpMyAdmin esta disponible en:

```text
http://localhost:8081
```

Datos de acceso a phpMyAdmin:

```text
Servidor: database
Usuario: app
Contrasena: app
Base de datos: gestion_proveedores
```

## Base de datos

La aplicacion usa MySQL mediante la variable `DATABASE_URL`:

```dotenv
DATABASE_URL="mysql://app:app@127.0.0.1:3306/gestion_proveedores?serverVersion=8.0.32&charset=utf8mb4"
```

Comprobar la conexion con Doctrine:

```bash
php bin/console doctrine:query:sql "SELECT DATABASE();"
```

Ejecutar migraciones:

```bash
php bin/console doctrine:migrations:migrate
```

## Comandos utiles

Instalar dependencias:

```bash
composer install
```

Ver rutas disponibles:

```bash
php bin/console debug:router
```

Limpiar cache:

```bash
php bin/console cache:clear
```

