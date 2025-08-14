<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reuniao;

class ReuniaoController extends Controller
{
    // Lista reuniões agendadas e concluídas
    public function index()
    {
        $reunioesAgendadas = Reuniao::where('status', 'agendada')->get();
        $reunioesConcluidas = Reuniao::where('status', 'concluida')->get();

        return view('reunioes.index', compact('reunioesAgendadas', 'reunioesConcluidas'));
    }

    // Salva uma nova reunião
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'local' => 'required|string|max:255',
            'data' => 'required|date',
            'hora' => 'required',
            'descricao' => 'nullable|string',
        ]);

        Reuniao::create([
            'titulo' => $request->titulo,
            'local' => $request->local,
            'data' => $request->data,
            'hora' => $request->hora,
            'descricao' => $request->descricao,
            'status' => 'agendada',
        ]);

        return redirect()->route('reunioes.index')->with('success', 'Reunião criada com sucesso!');
    }

    // Marca reunião como concluída
    public function concluir($id)
    {
        $reuniao = Reuniao::findOrFail($id);
        $reuniao->status = 'concluida';
        $reuniao->save();

        return redirect()->back()->with('success', 'Reunião concluída!');
    }
    
    public function edit($id) {
    $reuniao = Reuniao::findOrFail($id);
    return view('reunioes.create', compact('reuniao')); // reutilizando a view de criação
}

public function update(Request $request, $id) {
    $reuniao = Reuniao::findOrFail($id);

    $reuniao->update([
        'titulo' => $request->titulo,
        'descricao' => $request->descricao,
        'local' => $request->local,
        'data' => $request->data,
        'hora' => $request->hora,
        'status' => $reuniao->status, // mantém o status atual
    ]);

    return redirect()->route('reunioes.index')->with('success', 'Reunião atualizada!');
}
public function limparConcluidas() {
    Reuniao::where('status', 'concluida')->delete();
    return redirect()->back()->with('success', 'Reuniões concluídas foram limpas!');
}


}
