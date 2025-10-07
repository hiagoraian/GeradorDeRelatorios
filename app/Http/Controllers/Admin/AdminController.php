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

    public function __construct(
        protected AdminDashboardService $service
    ) {}

    public function index(Request $request): View
    {

        $availableSemesters = config('semesters.available');


        $selectedSemester = $request->input('semester', $availableSemesters[0]);

        $professors = $this->service->getProfessorListBySemester($selectedSemester);

        return view('admin.dashboard', [
            'professors' => $professors,
            'selectedSemester' => $selectedSemester,
            'availableSemesters' => $availableSemesters,
        ]);
    }

    public function create(): View
    {
        return view('admin.professores.create');
    }

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

    public function management(Request $request): View
    {
        $availableSemesters = config('semesters.available');

        $selectedSemester = $request->input('semester', $availableSemesters[0]);

        $professors = $this->service->getProfessorManagementList($selectedSemester);

        return view('admin.professores.management', [
            'professors' => $professors,
            'selectedSemester' => $selectedSemester,
            'availableSemesters' => $availableSemesters,
        ]);
    }

    public function sync(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'semester' => ['required', 'string'],
            'professor_ids' => ['nullable', 'array'],
            'professor_ids.*' => ['integer'],
        ]);

        $professorIds = $data['professor_ids'] ?? [];

        $this->service->syncProfessorsForSemester($data['semester'], $professorIds);

        return redirect()
            ->route('admin.management', ['semester' => $data['semester']])
            ->with('success', 'Professores do semestre atualizados com sucesso!');
    }
}
