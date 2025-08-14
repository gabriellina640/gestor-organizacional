@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10"><br>
    <h1 class="text-2xl font-bold mb-6">Gerenciar Participantes</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">Nome</th>
                <th class="border border-gray-300 px-4 py-2">Cargo</th>
                <th class="border border-gray-300 px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($participants as $participant)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $participant->name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $participant->cargo ?? '—' }}</td>
                <td class="border border-gray-300 px-4 py-2 flex gap-2">
                    <a href="{{ route('participants.edit', $participant) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Editar</a>
                    <form action="{{ route('participants.destroy', $participant) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
