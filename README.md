# 🧑‍💻 Sistema de Gestión de Usuarios

Aplicación web desarrollada en PHP utilizando Laravel que permite el registro, login y gestión de usuarios con distintos roles (Administrador y Usuario Regular). Este sistema implementa una arquitectura sólida y buenas prácticas de desarrollo, enfocándose en la seguridad, escalabilidad y facilidad de mantenimiento.

---

## ✨ Funcionalidades Principales

- **Registro y Login de Usuarios**  
  Permite a nuevos usuarios registrarse y luego autenticarse con sus credenciales mediante un sistema de sesiones personalizado.

- **Gestión de Usuarios (Admin)**  
  Los administradores pueden acceder a un listado completo de usuarios registrados y modificar/agregar fotos a cada perfil.

- **Perfil de Usuario (Regular)**  
  Los usuarios regulares pueden ver y editar su propia información y cambiar su foto de perfil.

- **Recuperación de Contraseña**  
  El sistema cuenta con una funcionalidad de recuperación de contraseña mediante el envío de un código de verificación al correo electrónico del usuario.

---

## 🛠️ Stack Tecnológico

- **Backend:** PHP 8.x con Laravel
- **Frontend:** Blade (Laravel) / HTML / CSS
- **Base de Datos:** MySQL
- **Autenticación:** Sesiones de PHP personalizadas con middleware
- **ORM:** Eloquent
- **Servidor local:** Laravel Artisan o XAMPP

---

## 🚀 ¿Qué hace único a este proyecto?

Este sistema está construido sobre el patrón de arquitectura **MVC (Modelo-Vista-Controlador)**, lo cual permite una separación clara de responsabilidades y facilita la escalabilidad del proyecto.

Además:

- Se utiliza un **middleware de autenticación personalizado** que gestiona el acceso a rutas protegidas según el rol del usuario.
- La seguridad se refuerza mediante sesiones y control de acceso basado en roles (RBAC).
- Se promueve una estructura limpia de código, reutilizable y mantenible.

> 💡 Aquí puedes incluir una imagen del diagrama de la arquitectura MVC aplicada al proyecto.

---

## 🗂️ Estructura del Proyecto (Laravel)

```plaintext
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Controladores MVC
│   │   ├── Middleware/         # Middleware de autenticación
│   ├── Models/                 # Modelos de la base de datos
├── database/
│   ├── migrations/             # Migraciones para crear las tablas
├── public/                     # Archivos públicos como imágenes y assets
├── resources/
│   ├── views/                  # Vistas Blade del sistema
├── routes/
│   └── web.php                 # Definición de rutas web
├── .env                        # Variables de entorno (DB, Mail, etc)
