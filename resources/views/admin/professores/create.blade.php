@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Cadastrar Novo Professor</h1>
    </div>

    {{-- Formulário que envia os dados para a rota 'store' --}}
    <form action="{{ route('admin.professores.store') }}" method="POST">
        @csrf

        <div class="profile-details">
            <div class="detail-item">
                <label for="name">Nome Completo</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control">
            </div>

            <div class="detail-item">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-control">
            </div>

            <div class="detail-item">
                <label for="masp">MASP</label>
                <input type="text" id="masp" name="masp" value="{{ old('masp') }}" required class="form-control">
            </div>

            <div class="detail-item">
                <label for="phone">Telefone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control">
            </div>

            <div class="detail-item">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required class="form-control">
            </div>
            
            <div class="detail-item">
                <label for="password_confirmation">Confirmar Senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control">
            </div>

            <div class="detail-item">
                <label for="employment_type">Vínculo</label>
                <select id="employment_type" name="employment_type" class="form-control" required>
                    <option value="Efetivo">Efetivo</option>
                    <option value="Contratado">Contratado</option>
                </select>
            </div>
        </div>

        <div class="profile-actions">
            <button type="submit" class="btn btn-primary">Salvar Professor</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection