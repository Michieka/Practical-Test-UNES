<?php
include_once 'php_db_connect.php'; // Include the database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $priority = $_POST['priority'];

    // Create the task
    if (createTask($name, $description, $due_date, $priority)) {
        echo "Task created successfully.";
    } else {
        echo "Error creating task: " . $conn->error;
    }
}
?>
