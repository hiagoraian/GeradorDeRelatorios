<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Exibe o painel principal do administrador.
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}