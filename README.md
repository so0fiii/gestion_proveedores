# Gestion de proveedores

Aplicacion web desarrollada con Symfony para gestionar proveedores de una empresa. 

## Objetivo

El departamento de contabilidad necesita una herramienta para gestionar proveedores de forma sencilla.

Funcionalidades previstas:

- Crear proveedores.
- Editar proveedores existentes.
- Listar proveedores.
- Ver el detalle de un proveedor.
- Eliminar proveedores.

Datos de cada proveedor:

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

## Arquitectura

El proyecto se plantea como un monolito Symfony con vistas renderizadas mediante Twig. 

La separacion se realiza por capas dentro del propio proyecto:

```text
src/Controller   Controladores HTTP.
src/Entity       Entidades Doctrine.
src/Enum         Tipos propios del dominio.
src/Form         Formularios Symfony.
src/Repository   Consultas a base de datos.
src/Service      Logica de aplicacion.
templates        Vistas Twig.
public/assets    CSS y JavaScript.
migrations       Migraciones Doctrine.
```

Las vistas no acceden directamente a la base de datos. La persistencia se gestiona mediante Doctrine, repositorios y servicios.

## Dominio

El dominio inicial esta formado por:

- `Proveedor`: entidad principal del sistema.
- `TipoProveedor`: enum con los tipos permitidos.
- `ProveedorRepository`: repositorio para consultas de proveedores.

Tipos de proveedor:

- Hotel.
- Crucero.
- Estacion de esqui.
- Parque tematico.

Las fechas de creacion y actualizacion se rellenan automaticamente mediante callbacks de Doctrine.

## Entorno de desarrollo

Levantar los servicios:

```bash
docker compose up -d
```

Ver el estado de los contenedores:

```bash
docker compose ps
```

Base de datos:

```text
Host: 127.0.0.1
Puerto: 3306
Base de datos: gestion_proveedores
Usuario: app
Contrasena: app
```

phpMyAdmin:

```text
URL: http://localhost:8081
Servidor: database
Usuario: app
Contrasena: app
```

## Configuracion

La conexion a MySQL se define con `DATABASE_URL`:

```dotenv
DATABASE_URL="mysql://app:app@127.0.0.1:3306/gestion_proveedores?serverVersion=8.0.32&charset=utf8mb4"
```

Las credenciales incluidas son solo para desarrollo local. Las credenciales reales deben definirse mediante variables de entorno o `.env.local`.

## Comandos utiles

Instalar dependencias:

```bash
composer install
```

Comprobar conexion con la base de datos:

```bash
php bin/console doctrine:query:sql "SELECT DATABASE();"
```

Crear una migracion:

```bash
php bin/console make:migration
```

Ejecutar migraciones:

```bash
php bin/console doctrine:migrations:migrate
```

Ver rutas:

```bash
php bin/console debug:router
```

Limpiar cache:

```bash
php bin/console cache:clear
```

Comprobar sintaxis PHP:

```bash
php -l src/Entity/Proveedor.php
php -l src/Enum/TipoProveedor.php
php -l src/Repository/ProveedorRepository.php
```

## Criterios de calidad

- CRUD implementado manualmente, sin usar `php bin/console make:crud`.
- Controladores ligeros.
- Logica de aplicacion en servicios.
- Consultas a base de datos mediante repositorios.
- Vistas renderizadas con Twig.
- Configuracion sensible mediante variables de entorno.
- No subir `vendor/`, `var/`, `.env.local` ni `node_modules/`.

## Estado actual

Implementado:

- Configuracion de MySQL 8 con Docker.
- phpMyAdmin para desarrollo local.
- Estructura base de la aplicacion.
- Dominio inicial de proveedores.

Pendiente:

- Migracion inicial de proveedores.
- Formulario de proveedores.
- Servicio de gestion de proveedores.
- CRUD manual.
- Autenticacion basica de administrador.
- Interfaz responsive.
- Animaciones ligeras con anime.js.
