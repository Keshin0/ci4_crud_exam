-- Profile Migration SQL
-- Add profile columns to users table

ALTER TABLE `users`
ADD COLUMN `student_id` VARCHAR(20) NULL COMMENT 'Student ID (e.g., 2021-00123)',
ADD COLUMN `course` VARCHAR(100) NULL COMMENT 'Course (e.g., BSIT, BSCS)',
ADD COLUMN `year_level` TINYINT(1) NULL COMMENT 'Year level (1-5)',
ADD COLUMN `section` VARCHAR(50) NULL COMMENT 'Section (e.g., IT3A)',
ADD COLUMN `phone` VARCHAR(20) NULL COMMENT 'Phone number (e.g., 09XX-XXX-XXXX)',
ADD COLUMN `address` TEXT NULL COMMENT 'Home address',
ADD COLUMN `profile_image` VARCHAR(255) NULL COMMENT 'Profile image filename (e.g., avatar_1.jpg)';
