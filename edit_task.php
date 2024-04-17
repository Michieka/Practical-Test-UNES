<?php
include_once 'php_db_connect.php'; // Include the database connection script

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $task = getTask($id);
    if (!$task) {
        echo "Task not found.";
        exit;
    }
} else {
    echo "Task ID not provided.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    // Update the task
    if (updateTask($id, $name, $description, $due_date, $priority, $status)) {
        echo "Task updated successfully.";
    } else {
        echo "Error updating task: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>
    <form action="edit_task.php?id=<?php echo $id; ?>" method="post">
        <label for="name">Task Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $task['name']; ?>" required><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo $task['description']; ?></textarea><br>
        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" value="<?php echo $task['due_date']; ?>" required><br>
        <label for="priority">Priority:</label>
        <select id="priority" name="priority">
            <option value="Low" <?php echo ($task['priority'] == 'Low') ? 'selected' : ''; ?>>Low</option>
            <option value="Medium" <?php echo ($task['priority'] == 'Medium') ? 'selected' : ''; ?>>Medium</option>
            <option value="High" <?php echo ($task['priority'] == 'High') ? 'selected' : ''; ?>>High</option>
        </select><br>
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="Pending" <?php echo ($task['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="In Progress" <?php echo ($task['status'] == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
            <option value="Completed" <?php echo ($task['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
        </select><br>
        <input type="submit" value="Update Task">
    </form>
</body>
</html>
