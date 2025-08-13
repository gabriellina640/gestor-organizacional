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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
        ]);

        Participant::create($request->all());

        return redirect()->route('participants.index')->with('success', 'Participante adicionado!');
    }

    public function edit(Participant $participant)
    {
        return view('participants.edit', compact('participant'));
    }

    public function update(Request $request, Participant $participant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email,' . $participant->id,
        ]);

        $participant->update($request->all());

        return redirect()->route('participants.index')->with('success', 'Participante atualizado!');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect()->route('participants.index')->with('success', 'Participante removido!');
    }
}
