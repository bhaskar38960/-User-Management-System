<?php
$host = "localhost";  // your host name
$user = "root";       // default XAMPP MySQL username
$pass = "";           // default password is empty in XAMPP
$db   = "user_management"; // your database name

// Correct way to connect
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>