<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
echo "Welcome, " . $_SESSION['username'];

if ($_SESSION['role_id'] == 1) {
    echo " | You are an Admin.";
} else {
    echo " | You are a User.";
}
?>

<a href="edit_profile.php">Edit Profile</a> | 
<a href="logout.php">Logout</a>