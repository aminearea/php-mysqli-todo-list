-- Base de données : todo_list
-- À importer via phpMyAdmin si besoin (http://localhost/phpmyadmin)

CREATE DATABASE IF NOT EXISTS todo_list CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE todo_list;

CREATE TABLE IF NOT EXISTS todos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    is_completed TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
