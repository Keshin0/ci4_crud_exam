<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomers extends Migration
{
    public function up()
    {
        // Use raw SQL with IF NOT EXISTS to prevent errors
        $this->db->query('CREATE TABLE IF NOT EXISTS `customers` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(100) NOT NULL,
            `contact_number` VARCHAR(20),
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            CONSTRAINT `pk_customers` PRIMARY KEY(`id`)
        ) DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci');
    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}