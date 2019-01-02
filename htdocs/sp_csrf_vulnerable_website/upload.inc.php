<?php
  include('session.php');
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);


  if (isset($_POST['submit'])) {
    include_once "db_connect.php";

    $path = mysqli_real_escape_string($conn, $_POST['path']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $username = $_SESSION['login_user'];
    $currentDate = date("y-m-d H:i:s",time());//an-luna-zi
    $likes = 0;

    //error handlers
    //check empty fields
    if (empty($path)) {
      header("Location: ../index.php?signup=empty");
      exit();
    } else {
      //check if input characters are valid
      /*
      if (!preg_match("/^[a-zA-Z]*$/", $description)) {
        header("Location: ../index.php?signup=invalid");
        exit();
      } else {
      */
      $sql_id = "SELECT userId FROM users WHERE username='$username'";
      $result = $conn->query($sql_id);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row["userId"];

        $stmt = $conn->prepare("INSERT INTO posts (userId, path, description, date, likes_no) VALUES (?, ?, ?, ?, ?)");
                  //var_dump($conn);

        $stmt->bind_param("ssssi", $userId, $path, $description, $currentDate, $likes);
        $stmt->execute();
        $stmt->close();
                  $conn->close();

        header("Location: index.php");
        exit();
      } else {
        echo "SQL query failed";
        exit();
      }
    }
  } else {
    header("Location: ../index.php");
    exit();
  }
?>