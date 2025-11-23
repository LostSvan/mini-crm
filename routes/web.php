<?php

use App\Http\Controllers\Widget\WidgetController;
use Illuminate\Support\Facades\Route;

Route::get('/widget', [WidgetController::class, 'index']);
