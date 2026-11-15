# Sistema de Gestión Académica

Aplicación web desarrollada con **Laravel** para la administración de una institución educativa. Permite gestionar estudiantes, profesores, materias, aulas, departamentos e inscripciones, con autenticación y control de roles.

## Características

- **Autenticación**: registro, inicio de sesión, recuperación y restablecimiento de contraseña.
- **Roles de usuario**: `admin`, `profesor` y `estudiante`, con permisos diferenciados.
- **Gestión de estudiantes**: crear, editar, listar y eliminar.
- **Gestión de profesores**: crear, editar, listar y eliminar.
- **Gestión de materias**: CRUD completo y listado de materias disponibles.
- **Gestión de aulas**: CRUD completo.
- **Gestión de departamentos**: CRUD completo.
- **Inscripciones**: los estudiantes pueden inscribirse en materias; administradores y profesores gestionan las inscripciones.
- **Dashboard** adaptado según el rol del usuario.
- Interfaz moderna con **Bootstrap 5** y **Vite**.

## Tecnologías

- PHP 8.3+
- Laravel 13
- MySQL
- Bootstrap 5
- Vite

## Requisitos

- PHP >= 8.3
- Composer
- Node.js y npm
- MySQL

## Instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/breysonmezalondono-debug/Sistema_de_Gestion_Academica.git
cd Sistema_de_Gestion_Academica

# 2. Instalar dependencias de PHP
composer install

# 3. Instalar dependencias de JavaScript
npm install

# 4. Configurar el entorno
cp .env.example .env
php artisan key:generate

# 5. Configurar la base de datos en .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# 6. Ejecutar migraciones y seeders
php artisan migrate --seed

# 7. Compilar assets
npm run build
```

## Ejecución en desarrollo

```bash
php artisan serve
npm run dev
```

La aplicación estará disponible en `http://127.0.0.1:8000`.

## Estructura principal

- `app/Http/Controllers` — controladores de cada módulo.
- `app/Models` — modelos Eloquent (Estudiante, Profesor, Materia, Aula, Departamento, etc.).
- `app/Http/Requests` — validación de formularios.
- `app/Http/Middleware/CheckRole.php` — control de acceso por rol.
- `routes/web.php` — definición de rutas.
- `resources/views` — vistas Blade.

## Licencia

Proyecto académico de uso educativo.
