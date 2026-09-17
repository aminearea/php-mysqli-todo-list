# 📝 Todo List — PHP + MySQL (mysqli) + XAMPP

> Application web simple pour gérer ses tâches : ajouter, afficher, terminer, modifier, supprimer.
> Projet débutant idéal pour apprendre **PHP + MySQL + GitHub**.

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-MariaDB-4479A1?style=flat&logo=mysql&logoColor=white)
![XAMPP](https://img.shields.io/badge/XAMPP-Apache-FB7A29?style=flat&logo=xampp&logoColor=white)
![Status](https://img.shields.io/badge/Status-Fonctionnel-success)

---

## ✨ Fonctionnalités

- [x] Ajouter une tâche
- [x] Afficher toutes les tâches (plus récentes d'abord)
- [x] Marquer terminée / annuler
- [x] Modifier une tâche
- [x] Supprimer avec confirmation
- [x] Compteur `terminées / total`
- [x] Design responsive simple

## 🛠️ Stack

- **Front :** HTML5 + CSS3 pur (aucun framework)
- **Back :** PHP 8 procédural + mysqli
- **Base :** MySQL / MariaDB via phpMyAdmin
- **Serveur local :** XAMPP (Apache + MySQL)

## 📁 Structure du projet

```text
todo-list/
├── index.php          # Liste + formulaire + SELECT + foreach
├── add.php            # INSERT (POST)
├── edit.php           # SELECT par id + UPDATE
├── delete.php         # DELETE par id
├── complete.php       # UPDATE is_completed = 1 - is_completed
├── config/
│   └── database.php   # Connexion $conn = new mysqli(...)
├── css/
│   └── style.css      # Design carte centrée
├── database.sql       # Création base + table
└── README.md
```

## 🚀 Installation en 4 étapes

### 1. Cloner / copier
```bash
# Option A : clone
git clone https://github.com/aminearea/todo-list.git C:\xampp\htdocs\todo-list

# Option B : copie manuelle du dossier vers :
C:\xampp\htdocs\todo-list\
```

### 2. Lancer XAMPP
- Ouvre **XAMPP Control Panel**
- Start **Apache** (port 80) → vert
- Start **MySQL** (port 3306) → vert

### 3. Créer la base
1. Va sur http://localhost/phpmyadmin
2. Crée base `todo_list` en `utf8mb4_unicode_ci`
3. Onglet **Importer** → choisis `database.sql` → Exécuter

Ou colle ça dans l'onglet SQL :
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

### 4. Config + lancement
Vérifie `config/database.php` :
```php
$host   = 'localhost';
$user   = 'root';
$pass   = '';
$dbname = 'todo_list';
$conn = new mysqli($host, $user, $pass, $dbname);
```

Ouvre : **http://localhost/todo-list/index.php**

## 🧠 Comment ça marche ? (pour débutant PHP)

1. `database.php` crée `$conn`, le tuyau vers MySQL
2. `index.php` fait `query(SELECT)` → `fetch_all()` → `foreach` en HTML
3. Formulaire en `POST` → `add.php` fait `prepare(INSERT ?)` + `bind_param("s")`
4. Boutons avec `?id=3` → `$_GET['id']` lu dans `delete/complete/edit.php`
5. Après chaque action : `header('Location: index.php')` pour revenir à la liste

Détail fichier par fichier dans le code (commentaires en français).

## 🔒 Sécurité

- Requêtes préparées : `prepare(?) + bind_param + execute` → anti-injection SQL
- `(int)` sur `$_GET['id']` → force un nombre
- `htmlspecialchars()` à l'affichage → anti-XSS
- `trim()` + contrôle vide avant INSERT/UPDATE

## 🗺️ Idées d'amélioration

- [ ] Recherche + filtre (toutes / actives / terminées)
- [ ] Dates limites + priorité
- [ ] Pagination
- [ ] Auth multi-utilisateurs
- [ ] Version PDO + version API JSON
- [ ] Dark mode

## 👤 Auteur

**aminearea** — https://github.com/aminearea/todo-list

Projet d'apprentissage PHP/MySQL. N'hésite pas à forker et proposer des PR !

## 📄 Licence

MIT — libre d'utilisation pour apprendre et modifier.
