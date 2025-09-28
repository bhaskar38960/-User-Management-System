<?php
session_start();
include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password, role_id FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $hashed_pass, $role_id);
    $stmt->fetch();

    if (password_verify($password, $hashed_pass)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['role_id'] = $role_id;
        header("Location: dashboard.php");
    } else {
        echo "Invalid login!";
    }
}
?>

<form method="post">
  Email: <input type="email" name="email" required><br>
  Password: <input type="password" name="password" required><br>
  <button type="submit">Login</button>
</form>