@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-blue-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Organiza Ai</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nome -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nome</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">E-mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Senha -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-2">Senha</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmar Senha -->
            <div class="mb-4">
                <label for="password-confirm" class="block text-gray-700 font-medium mb-2">Confirmar Senha</label>
                <input id="password-confirm" type="password" name="password_confirmation" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Botão -->
            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
                    Cadastrar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
