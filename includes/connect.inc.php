<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "artifymember";

// Establish connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if there is an error connecting
if ($conn->connect_error) {
    die('<div class="alert alert-warning mt-3" role="alert"><h4>Connection failed:</h4> ' . $conn->connect_error . '</div>');
}
?>