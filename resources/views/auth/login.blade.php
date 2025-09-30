@extends('layouts.guest')

@section('content')
<div class="login-card">
    <h1>Portal de Relatórios NECS</h1>
    <h3>Utilize suas credenciais para acessar</h3>

    @if ($errors->any())
        <div class="error-message">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit" class="form-button">Entrar</button>
        </div>
    </form>
</div>
@endsection