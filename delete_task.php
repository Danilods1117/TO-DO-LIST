<?php
    include 'db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_task'])) {
        $task_id = $_POST['task_id'];
        $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->execute([$task_id]);
    }

    header("Location: index.php"); 
    exit();
?>