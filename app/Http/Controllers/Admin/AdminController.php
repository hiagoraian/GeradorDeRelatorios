<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminDashboardService;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
}