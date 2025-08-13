<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Auth;

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

    // Dashboard inicial do usuário
    Route::get('/dashboard', [OrganizationController::class, 'dashboard'])
        ->name('dashboard');

    // Organização
    Route::get('/organization/create', [OrganizationController::class, 'create'])->name('organization.create');
    Route::post('/organization', [OrganizationController::class, 'store'])->name('organization.store');
    Route::get('/organization/{organization}/edit', [OrganizationController::class, 'edit'])->name('organization.edit');
    Route::put('/organization/{organization}', [OrganizationController::class, 'update'])->name('organization.update');

    // Tarefas
    Route::resource('tasks', TaskController::class);

    // Reuniões
    Route::resource('meetings', MeetingController::class);
    Route::post('meetings/{meeting}/checkin/{user}', [MeetingController::class, 'checkIn'])->name('meetings.checkin');

    // Participantes
    Route::resource('participants', ParticipantController::class);
});
