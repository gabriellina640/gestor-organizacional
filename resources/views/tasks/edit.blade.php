@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Editar Tarefa: {{ $task->name }}</h2>

    <form action="{{ route('tasks.update', $task) }}" method="POST" class="bg-white p-8 rounded-lg shadow-md max-w-lg mx-auto">
        @csrf
        @method('PUT')

        <label for="name" class="block mb-2 font-medium text-gray-700">Nome</label>
        <input type="text" name="name" id="name" value="{{ old('name', $task->name) }}" required
            class="w-full border border-gray-300 rounded-md px-4 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-yellow-400" />
        @error('name') <p class="text-red-600 mb-4">{{ $message }}</p> @enderror

        <label for="description" class="block mb-2 font-medium text-gray-700">Descrição</label>
        <textarea name="description" id="description" rows="4"
            class="w-full border border-gray-300 rounded-md px-4 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ old('description', $task->description) }}</textarea>
        @error('description') <p class="text-red-600 mb-4">{{ $message }}</p> @enderror

        <label for="urgency" class="block mb-2 font-medium text-gray-700">Urgência (1=baixa, 2=média, 3=alta)</label>
        <input type="number" name="urgency" id="urgency" value="{{ old('urgency', $task->urgency) }}" min="1" max="3" required
            class="w-full border border-gray-300 rounded-md px-4 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-yellow-400" />
        @error('urgency') <p class="text-red-600 mb-4">{{ $message }}</p> @enderror

        <label for="estimated_hours" class="block mb-2 font-medium text-gray-700">Horas Estimadas</label>
        <input type="number" name="estimated_hours" id="estimated_hours" value="{{ old('estimated_hours', $task->estimated_hours) }}" min="0"
            class="w-full border border-gray-300 rounded-md px-4 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-yellow-400" />
        @error('estimated_hours') <p class="text-red-600 mb-4">{{ $message }}</p> @enderror

        <label for="status" class="block mb-2 font-medium text-gray-700">Status</label>
        <select name="status" id="status" required
            class="w-full border border-gray-300 rounded-md px-4 py-2 mb-6 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pendente</option>
            <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>Em Progresso</option>
            <option value="paused" {{ old('status', $task->status) == 'paused' ? 'selected' : '' }}>Pausado</option>
            <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Concluído</option>
        </select>
        @error('status') <p class="text-red-600 mb-4">{{ $message }}</p> @enderror

        <button type="submit" class="bg-yellow-500 text-white px-6 py-3 rounded-md hover:bg-yellow-600 transition">
            Atualizar
        </button>
    </form>
@endsection
