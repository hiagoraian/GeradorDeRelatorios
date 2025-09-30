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
}