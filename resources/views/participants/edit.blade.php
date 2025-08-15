@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Editar Participante</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('participants.update', $participant) }}" class="bg-gray-50 p-6 rounded shadow flex flex-col gap-4">
        @csrf
        @method('PUT')

        <label class="flex flex-col">
            Nome
            <input type="text" name="name" value="{{ old('name', $participant->name) }}" class="border rounded p-2 w-full" required>
        </label>

        <label class="flex flex-col">
            Cargo (opcional)
            <input type="text" name="cargo" value="{{ old('cargo', $participant->cargo) }}" class="border rounded p-2 w-full">
        </label>

        <div class="flex gap-4 mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded font-bold">Salvar Alterações</button>
            <a href="{{ route('participants.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded font-bold">Cancelar</a>
        </div>
    </form>
</div>
@endsection
