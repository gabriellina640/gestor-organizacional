<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReuniaoController; 
use App\Http\Controllers\ParticipantController;
/*
|--------------------------------------------------------------------------
| Rotas de autenticação
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| Rotas públicas
|--------------------------------------------------------------------------
*/
// Página inicial → redireciona pro login
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Rotas protegidas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

 

});
// Dashboard inicial
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/sprints', function () {
        return "Página de Sprint";
    })->name('sprints.index');

    Route::get('/participants/create', function () {
        return "Página de Cadastrar Integrantes";
    })->name('participants.create');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
Route::get('/reunioes', [ReuniaoController::class, 'index'])->name('reunioes.index');
// routes/web.php


Route::get('/reunioes', [ReuniaoController::class, 'index'])->name('reunioes.index');
Route::post('/reunioes', [ReuniaoController::class, 'store'])->name('reunioes.store');
Route::post('/reunioes/{id}/concluir', [ReuniaoController::class, 'concluir'])->name('reunioes.concluir');

Route::get('/reunioes/{id}/edit', [ReuniaoController::class, 'edit'])->name('reunioes.edit');
Route::put('/reunioes/{id}', [ReuniaoController::class, 'update'])->name('reunioes.update');

Route::delete('/reunioes/limpar', [ReuniaoController::class, 'limparConcluidas'])->name('reunioes.limpar');

Route::resource('participants', ParticipantController::class)->middleware('auth');
Route::resource('reunioes', ReuniaoController::class);
// ou explicitamente
Route::post('reunioes', [ReuniaoController::class, 'store'])->name('reunioes.store');
Route::put('reunioes/{id}', [ReuniaoController::class, 'update'])->name('reunioes.update');

Route::resource('reunioes', ReuniaoController::class);

Route::put('/reunioes/{id}', [ReuniaoController::class, 'update'])->name('reunioes.update');
Route::post('/reunioes/limpar-concluidas', [ReuniaoController::class, 'limparConcluidas'])
    ->name('reunioes.limparConcluidas');