<?php

namespace App\Services;

use App\Repositories\Contracts\ProfessorSemesterRepositoryInterface;

/**
 * Class AdminDashboardService
 *
 * Encapsula as regras de negócio para o painel do administrador.
 */
class AdminDashboardService
{
    /**
     * O construtor injeta as dependências necessárias.
     *
     * @param ProfessorSemesterRepositoryInterface $repository O repositório para acesso aos dados.
     */
    public function __construct(
        protected ProfessorSemesterRepositoryInterface $repository
    ) {}

    /**
     * Busca a lista de professores ativos para um semestre específico.
     *
     * @param string $semester O semestre a ser filtrado (ex: '2025.2').
     * @return \App\DTOs\ProfessorSemesterDTO[]
     */
    public function getProfessorListBySemester(string $semester): array
    {
        // Por enquanto, o serviço apenas delega a chamada para o repositório.
        // Se no futuro precisarmos, por exemplo, de filtrar professores
        // com base em outra regra, a lógica seria adicionada aqui.
        return $this->repository->getActiveBySemester($semester);
    }
}