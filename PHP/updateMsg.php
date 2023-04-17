<?php
// Database connection parameters
$servername = "";
$username = "";
$password = "";
$dbname = "";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Acess denied:" . $conn->connect_error);
}

// Load specified data table
$table_name = "msgdata";

// Get POST parameters
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $t_id = $_POST["t_id"];
    $t_name = $_POST["t_name"];
    $t_email = $_POST["t_email"];
    $t_message = $_POST["t_message"];

    // update the data into the database
    $sql = "UPDATE $table_name SET t_name=('$t_name'),t_email=('$t_email'),t_message=('$t_message') WHERE id=$t_id";

    if (mysqli_query($conn, $sql)) {
        // update succeeded 
        header("Refresh:0,Url=admin.html");
    } else {
        // Message Failed
        echo "Update Failed,please try again.The page will refresh in two seconds";
        header("Refresh:2,Url=admin.html");
    }
}

// Close database connection
$conn->close();
