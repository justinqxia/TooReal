<?php
require 'backend/dbh.php';

// File Upload Handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['imageFile'])) {
    // check the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE uidUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo json_encode(["success" => false, "error" => "SQL error"]);
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['pwdUsers']);
        if ($pwdCheck == false) {
          echo json_encode(["success" => false, "error" => "Wrong password"]);
          exit();
        }
      } else {
        echo json_encode(["success" => false, "error" => "No user found"]);
        exit();
      }
    }


    $file = $_FILES['imageFile'];
    // check file size
    if ($file['size'] > 10000000) {
      echo json_encode(["success" => false, "error" => "File too large"]);
      exit();
    }
    // check file type
    $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if ($fileType !== 'jpg' && $fileType !== 'png' && $fileType !== 'jpeg') {
      echo json_encode(["success" => false, "error" => "Invalid file type"]);
      exit();
    }
    $uploadDir = 'uploads/';
    $uploadPath = $uploadDir . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
      $sql = "INSERT INTO images (filepath, userid) VALUES ('" . $uploadPath . "', " . $row['idUsers'] . ")";

      if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true]);
      } else {
        echo json_encode(["success" => false, "error" => $conn->error]);
      }
    } else {
      echo json_encode(["success" => false, "error" => "Could not upload file"]);
    }
  } else {
    echo json_encode(["success" => false, "error" => "No file uploaded"]);
  }
}

$conn->close();
?>