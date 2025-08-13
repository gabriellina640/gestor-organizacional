@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-blue-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Verifique seu e-mail</h2>

        @if (session('resent'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                Um novo link de verificação foi enviado para o seu e-mail.
            </div>
        @endif

        <p class="mb-4">Antes de continuar, verifique seu e-mail para o link de verificação.</p>
        <p class="mb-4">Se você não recebeu o e-mail,</p>

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit"
                class="text-blue-600 hover:underline font-medium">
                clique aqui para solicitar outro
            </button>.
        </form>
    </div>
</div>
@endsection
