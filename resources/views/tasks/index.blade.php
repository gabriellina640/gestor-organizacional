@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Tarefas</h1>

    <a href="{{ route('tasks.create') }}"
        class="inline-block mb-6 px-5 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
        Criar nova tarefa
    </a>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-md shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($tasks->isEmpty())
        <p class="text-gray-600">Nenhuma tarefa encontrada.</p>
    @else
        <ul class="space-y-4">
            @foreach($tasks as $task)
                <li class="bg-white rounded-lg shadow p-4 flex justify-between items-center">
                    <div>
                        <a href="{{ route('tasks.show', $task) }}"
                            class="font-semibold text-indigo-600 hover:underline">{{ $task->name }}</a>
                        <p class="text-gray-600 text-sm mt-1">
                            Status: {{ ucfirst(str_replace('_', ' ', $task->status)) }} &mdash; Urgência: {{ $task->urgency }}
                        </p>
                    </div>

                    <div class="flex space-x-3">
                        <a href="{{ route('tasks.edit', $task) }}"
                            class="px-4 py-2 bg-yellow-400 text-white rounded-md hover:bg-yellow-500 transition">
                            Editar
                        </a>

                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar esta tarefa?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                                Deletar
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
