<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    @if ($errors->any())
        <div style="color: red;">
            <strong>Erro:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <div>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <br>

        <div>
            <label for="password">Senha</label><br>
            <input type="password" id="password" name="password" required>
        </div>

        <br>

        <div>
            <button type="submit">
                Entrar
            </button>
        </div>
    </form>
</body>
</html>