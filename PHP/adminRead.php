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

// Extract content from a data table
$sql = "SELECT id,t_name,t_email,t_message FROM $table_name";
$result = mysqli_query($conn, $sql);

// counter variable
$count = 0;

// Output data for each row
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    // Traversal result set
    foreach ($row as $key => $value) {
        echo '<td>' . htmlspecialchars($value) . '</td>';
        // If it is the last column, end the current row and start outputting a new row
        if ($key === "t_message") {
            $count++;
            echo '<td><a href="deleteMsg.php?t_id=' . $row['id'] . '">Delete</a><a href="modifyMsg.php?t_id=' . $row['id'] . '">Modify</a></td>';
            // If the counter can be divided by 4, output the table code that ends the current row and starts a new row
            if ($count % 4 == 0) {
                echo '</tr><tr>';
            }
        }
    }
    echo '</tr>';
}

// Close database connection
$conn->close();
