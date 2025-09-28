<?php
include("config.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Prevent SQL injection

    $sql = "DELETE FROM users WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?msg=User deleted successfully");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit();
}
?>