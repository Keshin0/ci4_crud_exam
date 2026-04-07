<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'name', 'fullname', 'email',
        'password', 'role_id',
        'student_id', 'course',
        'year_level', 'section', 'phone',
        'address', 'profile_image',
    ];

    protected $useTimestamps = true;

    public function findByEmail(string $email): array|null
    {
        return $this->where('email', $email)->first();
    }

    public function getStudents(): array
    {
        $sql = 'SELECT users.id, users.name, users.fullname, users.email,
                users.student_id, users.course, users.year_level,
                users.section, users.phone, users.address,
                users.profile_image, users.created_at,
                roles.name AS role_name
                FROM users
                LEFT JOIN roles ON roles.id = users.role_id
                WHERE roles.name = ?
                ORDER BY users.name ASC';

        return $this->db->query($sql, ['student'])->getResultArray();
    }

    public function getStudentById(int $id): array|null
    {
        $sql = 'SELECT users.id, users.name, users.fullname, users.email,
                users.student_id, users.course, users.year_level,
                users.section, users.phone, users.address,
                users.profile_image, users.created_at,
                roles.name AS role_name
                FROM users
                LEFT JOIN roles ON roles.id = users.role_id
                WHERE users.id = ? AND roles.name = ?';

        $result = $this->db->query($sql, [(int) $id, 'student']);
        return $result->getRowArray() ?? null;
    }

    public function updateProfile(int $userId, array $data): bool
    {
        return $this->update($userId, $data);
    }

    public function findWithRole(int $userId): array|null
    {
        $sql = 'SELECT users.id, users.name, users.fullname, users.email,
                users.student_id, users.course, users.year_level,
                users.section, users.phone, users.address,
                users.profile_image, users.created_at,
                roles.name AS role_name, roles.label AS role_label
                FROM users
                LEFT JOIN roles ON roles.id = users.role_id
                WHERE users.id = ?';

        $result = $this->db->query($sql, [(int) $userId]);
        return $result->getRowArray() ?? null;
    }

    public function getAllWithRoles(): array
    {
        $sql = 'SELECT users.id, users.name, users.fullname, users.email,
                users.student_id, users.course, users.year_level,
                users.section, users.phone, users.address,
                users.profile_image, users.created_at,
                roles.name AS role_name, roles.label AS role_label
                FROM users
                LEFT JOIN roles ON roles.id = users.role_id
                ORDER BY users.name ASC';

        return $this->db->query($sql)->getResultArray();
    }
}
