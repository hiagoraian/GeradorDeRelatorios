<?php

namespace App\DTOs;

/**
 * ProfessorSemesterDTO (Data Transfer Object)
 *
 * Carrega os dados consolidados de um professor para um semestre específico,
 * incluindo o status do seu relatório.
 */
class ProfessorSemesterDTO
{
    /**
     * @param int $userId O ID do professor (da tabela 'users').
     * @param string $userName O nome do professor.
     * @param string $userMasp O MASP do professor.
     * @param string $employmentType O tipo de contrato (ex: 'Efetivo', 'Contratado').
     * @param bool $reportSent Um booleano indicando se o relatório foi enviado (true) ou não (false).
     * @param int|null $reportId O ID do relatório, se ele tiver sido enviado.
     */
    public function __construct(
        public readonly int $userId,
        public readonly string $userName,
        public readonly string $userMasp,
        public readonly string $employmentType,
        public readonly bool $reportSent,
        public readonly ?int $reportId,
    ) {}
}
