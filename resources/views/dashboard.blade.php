@extends('layouts.app')

@section('content')
<div x-data="{ openModal: false }" class="min-h-screen flex flex-col items-center px-4">
    <!-- Bem-vindo + Botões -->
    <div class="flex flex-col items-center" style="margin-top: 70px;">
        <h1 class="text-3xl font-bold text-center mb-4">
            Bem-vindo, {{ Auth::user()->name }}!
        </h1><br>

        <div class="flex gap-4">
            <!-- Botão para abrir modal de cadastro -->
            <button 
                @click="openModal = true" 
                class="bg-blue-200 hover:bg-blue-300 text-blue-900 font-bold py-3 px-6 rounded shadow">
                Cadastrar Participantes
            </button>

            <!-- Botão para gerenciar participantes -->
            <a href="{{ route('participants.index') }}" 
                class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-6 rounded shadow">
                Gerenciar Participantes
            </a>
        </div>
    </div>

    <!-- Banners -->
    <div style="display: flex; justify-content: center; gap: 2rem; margin-top: 4rem; flex-wrap: wrap;">
        <!-- Banner Reunião -->
        <a href="{{ route('reunioes.index') }}" 
           style="flex: 0 0 400px; height: 400px; position: relative; overflow: hidden; border-radius: 0.5rem;">
            <img src="{{ asset('images/reuniao.png') }}" 
                 style="width: 100%; height: 100%; object-fit: cover;" alt="Reunião">
        </a>

        <!-- Banner Sprint -->
        <a href="{{ route('tarefas.index') }}" 
           style="flex: 0 0 400px; height: 400px; position: relative; overflow: hidden; border-radius: 0.5rem;">
            <img src="{{ asset('images/tarefas.png') }}" 
                 style="width: 100%; height: 100%; object-fit: cover;" alt="Sprint">
        </a>
    </div>

    <!-- Formulário de cadastro de participante -->
    <div x-show="openModal" 
         @click.away="openModal = false"
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4"
         x-transition
         x-cloak>
         
        <div class="bg-gray-50 p-4 rounded shadow relative w-full max-w-md">
            <!-- Botão de fechar -->
            <div class="flex justify-end">
                <button @click="openModal = false" 
                        class="text-gray-500 hover:text-gray-800 font-bold text-xl">&times;</button>
            </div>

            <h2 class="text-xl font-bold mb-4">Cadastrar Participante</h2>

            <form method="POST" action="{{ route('participants.store') }}" class="flex flex-col gap-4 mt-2">
                @csrf
                <input type="text" name="name" placeholder="Nome" class="border rounded p-2 w-full" required>
                <input type="text" name="cargo" placeholder="Cargo (opcional)" class="border rounded p-2 w-full">
                
                <button type="submit" class="btn-preto">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection
