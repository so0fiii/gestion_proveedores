# Gestion de proveedores

Aplicacion web desarrollada con PHP y Symfony para gestionar proveedores desde un panel interno de administracion.

## Funcionalidades anadidas

- Inicio de sesion para acceder al panel de administracion.
- Cierre de sesion desde la cabecera del panel.
- Proteccion de las rutas de proveedores con `ROLE_ADMIN`.
- Listado de proveedores.
- Busqueda por nombre, correo electronico o telefono.
- Filtros por tipo de proveedor y estado.
- Ordenacion por nombre, fecha de alta y fecha de ultima actualizacion.
- Vista de detalle de cada proveedor.
- Creacion de proveedores mediante formulario Symfony.
- Edicion de proveedores mediante formulario reutilizable.
- Eliminacion segura mediante `POST` y token CSRF.
- Mensajes flash tras acciones principales.
- Comando para crear un usuario administrador.
- Comando para generar proveedores de prueba.
- Interfaz responsive para escritorio y movil.
- Animacion decorativa ligera en la pantalla de login.

Datos guardados de cada proveedor:

- Nombre.
- Correo electronico.
- Telefono de contacto.
- Tipo de proveedor.
- Estado activo o inactivo.
- Fecha de creacion.
- Fecha de ultima actualizacion.

## Tecnologias usadas

- PHP 8.3.
- Symfony 7.x.
- MySQL 8.
- Doctrine ORM.
- Doctrine Migrations.
- Twig.
- Symfony Forms.
- Symfony Validator.
- Symfony Security.
- Docker Compose.
- phpMyAdmin para desarrollo local.
- CSS propio.
- JavaScript propio.
- anime.js para animaciones decorativas.

## Arquitectura

El proyecto usa una arquitectura monolitica Symfony con vistas renderizadas mediante Twig.

El proyecto se ha desarrollado como un monolito Symfony con vistas Twig porque el alcance funcional es un panel interno de gestion y no una aplicacion distribuida. En este contexto, separar un frontend independiente y una API JSON anadiria complejidad innecesaria sin aportar una ventaja clara al enunciado.

La separacion de responsabilidades se mantiene dentro de la propia aplicacion mediante capas: controladores para coordinar las peticiones, servicios para la logica de aplicacion, repositorios para las consultas, entidades para el modelo de datos y vistas Twig para la presentacion.

```text
src/Controller    Controladores HTTP.
src/Entity        Entidades Doctrine.
src/Enum          Enums del dominio.
src/Form          Formularios Symfony.
src/Repository    Consultas a base de datos.
src/Service       Logica de aplicacion.
src/Command       Comandos de consola.
templates         Vistas Twig.
public/assets     CSS y JavaScript.
migrations        Migraciones Doctrine.
```

Las vistas Twig no acceden directamente a la base de datos. Los controladores coordinan la peticion, los formularios y las respuestas. La persistencia se gestiona mediante Doctrine, repositorios y servicios.

## Dominio

El dominio principal esta formado por:

- `Proveedor`: entidad principal del sistema.
- `TipoProveedor`: enum con los tipos permitidos.
- `ProveedorRepository`: repositorio para consultas, filtros y ordenacion.
- `ProveedorService`: servicio para guardar, actualizar fechas y eliminar proveedores.

Tipos de proveedor:

- Hotel.
- Crucero.
- Estacion de esqui.
- Parque tematico.

## Seguridad

- Las rutas de proveedores estan protegidas con `ROLE_ADMIN`.
- El login se implementa con Symfony Security.
- La eliminacion de proveedores solo se permite mediante `POST`.
- La eliminacion usa token CSRF.
- Las credenciales reales no deben guardarse en Git.
- `.env.local` debe usarse para configuracion sensible local.
- El entorno local usa credenciales de desarrollo.

## Flujo de ejecucion completo

1. El usuario accede a la aplicacion.
2. Si no ha iniciado sesion, Symfony Security redirige a `/login`.
3. El usuario inicia sesion con una cuenta administradora.
4. Tras iniciar sesion, accede al listado de proveedores.
5. Desde el listado puede buscar, filtrar y ordenar proveedores.
6. Al pulsar sobre un proveedor, accede a la vista de detalle.
7. Desde el detalle puede editar o eliminar el proveedor.
8. Desde el listado puede crear un nuevo proveedor.
9. Al crear o editar, Symfony Forms valida los datos introducidos.
10. La logica de guardado y eliminacion pasa por `ProveedorService`.
11. Doctrine persiste los cambios en MySQL.
12. La aplicacion muestra mensajes flash tras las acciones principales.
13. El usuario puede cerrar sesion desde la cabecera del panel.

## Entorno local

Levantar MySQL y phpMyAdmin:

```bash
docker compose up -d
```

Ver contenedores:

```bash
docker compose ps
```

Instalar dependencias:

```bash
composer install
```

Crear la base de datos si no existe:

```bash
php bin/console doctrine:database:create --if-not-exists
```

Ejecutar migraciones:

```bash
php bin/console doctrine:migrations:migrate
```

Crear usuario administrador:

```bash
php bin/console app:create-admin admin@example.com admin123
```

Generar proveedores de prueba:

```bash
php bin/console app:generar-proveedores 50
```

Arrancar la aplicacion en desarrollo:

```bash
php -S localhost:8000 -t public
```

Acceso local:

```text
Aplicacion: http://localhost:8000
Login:      http://localhost:8000/login
Panel:      http://localhost:8000/proveedores
```

phpMyAdmin:

```text
URL:        http://localhost:8081
Servidor:   database
Usuario:    app
Contrasena: app
```

Base de datos local:

```text
Host:           127.0.0.1
Puerto:         3306
Base de datos:  gestion_proveedores
Usuario:        app
Contrasena:     app
```

## Comandos utiles

Ver rutas:

```bash
php bin/console debug:router
```

Comprobar comandos propios:

```bash
php bin/console list app
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

Limpiar cache:

```bash
php bin/console cache:clear
```

Validar Twig:

```bash
php bin/console lint:twig templates
```

Validar YAML:

```bash
php bin/console lint:yaml config
```

Comprobar sintaxis PHP de un archivo:

```bash
php -l src/Controller/ProveedorController.php
```

## Rutas principales

```text
/login                    Inicio de sesion.
/logout                   Cierre de sesion.
/proveedores              Listado de proveedores.
/proveedores/nuevo        Crear proveedor.
/proveedores/{id}         Detalle de proveedor.
/proveedores/{id}/editar  Editar proveedor.
```

La eliminacion se realiza mediante `POST` en:

```text
/proveedores/{id}/eliminar
```

## Opciones responsive

La interfaz se ha adaptado para escritorio y movil mediante CSS propio.

En escritorio:

- El listado muestra todas las columnas principales.
- Los filtros se muestran en una fila para facilitar busqueda rapida.
- El detalle muestra la informacion en formato de tabla vertical.
- Las acciones principales quedan visibles en la cabecera de cada vista.

En movil:

- La cabecera global se oculta para reducir ruido visual.
- El listado se simplifica y muestra solo el nombre del proveedor.
- Los filtros se reorganizan para caber en pantallas estrechas.
- Los botones pasan a ocupar el ancho disponible.
- El detalle reduce tamanos de texto y permite que correos largos no rompan el layout.
- El fondo animado del login se puede ocultar para evitar distracciones y scroll innecesario.

## Despliegue para produccion

Este repositorio esta preparado principalmente para desarrollo y evaluacion local. Para produccion se recomienda:

1. Configurar variables de entorno reales fuera del repositorio.
2. Usar `APP_ENV=prod` y `APP_DEBUG=0`.
3. Configurar una base de datos MySQL gestionada o un servidor MySQL seguro.
4. Ejecutar `composer install --no-dev --optimize-autoloader`.
5. Ejecutar migraciones con control:

```bash
php bin/console doctrine:migrations:migrate --no-interaction
```

6. Limpiar y calentar cache de produccion:

```bash
php bin/console cache:clear --env=prod
```

7. Servir la aplicacion mediante Nginx o Apache apuntando a la carpeta `public/`.
8. Configurar HTTPS en el proxy inverso, balanceador o proveedor de despliegue.
9. No subir `.env.local`, `vendor/`, `var/` ni credenciales reales.

En produccion, HTTPS no deberia gestionarse desde la logica de Symfony, sino desde el servidor web o proxy inverso. Symfony queda centrado en la aplicacion y recibe las peticiones ya terminadas en HTTPS.

## Dominio local opcional

Para trabajar con un dominio local se puede editar el archivo `hosts` del sistema:

```text
127.0.0.1 gestion-proveedores.local
```

Despues se puede acceder a:

```text
http://gestion-proveedores.local:8000
```

