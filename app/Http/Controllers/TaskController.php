<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'urgency' => 'required|integer|between:1,3',
            'estimated_hours' => 'nullable|integer',
            'status' => 'required|in:pending,in_progress,paused,completed',
        ]);

        Task::create($data);

        return redirect()->route('tasks.index')->with('success', 'Task criada com sucesso!');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'urgency' => 'required|integer|between:1,3',
            'estimated_hours' => 'nullable|integer',
            'status' => 'required|in:pending,in_progress,paused,completed',
        ]);

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Task atualizada com sucesso!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deletada com sucesso!');
    }
}
