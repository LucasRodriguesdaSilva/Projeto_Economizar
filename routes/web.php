<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [DashboardController::class, 'index']);
Route::post('/criar_valor', [DashboardController::class, 'store']);

/* Criar a rota de deletar dados e a rota de alterar dados */
/* Criar a rota de gerar gráficos */