<?php
  include('session.php');

  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Account Settings</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css_stylesheet_global.css">
</head>
<body>
<?php if (isset($_POST['form_submitted'])): ?>
  <?php

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
          echo "username=$username";  
          exit();
        }
      }
    }
  ?>
<?php else: ?>
  <div class="container">
    <div class="jumbotron">
      <div class="row">
        <div class="col-sm-4">
          <form method="POST" action="acc_settings.php">

          <div class="Fonts">Change Email<br></div>
          <div class="casute_name">
            <input type="text" name="change_email" placeholder="Enter new email address" size="40" required>
          </div>
          <br>
          <input type="hidden" name="form_submitted" value="1" />
          <input type="submit" value="Submit">
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
</body>
</html>
