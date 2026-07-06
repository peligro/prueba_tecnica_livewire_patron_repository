# Prueba Técnica - Player Notes Module

## Descripción
Módulo de historial de notas de jugador que permite a los agentes de soporte dejar notas internas sobre los jugadores, implementado con Laravel 13, Livewire 3 y arquitectura basada en el patrón Repository.

##  Características

- ✅ **Gestión de notas CRUD**: Crear y visualizar notas de jugadores
- ✅ **Sistema de permisos**: Control de acceso basado en roles (Admin, Support Agent, Viewer)
- ✅ **Frontend reactivo**: Livewire 3 para actualizaciones en tiempo real sin recargar la página
- ✅ **Arquitectura limpia**: Patrón Repository con inyección de dependencias
- ✅ **Validaciones**: Validación de formularios del lado del servidor
- ✅ **Tests automatizados**: Feature tests para verificar funcionalidad crítica
- ✅ **Soporte UTF-8**: Manejo correcto de caracteres especiales

## 📋 Requisitos

- Docker y Docker Compose
- PHP 8.4+
- Laravel 13.x
- PostgreSQL 15+
- Node.js 18+ y NPM

## 🛠️ Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/peligro/prueba_tecnica_livewire_patron_repository
cd laravel
```

### 2. Instalar dependencias de PHP
```bash
composer install
```

### 3. Configurar variables de entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar base de datos
```env
DB_CONNECTION=pgsql
DB_HOST=laravel-postgres
DB_PORT=5432
DB_DATABASE=livewire
DB_USERNAME=laravel
DB_PASSWORD=secret
```

### 5. Ejecutar migraciones y seeders
```bash
php artisan migrate --seed
```

### 6. Instalar dependencias de Node.js y compilar assets
```bash
npm install
npm run build
```

### 7. Iniciar el servidor de desarrollo
```bash
npm run dev
# En otra terminal
php artisan serve
```

## 👥 Usuarios de Prueba

| Rol | Email | Password | Permisos |
|-----|-------|----------|----------|
| **Admin** | admin@test.com | password | Todos los permisos |
| **Support Agent** | support@test.com | password | Crear y ver notas |
| **Viewer** | viewer@test.com | password | Solo ver notas |

## 🏗️ Arquitectura

### Patrón Repository

```text
app/
├── Repositories/
│   ├── PlayerNoteRepositoryInterface.php
│   └── EloquentPlayerNoteRepository.php
├── Models/
│   ├── Player.php
│   ├── PlayerNote.php
│   └── User.php
├── Livewire/
│   ── PlayerNotes.php
└── Providers/
    └── AppServiceProvider.php
```

### Capas de la aplicación

1. **Repository Layer**: Abstracción del acceso a datos
   - `PlayerNoteRepositoryInterface`: Contrato para operaciones de notas
   - `EloquentPlayerNoteRepository`: Implementación con Eloquent ORM

2. **Business Logic Layer**: Componentes Livewire
   - Manejo de estado y validaciones
   - Coordinación entre vistas y repositorios

3. **Presentation Layer**: Vistas Blade
   - Componentes Livewire reactivos
   - Bootstrap 5 para estilos

4. **Authorization Layer**: Spatie Laravel Permission
   - Roles y permisos configurables
   - Gates y policies integrados

## 🧪 Ejecutar Tests

```bash
# Ejecutar todos los tests
php artisan test

# Ejecutar solo tests del módulo Player Notes
php artisan test tests/Feature/PlayerNoteTest.php

# Ejecutar tests con cobertura
php artisan test --coverage
```

### Tests incluidos

- ✅ `test_support_agent_can_create_note`: Verifica que un agente de soporte puede crear notas
- ✅ `test_viewer_cannot_see_create_form`: Verifica que un viewer no ve el formulario de creación

## 📡 Endpoints

| Método | URL | Descripción | Auth |
|--------|-----|-------------|------|
| GET | `/` | Home page | Público |
| GET | `/login` | Login | Público |
| GET | `/dashboard` | Dashboard | Requerido |
| GET | `/players/{player}/notes` | Ver notas de un jugador | Requerido |
| POST | `/livewire/update` | Crear nota (Livewire) | Requerido + Permiso |

## 🔐 Permisos y Roles

### Roles disponibles

- **admin**: Acceso completo al sistema
- **support_agent**: Puede crear y visualizar notas
- **viewer**: Solo puede visualizar notas

### Permisos

- `create player note`: Permiso para crear nuevas notas
- `view player notes`: Permiso para visualizar notas

## 🎯 Decisiones Técnicas

### ¿Por qué Patrón Repository?

Aunque Eloquent ya es un ORM completo, se implementó el patrón Repository para:

1. **Abstracción**: Separar la lógica de acceso a datos del business logic
2. **Testabilidad**: Facilitar el mocking en tests unitarios
3. **Flexibilidad**: Permitir cambiar la fuente de datos sin afectar el resto del código
4. **Principio SOLID**: Cumplir con Dependency Inversion Principle

### ¿Por qué Spatie Permission?

- Estándar de la industria en Laravel
- Ampliamente probado y mantenido
- Integración nativa con Gates y Policies
- Soporte para roles y permisos multi-nivel

### ¿Por qué Livewire 3?

- Desarrollo rápido de interfaces reactivas
- Menos JavaScript que escribir
- Integración perfecta con Laravel
- Actualizaciones en tiempo real sin APIs complejas

## 📦 Dependencias Principales

```json
{
  "php": "^8.4",
  "laravel/framework": "^13.8",
  "livewire/livewire": "^3.5",
  "spatie/laravel-permission": "^6.0"
}
```

## 🔧 Configuración Adicional

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

## Regenerar autoload
```bash
composer dump-autoload
```

## 📝 Notas Importantes

- La aplicación usa **PostgreSQL** como base de datos
- Las sesiones se almacenan en **base de datos**
- El cache se almacena en **base de datos**
- Se requiere **PHP 8.4** mínimo por uso de typed properties y return types
- Los assets están compilados con **Vite**

## 👨‍ Autor

**César Cancino**
- Web: [cesarcancino.com](https://www.cesarcancino.com)

## 📄 Licencia

Este proyecto es parte de una prueba técnica y está bajo licencia privada.

---

**Fecha de entrega**: Julio 2026  
**Versión**: 1.0.0