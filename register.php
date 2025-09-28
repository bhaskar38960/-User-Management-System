<?php include("config.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Register New User</h2>
    <form action="" method="POST">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <input type="submit" name="register" value="Register">
    </form>
    <br>
    <a href="index.php"><button>Back to User List</button></a>
</div>
</body>
</html>

<?php
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id = 1;

    $sql = "INSERT INTO users (username, email, password, role_id) VALUES ('$username', '$email', '$password', $role_id)";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User Registered Successfully!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>