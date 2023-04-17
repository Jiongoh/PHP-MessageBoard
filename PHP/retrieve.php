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
$table_name = "usermsg";

// Get POST parameters
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $t_account = $_POST["t_account"];
    $t_password = $_POST["t_password"];

    // Update account and password
    $sql = "UPDATE $table_name SET t_password='$t_password' WHERE t_account='$t_account'";

    // Execute SQL statements
    if (mysqli_query($conn, $sql)) {
        if ($conn->affected_rows > 0) {
            echo "The password has been updated, the page will jump to the login page in two seconds";
            // Clear cookies
            setcookie('user', 'clear', time() - 3600 * 24 * 7, "/");
            header("Refresh:2,Url=login.html");
        } else {
            echo "The specified user was not found,the page will jump to the retrieve page in two seconds";
            header("Refresh:2,Url=retrieve.html");
        }
    } else {
        echo "An error occurred while updating the password,the page will jump to the login page in two seconds";
        header("Refresh:2,Url=login.html");
    }
}
