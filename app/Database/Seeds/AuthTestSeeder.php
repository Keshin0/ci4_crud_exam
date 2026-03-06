<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthTestSeeder extends Seeder
{
    public function run()
    {
        // Insert test user accounts for authentication testing
        $this->db->table('users')->insertBatch([
            [
                'name'       => 'Test User',
                'email'      => 'test@example.com',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Developer',
                'email'      => 'developer@example.com',
                'password'   => password_hash('dev12345', PASSWORD_BCRYPT),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Admin User',
                'email'      => 'admin@example.com',
                'password'   => password_hash('admin123', PASSWORD_BCRYPT),
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
