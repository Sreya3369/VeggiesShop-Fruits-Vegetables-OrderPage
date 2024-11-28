<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action === "order") {
        $updateQuery = "UPDATE admin SET `order`=1 WHERE id=$id";
    } elseif ($action === "process") {
        $updateQuery = "UPDATE admin SET `process`=1 WHERE id=$id";
    } elseif ($action === "placed") {
        $updateQuery = "UPDATE admin SET `placed`=1 WHERE id=$id";
    }

    if ($conn->query($updateQuery)) {
        // Check if all actions are completed
        $checkQuery = "SELECT * FROM admin WHERE id=$id";
        $result = $conn->query($checkQuery);
        if ($result->num_rows > 0) {
            $order = $result->fetch_assoc();
            if ($order['order'] == 1 && $order['process'] == 1 && $order['placed'] == 1) {
                $statusUpdateQuery = "UPDATE admin SET status='Success' WHERE id=$id";
                $conn->query($statusUpdateQuery);
            }
        }
        echo "Action updated successfully.";
    } else {
        echo "Error updating action.";
    }
}

$conn->close();
?>
