<?php
    include 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty(trim($_POST['task_name']))) {
        $stmt = $conn->prepare("INSERT INTO tasks (task_name) VALUES (?)");
        $stmt->execute([trim($_POST['task_name'])]);
    }

    header("Location: index.php");
    exit();
?>
