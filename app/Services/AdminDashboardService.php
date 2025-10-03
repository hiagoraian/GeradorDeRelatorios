<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Repositories\Contracts\ProfessorSemesterRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

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
    public function findProfessorById(string $id): ?UserDTO
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
     public function createProfessor(array $data): ?UserDTO
    {
        // 2. SEPARAMOS os dados: pegamos apenas o que pertence à tabela 'users'
        $userData = Arr::only($data, ['name', 'email', 'masp', 'phone', 'password']);
        
        // Criptografa a senha antes de salvar
        $userData['password'] = Hash::make($userData['password']);

        // 3. Criamos o usuário APENAS com os dados dele
        $newUser = $this->userRepository->create($userData);

        // 4. Se o usuário foi criado, usamos o ID dele para criar o registro associado
        if ($newUser) {
            $this->professorSemesterRepository->create([
                'user_id' => $newUser->id,
                'semester' => '2025.2', // O semestre padrão para novos cadastros
                'employment_type' => $data['employment_type'], // Usamos o dado original aqui
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $newUser;
    }
}