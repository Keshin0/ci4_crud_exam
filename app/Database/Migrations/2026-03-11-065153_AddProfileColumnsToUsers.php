<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProfileColumnsToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'student_id' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'course' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'year_level' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],
            'section' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'profile_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ];
        
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['student_id', 'course', 'year_level', 'section', 'phone', 'address', 'profile_image']);
    }
}
