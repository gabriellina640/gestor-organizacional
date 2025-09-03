@extends('layouts.app')

@section('content')

<style>
/* Botões */
.btn-preto { background-color: #000; color: #fff; padding: 0.5rem 1rem; border-radius: 0.375rem; transition: filter 0.2s; font-weight: 500; cursor: pointer; }
.btn-preto:hover { filter: brightness(90%); }

.btn-verde { background-color: #16a34a; color: #fff; padding: 0.5rem 1rem; border-radius: 0.375rem; transition: filter 0.2s; font-weight: 500; cursor: pointer; }
.btn-verde:hover { filter: brightness(90%); }

.btn-vermelho { background-color: #dc2626; color: #fff; padding: 0.5rem 1rem; border-radius: 0.375rem; transition: filter 0.2s; font-weight: 500; cursor: pointer; }
.btn-vermelho:hover { filter: brightness(90%); }

/* Reunião card */
.reuniao-card { border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem; background-color: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
.reuniao-info { margin-bottom: 0.5rem; }
.reuniao-info span { display: block; color: #374151; font-size: 0.95rem; }
.reuniao-titulo { font-weight: 600; font-size: 1.1rem; margin-bottom: 0.3rem; color: #111827; }
.reuniao-botoes { display: flex; gap: 0.5rem; margin-top: 0.5rem; }
@media (max-width: 768px) { .reuniao-botoes { flex-direction: column; } }
</style>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{
    openForm: false,
    openCheckIn: false,
    editReuniao: { id: '', titulo: '', local: '', data: '', hora: '', descricao: '' },
    checkInReuniao: { id: '', participants: [] },
    abrirForm(reuniao = null) {
        if(reuniao) this.editReuniao = reuniao;
        else this.editReuniao = { id: '', titulo: '', local: '', data: '', hora: '', descricao: '' };
        this.openForm = true;
        $nextTick(() => { document.querySelector('input[name=titulo]').focus(); });
    },
    abrirCheckIn(reuniaoId, participants) {
        this.checkInReuniao.id = reuniaoId;
        this.checkInReuniao.participants = participants || [];
        this.openCheckIn = true;
    }
}">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Minhas Reuniões</h1>
        <button @click="abrirForm()" class="btn-preto">Agendar Reunião</button>
    </div>

    <!-- Formulário -->
    <div x-show="openForm" @click.away="openForm = false" class="mb-6 bg-gray-50 p-4 rounded shadow relative" x-transition>
        <div class="flex justify-end">
            <button @click="openForm = false" class="text-gray-500 hover:text-gray-800 font-bold text-xl">&times;</button>
        </div>

        <form :action="editReuniao.id ? '/reunioes/' + editReuniao.id : '{{ route('reunioes.store') }}'" method="POST" class="flex flex-col gap-4 mt-2">
            @csrf
            <template x-if="editReuniao.id">
                <input type="hidden" name="_method" value="PUT">
            </template>

            <input type="text" name="titulo" placeholder="Título" class="border rounded p-2 w-full" required x-bind:value="editReuniao.titulo">
            <input type="text" name="local" placeholder="Local" class="border rounded p-2 w-full" required x-bind:value="editReuniao.local">
            <input type="date" name="data" class="border rounded p-2 w-full" required x-bind:value="editReuniao.data">
            <input type="time" name="hora" class="border rounded p-2 w-full" required x-bind:value="editReuniao.hora">
            <textarea name="descricao" placeholder="Descrição" class="border rounded p-2 w-full" required x-text="editReuniao.descricao"></textarea>

            <button type="submit" class="btn-preto">Salvar</button>
        </form>
    </div>

    <!-- Modal de Check-in -->
    <div x-show="openCheckIn" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50" x-transition>
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md" @click.away="openCheckIn = false">
            <h3 class="text-lg font-bold mb-4">Marcar Presença</h3>

            <form :action="'/reunioes/' + checkInReuniao.id + '/concluir'" method="POST" class="flex flex-col gap-2">
                @csrf
                <template x-for="user in checkInReuniao.participants" :key="user.id">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" :name="'presenca['+user.id+']'" value="1" x-bind:checked="user.presente">
                        <span x-text="user.nome || user.name"></span>
                    </label>
                </template>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" @click="openCheckIn = false" class="btn-vermelho">Cancelar</button>
                    <button type="submit" class="btn-verde">Confirmar</button>
                </div>
            </form>
        </div>
    </div>

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

                            <!-- Botão Editar -->
                            <button 
                                @click.prevent="abrirForm({
                                    id: '{{ $reuniao->id }}',
                                    titulo: '{{ addslashes($reuniao->titulo) }}',
                                    local: '{{ addslashes($reuniao->local) }}',
                                    data: '{{ $reuniao->data }}',
                                    hora: '{{ $reuniao->hora }}',
                                    descricao: '{{ addslashes($reuniao->descricao) }}'
                                })" 
                                class="btn-preto">
                                Editar
                            </button>

                            <!-- Botão Concluir -->
                            <button 
                                @click.prevent="abrirCheckIn({{ $reuniao->id }}, {{ $participants->toJson() }})"
                                class="btn-verde">
                                Concluir
                            </button>
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
                <form action="{{ route('reunioes.limparConcluidas') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-vermelho text-sm">Limpar</button>
                </form>
            </div>

            @if($reunioesConcluidas->count() > 0)
                @foreach($reunioesConcluidas as $reuniao)
                    <div class="reuniao-card">
                        <div class="reuniao-titulo">{{ $reuniao->titulo }}</div>
                        <div class="reuniao-info"><strong>Local:</strong> <span>{{ $reuniao->local }}</span></div>
                        <div class="reuniao-info"><strong>Data:</strong> <span>{{ $reuniao->data }} {{ $reuniao->hora }}</span></div>
                        <div class="reuniao-info"><strong>Descrição:</strong> <span>{{ $reuniao->descricao }}</span></div>

                        <!-- Lista de Participantes Presentes -->
                        <div class="reuniao-info">
                            <strong></strong>
                            <ul>
                                @foreach($reuniao->participantes as $p)
                                    @if($p->pivot->presente)
                                        <li>{{ $p->nome }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500">Nenhuma reunião concluída</p>
            @endif
        </div>

    </div>

</div>

@endsection
