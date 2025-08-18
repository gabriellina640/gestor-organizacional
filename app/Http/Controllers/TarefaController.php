<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;

class TarefaController extends Controller
{
    public function index()
    {
        $tarefas = Tarefa::all()->groupBy('status'); // agrupa por status
        return view('tarefas.index', compact('tarefas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'urgencia' => 'required|in:baixa,media,alta',
        ]);

        Tarefa::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'urgencia' => $request->urgencia,
            'status' => 'a_fazer', // por padrão vai pra "A Fazer"
        ]);

        return redirect()->back()->with('success', 'Tarefa adicionada!');
    }

    public function updateStatus(Request $request, Tarefa $tarefa)
{
    $request->validate([
        'status' => 'required|in:a_fazer,concluida,pausada,finalizada'
    ]);

    $tarefa->update(['status' => $request->status]);

    return redirect()->back();
}

}
