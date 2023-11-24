<?php
// addtask.php

// Start the session if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../server/db_connection.php';

$conn = OpenCon();
$error = false;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $due_date = $_POST['due_date'];

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if ($user_id !== null) {
    // Continue with your code using $user_id
    } else {
    // Handle the case where user_id is not set
    echo "User is not authenticated.";
    }

    // You should perform proper validation and sanitation of user inputs here

    // Insert the task into the database
    $query = "INSERT INTO tasks (user_id, title, description, status, due_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    $user_id = $_SESSION['user_id']; // Make sure to set user_id when the user logs in
    mysqli_stmt_bind_param($stmt, "issss", $user_id, $title, $description, $status, $due_date);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: tasks.php'); // Redirect to the tasks page after successful insertion
        exit();
    } else {
        $error = true;
        $error_message = "Error adding the task. Please try again.";
    }

    mysqli_stmt_close($stmt);
}

CloseCon($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='../styles/main/styles.css'>
    <script src="../scripts/add_task.js" defer></script>
    <title>Add Task</title>
</head>
<body>
    <main>
        <?php include("../components/header.php"); ?>
        <form method="post" action="addtask.php" onsubmit="return validateForm()" class="input-form">
            <div class="input-field">
                <label>
                    <h5>Title *</h5>
                    <input class="mar-bottom-8" type="text" name="title" id="title" placeholder="Task title">
                </label>
                <p id="title-error" class="error"></p>
            </div>

            <div class="input-field">
                <label>
                    <h5>Description</h5>
                    <textarea class="mar-bottom-8" name="description" id="description" placeholder="Task description"></textarea>
                </label>
            </div>

            <div class="input-field">
                <label>
                    <h5>Status *</h5>
                    <select class="mar-bottom-8" name="status" id="status">
                        <option value="not started">Not Started</option>
                        <option value="in progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="on hold">On Hold</option>
                    </select>
                </label>
            </div>

            <div class="input-field">
                <label>
                    <h5>Due Date</h5>
                    <input class="mar-bottom-8" type="date" name="due_date" id="due_date" placeholder="YYYY-MM-DD">
                </label>
                <p id="due_date-error" class="error"></p>
            </div>

            <p id="errorMessage" class="error mar-bottom-8"><?php echo $error ? $error_message : ''; ?></p>
            <button class="anti-default-btn">
                <h5>ADD TASK</h5>
            </button>
        </form>
    </main>
</body>
</html>