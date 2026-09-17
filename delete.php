<?php
require_once __DIR__ . '/config/database.php';

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM todos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header('Location: index.php');
exit;
