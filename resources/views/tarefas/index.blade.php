@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{
    novaTarefa: {nome: '', descricao: '', urgencia: 'baixa'},
}">
    <h1 class="text-2xl font-bold mb-6">Painel de Tarefas</h1>

    <!-- Formulário Adicionar Tarefa -->
    <div class="mb-6 bg-gray-50 p-4 rounded shadow">
        <form action="{{ route('tarefas.store') }}" method="POST" class="flex flex-col gap-3 md:flex-row md:items-end">
            @csrf
            <input type="text" name="nome" placeholder="Nome da Tarefa" class="border rounded p-2 w-full md:w-1/3" required>
            <input type="text" name="descricao" placeholder="Descrição" class="border rounded p-2 w-full md:w-1/3">
            <select name="urgencia" class="border rounded p-2 w-full md:w-1/6">
                <option value="baixa">Baixa</option>
                <option value="media">Média</option>
                <option value="alta">Alta</option>
            </select>
            <button type="submit" class="btn-verde md:w-1/6">Adicionar</button>
        </form>
    </div>

    <!-- Kanban -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @foreach(['a_fazer'=>'A Fazer','concluida'=>'Concluídas','pausada'=>'Pausadas','finalizada'=>'Finalizadas'] as $status => $label)
        <div class="bg-white rounded shadow p-4">
            <h2 class="text-xl font-semibold mb-4">{{ $label }}</h2>

            @if(isset($tarefas[$status]))
                @foreach($tarefas[$status] as $tarefa)
                    <div class="border rounded p-2 mb-2 flex justify-between items-center">
                        <div>
                            <div class="font-semibold">{{ $tarefa->nome }}</div>
                            <div class="text-sm text-gray-600">{{ $tarefa->descricao }}</div>
                            <div class="text-xs text-gray-500">Urgência: {{ ucfirst($tarefa->urgencia) }}</div>
                        </div>
                        <!-- Dropdown para alterar status -->
                        <form action="{{ route('tarefas.updateStatus', $tarefa->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="border rounded p-1 text-sm">
                                <option value="a_fazer" {{ $tarefa->status=='a_fazer'?'selected':'' }}>A Fazer</option>
                                <option value="concluida" {{ $tarefa->status=='concluida'?'selected':'' }}>Concluídas</option>
                                <option value="pausada" {{ $tarefa->status=='pausada'?'selected':'' }}>Pausadas</option>
                                <option value="finalizada" {{ $tarefa->status=='finalizada'?'selected':'' }}>Finalizadas</option>
                            </select>
                        </form>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500 text-sm">Nenhuma tarefa</p>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
