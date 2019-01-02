<?php
include('session.php');
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);


if (isset($_POST['submit'])) {
  include_once "db_connect.php";

  $email = mysqli_real_escape_string($conn, $_POST['change_email']);
  $username = $_SESSION['login_user'];

  //error handlers
  //check empty fields
  if (empty($email)) {
    header("Location: ../index.php?signup=empty");
    exit();
  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../index.php?signup=email");
      exit();
    } else {
      $sql_id = "SELECT userId FROM users WHERE username='$username'";
      $result = $conn->query($sql_id);
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['userId'];
        //$email_addr = $row["username"];

        $stmt = $conn->prepare("UPDATE users SET email=? WHERE userId =?");

        $stmt->bind_param("ss", $email, $user_id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header("Location: index.php");
        exit();
      } else {
        echo "Invalid query return";//redirect catre error page (invalid sql query)
        exit();
      }
    }
  }
} else {
  header("Location: ../index.php");
  exit();
}
