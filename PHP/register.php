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
    $result=$conn->query($sql);

    if($result->num_rows>0){
        // Duplicate account name
        echo "This account already exists. Please enter the correct account password on the login page and log in, or try registering with a different account.the page will jump to the register page in five seconds ";
        header("Refresh:5,Url=register.html");
    }
    else{
        // Write the account and password into the database
        $sql="INSERT INTO $table_name (t_account,t_password) VALUES ('$t_account','$t_password')";
        if(mysqli_query($conn,$sql)){
            // Register succeeded
            echo "Register succeeded,the page will jump to the login page in two seconds";
            header("Refresh:2,Url=login.html");
        }else{
            // Register Failed
            echo "Register Failed";
        }
    }
}

// Close database connection
$conn->close();
?>