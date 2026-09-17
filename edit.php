<?php
require_once __DIR__ . '/config/database.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

// Si le formulaire est soumis -> mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    if ($title !== '') {
        $stmt = $conn->prepare("UPDATE todos SET title = ? WHERE id = ?");
        $stmt->bind_param("si", $title, $id);
        $stmt->execute();
        $stmt->close();
    }
    header('Location: index.php');
    exit;
}

// Sinon -> afficher la tâche à modifier
$stmt = $conn->prepare("SELECT * FROM todos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$todo = $result->fetch_assoc();
$stmt->close();

if (!$todo) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier - Todo List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>✎ Modifier la tâche</h1>
        <form class="add-form" action="edit.php?id=<?= $todo['id'] ?>" method="POST">
            <input type="text" name="title" value="<?= htmlspecialchars($todo['title']) ?>" required maxlength="255">
            <button type="submit">Enregistrer</button>
        </form>
        <p style="text-align:center; margin-top:15px;">
            <a href="index.php">← Retour</a>
        </p>
    </div>
</body>
</html>
