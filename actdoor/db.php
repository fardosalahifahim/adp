<?php
$servername = "localhost";
$username = "root";
$password = "Fahim"; // Updated password
$dbname = "actdoor_db";
$port = 3307; // Updated port

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
