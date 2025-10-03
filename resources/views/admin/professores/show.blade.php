@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Perfil de: {{ $professor->name }}</h1>
        {{-- [MELHORIA] Adicionamos as classes de botão ao link de "Voltar" --}}
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Voltar para a Lista</a>
    </div>

    {{-- [MELHORIA] A estrutura do HTML continua a mesma, mas o novo CSS vai organizá-la em grade --}}
    <div class="profile-details">
        <div class="detail-item">
            <label>Nome Completo</label>
            <p>{{ $professor->name }}</p>
        </div>
        <div class="detail-item">
            <label>Email</label>
            <p>{{ $professor->email }}</p>
        </div>
        <div class="detail-item">
            <label>MASP</label>
            <p>{{ $professor->masp }}</p>
        </div>
    </div>

    <div class="profile-actions">
        <button href="#" class="btn btn-warning">Editar Perfil</button>
        
    </div>
</div>
@endsection