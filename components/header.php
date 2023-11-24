<!-- Header.php -->
<?php
    //session_start();



?>
<nav class='header flex space-between align-center'>

    <img src='../images/to-do-list-64.png' alt='todo'/>
    <!-- Right side of nav -->
    <div class="flex align-center">
        <h5 class='mar-right-32'>

            <a href="../index.html">
                Home Page
            </a>
        </h5>
        <h5 class='mar-right-32'>

            <a href="../pages/tasks.php">
                My Tasks
            </a>
        </h5>
        <div class="default-btn">
            <h5>
                <?php
                if (isset($_SESSION['email'])) {
                    echo " <a href='../pages/logout.php'>
                        SIGN OUT
                </a>";
                } else {

                    echo " <a href='../pages/login.php'>
                        LOG IN
                </a>";
                }
                ?>

            </h5>
        </div>
    </div>
    <!-- End of right side of nav-->
</nav>