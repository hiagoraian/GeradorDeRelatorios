<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct(
        protected LoginService $loginService
    ) {}

    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = $this->loginService->attempt($credentials['email'], $credentials['password']);

        if ($user) {
            $request->session()->regenerate();

            if ($user->is_adm) {
                return redirect()->intended(route('admin.dashboard'));
            }
            
            return redirect()->intended(route('documents.dashboard'));
        }

        throw ValidationException::withMessages([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}