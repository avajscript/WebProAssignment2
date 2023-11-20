<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../styles/main/styles.css">
        <title>Sign Up Page</title>
    </head>
    <body>
        <?php include('../components/header.php') ?>
        <form method = 'post' action = 'signup.php' class='input-form' onsubmit="valdiateForm()">
            <div class="input-field">
                <label>
                    <h5>
                        Email Address *
                    </h5>
                    <input type="text" name = 'email' id = 'email' placeholder='johndoe@gmail.com'>
                </label>
            </div>

            <div class="input-field">
                <label>
                    <h5>
                        Password *
                    </h5>
                    <input type="password" id = 'password' name = 'password' placeholder="password">
                </label>
            </div>

            <div class="input-field">
                <label>
                    <h5>
                        Confirm Password *
                    </h5>
                    <input type="password" id = 'password' name = 'password' placeholder="confirm password">
                </label>
            </div>

            <div class="mar-bottom-32">
                <p>Already have an account?
                    <b>
                        <a href="signup.php" class = 'green'>
                            Log in here
                        </a>
                    </b></p>
            </div>
            <button class="anti-default-btn">
                <h5>SIGN UP</h5>
            </button>
        </form>
        <script>
            const errors = {email: "Email be a valid email. johndoe@gmail.com", password: "Password must be 8 characters", password2: "Passwords must match"}
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const password2 = document.getElementById('password2');

            const validateForm = () => {

            }

        </script>
    </body>
</html>