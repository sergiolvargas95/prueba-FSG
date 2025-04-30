# 🧑‍💻 Sistema de Gestión de Usuarios

Aplicación web desarrollada en PHP utilizando Laravel que permite el registro, login y gestión de usuarios con distintos roles (Administrador y Usuario Regular). Este sistema implementa una arquitectura sólida y buenas prácticas de desarrollo, enfocándose en la seguridad, escalabilidad y facilidad de mantenimiento.

---

## ✨ Funcionalidades Principales

- **Registro y Login de Usuarios**  
  Permite a nuevos usuarios registrarse y luego autenticarse con sus credenciales mediante un sistema de sesiones personalizado.

- **Gestión de Usuarios (Admin)**  
  Los administradores pueden acceder a un listado completo de usuarios registrados y modificar/agregar fotos a cada perfil.

- **Perfil de Usuario (Regular)**  
  Los usuarios regulares pueden ver y cambiar su foto de perfil.

- **Recuperación de Contraseña**  
  El sistema cuenta con una funcionalidad de recuperación de contraseña mediante el envío de un código de verificación al correo electrónico del usuario.

---

## 🛠️ Stack Tecnológico

- **Backend:** PHP 8.2 con Laravel 11.9
- **Frontend:** Blade (Laravel) / HTML / CSS
- **Base de Datos:** MySQL
- **Autenticación:** Sesiones de PHP personalizadas con middleware
- **ORM:** Eloquent
- **Servidor local:** Laravel Artisan

---

## 🚀 ¿Qué hace único a este proyecto?

Este sistema está construido sobre el patrón de arquitectura **MVC (Modelo-Vista-Controlador)**, lo cual permite una separación clara de responsabilidades y facilita la escalabilidad del proyecto.

Además:

- Se utiliza un **middleware de autenticación personalizado** que gestiona el acceso a rutas protegidas según el rol del usuario.
- La seguridad se refuerza mediante sesiones y control de acceso basado en roles (RBAC).
- Se promueve una estructura limpia de código, reutilizable y mantenible.

---

## 🗃️ Modelo de Base de Datos

La base de datos del sistema está diseñada para gestionar usuarios, sus roles y el proceso de recuperación de contraseñas. A continuación se describe cada tabla y sus relaciones:

### 🔐 `seg_usuario`
Contiene la información principal de los usuarios del sistema.

| Campo                   | Descripción                          |
|-------------------------|--------------------------------------|
| `idUsuario`             | Identificador único del usuario      |
| `usuarioAlias`          | Alias del usuario                    |
| `usuarioPassword`       | Contraseña cifrada del usuario       |
| `usuarioNombre`         | Nombre completo del usuario          |
| `usuarioEmail`          | Correo electrónico del usuario       |
| `usuarioFoto`           | URL de la foto de perfil             |
| `usuarioEstado`         | Estado del usuario (activo/inactivo) |
| `usuarioConectado`      | Estado de conexión                   |
| `usuarioUltimaConexion` | Fecha y hora de última conexión      |

---

### 🧑‍💼 `roles`
Define los roles disponibles en el sistema.

| Campo      | Descripción             |
|------------|-------------------------|
| `idRol`    | Identificador del rol   |
| `nombreRol`| Nombre del rol          |

---

### 🔗 `usuario_rol`
Tabla intermedia para la relación muchos a muchos entre usuarios y roles.

| Campo      | Descripción              |
|------------|--------------------------|
| `idUsuario`| ID del usuario           |
| `idRol`    | ID del rol               |

---

### 🔁 `password_resets`
Tabla auxiliar para el proceso de recuperación de contraseñas.

| Campo       | Descripción                            |
|-------------|----------------------------------------|
| `email`     | Email asociado al usuario              |
| `token`     | Token único para restablecimiento      |


## 🧪 Guía de Instalación en Entorno Local

Sigue estos pasos para ejecutar el proyecto en tu máquina local:

### 📁 1. Clonar el repositorio

```bash
git clone https://github.com/tuusuario/tu-proyecto.git
cd tu-proyecto
```

### 📦 2. Instalar dependencias

Asegúrate de tener Composer instalado en tu sistema.

```bash
composer install
```

### ⚙️ 3. Copiar el archivo de entorno

```bash 
cp .env.example .env
```

#### 🧱 4. Ejecutar migraciones
Este comando creará todas las tablas necesarias en tu base de datos:

```bash 
php artisan migrate
```

### 🚀 6. Iniciar el servidor de desarrollo
Ejecuta el siguiente comando para iniciar el servidor integrado de Laravel:

```bash
php artisan serve
```

🌐 8. Acceder a la aplicación
Abre tu navegador y visita:

```bash
http://localhost:8000
```

## 🧭 Guía de Uso

A continuación se describe cómo interactuar con la aplicación, tanto para usuarios regulares como para administradores.

---

### 👤 1. Registro de Usuario

- Accede a la ruta `/register`.
- Completa el formulario con tu nombre, correo electrónico, contraseña y confirmación de contraseña.
- Al registrarte, recibirás un correo de confirmación (si está habilitado el servicio de correo).
  
![register_user](https://github.com/user-attachments/assets/e34fc39d-809d-4d39-af78-e23dcb227ad3)

---

### 🔐 2. Iniciar Sesión

- Accede a `/login`.
- Ingresa tu correo y contraseña registrados.
- Si las credenciales son válidas, serás redirigido a tu panel de usuario.

---

### 🔄 3. Recuperar Contraseña

- Accede a `/forgot-password`.
- Ingresa tu correo electrónico.
- Recibirás un correo con un **código de validación**.
- Introduce el código recibido en la ruta indicada y crea una nueva contraseña.

---

### 🧑‍💼 4. Funcionalidades para Usuario Regular

- Accede a tu perfil desde el panel de navegación.
- Puedes:
  - Ver tu información personal.
  - Cambiar tu foto de perfil.
  - Modificar tu contraseña desde el área de ajustes.
- No tienes acceso a datos de otros usuarios.

---

### 🛠️ 5. Funcionalidades para Administradores

- Desde el panel de administración puedes:
  - Ver el **listado de todos los usuarios registrados**.
  - Acceder a cada perfil individual.
  - Subir o actualizar fotos para cada usuario.
  - Administrar datos básicos de los usuarios si es necesario.

> ⚠️ Solo los usuarios con rol **admin** pueden acceder a estas funcionalidades, protegidas mediante middleware personalizado.

---

### 🚪 6. Cerrar Sesión

- Haz clic en el botón “Cerrar sesión” en el menú superior.
- La sesión se destruirá y serás redirigido a la pantalla de inicio.

---

### 💡 Recomendaciones

- Usa contraseñas seguras.
- Mantén tu correo actualizado para recuperación de cuenta.
- Si tienes rol admin, maneja los datos con responsabilidad.



## ✅ Buenas Prácticas Implementadas

- Uso del patrón **MVC** para separar la lógica de presentación y de negocio.
- **Middlewares personalizados** para proteger rutas según el rol del usuario.
- **Validaciones robustas** en controladores y formularios para garantizar datos consistentes.
- Envío de correos implementado mediante **servicios SMTP** utilizando las utilidades de Laravel.
- **Migraciones versionadas** para mantener una estructura clara y evolutiva de la base de datos.
- Uso de **Blade Templates** para construir vistas dinámicas, reutilizables y mantenibles.
- Organización **modular del código** para facilitar el mantenimiento y escalabilidad.
- Se evita colocar lógica en las vistas, respetando el **principio de responsabilidad única (SRP)**.
- Control de errores mediante manejo de excepciones y **respuestas claras y amigables** al usuario.
