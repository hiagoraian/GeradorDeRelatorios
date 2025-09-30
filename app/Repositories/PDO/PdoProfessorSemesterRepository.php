<?php

namespace App\Repositories\PDO;

use App\DTOs\ProfessorSemesterDTO;
use App\Repositories\Contracts\ProfessorSemesterRepositoryInterface;
use Illuminate\Support\Facades\DB;
use PDO;

class PdoProfessorSemesterRepository implements ProfessorSemesterRepositoryInterface
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connection()->getPdo();
    }

    public function getActiveBySemester(string $semester): array
    {
        $sql = "
            SELECT
                u.id as user_id,
                u.name as user_name,
                u.masp as user_masp,
                ps.employment_type,
                ps.report_id
            FROM
                professor_semesters as ps
            INNER JOIN
                users as u ON ps.user_id = u.id
            WHERE
                ps.semester = :semester
                AND ps.is_active = true
            ORDER BY
                u.name ASC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':semester' => $semester]);
        
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $dtos = [];
        foreach ($results as $row) {
            $dtos[] = new ProfessorSemesterDTO(
                userId: $row->user_id,
                userName: $row->user_name,
                userMasp: $row->user_masp,
                employmentType: $row->employment_type,
                reportSent: !is_null($row->report_id),
                reportId: $row->report_id
            );
        }

        return $dtos;
    }
}