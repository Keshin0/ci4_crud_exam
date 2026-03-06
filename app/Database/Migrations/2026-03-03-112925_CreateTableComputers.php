<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateComputers extends Migration
{
    public function up()
{
    // Use raw SQL with IF NOT EXISTS to prevent errors
    $this->db->query('CREATE TABLE IF NOT EXISTS `computers` (
        `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        `computer_name` VARCHAR(255) NOT NULL,
        `brand` VARCHAR(255) NOT NULL,
        `price` DECIMAL(10,2) NOT NULL,
        `stock` INT(11) NOT NULL,
        `status` VARCHAR(50) NOT NULL,
        `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        CONSTRAINT `pk_computers` PRIMARY KEY(`id`)
    ) DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci');
}

public function down()
{
    $this->forge->dropTable('computers');
    }
}