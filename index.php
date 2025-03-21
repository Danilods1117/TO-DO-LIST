<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="box-a">
            <h2>To Do List</h2>
            <p>New Task</p>
        </div>
        <div class="box-b">
            <h2>New Task</h2>
            <form action="add_task.php" method="POST">
                <input type="text" name="task_name" placeholder="Enter a task" required>
                <button type="submit" class="btn">Add Task</button>
            </form>
            
            <?php include 'db.php';
              $tasks = $conn->query("SELECT * FROM tasks WHERE is_completed = 0")->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <h3>Task List</h3>
            <ul>
                <?php foreach ($tasks as $task): ?>
                <li>
                    <span><?php echo htmlspecialchars($task['task_name']); ?></span>
                    <div class="task-buttons">
                        <form action="complete_task.php" method="POST">
                            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                            <button type="submit" name="complete_task" class="complete">Completed</button>
                        </form>
                        <form action="delete_task.php" method="POST">
                            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                            <button type="submit" name="delete_task" class="delete">Delete</button>
                        </form>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>

            <h3>Completed Tasks</h3>
            <ul>
                <?php
                $completedTasks = $conn->query("SELECT * FROM tasks WHERE is_completed = 1")->fetchAll(PDO::FETCH_ASSOC);
                
                if (count($completedTasks) > 0):
                    foreach ($completedTasks as $task): ?>
                        <li class="completed-task">
                            <span><?php echo htmlspecialchars($task['task_name']); ?></span>
                            <form action="delete_task.php" method="POST" class="delete-form">
                                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                <button type="submit" name="delete_task" class="delete">Delete</button>
                            </form>
                        </li>
                    <?php endforeach; 
                else:
                    echo "<p>No completed tasks.</p>";
                endif;
                ?>
            </ul>
        </div>
    </div>
</body>
</html>
