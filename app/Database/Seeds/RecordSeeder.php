<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordSeeder extends Seeder
{
    public function run()
    {
        // Get the first user from the database for foreign key
        $db = \Config\Database::connect();
        $user = $db->table('users')->get(1)->getRow();
        $userId = $user ? $user->id : 1;

        // Insert sample records
        $this->db->table('records')->insertBatch([
            [
                'title'       => 'Project Documentation',
                'description' => 'Comprehensive documentation for the CodeIgniter 4 Starter Panel project including setup instructions, database schema, and API endpoints. This documentation covers all aspects of the system architecture.',
                'status'      => 'active',
                'user_id'     => $userId,
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Database Migration Guide',
                'description' => 'Complete guide for creating and managing database migrations in CodeIgniter 4. Includes examples for creating tables, adding columns, modifying indexes, and implementing soft deletes for data preservation.',
                'status'      => 'active',
                'user_id'     => $userId,
                'created_at'  => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
            [
                'title'       => 'API Development Best Practices',
                'description' => 'Guidelines for developing RESTful APIs using CodeIgniter 4. Covers request validation, error handling, authentication, authorization, rate limiting, and response formatting for optimal performance.',
                'status'      => 'active',
                'user_id'     => $userId,
                'created_at'  => date('Y-m-d H:i:s', strtotime('-10 days')),
            ],
            [
                'title'       => 'Testing Strategy and Implementation',
                'description' => 'Framework for unit testing, integration testing, and end-to-end testing. Includes test data setup, assertion methods, mocking dependencies, and continuous integration pipeline configuration.',
                'status'      => 'pending',
                'user_id'     => $userId,
                'created_at'  => date('Y-m-d H:i:s', strtotime('-15 days')),
            ],
            [
                'title'       => 'Security Implementation Guide',
                'description' => 'Security best practices including CSRF protection, SQL injection prevention, XSS mitigation, authentication mechanisms, authorization policies, and encryption methods for protecting user data.',
                'status'      => 'inactive',
                'user_id'     => $userId,
                'created_at'  => date('Y-m-d H:i:s', strtotime('-20 days')),
            ],
        ]);
    }
}
