<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Session extends Migration
{
    public function up()
    {
        // Skip if table already exists
        if ($this->db->tableExists('sessions')) {
            return;
        }

        $this->forge->addField([
            'id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128
            ],
            'ip_address'       => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
            ],
            'timestamp' => [
                'type' => 'timestamp'
            ],
            'data' => [
                'type' => 'blob'
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('timestamp', true);
        $this->forge->createTable('sessions', true);
    }

    public function down()
    {
        $this->forge->dropTable('sessions');
    }
}
