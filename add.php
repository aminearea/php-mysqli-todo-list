<?php
require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty(trim($_POST['title'] ?? ''))) {
    $title = trim($_POST['title']);
    $stmt = $conn->prepare("INSERT INTO todos (title) VALUES (?)");
    $stmt->bind_param("s", $title);
    $stmt->execute();
    $stmt->close();
}

header('Location: index.php');
exit;
