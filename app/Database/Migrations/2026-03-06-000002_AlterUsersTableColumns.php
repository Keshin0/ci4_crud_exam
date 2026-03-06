<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUsersTableColumns extends Migration
{
    public function up()
    {
        // Check if table exists and has the old columns
        if (!$this->db->tableExists('users')) {
            return;
        }

        $fields = $this->db->getFieldData('users');
        $fieldNames = array_column($fields, 'name');

        // Only proceed if old columns exist and new ones don't
        if (in_array('fullname', $fieldNames) && !in_array('name', $fieldNames)) {
            // Add new columns
            $this->forge->addColumn('users', [
                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true,
                ],
                'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true,
                    'unique' => true,
                ],
            ]);

            // Copy data from old columns to new ones if they exist
            $this->db->query('UPDATE users SET name = fullname WHERE name IS NULL');
            $this->db->query('UPDATE users SET email = username WHERE email IS NULL');

            // Drop old columns as they're no longer needed
            // Note: We can keep them for backward compatibility or drop them
            // For now, let's keep them to avoid breaking existing code
        }
    }

    public function down()
    {
        // Reverse the process if needed
        if ($this->db->tableExists('users')) {
            $fields = $this->db->getFieldData('users');
            $fieldNames = array_column($fields, 'name');

            if (in_array('name', $fieldNames)) {
                $this->forge->dropColumn('users', ['name', 'email']);
            }
        }
    }
}
