@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Painel do Administrador</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">Sair</button>
        </form>
    </div>

    {{-- Filtro de Semestre --}}
    <div class="filter-bar">
        <form action="{{ route('admin.dashboard') }}" method="GET">
            <label for="semester">Filtrar por Semestre:</label>
            <select name="semester" id="semester" onchange="this.form.submit()">
                <option value="2025.2" {{ $selectedSemester == '2025.2' ? 'selected' : '' }}>2025.2</option>
                <option value="2026.1" {{ $selectedSemester == '2026.1' ? 'selected' : '' }}>2026.1</option>
                <option value="2026.2" {{ $selectedSemester == '2026.2' ? 'selected' : '' }}>2026.2</option>
            </select>
        </form>
    </div>

    {{-- Tabela de Professores --}}
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Professor</th>
                    <th>MASP</th>
                    <th>Vínculo</th>
                    <th>Status do Relatório</th>
                    <th>Ações</th>
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
                            <button class="btn btn-secondary">Perfil</button>
                            {{-- O botão "Ver Relatório" só aparece se foi enviado --}}
                            @if ($professor->reportSent)
                                <button class="btn btn-primary">Ver Relatório</button>
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