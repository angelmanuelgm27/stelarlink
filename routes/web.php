<?php

use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\PaymentMethodsController;
use App\Http\Controllers\Admin\PlanController as AdminPlanController;
use App\Http\Controllers\Admin\ServiciosController as AdminServiciosController;
use App\Http\Controllers\Admin\StaffController as AdminStaffController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FinishedController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstallerPayment;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Profiles;
use App\Http\Controllers\TechnicalSupportGroupController;
use App\Http\Controllers\TechnicalSupportTaskController;
use App\Http\Controllers\Users\UserPlanController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ZoneController;
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
Route::get('/administrador/usuario', [AdminUsersController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.users');

Route::put('/administrador/usuario/{user}/add-funds', [AdminUsersController::class, 'addFunds'])
    ->middleware(['auth', 'verified'])
    ->name('admin.user.addFunds');

Route::put('/administrador/usuario/{user}/withdraw-funds', [AdminUsersController::class, 'withdrawFunds'])
    ->middleware(['auth', 'verified'])
    ->name('admin.user.withdrawFunds');

// ACTIVIDADES COMPLETADS

Route::get('/administrador/actividades-completadas', [InstallerPayment::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('installer.payment.index');

Route::put('/administrador/actividades-completadas/{finished}/pagar', [InstallerPayment::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('installer.payment.store');

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
Route::get('/administrador/plan', [AdminPlanController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.requests.index');

Route::get('/administrador/plan/{id}', [AdminPlanController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('admin.requests.show');

Route::post('/administrador/plan/{plan}', [AdminPlanController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('admin.requests.update');


// metodos de pago
Route::get('/administrador/metodos-pagos', [PaymentMethodsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.payment.methods.index');

Route::post('/administrador/metodos-pagos', [PaymentMethodsController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('admin.payment.methods.store');

Route::delete('/administrador/metodos-pagos/{payment_method}', [PaymentMethodsController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('admin.payment.methods.destroy');

Route::put('/administrador/metodos-pagos/{payment_method}', [PaymentMethodsController::class, 'availability'])
    ->middleware(['auth', 'verified'])
    ->name('admin.payment.methods.availability');

Route::put('/administrador/rechazar-plan/{plan}', [AdminPlanController::class, 'reject'])
    ->middleware(['auth', 'verified'])
    ->name('admin.requests.reject');

Route::put('/administrador/suspender-plan/{plan}', [AdminPlanController::class, 'suspend'])
    ->middleware(['auth', 'verified'])
    ->name('admin.requests.suspend');

Route::put('/administrador/activar-plan/{plan}', [AdminPlanController::class, 'activate'])
    ->middleware(['auth', 'verified'])
    ->name('admin.requests.activate');

// PAGOS
Route::get('/administrador/pago', [PaymentController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.payment.index');

Route::put('/administrador/aprobar-pago/{payment}', [PaymentController::class, 'approve'])
    ->middleware(['auth', 'verified'])
    ->name('admin.payment.approve');

Route::put('/administrador/rechazar-pago/{payment}', [PaymentController::class, 'reject'])
    ->middleware(['auth', 'verified'])
    ->name('admin.payment.reject');

//'admin.map.delete
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
//     ->name('home');

//CLIENTE
Route::get('/cliente/plan', [UserPlanController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('client.plans');

Route::post('/cliente/plan/compra', [UserPlanController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('client.plans.shop');

Route::put('/cliente/plan/cancelar/{plan}', [UserPlanController::class, 'cancel'])
    ->middleware(['auth', 'verified'])
    ->name('client.plans.cancel');

Route::put('/cliente/plan/activar/{plan}', [UserPlanController::class, 'activate'])
    ->middleware(['auth', 'verified'])
    ->name('client.plans.activate');

//BILETERA
Route::get('/cliente/billetera', [WalletController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('wallet.index');

Route::get('/cliente/agregar-fondos', [FundController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('funds.index');

Route::get('/cliente/metodo-de-pago/{payment_method}', [FundController::class, 'getPaymenMethod'])
    ->middleware(['auth', 'verified'])
    ->name('payment.method.show');

Route::post('/cliente/pago', [PaymentController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('payment.store');

//INVOICE
Route::get('/invoice/{invoice}', [InvoiceController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('invoice.show');

//SOPORTE TECNICO
Route::get('/soporte-tecnico/actividades-completadas', [FinishedController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('completedActivities.index');

//SOPORTE TECNICO - GRUPOS
Route::get('/soporte-tecnico/grupos-instaladores', [TechnicalSupportGroupController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('technical.support.group.index');

Route::post('/soporte-tecnico/grupos-instaladores', [TechnicalSupportGroupController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('technical.support.group.store');

Route::delete('/soporte-tecnico/grupos-instaladores/{technicalSupportGroup}', [TechnicalSupportGroupController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('technical.support.group.destroy');

Route::PUT('/soporte-tecnico/update-availability/{technical_support_group}', [TechnicalSupportGroupController::class, 'updateAvailability'])
    ->middleware(['auth', 'verified'])
    ->name('technical.support.group.update.availability');

//SOPORTE TECNICO - TASKS
Route::get('/soporte-tecnico/actividades', [TechnicalSupportTaskController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('technical.support.task.index');

Route::put('/soporte-tecnico/actividades/{task}', [TechnicalSupportTaskController::class, 'markAsCompleted'])
    ->middleware(['auth', 'verified'])
    ->name('technical.support.task.completed');

//GESTION DE ZONAS
Route::get('/administrador/zona', [ZoneController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('zone.index');

Route::post('/administrador/zona', [ZoneController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('zone.store');

Route::delete('/administrador/zona/{zone}', [ZoneController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('zone.destroy');

//COBRANZAS
// Route::get('/cobranzas/historial-pagos', [AdminStaffController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('admin.staff');


// ARCHIVOS
Route::get('/file/{file}', [FileController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('file.show');

// NOTIFICACIONES
Route::get('notificaciones/index', [NotificationsController::class, 'index'])
    ->name('notificaciones.index');

Route::get('notificaciones/get', [NotificationsController::class, 'getNotificationsData'])
    ->name('notificaciones.get');

Route::put('notificacion/{notification}/visto', NotificationSeenController::class)
    ->name('notificacion.visto');

Route::delete('notificacion/{notification}/borrar', [NotificationsController::class, 'delete'])
    ->name('notificacion.borrar');
