<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Repositories\Contracts\ProfessorSemesterRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AdminDashboardService
{
    public function __construct(
        protected ProfessorSemesterRepositoryInterface $professorSemesterRepository,
        protected UserRepositoryInterface $userRepository
    ) {}

    public function getProfessorListBySemester(string $semester): array
    {
        return $this->professorSemesterRepository->getActiveBySemester($semester);
    }

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

    public function findProfessorById(int $id): ?UserDTO
    {
        return $this->userRepository->findById($id);
    }

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

    public function updateProfessor(int $id, array $data): bool
    {
        return $this->userRepository->update($id, $data);
    }

    public function syncProfessorsForSemester(string $semester, array $professorIds): bool
    {
        $professors = $this->userRepository->findManyByIds($professorIds);
        $dataForSync = [];
        foreach ($professors as $professor) {
            $dataForSync[] = [
                'user_id' => $professor->id,
                'employment_type' => 'Efetivo',
            ];
        }
        return $this->professorSemesterRepository->sync($semester, $dataForSync);
    }
}
