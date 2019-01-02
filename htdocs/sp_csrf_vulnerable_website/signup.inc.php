<?php

if (isset($_POST['submit'])) {
  include_once "db_connect.php";

  $first = mysqli_real_escape_string($conn, $_POST['firstname']);
  $last = mysqli_real_escape_string($conn, $_POST['lastname']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $pwd = mysqli_real_escape_string($conn, $_POST['password']);
  $pwd_confirm = mysqli_real_escape_string($conn, $_POST['password2']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  //error handlers
  //check 4 empty fields
  if (empty($first) || empty($last) || empty($username) || empty($pwd) || empty($pwd_confirm) || empty($email)) {
    header("Location: ../index.php?signup=empty");
    echo("Variables not here?");
    exit();
  } else {
    //check if input characters are valid
    if (!preg_match("/^[a-zA-Z ]*$/", $first) || !preg_match("/^[a-zA-Z ]*$/", $last) || (preg_match("/^[a-zA-Z0-9_\s]*$/", $pwd) != preg_match("/^[a-zA-Z0-9_\s]*$/", $pwd_confirm)) || !preg_match("/^[a-zA-Z0-9_]*$/", $username)) {
      header("Location: ../index.php?signup=invalid");
      exit();
    } else {
      //check if email is valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?signup=email");
        //echo "Invalid email";
        exit("Invalid email");
      } else {
        $sql = "SELECT * FROM users WHERE firstname='$first'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
          header("Location: ../index.php?signup=usertaken");
          exit();
        } else {
          //hashing the pwd
          $hashedPwd = hash('sha256', $pwd);
          //insert user into db
          $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, username, password) VALUES (?, ?, ?, ?, ?)");

          $stmt->bind_param("sssss", $first, $last, $email, $username, $hashedPwd);
          $stmt->execute();
          //echo "New records created successfully";
          $stmt->close();
          $conn->close();
          header("Location: log_in.php");
          exit();
        }
      }
    }
  }

} else {
  header("Location: ../index.php");
  exit();
}
