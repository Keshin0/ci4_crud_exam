<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiTokenModel extends Model
{
    protected $table      = 'api_tokens';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = ['user_id', 'token', 'expires_at'];

    protected $useTimestamps = true;
    protected $updatedField  = '';

    public function createToken(int $userId, string $token, string $expiresAt): void
    {
        $this->insert([
            'user_id'    => $userId,
            'token'      => $token,
            'expires_at' => $expiresAt,
        ]);
    }

    public function findByToken(string $token): array|null
    {
        return $this->where('token', $token)
            ->where('expires_at >', date('Y-m-d H:i:s'))
            ->first();
    }

    public function deleteByToken(string $token): void
    {
        $this->where('token', $token)->delete();
    }
}
