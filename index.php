<?php
require_once __DIR__ . '/config/database.php';

// Récupérer toutes les tâches, les plus récentes d'abord
$result = $conn->query("SELECT * FROM todos ORDER BY created_at DESC");
$todos = $result->fetch_all(MYSQLI_ASSOC);

// Compteurs
$total = count($todos);
$done = count(array_filter($todos, fn($t) => $t['is_completed']));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>📝 Ma Todo List</h1>
        <p class="stats"><?= $done ?> / <?= $total ?> tâche(s) terminée(s)</p>

        <form class="add-form" action="add.php" method="POST">
            <input type="text" name="title" placeholder="Nouvelle tâche..." required maxlength="255">
            <button type="submit">Ajouter</button>
        </form>

        <?php if (empty($todos)): ?>
            <p class="empty">Aucune tâche pour le moment. Ajoutez-en une ! 🎉</p>
        <?php else: ?>
            <ul class="todo-list">
                <?php foreach ($todos as $todo): ?>
                    <li class="<?= $todo['is_completed'] ? 'completed' : '' ?>">
                        <span class="title"><?= htmlspecialchars($todo['title']) ?></span>
                        <span class="date"><?= htmlspecialchars($todo['created_at']) ?></span>
                        <div class="actions">
                            <a class="btn done" href="complete.php?id=<?= $todo['id'] ?>">
                                <?= $todo['is_completed'] ? '↩ Annuler' : '✓ Terminer' ?>
                            </a>
                            <a class="btn edit" href="edit.php?id=<?= $todo['id'] ?>">✎ Modifier</a>
                            <a class="btn delete" href="delete.php?id=<?= $todo['id'] ?>"
                               onclick="return confirm('Supprimer cette tâche ?')">🗑 Supprimer</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>
