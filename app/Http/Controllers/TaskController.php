<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // só usuários logados acessam
    }

    /**
     * Listar tasks do usuário logado
     */
    public function index(): View
    {
        $tasks = Task::where('user_id', auth()->id())->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Formulário de criação
     */
    public function create(): View
    {
        return view('tasks.create');
    }

    /**
     * Salvar nova task
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'urgency' => 'required|integer|between:1,3',
            'estimated_hours' => 'nullable|integer',
            'status' => 'required|in:pending,in_progress,paused,completed',
        ]);

        $data['user_id'] = auth()->id();

        Task::create($data);

        return redirect()->route('tasks.index')
                         ->with('success', 'Task criada com sucesso!');
    }

    /**
     * Mostrar task
     */
    public function show(Task $task): View
    {
        $this->authorizeTask($task);
        return view('tasks.show', compact('task'));
    }

    /**
     * Formulário de edição
     */
    public function edit(Task $task): View
    {
        $this->authorizeTask($task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Atualizar task
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->authorizeTask($task);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'urgency' => 'required|integer|between:1,3',
            'estimated_hours' => 'nullable|integer',
            'status' => 'required|in:pending,in_progress,paused,completed',
        ]);

        // impede que user_id seja modificado
        $data['user_id'] = $task->user_id;

        $task->update($data);

        return redirect()->route('tasks.index')
                         ->with('success', 'Task atualizada com sucesso!');
    }

    /**
     * Deletar task
     */
    public function destroy(Task $task): RedirectResponse
    {
        $this->authorizeTask($task);
        $task->delete();

        return redirect()->route('tasks.index')
                         ->with('success', 'Task deletada com sucesso!');
    }

    /**
     * Verifica se a task pertence ao usuário
     */
    private function authorizeTask(Task $task): void
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }
    }
}