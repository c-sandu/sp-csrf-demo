<?php
  // include('session.php');
   ini_set('display_errors', 'On');
   error_reporting(E_ALL | E_STRICT);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Home</title>
</head>
<style>
.tab { margin-left: 40px; }
</style>
<body>
  <h1>Session timeout</h1>
  <p class="tab">Your session has expired! <a href='log_in.php'>Login here</a></p>

</body>
</html>
