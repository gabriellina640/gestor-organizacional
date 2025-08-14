@extends('layouts.app')

@section('content')

<style>
    /* Botões */
    .btn-preto {
        background-color: #000;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        transition: filter 0.2s;
        text-align: center;
        font-weight: 500;
    }
    .btn-preto:hover {
        filter: brightness(90%);
    }

    .btn-verde {
        background-color: #16a34a;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        transition: filter 0.2s;
        text-align: center;
        font-weight: 500;
    }
    .btn-verde:hover {
        filter: brightness(90%);
    }

    .btn-vermelho {
        background-color: #dc2626;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        transition: filter 0.2s;
        text-align: center;
        font-weight: 500;
    }
    .btn-vermelho:hover {
        filter: brightness(90%);
    }

    /* Reunião card */
    .reuniao-card {
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
        background-color: #ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .reuniao-info {
        margin-bottom: 0.5rem;
    }

    .reuniao-info span {
        display: block;
        color: #374151;
        font-size: 0.95rem;
    }

    .reuniao-titulo {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.3rem;
        color: #111827;
    }

    .reuniao-botoes {
        display: flex;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    /* Layout responsivo */
    @media (max-width: 768px) {
        .reuniao-botoes {
            flex-direction: column;
        }
    }
</style>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ openForm: false, editReuniao: null }">

    <!-- Cabeçalho -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Minhas Reuniões</h1>
        <button @click="openForm = !openForm; editReuniao = null" class="btn-preto">
            Agendar Reunião
        </button>
    </div>

    <!-- Formulário -->
    <div x-show="openForm" @click.away="openForm = false" class="mb-6 bg-gray-50 p-4 rounded shadow relative" x-transition>
        <div class="flex justify-end">
            <button @click="openForm = false" class="text-gray-500 hover:text-gray-800 font-bold text-xl">&times;</button>
        </div>

        <form :action="editReuniao ? '/reunioes/' + editReuniao.id : '{{ route('reunioes.store') }}'" method="POST" class="flex flex-col gap-4 mt-2">
            @csrf
            <template x-if="editReuniao">
                @method('PUT')
            </template>

            <input type="text" name="titulo" placeholder="Título" class="border rounded p-2 w-full" required
                   x-bind:value="editReuniao ? editReuniao.titulo : ''">
            <input type="text" name="local" placeholder="Local" class="border rounded p-2 w-full" required
                   x-bind:value="editReuniao ? editReuniao.local : ''">
            <input type="date" name="data" class="border rounded p-2 w-full" required
                   x-bind:value="editReuniao ? editReuniao.data : ''">
            <input type="time" name="hora" class="border rounded p-2 w-full" required
                   x-bind:value="editReuniao ? editReuniao.hora : ''">
            <textarea name="descricao" placeholder="Descrição" class="border rounded p-2 w-full" required x-text="editReuniao ? editReuniao.descricao : ''"></textarea>

            <button type="submit" class="btn-preto">Salvar</button>
        </form>
    </div>

    <!-- Conteúdo das reuniões -->
    <div class="flex gap-6 flex-col md:flex-row">

        <!-- Reuniões Agendadas -->
        <div class="flex-1">
            <h2 class="text-xl font-semibold mb-4">Reuniões Agendadas</h2>
            @if($reunioesAgendadas->count() > 0)
                @foreach($reunioesAgendadas as $reuniao)
                    <div class="reuniao-card">
                        <div class="reuniao-titulo">{{ $reuniao->titulo }}</div>
                        <div class="reuniao-info"><strong>Local:</strong> <span>{{ $reuniao->local }}</span></div>
                        <div class="reuniao-info"><strong>Data:</strong> <span>{{ $reuniao->data }} {{ $reuniao->hora }}</span></div>
                        <div class="reuniao-info"><strong>Descrição:</strong> <span>{{ $reuniao->descricao }}</span></div>
                        <div class="reuniao-botoes">
                            <button @click.prevent="openForm = true; editReuniao = {{ json_encode($reuniao) }}" class="btn-preto">Editar</button>
                            <form action="{{ route('reunioes.concluir', $reuniao->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-verde">Concluir</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500">Nenhuma reunião agendada</p>
            @endif
        </div>

        <!-- Reuniões Concluídas -->
        <div class="flex-1">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Reuniões Concluídas</h2>
                @if($reunioesConcluidas->count() > 0)
                    <form action="{{ route('reunioes.limpar') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-vermelho">Limpar</button>
                    </form>
                @endif
            </div>
            @if($reunioesConcluidas->count() > 0)
                @foreach($reunioesConcluidas as $reuniao)
                    <div class="reuniao-card">
                        <div class="reuniao-titulo">{{ $reuniao->titulo }}</div>
                        <div class="reuniao-info"><strong>Local:</strong> <span>{{ $reuniao->local }}</span></div>
                        <div class="reuniao-info"><strong>Data:</strong> <span>{{ $reuniao->data }} {{ $reuniao->hora }}</span></div>
                        <div class="reuniao-info"><strong>Descrição:</strong> <span>{{ $reuniao->descricao }}</span></div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500">Nenhuma reunião concluída</p>
            @endif
        </div>

    </div>
</div>

@endsection
