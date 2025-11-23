<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Widget\WidgetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'role:admin|manager'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('tickets.show');
        Route::patch('/tickets/{ticket}/status', [AdminTicketController::class, 'updateStatus'])->name('tickets.update-status');
    });


Route::get('/widget', [WidgetController::class, 'index']);


require __DIR__.'/auth.php';
