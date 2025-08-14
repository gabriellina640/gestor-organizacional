<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = Participant::all();
        return view('participants.index', compact('participants'));
    }

    public function create()
    {
        return view('participants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'cargo' => 'nullable|string|max:255'
        ]);

        Participant::create($request->only('name', 'cargo'));
        return redirect()->route('participants.index')->with('success', 'Participante cadastrado com sucesso!');
    }

    public function edit(Participant $participant)
    {
        return view('participants.edit', compact('participant'));
    }

    public function update(Request $request, Participant $participant)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'cargo' => 'nullable|string|max:255'
        ]);

        $participant->update($request->only('name', 'cargo'));
        return redirect()->route('participants.index')->with('success', 'Participante atualizado com sucesso!');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect()->route('participants.index')->with('success', 'Participante excluído com sucesso!');
    }
}
