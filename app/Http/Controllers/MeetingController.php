<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\User;
use Carbon\Carbon; 

class MeetingController extends Controller
{
    // Lista todas as reuniões
    public function index()
    {
        $meetings = Meeting::with('users')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('meetings.index', compact('meetings'));
    }

    // Formulário para criar nova reunião
    public function create()
    {
        $users = User::all();
        return view('meetings.create', compact('users'));
    }

    // Salvar nova reunião
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'repeats_weekly' => 'nullable|boolean',
            'users' => 'nullable|array',
            'users.*' => 'exists:users,id',
        ]);

        $scheduled_at = Carbon::parse($data['date'] . ' ' . $data['time']);

         $meeting = Meeting::create([
        'title' => $data['title'],
         'content' => $data['content'] ?? null,
         'scheduled_at' => $scheduled_at, // aqui
        'repeats_weekly' => $request->has('repeats_weekly'),
]);

        if (!empty($data['users'])) {
            $meeting->users()->attach($data['users']);
        }

        return redirect()->route('meetings.index')->with('success', 'Reunião criada com sucesso!');
    }

    // Mostrar detalhes da reunião
    public function show(Meeting $meeting)
    {
        $meeting->load('users');
        return view('meetings.show', compact('meeting'));
    }

    // Formulário para editar reunião
    public function edit(Meeting $meeting)
    {
        $users = User::all();
        $meeting->load('users');
        return view('meetings.edit', compact('meeting', 'users'));
    }

    // Atualizar reunião
    public function update(Request $request, Meeting $meeting)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'repeats_weekly' => 'nullable|boolean',
            'users' => 'nullable|array',
            'users.*' => 'exists:users,id',
        ]);

        $meeting->update([
            'title' => $data['title'],
            'content' => $data['content'] ?? null,
            'date' => $data['date'],
            'time' => $data['time'],
            'repeats_weekly' => $request->has('repeats_weekly'),
        ]);

        $meeting->users()->sync($data['users'] ?? []);

        return redirect()->route('meetings.index')->with('success', 'Reunião atualizada com sucesso!');
    }

    // Deletar reunião
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('meetings.index')->with('success', 'Reunião removida!');
    }

    // Check-in de presença
    public function checkIn(Meeting $meeting, User $user)
    {
        $meeting->users()->syncWithoutDetaching([
            $user->id => ['checked_in' => true]
        ]);

        return redirect()->back()->with('success', 'Check-in realizado com sucesso!');
    }
}
