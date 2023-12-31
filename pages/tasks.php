<!--Tasks.php -->
<?php
session_start();
include "../server/db_connection.php";
include "../server/functions.php";

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // if user is not logged in, redirect to the login page
    exit();
}

$conn = OpenCon();
// check if user logged in
$pastDueTasks = "";
$upcomingTasks = "";
$todayTasks = "";

if (isset($_SESSION['user_id'])) {
    // Initializing variables
$user_id = $_SESSION['user_id'];
$search = $_GET['search'] ?? null;
$statusFilter = $_GET['status'] ?? null;
$startDateFilter = $_GET['start_date'] ?? null;
$endDateFilter = $_GET['end_date'] ?? null;
$priorityFilter = $_GET['priority'] ?? null; // Adding null coalescing operator for priority

// Start building the query
$query = "SELECT * FROM tasks WHERE user_id = $user_id";

// Append search condition if search parameter is provided
if (!empty($search)) {
    $query .= " AND (title LIKE '%$search%' OR description LIKE '%$search%')";
}

// Append status filter condition if status parameter is provided
if (!empty($statusFilter)) {
    $query .= " AND status = '$statusFilter'";
}

// Append priority filter condition if priority parameter is provided
if (!empty($priorityFilter)) { // Ensuring priority is set before appending it to the query
    $query .= " AND priority = '$priorityFilter'";
}

// Append due date filter condition if both start and end date parameters are provided
if (!empty($startDateFilter) && !empty($endDateFilter)) {
    $query .= " AND DATE(due_date) >= '$startDateFilter' AND DATE(due_date) <= '$endDateFilter'";
}

$result = mysqli_query($conn, $query);

    if ($result) {
    // iterate over tasks, add styling and add to tasks string
    while ($row = mysqli_fetch_assoc($result)) {
        // returns the colored date and state of the date (today, normal, passed)
        [$dateElem, $state] = getDateElem($row['due_date']);
        
        // Get the priority class styling
        switch ($row['priority']) {
            case 'low':
                $priorityClass = 'bg-green'; // Green for low priority
                break;
            case 'medium':
                $priorityClass = 'bg-orange'; // Orange for medium priority
                break;
            case 'high':
                $priorityClass = 'bg-red'; // Red for high priority
                break;
            default:
                $priorityClass = 'bg-green'; // Default to green if no priority is set
                break;
        }
            // date element
            $task_id = $row['task_id'];
            $task = "
           
            <a href='./task.php?id=$task_id' class='no-underline'>
           
            <div class = 'task task-small' >
                <div class='priority $priorityClass'>
                <div class = 'flex justify-end' >
                <div >
                    <p class='bold'>
                        {$row['priority']}
                    </p>
                    </div>
                </div>
            </div>
            <div style = 'padding: 8px 24px 16px'>
            

            
                     
                <h4 class = 'mar-bottom-8'>
                {$row['title']}
                </h4>
                
                <p class='mar-bottom-8 task-text'>
                {$row['description']}
                </p>
            <div>
                   <div>
                    $dateElem
                    </div>
                </div>
            </div>
            </div>
            </a>
            ";
            // push into today, upcoming or pastDue based on date
            switch ($state) {
                case "date-today":
                    $todayTasks .= $task;
                    break;
                case "date-upcoming":
                    $upcomingTasks .= $task;
                    break;
                case "date-passed":
                    $pastDueTasks .= $task;
                    break;
                default:
                    break;
            }
        }
    }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../styles/main/styles.css">

        <title>Tasks Page</title>
    </head>
    <body>
        <main>
            <?php
            include('../components/header.php');
            ?>
            <div class="default-page">
                <h1 class='mar-bottom-16'>Your tasks</h1>

                <!-- Search and Filter Form -->
                <form action="tasks.php" method="get" class="filter-bar mar-bottom-32">
                    <div class="mar-bottom-16">
                        <input class='focus-search' type="text" name="search" placeholder="Search tasks"
                               value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                    </div>
                    <div class="flex flex-column align-start flex-content flex-row">

                        <div class="">
                            <!-- Status select -->
                            <select name="status" id='status' class=mar-right-16>
                                <option value="">Any Status</option>
                                <option value="not started" <?php if (($_GET['status'] ?? '') == 'not started') echo 'selected'; ?>>
                                    Not Started
                                </option>
                                <option value="in progress" <?php if (($_GET['status'] ?? '') == 'in progress') echo 'selected'; ?>>
                                    In Progress
                                </option>
                                <option value="completed" <?php if (($_GET['status'] ?? '') == 'completed') echo 'selected'; ?>>
                                    Completed
                                </option>
                                <option value="on hold" <?php if (($_GET['status'] ?? '') == 'on hold') echo 'selected'; ?>>
                                    On Hold
                                </option>
                            </select>
                            <!-- End of status select -->

                            <!-- Priority select -->
                            <select name="priority" id='priority'>
                                <option value="">Any Priority</option>
                                <option value="low" <?php if (($_GET['priority'] ?? '') == 'low') echo 'selected'; ?>>
                                    Low
                                </option>
                                <option value="medium" <?php if (($_GET['priority'] ?? '') == 'medium') echo 'selected'; ?>>
                                    Medium
                                </option>
                                <option value="high" <?php if (($_GET['priority'] ?? '') == 'high') echo 'selected'; ?>>
                                    High
                                </option>

                            </select>
                            <!-- End of priority select -->

                        </div>
                        <!-- Date selectors -->
                        <div class="mar-bottom-8 flex align-center flex-wrap">
                            <div class="mar-right-16">
                                <label>
                                    <p class='bold mar-bottom-4'>From</p>
                                    <input type="date" name="start_date" id='from'
                                           value="<?php echo htmlspecialchars($_GET['start_date'] ?? ''); ?>"
                                </label>

                            </div>

                            <div class="">
                                <label>
                                    <p class="bold mar-bottom-4">To</p>
                                    <input type="date" name="end_date"
                                           id='to'
                                           value="<?php echo htmlspecialchars($_GET['end_date'] ?? ''); ?>">
                                </label>
                            </div>
                        </div>
                        <!-- End of date selectors -->
                    </div>
                    <div class="flex space-between align-end">
                        <!-- Search button -->
                        <button type="submit" class="anti-default-white-btn ">
                            <h5 class='mar-right-8'>Search</h5>
                        </button>
                        <!-- End of search button -->

                        <!-- Clear -->
                        <p class='underline' onclick="clearFilter()">
                            clear
                        </p>
                        <!-- End of clear -->
                    </div>

                </form>
                <!-- End of Search and Filter Form -->

                <div class="flex justify-end mar-bottom-32">
                    <div class="anti-default-btn">
                        <h5>

                            <a href="./addtask.php">
                                Add Task
                            </a>
                        </h5>

                    </div>

                </div>
                <!-- Task section -->
                <div class="task-section">
                    <div class="task-holder">
                        <div class="task-header  space-between">
                            <div class='flex align-center'>
                                <div class="circle-red"></div>
                                <h3>Past Due</h3>
                            </div>
                            <h5 class="bold">Priority</h5>
                        </div>
                        <?php
                        echo $pastDueTasks;
                        ?>
                    </div>

                    <div class="task-holder">
                        <div class="task-header space-between">
                            <div class="flex align-center">
                                <div class="circle-yellow"></div>
                                <h3>Upcoming</h3>
                            </div>
                            <h5 class="bold">Priority</h5>
                        </div>
                        <?php
                        echo $upcomingTasks;
                        ?>
                    </div>

                    <div class="task-holder">
                        <div class="task-header space-between">
                            <div class="flex align-center">
                                <div class="circle-green"></div>
                                <h3>Today</h3>
                            </div>
                            <h5 class="bold">Priority</h5>
                        </div>
                        <?php
                        echo $todayTasks;
                        ?>
                    </div>

                </div>
                <!-- End of task section -->
            </div>
        </main>
        <script>
            // getting elements from the search filter
            const searchBar = document.querySelector(".focus-search");
            const status = document.getElementById('status');
            const from = document.getElementById('from');
            const to = document.getElementById('to');

            // clear all values in search filter elements
            const clearFilter = () => {
                searchBar.value = '';
                status.value = '';
                from.value = '';
                to.value = '';
            }
        </script>
    </body>
</html>
