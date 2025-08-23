# Password Manager

## Descripción del Proyecto
Este es un proyecto para la creación de un gestor de contraseñas seguro y funcional. Su objetivo principal es permitir a los usuarios almacenar de manera segura sus credenciales, como nombres de usuario, contraseñas y otros datos sensibles. La seguridad es la prioridad número uno en el desarrollo de esta aplicación.

## Características Principales
<ul>
<li>Autenticación Segura: Sistema de registro y login de usuarios con autenticación de dos factores (2FA).</li>

<li>Encriptación de Datos: Las contraseñas se almacenan en la base de datos de forma encriptada, garantizando su confidencialidad.</li>

<li>Generador de Contraseñas Seguras: Herramienta integrada para crear contraseñas con diferentes niveles de complejidad.</li>

<li>Gestión de Roles: Dos roles de usuario (Usuario y Administrador) con permisos específicos para cada uno.</li>

<li>Dashboard Personalizado: Interfaz intuitiva para ver, añadir, editar y eliminar contraseñas.</li>

<li>Opciones de Almacenamiento: Soporte para guardar URLs, notas, claves 2FA y archivos adjuntos.</li>

</ul>

### Tecnologías Utilizadas
Para este proyecto, hemos elegido un conjunto de tecnologías de vanguardia que nos garantizan la robustez, seguridad y escalabilidad necesarias.
<ul>

<li>Backend</li>
<ul>
</li>Laravel Framework: El corazón de nuestra aplicación. Nos proporciona una base sólida para la autenticación, las migraciones de la base de datos y la arquitectura MVC.</li>

<li>PHP: El lenguaje de programación principal.</li>
</ul>
Frontend
<ul>
<li>Laravel Livewire: Nos permite construir interfaces de usuario dinámicas y reactivas de forma sencilla, eliminando la necesidad de escribir mucho JavaScript.</li>

<li>Blade Templates: El motor de plantillas de Laravel para la renderización de las vistas.</li>

<li>Tailwind CSS: Un framework de CSS que nos permite diseñar la interfaz de usuario de forma rápida y eficiente, sin tener que escribir código CSS desde cero.</li>

<li>JavaScript: Para funcionalidades menores del lado del cliente.</li>
</ul>
Base de Datos
<ul>
<li>MySQL: Un sistema de gestión de bases de datos relacionales robusto y ampliamente utilizado.</li>
</ul>
</ul>

<hr>

## Instalación y Configuración del Entorno
Clonar el repositorio de GitHub:

Bash

git clone https://github.com/tu-usuario/gestor-de-contrasenas.git 
<br>
cd gestor-de-contrasenas
<br>

## Instalar las dependencias de Composer:

Bash

composer install
Configurar el archivo .env:

Copia el archivo .env.example a .env.

Configura la base de datos con tus credenciales.

Generar la clave de la aplicación:

Bash

php artisan key:generate

Ejecutar las migraciones de la base de datos:

Bash

php artisan migrate

Instalar las dependencias de Node.js y compilar los assets:

Bash

npm install
npm run dev
Iniciar el servidor local:

Bash

php artisan serve

<hr>

## Contribuciones
Las contribuciones son bienvenidas. Si encuentras un bug o tienes una sugerencia, por favor, abre un issue o envía un pull request.

