<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class OrganizationController extends Controller
{
    // Exibir a página de boas-vindas
    public function welcome()
    {
        return view('organization.welcome');
    }

    // Formulário para criar uma nova organização
    public function create()
    {
        return view('organization.create');
    }

    // Armazenar uma nova organização
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'work_hours_per_day' => 'required|integer|min:1|max:24',
            'work_days_per_week' => 'required|integer|min:1|max:7',
        ]);

        $organization = Organization::create($validated);

        // Armazena a organização na sessão
        $request->session()->put('organization', $organization);

        return redirect()->route('organization.dashboard');
    }

    // Formulário para entrar em uma organização existente
    public function showForm()
    {
        return view('organization.enter');
    }

    // Processar a entrada na organização
    public function enter(Request $request)
    {
        $request->validate([
            'organization_id' => 'required|exists:organizations,id',
        ]);

        $organization = Organization::find($request->organization_id);
        $request->session()->put('organization', $organization);

        return redirect()->route('organization.dashboard');
    }

    // Exibir o dashboard da organização
    public function dashboard(Request $request)
    {
        $organization = $request->session()->get('organization');

        return view('organization.dashboard', compact('organization'));
    }

    // Sair da organização
    public function logout(Request $request)
    {
        $request->session()->forget('organization');
        return redirect()->route('organization.welcome');
    }
// Formulário para editar organização
public function edit(Request $request)
{
    $organization = $request->session()->get('organization');
    return view('organization.edit', compact('organization'));
}

// Atualizar a organização
public function update(Request $request)
{
    $organization = $request->session()->get('organization');

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'work_hours_per_day' => 'required|integer|min:1|max:24',
        'work_days_per_week' => 'required|integer|min:1|max:7',
    ]);

    $organization->update($validated);

    return redirect()->route('organization.dashboard')->with('success', 'Organização atualizada!');
}




}
