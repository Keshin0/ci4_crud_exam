-- ============================================================
-- RBAC Migration — Step 1
-- Run this in phpMyAdmin against your `adminpanel` database
-- ============================================================

-- 1. Create roles table
CREATE TABLE IF NOT EXISTS `roles` (
    `id`          INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`        VARCHAR(50)  NOT NULL,
    `label`       VARCHAR(100) NOT NULL,
    `description` TEXT         NULL,
    `created_at`  DATETIME     NULL,
    `updated_at`  DATETIME     NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Add role_id FK column to users (skip if already exists)
ALTER TABLE `users`
    ADD COLUMN IF NOT EXISTS `role_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `email`;

ALTER TABLE `users`
    ADD CONSTRAINT `fk_users_role_id`
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)
    ON DELETE SET NULL ON UPDATE CASCADE;

-- 3. Insert core roles
INSERT INTO `roles` (`name`, `label`, `description`, `created_at`, `updated_at`) VALUES
('admin',       'Administrator',         'Full access to all modules.',                                          NOW(), NOW()),
('teacher',     'Teacher',               'Access to dashboard, student management, and items module.',           NOW(), NOW()),
('student',     'Student',               'Restricted to own student dashboard and profile only.',                NOW(), NOW()),
('coordinator', 'Department Coordinator','CHALLENGE: Teacher access + /coordinator/report. Requires CoordinatorFilter.php.', NOW(), NOW());

-- 4. Insert demo users (password = Password1)
-- Hash: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.
INSERT INTO `users` (`name`, `email`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
('Admin User',           'admin@school.edu',       '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.', (SELECT id FROM roles WHERE name='admin'),       NOW(), NOW()),
('Teacher Cruz',         'teacher@school.edu',     '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.', (SELECT id FROM roles WHERE name='teacher'),     NOW(), NOW()),
('Student Reyes',        'student@school.edu',     '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.', (SELECT id FROM roles WHERE name='student'),     NOW(), NOW()),
('Coordinator Bautista', 'coordinator@school.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.', (SELECT id FROM roles WHERE name='coordinator'), NOW(), NOW());
