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

    // Query whether the specified user exists in the database
    $sql = "SELECT * FROM $table_name WHERE t_account='$t_account' AND t_password='$t_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Detect whether the account password is admin
        if ($t_account == "admin" && $t_password == "admin") {
            // Login with administrator account
            echo "Login with administrator account,the page will jump to the admin page in two seconds";
            // Send a 7-day cookie
            setcookie('user', 'admin', time() + 3600 * 24 * 7, "/");
            header("Refresh:2,Url=admin.html");
        } else {
            // Normal user successfully logged in
            echo "Login Succeeded,the page will jump to the home page in two seconds";
            // Send a 7-day cookie
            setcookie('user', 'normal', time() + 3600 * 24 * 7, "/");
            header("Refresh:2,Url=homepage.html");
        }
    } else {
        // Login failed
        echo "User name or password error,the page will jump to the login page in two seconds";
        header("Refresh:2,Url=login.html");
    }
}

// Close database connection
$conn->close();
