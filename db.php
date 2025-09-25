<?php
$servername = "localhost";
$username = "root";   // default pentru XAMPP
$password = "";       // gol implicit
$dbname = "student_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
