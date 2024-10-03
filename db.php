<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "beasiswa_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek apabila gagal
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>