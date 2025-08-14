@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-blue-100">
    
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-center text-blue-600 mb-6"></h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
          <div class="flex flex-col items-center mb-6">
       <img src="{{ asset('images/slogan.png') }}" 
         alt="Organiza Ai" 
         style="height: 300px; width: auto;">
         </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">E-mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
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

            <!-- Lembrar-me -->
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="text-gray-700">Lembrar-me</label>
            </div>

            <!-- Botão -->
            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
                    Entrar
                </button>
            </div>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="text-blue-600 hover:underline" href="{{ route('password.request') }}">
                        Esqueceu sua senha?
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
