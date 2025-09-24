<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Professor</title>
</head>
<body>
    <h1>Página do Professor</h1>

    {{-- É uma boa prática exibir o nome do usuário logado --}}
    <p>Bem-vindo(a), {{ Auth::user()->nome ?? 'Professor' }}!</p>

    {{-- Formulário de Logout --}}
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Sair</button>
    </form>
</body>
</html>