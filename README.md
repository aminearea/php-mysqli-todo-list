# 📝 Todo List PHP + MySQL (mysqli)

Petite application Todo List en PHP procédural avec MySQL (XAMPP).
Ajouter, terminer, modifier, supprimer des tâches.

## Prérequis

- XAMPP avec Apache + MySQL lancés (verts)
- PHP 8.x, MariaDB / MySQL
- Navigateur sur `http://localhost`

## Installation

1. Copier le dossier dans XAMPP :
   `C:\xampp\htdocs\todo-list\`

2. Créer la base de données :
   - Ouvrir `http://localhost/phpmyadmin`
   - Créer la base `todo_list` en `utf8mb4_unicode_ci`
   - Importer `database.sql` (ou copier son contenu dans l'onglet SQL)

3. Vérifier la connexion dans `config/database.php` :
   ```php
   $host = 'localhost';
   $user = 'root';
   $pass = '';
   $dbname = 'todo_list';
   ```

4. Ouvrir l'app :
   `http://localhost/todo-list/index.php`

## Structure

```
todo-list/
├── index.php        -> affiche la liste (SELECT + foreach)
├── add.php          -> ajoute (INSERT + POST)
├── edit.php         -> modifie (SELECT puis UPDATE)
├── delete.php       -> supprime (DELETE avec ?id)
├── complete.php     -> termine / annule (UPDATE 1-is_completed)
├── config/
│   └── database.php -> connexion mysqli ($conn)
├── css/
│   └── style.css
└── database.sql     -> création base + table todos
```

## Table SQL

```sql
CREATE DATABASE IF NOT EXISTS todo_list CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE todo_list;
CREATE TABLE IF NOT EXISTS todos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  is_completed TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Sécurité

- Requêtes préparées `prepare(?)+ bind_param + execute`
- `htmlspecialchars()` à l'affichage
- `(int)` sur `$_GET['id']`
