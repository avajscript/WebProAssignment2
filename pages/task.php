<?php
session_start();

/*
 * TODO:
 * Write logic to fetch single task based on get request
 * Url looks like tasks.php?id=5
 * Use $_GET["id"] and fetch from database and render to screen
 * Add a delete button too
 */

include "../server/db_connection.php";
include "../server/functions.php";

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = OpenCon();

// Check if task ID is provided in the URL
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    // Fetch task details based on task ID
    $query = "SELECT * FROM tasks WHERE task_id = $task_id AND user_id = {$_SESSION['user_id']}";
    $result = mysqli_query($conn, $query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        // Task details found
        $title = $row['title'];
        $description = $row['description'];
        $status = $row['status'];
        $due_date = $row['due_date'];
    } else {
        // Task not found or unauthorized access
        header("Location: tasks.php");
        exit();
    }
} else {
    // Task ID not provided in the URL
    header("Location: tasks.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main/styles.css">
    <title>Task Details</title>
</head>
<body>
    <?php include('../components/header.php'); ?>
    <main>
        <div class="default-page">
            <h1 class='mar-bottom-16'>Task Details</h1>
            <div class="task-details">
                <h2 class='mar-bottom-8'><?php echo $title; ?></h2>
                <p class='mar-bottom-8'><?php echo $description; ?></p>
                <p class='mar-bottom-8'>Status: <?php echo $status; ?></p>
                <p class='mar-bottom-8'>Due Date: <?php echo $due_date; ?></p>
                
                <!-- Edit and Delete options -->
                <div class="flex">
                    <!-- Link to Edit Task -->
                    <a href="./edit_task.php?id=<?php echo $task_id; ?>" class="default-btn mar-right-8">Edit</a>
                    <!-- Link to Delete Task -->
                    <a href="./delete_task.php?id=<?php echo $task_id; ?>" class="default-btn delete-btn">Delete</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>