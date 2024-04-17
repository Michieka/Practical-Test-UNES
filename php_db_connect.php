<?php
$servername = "localhost";
$username = "task_management";
$password = "B3qDJg2Bq*ugb-@P";
$dbname = "task_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function createTask($name, $description, $due_date, $priority) {
    global $conn;
    $name = mysqli_real_escape_string($conn, $name);
    $description = mysqli_real_escape_string($conn, $description);
    $due_date = mysqli_real_escape_string($conn, $due_date);
    $priority = mysqli_real_escape_string($conn, $priority);
    
    $sql = "INSERT INTO tasks (name, description, due_date, priority) VALUES ('$name', '$description', '$due_date', '$priority')";
    return $conn->query($sql);
}

function getTasks() {
    global $conn;
    $sql = "SELECT * FROM tasks";
    $result = $conn->query($sql);
    $tasks = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
    }
    return $tasks;
}

function getTask($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT * FROM tasks WHERE id='$id'";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error retrieving task: " . $conn->error;
        return null;
    }
    return $result->fetch_assoc();
}



function updateTask($id, $name, $description, $due_date, $priority, $status) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $name = mysqli_real_escape_string($conn, $name);
    $description = mysqli_real_escape_string($conn, $description);
    $due_date = mysqli_real_escape_string($conn, $due_date);
    $priority = mysqli_real_escape_string($conn, $priority);
    $status = mysqli_real_escape_string($conn, $status);
    
    $sql = "UPDATE tasks SET name='$name', description='$description', due_date='$due_date', priority='$priority', status='$status' WHERE id=$id";
    return $conn->query($sql);
}

function deleteTask($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "DELETE FROM tasks WHERE id=$id";
    return $conn->query($sql);
}
?>
