<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="../scripts/forms.js" defer></script>
        <link rel="stylesheet" href="../styles/main/styles.css">
        <title>Sign Up Page</title>
    </head>
    <body>
        <?php include('../components/header.php') ?>
        <form method = 'post' action = 'signup.php' class='input-form' >
            <div class="input-field">
                <label>
                    <h5>
                        Email Address *
                    </h5>
                    <input class = 'mar-bottom-8' type="text" name = 'email' id = 'email' placeholder='johndoe@gmail.com'>
                </label>
                <p id="email-error" class ='error' ></p>
            </div>

            <div class="input-field">
                <label>
                    <h5>
                        Password *
                    </h5>
                    <input class = 'mar-bottom-8' type="password" id = 'password' name = 'password' placeholder="password">
                </label>
                <div id="password-error" class ='error'></div>
            </div>



            <div class="mar-bottom-32">
                <p>Already have an account?
                    <b>
                        <a href="signup.php" class = 'green'>
                            Log in here
                        </a>
                    </b></p>
            </div>
            <button type = 'button' class="anti-default-btn" onclick="validateForm()">
                <h5>SIGN UP</h5>
            </button>
        </form>

    </body>
</html>