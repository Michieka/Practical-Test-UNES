<?php
include_once 'php_db_connect.php'; // Include the database connection script

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    // Delete the task
    if (deleteTask($id)) {
        echo "Task deleted successfully.";
    } else {
        echo "Error deleting task: " . $conn->error;
    }
} else {
    echo "Task ID not provided.";
    exit;
}
?>
