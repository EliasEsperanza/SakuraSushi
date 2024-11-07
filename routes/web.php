<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuentaContableController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstadoFinancieroController;
use App\Http\Controllers\DocumentoFuenteController;
/*

*/

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/



Route::resource('documento_fuentes', DocumentoFuenteController::class)->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/estado-financiero/balance-comprobacion', [EstadoFinancieroController::class, 'balanceComprobacion'])->name('estado_financiero.balance_comprobacion');
Route::get('/estado-financiero/balance-general', [EstadoFinancieroController::class, 'balanceGeneral'])->name('estado_financiero.balance_general');
Route::get('/estado-financiero/estado-resultados', [EstadoFinancieroController::class, 'estadoResultados'])->name('estado_financiero.estado_resultados');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::middleware(['auth'])->group(function () {
    Route::get('/cuentas', [CuentaContableController::class, 'indexView'])->name('cuentas.index');
    Route::get('/cuentas/crear', [CuentaContableController::class, 'createView'])->name('cuentas.create');
    Route::get('/cuentas/{id}/editar', [CuentaContableController::class, 'editView'])->name('cuentas.edit');
    Route::get('/cuentas/{id}/mayor', [CuentaContableController::class, 'mayorizar'])->name('cuentas.mayorizar');

    
    Route::get('/transacciones', [TransaccionController::class, 'indexView'])->name('transacciones.index');
    Route::get('/transacciones/crear', [TransaccionController::class, 'createView'])->name('transacciones.create');
    Route::get('/transacciones/{id}/editar', [TransaccionController::class, 'editView'])->name('transacciones.edit');
    Route::put('/transacciones/{id}', [TransaccionController::class, 'update'])->name('transacciones.update');
    Route::delete('/transacciones/{id}', [TransaccionController::class, 'destroy'])->name('transacciones.destroy');
    Route::get('/libro-diario', [TransaccionController::class, 'libroDiario'])->name('libro.diario');

});
