<!--Tasks.php -->
<?php
session_start();


?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../styles/main/styles.css">
        <script src='../scripts/tasks.js'></script>

        <title>Tasks Page</title>
    </head>
    <body>
        <?php
        include('../components/header.php');
        ?>
        <h1 class ='mar-bottom-16'>Your tasks</h1>
        <div class="flex">
        <div class="anti-default-btn">
            <h5>

                <a href="./addtask.php">
                    Add Task
                </a>
            </h5>
        </div>
        </div>

    </body>
</html>
