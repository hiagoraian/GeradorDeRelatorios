<?php

namespace App\Repositories\Contracts;

/**
 * Interface para o Repositório que lida com os dados de professores por semestre.
 */
interface ProfessorSemesterRepositoryInterface
{
    /**
     * Busca uma lista de professores ativos para um determinado semestre.
     *
     * @param string $semester
     * @return \App\DTOs\ProfessorSemesterDTO[]
     */
    public function getActiveBySemester(string $semester): array;

    public function create(array $data): bool;
}