@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('content')
{{-- Para manter simples, vamos colocar o CSS da tabela aqui por enquanto --}}

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Professores</h1>
        {{-- O botão de sair agora está no menu lateral, podemos remover este se quisermos --}}
        {{-- <form action="{{ route('logout') }}" method="POST"><button type="submit" class="logout-button">Sair</button></form> --}}
    </div>

    <div class="filter-bar">
        <form action="{{ route('admin.dashboard') }}" method="GET">
            <label for="semester">Filtrar por Semestre:</label>
            <select name="semester" id="semester" onchange="this.form.submit()">
                <option value="2025.2" {{ $selectedSemester == '2025.2' ? 'selected' : '' }}>2025.2</option>
                <option value="2026.1" {{ $selectedSemester == '2026.1' ? 'selected' : '' }}>2026.1</option>
            </select>
        </form>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Professor</th><th>MASP</th><th>Vínculo</th><th>Status do Relatório</th><th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($professors as $professor)
                    <tr>
                        <td>{{ $professor->userName }}</td>
                        <td>{{ $professor->userMasp }}</td>
                        <td>{{ $professor->employmentType }}</td>
                        <td>
                            @if ($professor->reportSent)
                                <span class="status-sent">Enviado</span>
                            @else
                                <span class="status-pending">Pendente</span>
                            @endif
                        </td>
                        <td class="actions">
                            <a href="#" class="btn btn-warning">Perfil</a>
                            @if ($professor->reportSent)
                                <a href="#" class="btn btn-primary">Ver Relatório</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Nenhum professor ativo encontrado para este semestre.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection