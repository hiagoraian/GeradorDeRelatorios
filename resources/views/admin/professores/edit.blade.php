@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Editando Perfil de: {{ $professor->name }}</h1>
    </div>

    {{-- O formulário que enviará os dados para a rota 'update' --}}
    <form action="{{ route('admin.professores.update', ['id' => $professor->id]) }}" method="POST">
        @csrf
        @method('PUT') {{-- Diretiva especial para usar o método PUT --}}

        <div class="profile-details">
            <div class="detail-item">
                <label for="name">Nome Completo</label>
                {{-- O 'old' garante que se a validação falhar, o campo mantém o valor digitado --}}
                <input type="text" id="name" name="name" value="{{ old('name', $professor->name) }}" class="form-control">
            </div>

            <div class="detail-item">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $professor->email) }}" class="form-control">
            </div>

            <div class="detail-item">
                <label for="masp">MASP</label>
                <input type="text" id="masp" name="masp" value="{{ old('masp', $professor->masp) }}" class="form-control">
            </div>
            <div class="detail-item">
                <label for="phone">Telefone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $professor->phone) }}" class="form-control">
            </div>
        </div>

        <div class="profile-actions">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('admin.professores.show', ['id' => $professor->id]) }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection