<?php
// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "tertibega_coffee");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>
