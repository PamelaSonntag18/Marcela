<?php
$servername = "localhost";
$username = "pamela";
$password = "pamela";
$dbname = "Livraria";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
