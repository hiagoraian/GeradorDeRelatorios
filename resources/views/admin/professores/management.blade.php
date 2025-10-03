@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Gestão de Professores por Semestre</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Voltar ao Dashboard</a>
    </div>

    <div class="filter-bar">
        <form action="{{ route('admin.management') }}" method="GET">
            <label for="semester">Selecione o Semestre:</label>
            <select name="semester" id="semester" onchange="this.form.submit()">
                @foreach ($availableSemesters as $semester)
                    <option value="{{ $semester }}" {{ $selectedSemester == $semester ? 'selected' : '' }}>
                        {{ $semester }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
    <form action="{{ route('admin.management.sync') }}" method="POST">
        @csrf
        <input type="hidden" name="semester" value="{{ $selectedSemester }}">

        <div class="table-container">
            <table>
                {{-- Conteúdo da tabela com os checkboxes --}}
                <thead>
                    <tr>
                        <th style="width: 50px;">Ativo</th>
                        <th>Professor</th>
                        <th>MASP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($professors as $professor)
                        <tr>
                            <td>
                                <input type="checkbox" name="professor_ids[]" value="{{ $professor->id }}" 
                                       {{ $professor->isActiveInSemester ? 'checked' : '' }}>
                            </td>
                            <td>{{ $professor->name }}</td>
                            <td>{{ $professor->masp }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Nenhum professor cadastrado no sistema.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="profile-actions">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </div>
    </form>
    </div>
@endsection