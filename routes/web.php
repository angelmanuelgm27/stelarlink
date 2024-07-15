<?php

use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\MethodsPaymentsController as AdminMethodsPaymentsController;
use App\Http\Controllers\Admin\ServiciosController as AdminServiciosController;
use App\Http\Controllers\Admin\SolicitudesController as AdminSolicitudesController;
use App\Http\Controllers\Admin\StaffController as AdminStaffController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Profiles;
use App\Http\Controllers\TechnicalSupportGroupController;
use App\Http\Controllers\TechnicalSupport\SolicitudesController as TechnicalSolicitudesController;
use App\Http\Controllers\Users\PlansController;
use App\Mail\Contact;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home'])
    ->name('home');
Route::get('/nosotros', [HomeController::class, 'about'])
    ->name('about');
Route::post('/form-contacto', [HomeController::class, 'contact'])
    ->name('form.contact');
Auth::routes();

Route::get('/dashboard', [HomeController::class, 'panel'])
    ->middleware(['auth', 'verified']);
Route::get('/perfil', [HomeController::class, 'profile'])
    ->middleware(['auth', 'verified'])
    ->name('profile');
Route::put('/perfil/imagen-actualizar/{id}', [Profiles::class, 'updateAvatar'])
    ->middleware(['auth', 'verified'])
    ->name('profile.update.image');
Route::put('/perfil/actualizar/{id}', [Profiles::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('profile.update');

//ADMINISTRADOR - USUARIOS
Route::get('/administrador/usuarios', [AdminUsersController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.users');
Route::get('/administrador/usuarios/all', [AdminUsersController::class, 'list'])
    ->middleware(['auth', 'verified'])
    ->name('admin.users.all');
Route::patch('/administrador/usuarios/{id}', [AdminUsersController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('admin.users.update');
Route::delete('/administrador/usuarios/{id}', [AdminUsersController::class, 'delete'])
    ->middleware(['auth', 'verified'])
    ->name('admin.users.delete');

//ADMINISTRADOR - EMPLEADOS
Route::get('/administrador/personal', [AdminStaffController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.staff');
Route::post('/administrador/personal/crear', [AdminStaffController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('admin.staff.create');
Route::get('/administrador/personal/all', [AdminStaffController::class, 'list'])
    ->middleware(['auth', 'verified'])
    ->name('admin.staff.list');
Route::delete('/administrador/personal/{id}', [AdminStaffController::class, 'delete'])
    ->middleware(['auth', 'verified'])
    ->name('admin.staff.delete');

//ADMINISTRADOR

// me parece que es incorrecto ***
// Route::get('/administrador/solicitudes-instlacion', [AdminStaffController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('admin.staff');

//ADMINISTRADOR - SERVICIOS
Route::get('/administrador/servicios/all', [AdminServiciosController::class, 'list'])
    ->middleware(['auth', 'verified'])
    ->name('admin.services.all');
Route::get('/administrador/servicios', [AdminServiciosController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.services');
Route::patch('/administrador/servicios/estado/{id}', [AdminServiciosController::class, 'updateStatus'])
    ->middleware(['auth', 'verified'])
    ->name('admin.services.update.status');
Route::patch('/administrador/servicios/editar/{id}', [AdminServiciosController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('admin.services.update');
Route::delete('/administrador/servicios/eliminar/{id}', [AdminServiciosController::class, 'delete'])
    ->middleware(['auth', 'verified'])
    ->name('admin.services.delete');
Route::post('/administrador/servicios/crear', [AdminServiciosController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('admin.services.create');

//MAPA
Route::get('/administrador/mapa', [MapController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.map');
Route::post('/administrador/mapa/crear-punto', [MapController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('admin.map.create');
Route::get('/administrador/mapa/delete/${id}', [MapController::class, 'delete'])
    ->middleware(['auth', 'verified'])
    ->name('admin.map.delete');

//SOLCITUD INSTALACION
Route::get('/administrador/solicitudes-instlacion', [AdminSolicitudesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.requests.index');
Route::get('/administrador/solicitudes-instlacion/{id}', [AdminSolicitudesController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('admin.requests.show');

//METODOS DE PAGO
Route::get('/administrador/metodos-pagos', [AdminMethodsPaymentsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.staff');

//'admin.map.delete
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
//     ->name('home');

//CLIENTE
Route::get('/cliente/planes', [PlansController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('client.plans');
Route::post('/cliente/planes/compra', [PlansController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('client.plans.shop');
Route::get('/cliente/planes/list', [PlansController::class, 'findAll'])
    ->middleware(['auth', 'verified'])
    ->name('client.plans.user');
//route('client.plans.user')

//SOPORTE TECNICO
Route::get('/soporte-tecnico/solicitudes-instlacion', [TechnicalSolicitudesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.staff');

//SOPORTE TECNICO - GRUPOS
Route::get('/soporte-tecnico/grupos-instaladores', [TechnicalSupportGroupController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('technical-support-group.index');
Route::post('/soporte-tecnico/grupos-instaladores', [TechnicalSupportGroupController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('technical-support-group.store');
Route::delete('/soporte-tecnico/grupos-instaladores/{technicalSupportGroup}', [TechnicalSupportGroupController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('technical-support-group.destroy');

//COBRANZAS
// Route::get('/cobranzas/historial-pagos', [AdminStaffController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('admin.staff');
