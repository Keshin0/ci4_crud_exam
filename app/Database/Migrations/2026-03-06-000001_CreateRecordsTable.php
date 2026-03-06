<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecordsTable extends Migration
{
    public function up()
    {
        // Use raw SQL with IF NOT EXISTS to prevent errors  
        $this->db->query('CREATE TABLE IF NOT EXISTS `records` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT,
            `status` VARCHAR(50) DEFAULT "active",
            `user_id` INT(11) UNSIGNED,
            `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            `deleted_at` DATETIME DEFAULT NULL,
            CONSTRAINT `pk_records` PRIMARY KEY(`id`),
            CONSTRAINT `fk_records_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
        ) DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci');
    }

    public function down()
    {
        $this->forge->dropTable('records');
    }
}
