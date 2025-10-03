<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Painel - Gestão de Relatórios</title>
    <style>

    </style>
    @stack('styles')
</head>
<body>
    <div class="app-container">
        @auth
            @if(Auth::user()->is_adm)
                <aside class="sidebar">
                    <div class="sidebar-header">Portal NECS</div>
                    <ul class="sidebar-menu">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="#">Gestão de Professores</a></li>
                        <li><a href="{{ route('admin.professores.create') }}">Cadastrar Professor</a></li>
                        <li><a href="#">Analise de Dados</a></li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                        </li>
                    </ul>
                </aside>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            @endif
        @endauth

        <div class="main-wrapper">
            <header class="top-bar"></header>
            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>