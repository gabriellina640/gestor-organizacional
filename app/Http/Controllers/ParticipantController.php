<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    // Lista todos os participantes
    public function index()
    {
        $participants = Participant::all();
        return view('participants.index', compact('participants'));
    }

    // Retorna o formulário de criação (não será usado se você abrir via modal)
    public function create()
    {
        return view('participants.create');
    }

    // Salva novo participante
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'cargo' => 'nullable|string|max:255',
        ]);

        Participant::create($request->only('name', 'cargo'));

        return redirect()->route('participants.index')
                         ->with('success', 'Participante cadastrado com sucesso!');
    }

    // Retorna o formulário de edição
    public function edit(Participant $participant)
    {
        return view('participants.edit', compact('participant'));
    }

    // Atualiza participante
    public function update(Request $request, Participant $participant)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'cargo' => 'nullable|string|max:255',
        ]);

        $participant->update($request->only('name', 'cargo'));

        return redirect()->route('participants.index')
                         ->with('success', 'Participante atualizado com sucesso!');
    }

    // Exclui participante
    public function destroy(Participant $participant)
    {
        $participant->delete();

        return redirect()->route('participants.index')
                         ->with('success', 'Participante excluído com sucesso!');
    }
}
