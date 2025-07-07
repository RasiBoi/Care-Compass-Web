<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Default username for WampServer
$password = ""; // Default password is empty
$dbname = "CCH";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
