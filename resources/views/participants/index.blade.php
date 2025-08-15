@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10"><br>
    <h1 class="text-2xl font-bold mb-6">Gerenciar Participantes</h1>

    <!-- Mensagem de sucesso -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabela de participantes -->
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
                <td class="border border-gray-300 px-4 py-2 text-right space-x-2">
                    <!-- Botão Editar -->
                    <a href="{{ route('participants.edit', $participant) }}" 
                       class="inline-flex items-center justify-center bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Editar</a>

                    <!-- Botão Excluir -->
                    <form action="{{ route('participants.destroy', $participant) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')" class="inline-flex">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach

            @if($participants->isEmpty())
            <tr>
                <td colspan="3" class="border border-gray-300 px-4 py-2 text-center text-gray-500">Nenhum participante cadastrado.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
