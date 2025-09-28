<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $user_id = $_SESSION['user_id'];

    // File upload
    if (!empty($_FILES['profile_pic']['name'])) {
        $fileName = $_FILES['profile_pic']['name'];
        $fileTmp = $_FILES['profile_pic']['tmp_name'];
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowed = ['jpg','jpeg','png'];

        if (in_array(strtolower($fileType), $allowed)) {
            $newName = "uploads/" . time() . "_" . $fileName;
            move_uploaded_file($fileTmp, $newName);

            $stmt = $conn->prepare("UPDATE users SET username=?, profile_pic=? WHERE id=?");
            $stmt->bind_param("ssi", $username, $newName, $user_id);
        } else {
            echo "Invalid file type!";
        }
    } else {
        $stmt = $conn->prepare("UPDATE users SET username=? WHERE id=?");
        $stmt->bind_param("si", $username, $user_id);
    }

    if ($stmt->execute()) {
        echo "Profile updated!";
    } else {
        echo "Error updating profile!";
    }
}
?>

<form method="post" enctype="multipart/form-data">
  Username: <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>"><br>
  Profile Picture: <input type="file" name="profile_pic"><br>
  <button type="submit">Update Profile</button>
</form>