<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeletedAtToRecords extends Migration
{
    public function up()
    {
        // Add deleted_at column for soft deletes if it doesn't exist
        if ($this->db->tableExists('records')) {
            $fields = $this->db->getFieldData('records');
            $fieldNames = array_column($fields, 'name');

            if (!in_array('deleted_at', $fieldNames)) {
                $this->forge->addColumn('records', [
                    'deleted_at' => [
                        'type'    => 'DATETIME',
                        'null'    => true,
                        'default' => null,
                    ],
                ]);
            }
        }
    }

    public function down()
    {
        if ($this->db->tableExists('records')) {
            $fields = $this->db->getFieldData('records');
            $fieldNames = array_column($fields, 'name');

            if (in_array('deleted_at', $fieldNames)) {
                $this->forge->dropColumn('records', 'deleted_at');
            }
        }
    }
}
