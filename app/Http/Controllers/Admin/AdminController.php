<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminDashboardService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function __construct(
        protected AdminDashboardService $service
    ) {}

 
    public function index(Request $request): View
    {

        $selectedSemester = $request->input('semester', '2025.2');


        $professors = $this->service->getProfessorListBySemester($selectedSemester);

        return view('admin.dashboard', [
            'professors' => $professors,
            'selectedSemester' => $selectedSemester,
        ]);
    }

    public function show(int $id): View
    {
        $professor = $this->service->findProfessorById($id);

        if (!$professor) {
            abort(404, 'Professor não encontrado.');
        }

        return view('admin.professores.show', [
            'professor' => $professor
        ]);
    }

    public function edit(int $id): View
    {
        $professor = $this->service->findProfessorById($id);

        if (!$professor) {
            abort(404, 'Professor não encontrado.');
        }

        return view('admin.professores.edit', [
            'professor' => $professor
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        // 1. Validação dos dados
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'masp' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
        ]);

        // 2. Chama o serviço para executar a atualização
        $this->service->updateProfessor($id, $validatedData);

        // 3. Redireciona de volta para a página de perfil com uma mensagem de sucesso
        return redirect()
            ->route('admin.professores.show', ['id' => $id])
            ->with('success', 'Perfil do professor atualizado com sucesso!');
    }
}