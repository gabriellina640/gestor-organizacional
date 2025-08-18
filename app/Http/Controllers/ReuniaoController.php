<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reuniao;
use App\Models\Participant;

class ReuniaoController extends Controller
{
    // Lista reuniões agendadas e concluídas
    public function index()
    {
        // Reuniões agendadas com participantes
        $reunioesAgendadas = Reuniao::where('status', 'agendada')
            ->with('participantes')
            ->get();

        // Reuniões concluídas com participantes que marcaram presença
        $reunioesConcluidas = Reuniao::where('status', 'concluida')
            ->with(['participantes' => function ($query) {
                $query->wherePivot('presente', true); // apenas quem esteve presente
            }])
            ->get();

        // Todos os participantes disponíveis
        $participants = Participant::all();

        return view('reunioes.index', compact('reunioesAgendadas', 'reunioesConcluidas', 'participants'));
    }

    // Cria nova reunião
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

        // Adiciona participantes, se enviados
        if ($request->has('participantes')) {
            $reuniao->participantes()->sync($request->participantes);
        }

        return redirect()->route('reunioes.index')->with('success', 'Reunião criada com sucesso!');
    }

    // Marca reunião como concluída e salva presença
    public function concluir(Request $request, $id)
    {
        $reuniao = Reuniao::findOrFail($id);

        // Atualiza status da reunião
        $reuniao->status = 'concluida';
        $reuniao->save();

        // Atualiza presenças na tabela pivot
        if ($request->has('presenca')) {
            foreach ($request->presenca as $participantId => $presente) {
                // Atualiza cada participante na pivot
                $reuniao->participantes()->updateExistingPivot($participantId, ['presente' => $presente]);
            }
        }

        return redirect()->back()->with('success', 'Reunião concluída e presenças registradas!');
    }

    // Edita reunião
    public function edit($id)
    {
        $reuniao = Reuniao::with('participantes')->findOrFail($id);
        return view('reunioes.create', compact('reuniao'));
    }

    // Atualiza reunião
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

        // Atualiza participantes
        if ($request->has('participantes')) {
            $reuniao->participantes()->sync($request->participantes);
        }

        return redirect()->route('reunioes.index')->with('success', 'Reunião atualizada!');
    }

    // Limpa reuniões concluídas
    public function limparConcluidas()
    {
        Reuniao::where('status', 'concluida')->delete();
        return redirect()->route('reunioes.index')->with('success', 'Reuniões concluídas limpas!');
    }
}
