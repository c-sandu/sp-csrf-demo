<?php
  include("db_connect.php");
  session_start();
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $myusername = mysqli_real_escape_string($conn,$_POST['username']);
    $mypassword = mysqli_real_escape_string($conn,$_POST['password']);
    $hashedPassword = hash('sha256', $mypassword);

    $sql = "SELECT * FROM users WHERE username = '$myusername' and password = '$hashedPassword'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($resultCheck == 1) {

      $_SESSION['login_user'] = $myusername;
      $_SESSION['start'] = time(); // Taking now logged in time.
      // Ending a session in 30 minutes from the starting time.
      $_SESSION['expire'] = $_SESSION['start'] + (30*60);

      header("location: index.php");
    } else {
      echo '<p style="color:red;">Invalid username or password</p>';
      //$error = "Your Login Name or Password is invalid";
    }
  }
?>
<html>

<head>
  <title>Login Page</title>

  <style type = "text/css">
     body {
        font-family:Arial, Helvetica, sans-serif;
        font-size:14px;
     }
     label {
        font-weight:bold;
        width:100px;
        font-size:14px;
     }
     .box {
        border:#666666 solid 1px;
     }
     a{
        text-decoration: none!important;


      }
  </style>
</head>

<body bgcolor = "#FFFFFF">

  <div align = "center">
    <div style = "width:300px; border: solid 1px #333333; " align = "left">
      <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
        <div style = "margin:30px">
          <form action = "" method = "post">
            <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
            <label>Password  :</label><br><input type = "password" name = "password" class = "box" /><br/><br />
            <input type = "submit" value = " Login "/><br />
          </form>
          <button><a href="register.php">Sign Up</button><br><button>Forgot password</button>
          <!--<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>-->
        </div>
     </div>
  </div>

</body>
</html>
