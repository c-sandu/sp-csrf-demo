<?php
  include('db_connect.php');
  session_start();
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
  if(!isset($_SESSION['login_user'])){

    session_destroy();
    header("location: log_in.php");
  } else {
    $user_check = $_SESSION['login_user'];

    $ses_sql = mysqli_query($conn,"select username from users where username = '$user_check' ");

    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

    $login_session = $row['username'];


    $now = time(); // Checking the time now when home page starts.
    if ($now > $_SESSION['expire']) {
        session_destroy();
        //echo "Your session has expired! <a href='http://localhost/somefolder/login.php'>Login here</a>";
        header("location: error_page_sess_timeout.php");
    }
  }
?>
