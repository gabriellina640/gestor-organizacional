<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reuniao;

class ReuniaoController extends Controller
{
    // Lista reuniões agendadas e concluídas
    public function index()
{
    // Carrega reuniões agendadas
    $reunioesAgendadas = Reuniao::where('status', 'agendada')->get();

    // Carrega reuniões concluídas
    $reunioesConcluidas = Reuniao::where('status', 'concluida')->get();

    // Carrega todos os participantes da tabela participants
    $participants = \App\Models\Participant::all();

    return view('reunioes.index', compact('reunioesAgendadas', 'reunioesConcluidas', 'participants'));
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

        $reuniao = Reuniao::create([
            'titulo' => $request->titulo,
            'local' => $request->local,
            'data' => $request->data,
            'hora' => $request->hora,
            'descricao' => $request->descricao,
            'status' => 'agendada',
        ]);

        // Se quiser já adicionar participantes ao criar:
        if ($request->has('participantes')) {
            $reuniao->participantes()->sync($request->participantes);
        }

        return redirect()->route('reunioes.index')->with('success', 'Reunião criada com sucesso!');
    }

    // Marca reunião como concluída
    public function concluir(Request $request, $id)
    {
        $reuniao = Reuniao::findOrFail($id);
        $reuniao->status = 'concluida';
        $reuniao->save();

        // Salvar presenças, se for necessário
        // $reuniao->participantes()->sync($request->input('presenca', []));

        return redirect()->back()->with('success', 'Reunião concluída!');
    }

    public function edit($id)
    {
        $reuniao = Reuniao::with('participantes')->findOrFail($id);
        return view('reunioes.create', compact('reuniao'));
    }

    public function update(Request $request, $id)
    {
        $reuniao = Reuniao::findOrFail($id);

        $reuniao->update([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'local' => $request->local,
            'data' => $request->data,
            'hora' => $request->hora,
            'status' => $reuniao->status,
        ]);

        // Atualiza participantes, se enviados
        if ($request->has('participantes')) {
            $reuniao->participantes()->sync($request->participantes);
        }

        return redirect()->route('reunioes.index')->with('success', 'Reunião atualizada!');
    }

    public function limparConcluidas()
    {
        Reuniao::where('status', 'concluida')->delete();
        return redirect()->route('reunioes.index')->with('success', 'Reuniões concluídas limpas!');
    }
}
