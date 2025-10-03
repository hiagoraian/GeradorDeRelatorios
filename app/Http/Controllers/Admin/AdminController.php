<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminDashboardService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * O construtor injeta o serviço que contém a lógica de negócio.
     */
    public function __construct(
        protected AdminDashboardService $service
    ) {}

    /**
     * Exibe a lista de professores (painel principal).
     */
    public function index(Request $request): View
    {
        $availableSemesters = ['2025.2', '2026.1', '2026.2'];
        $selectedSemester = $request->input('semester', $availableSemesters[0]);
        $professors = $this->service->getProfessorListBySemester($selectedSemester);

        return view('admin.dashboard', [
            'professors' => $professors,
            'selectedSemester' => $selectedSemester,
            'availableSemesters' => $availableSemesters,
        ]);
    }

    /**
     * Exibe o formulário para criar um novo professor.
     */
    public function create(): View
    {
        return view('admin.professores.create');
    } 

    /**
     * Salva um novo professor no banco de dados.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'masp' => ['required', 'string', 'max:255', 'unique:users,masp'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'employment_type' => ['required', 'string'],
        ]);

        $this->service->createProfessor($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Professor cadastrado com sucesso!');
    }

    /**
     * Exibe o perfil de um professor específico.
     */
    public function show(string $id): View
    {
        $professor = $this->service->findProfessorById((int) $id);

        if (!$professor) {
            abort(404, 'Professor não encontrado.');
        }

        return view('admin.professores.show', [
            'professor' => $professor
        ]);
    }

    /**
     * Exibe o formulário para editar um professor específico.
     */
    public function edit(string $id): View
    {
        $professor = $this->service->findProfessorById((int) $id);

        if (!$professor) {
            abort(404, 'Professor não encontrado.');
        }

        return view('admin.professores.edit', [
            'professor' => $professor
        ]);
    }

    /**
     * Processa a atualização dos dados de um professor.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $userId = (int) $id;

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'masp' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId)],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $this->service->updateProfessor($userId, $validatedData);

        return redirect()
            ->route('admin.professores.show', ['id' => $userId])
            ->with('success', 'Perfil do professor atualizado com sucesso!');
    }
}