@extends('layouts.app')

@section('content')
<div style="max-width: 500px; margin: 50px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); font-family: Arial, sans-serif;">
    <h2 style="text-align: center; margin-bottom: 20px;">Editar Perfil</h2>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">Nome</label>
            <input id="name" type="text" name="name" value="{{ $user->name }}" required 
                   style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold;">Nova Senha</label>
            <input id="password" type="password" name="password" 
                   style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="password_confirmation" style="display: block; margin-bottom: 5px; font-weight: bold;">Confirme a Senha</label>
            <input id="password_confirmation" type="password" name="password_confirmation" 
                   style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <button type="submit" 
                style="width: 100%; padding: 10px; background-color: #080a08ff; color: white; font-weight: bold; border: none; border-radius: 5px; cursor: pointer;">
            Salvar Alterações
        </button>
    </form>
</div>
@endsection
