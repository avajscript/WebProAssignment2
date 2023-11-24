<?php
session_start();
/*
 * TODO:
 * Write logic to fetch single task based on get request
 * Url looks like tasks.php?id=5
 * Use $_GET["id"] and fetch from database and render to screen
 * Add a delete button too
 */
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../styles/main/styles.css">
        <title>Task Page</title>
    </head>
    <body>
        <?php
        include "../components/header.php";
        ?>
    </body>
</html>
