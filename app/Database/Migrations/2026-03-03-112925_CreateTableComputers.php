<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateComputers extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'auto_increment' => true,
        ],
        'computer_name' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
        ],
        'brand' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
        ],
        'price' => [
            'type' => 'DECIMAL',
            'constraint' => '10,2',
        ],
        'stock' => [
            'type' => 'INT',
            'constraint' => 11,
        ],
        'status' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
        ],
        'created_at DATETIME default current_timestamp',
        'updated_at DATETIME default current_timestamp on update current_timestamp'
    ]);

    $this->forge->addKey('id', true);
    $this->forge->createTable('computers');
}

public function down()
{
    $this->forge->dropTable('computers');
    }
}