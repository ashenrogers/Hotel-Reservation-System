<?php
$servername = "localhost"; // XAMPP's default server
$username = "root";        // Default username for XAMPP
$password = "";            // No password for XAMPP by default
$dbname = "hotel_reservation"; // Name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
