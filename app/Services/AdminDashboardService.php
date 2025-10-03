<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Repositories\Contracts\ProfessorSemesterRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

/**
 * Class AdminDashboardService
 * Encapsula as regras de negócio para as funcionalidades do painel do administrador.
 */
class AdminDashboardService
{
    public function __construct(
        protected ProfessorSemesterRepositoryInterface $professorSemesterRepository,
        protected UserRepositoryInterface $userRepository
    ) {}

    /**
     * Busca a lista de professores para a visualização principal do dashboard.
     */
    public function getProfessorListBySemester(string $semester): array
    {
        return $this->professorSemesterRepository->getActiveBySemester($semester);
    }

    /**
     * Retorna a lista de todos os professores para a página de gerenciamento,
     * indicando quais estão ativos no semestre selecionado.
     */
    public function getProfessorManagementList(string $semester): array
    {
        $allProfessors = $this->userRepository->getAllProfessors();
        $activeProfessorIds = $this->professorSemesterRepository->getActiveProfessorIdsBySemester($semester);

        $managementList = [];
        foreach ($allProfessors as $professor) {
            $managementList[] = (object) [
                'id' => $professor->id,
                'name' => $professor->name,
                'masp' => $professor->masp,
                'isActiveInSemester' => in_array($professor->id, $activeProfessorIds)
            ];
        }
        return $managementList;
    }

    /**
     * Encontra um professor específico pelo seu ID.
     */
    public function findProfessorById(int $id): ?UserDTO
    {
        return $this->userRepository->findById($id);
    }

    /**
     * Cria um novo professor e seu registro de semestre associado.
     */
    public function createProfessor(array $data): ?UserDTO
    {
        $userData = Arr::only($data, ['name', 'email', 'masp', 'phone', 'password']);
        $userData['password'] = Hash::make($userData['password']);
        $newUser = $this->userRepository->create($userData);

        if ($newUser) {
            $this->professorSemesterRepository->create([
                'user_id' => $newUser->id,
                'semester' => '2025.2',
                'employment_type' => $data['employment_type'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return $newUser;
    }

    /**
     * Atualiza os dados de um professor.
     */
    public function updateProfessor(int $id, array $data): bool
    {
        return $this->userRepository->update($id, $data);
    }

    /**
     * Sincroniza os professores ativos para um determinado semestre.
     */
    public function syncProfessorsForSemester(string $semester, array $professorIds): bool
    {
        $professors = $this->userRepository->findManyByIds($professorIds);
        $dataForSync = [];
        foreach ($professors as $professor) {
            $dataForSync[] = [
                'user_id' => $professor->id,
                'employment_type' => 'Efetivo', // Valor padrão
            ];
        }
        return $this->professorSemesterRepository->sync($semester, $dataForSync);
    }
}