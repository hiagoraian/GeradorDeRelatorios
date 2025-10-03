<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Repositories\Contracts\ProfessorSemesterRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class AdminDashboardService
{
    /**
     * O construtor agora injeta AMBOS os repositórios que o serviço precisa.
     */
    public function __construct(
        protected ProfessorSemesterRepositoryInterface $professorSemesterRepository,
        protected UserRepositoryInterface $userRepository
    ) {}

    /**
     * Busca a lista de professores ativos para um semestre específico.
     */
    public function getProfessorListBySemester(string $semester): array
    {
        return $this->professorSemesterRepository->getActiveBySemester($semester);
    }

    /**
     * Encontra um professor específico pelo seu ID.
     *
     * @param int $id O ID do professor.
     * @return UserDTO|null
     */
    public function findProfessorById(int $id): ?UserDTO
    {
        // 3. O serviço simplesmente delega a busca para o repositório correto.
        return $this->userRepository->findById($id);
    }

    public function updateProfessor(int $id, array $data): bool
    {
        // Por enquanto, o serviço apenas repassa a chamada para o repositório.
        // No futuro, poderíamos adicionar lógicas aqui, como enviar um e-mail de notificação.
        return $this->userRepository->update($id, $data);
    }
}