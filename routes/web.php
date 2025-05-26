<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RifaController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// web.php

// Página pública
Route::get('/', [TicketController::class, 'index']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');

// Procesar login
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
// Dashboard privado
Route::middleware('auth')->group(function(){
    Route::get('/comprar', [TicketController::class, 'showPurchaseForm'])->name('tickets.comprar');
    Route::post('/comprar', [TicketController::class, 'purchase'])->name('tickets.purchase');
    Route::get('/resumen-ventas', [TicketController::class, 'resumenVentas'])->name('tickets.resumen');
    Route::get('/confirmar-pagos', [TicketController::class, 'pagos'])->name('tickets.pago');
    Route::post('/tickets/confirmar-pagos', [TicketController::class, 'confirmarPagos'])->name('tickets.confirmarPagos');
});
