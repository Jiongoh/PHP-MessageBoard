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
$sql = "SELECT t_name,t_email,t_message FROM $table_name WHERE id=('$t_id')";

// Perform database operations
$result = mysqli_query($conn, $sql);

// Determine if the result is empty
if (mysqli_num_rows($result) > 0) {
    // Output results in JSON format
    $row = mysqli_fetch_assoc($result);
    $data = array(
        't_id' => $t_id,
        't_name' => $row['t_name'],
        't_email' => $row['t_email'],
        't_message' => $row['t_message']
    );
    $json_data = json_encode($data);
    echo $json_data;
    // header("Refresh:0,Url=admin.html");
} else {
    // Output error message
    echo "No records";
    header("Refresh:0,Url=admin.html");
}


// Close database connection
$conn->close();
