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
    $t_name = $_POST["t_name"];
    $t_email = $_POST["t_email"];
    $t_message = $_POST["t_message"];

    // Write the data into the database
    $sql = "INSERT INTO $table_name (t_name,t_email,t_message) VALUES ('$t_name','$t_email','$t_message')";

    if(mysqli_query($conn,$sql)){
        // Message succeeded 
        header("Refresh:0,Url=homepage.html");
    }else{
        // Message Failed
        echo "Message Failed,please try again.The page will refresh in two seconds";
        header("Refresh:2,Url=homepage.html");
    }
}

// Close database connection
$conn->close();
