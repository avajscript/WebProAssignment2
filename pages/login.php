<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='../styles/main/styles.css'>
        <title>Document</title>
    </head>
    <body>
        <main>
            <?php
            require_once "../components/header.php";
            ?>
            <form class='input-form'>
                <div class="input-field">
                    <label>
                        <h5>
                            Email Address *
                        </h5>
                        <input type="text" placeholder='johndoe@gmail.com'>
                    </label>
                </div>
                
                <div class="input-field">
                    <label>
                        <h5>
                            Password *
                        </h5>
                        <input type="password" placeholder="password">
                    </label>
                </div>
            </form>
        </main>

    </body>
</html>