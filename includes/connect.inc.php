<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "artifymember";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die('<div class="alert alert-warning mt-3" role="alert"><h4>Connection failed:</h4> ' . $conn->connect_error . '</div>');
}
?>