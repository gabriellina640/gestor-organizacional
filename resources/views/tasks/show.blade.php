@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Detalhes da Tarefa: {{ $task->name }}</h2>

    <div class="bg-white p-6 rounded-lg shadow max-w-lg">
        <p class="mb-3"><strong>Nome:</strong> {{ $task->name }}</p>
        <p class="mb-3"><strong>Descrição:</strong> {{ $task->description ?? 'Nenhuma descrição' }}</p>
        <p class="mb-3"><strong>Urgência:</strong> {{ $task->urgency }}</p>
        <p class="mb-3"><strong>Horas Estimadas:</strong> {{ $task->estimated_hours ?? 'Não informado' }}</p>
        <p class="mb-3"><strong>Status:</strong> <span class="capitalize">{{ str_replace('_', ' ', $task->status) }}</span></p>

        <div class="mt-6 flex space-x-4">
            <a href="{{ route('tasks.edit', $task) }}" 
               class="bg-yellow-500 text-white px-5 py-2 rounded-md hover:bg-yellow-600 transition">
               Editar
            </a>
            <a href="{{ route('tasks.index') }}" 
               class="bg-gray-400 text-white px-5 py-2 rounded-md hover:bg-gray-500 transition">
               Voltar
            </a>
        </div>
    </div>
@endsection
