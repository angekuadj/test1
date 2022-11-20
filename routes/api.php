<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ProfController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SalleController;
use App\Http\Controllers\Api\ClasseController;
use App\Http\Controllers\Api\EmploiController;
use App\Http\Controllers\Api\RoleUsersController;
use App\Http\Controllers\Api\UserEmploisController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\ProfEmploisController;
use App\Http\Controllers\Api\SalleEmploisController;
use App\Http\Controllers\Api\ClasseEmploisController;
use App\Http\Controllers\Api\UserReservationsController;
use App\Http\Controllers\Api\SalleReservationsController;
use App\Http\Controllers\Api\ClasseReservationsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('users', UserController::class);

        // User Reservations
        Route::get('/users/{user}/reservations', [
            UserReservationsController::class,
            'index',
        ])->name('users.reservations.index');
        Route::post('/users/{user}/reservations', [
            UserReservationsController::class,
            'store',
        ])->name('users.reservations.store');

        // User Emplois
        Route::get('/users/{user}/emplois', [
            UserEmploisController::class,
            'index',
        ])->name('users.emplois.index');
        Route::post('/users/{user}/emplois', [
            UserEmploisController::class,
            'store',
        ])->name('users.emplois.store');

        Route::apiResource('classes', ClasseController::class);

        // Classe Reservations
        Route::get('/classes/{classe}/reservations', [
            ClasseReservationsController::class,
            'index',
        ])->name('classes.reservations.index');
        Route::post('/classes/{classe}/reservations', [
            ClasseReservationsController::class,
            'store',
        ])->name('classes.reservations.store');

        // Classe Emplois
        Route::get('/classes/{classe}/emplois', [
            ClasseEmploisController::class,
            'index',
        ])->name('classes.emplois.index');
        Route::post('/classes/{classe}/emplois', [
            ClasseEmploisController::class,
            'store',
        ])->name('classes.emplois.store');

        Route::apiResource('salles', SalleController::class);

        // Salle Salles
        Route::get('/salles/{salle}/reservations', [
            SalleReservationsController::class,
            'index',
        ])->name('salles.reservations.index');
        Route::post('/salles/{salle}/reservations', [
            SalleReservationsController::class,
            'store',
        ])->name('salles.reservations.store');

        // Salle Emplois
        Route::get('/salles/{salle}/emplois', [
            SalleEmploisController::class,
            'index',
        ])->name('salles.emplois.index');
        Route::post('/salles/{salle}/emplois', [
            SalleEmploisController::class,
            'store',
        ])->name('salles.emplois.store');

        Route::apiResource('reservations', ReservationController::class);

        Route::apiResource('roles', RoleController::class);

        // Role Users
        Route::get('/roles/{role}/users', [
            RoleUsersController::class,
            'index',
        ])->name('roles.users.index');
        Route::post('/roles/{role}/users', [
            RoleUsersController::class,
            'store',
        ])->name('roles.users.store');

        Route::apiResource('all-emploitemps', EmploiController::class);

        Route::apiResource('profs', ProfController::class);

        // Prof Emplois
        Route::get('/profs/{prof}/emplois', [
            ProfEmploisController::class,
            'index',
        ])->name('profs.emplois.index');
        Route::post('/profs/{prof}/emplois', [
            ProfEmploisController::class,
            'store',
        ])->name('profs.emplois.store');
    });
