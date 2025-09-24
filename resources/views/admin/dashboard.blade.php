<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Administrador</title>
</head>
<body>
    <h1>Página do Administrador</h1>

    <p>Bem-vindo(a), {{ Auth::user()->nome ?? 'Admin' }}!</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Sair</button>
    </form>
</body>
</html>