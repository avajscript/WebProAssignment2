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
            include("../components/header.php");
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

                <div class="mar-bottom-32">
                    <p>Don't have an account?
                        <b>
                        <a href="signup.php" class = 'green'>
                            Sign up here
                        </a>
                        </b></p>
                </div>
                <button class="anti-default-btn">
                    <h5>LOG IN</h5>
                </button>
            </form>
        </main>

    </body>
</html>