<?php
// Database connection parameters
$servername = "";
$username = "";
$password = "";
$dbname = "";

// Get ID parameters
$t_id = $_GET['t_id'];

// If the ID does not exist, an error will be reported
if (!$t_id) {
    die("ID does not exist");
}

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Acess denied:" . $conn->connect_error);
}

// Load specified data table
$table_name = "msgdata";

// Prepare SQL statements
$sql = "DELETE FROM $table_name WHERE id=('$t_id')";

// Perform database operations
if (mysqli_query($conn, $sql)) {
    header("Refresh:0,Url=admin.html");
} else {
    echo "Failed to delete message,'" . mysqli_error($conn) . "' page will return in two seconds";
}

// Close database connection
$conn->close();
