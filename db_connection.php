<?php
include 'config.php';

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "dorier";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$pdo = new PDO('mysql:host='.$servername.';dbname='.$dbname, $username, $password);
?>