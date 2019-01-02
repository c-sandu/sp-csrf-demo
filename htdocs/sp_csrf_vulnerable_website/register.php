<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Documentatie</title>

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css_stylesheet_global.css">

<script type="text/javascript">
  function checkLength(el) {
    var node = document.getElementById("number_error");
    var node2 = document.getElementById("myimg");

    if (el.value.length != 10) {
      node.classList.add("show");
      node2.classList.remove("check_mark_show")
    }
    if(el.value.length == 10){
      node.classList.remove("show");
      node2.classList.add("check_mark_show")
    }
  }
  function checkLength_first(el) {
    var node = document.getElementById("number_error2");
    var node2 = document.getElementById("myimg2");

    if(el.value.length == 0){
      node.classList.add("show");
       node2.classList.remove("check_mark_show");
    }
    if(el.value.length != 0){
      node.classList.remove("show");
      node2.classList.add("check_mark_show");
    }
  }
</script>
<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
</head>

<body>
<?php
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
?>
<div class = "container">
  <div class="row">
    <div class = "col-sm-3">
    </div>
    <div class = "col-sm-6">
      <div class="jumbotron">
        <form method="POST" action="signup.inc.php">
          <div class="Fonts">Name<br></div>
          <div class="casute_name">
            <input onblur="checkLength_first(this)" type="text" name="firstname" placeholder="First" size="15">
            &nbsp;
            <input onblur="checkLength_last(this)" type="text" name="lastname" placeholder="Last" size="15">
            <img src="green_check_mark_2.png" class="green_check" id="myimg2">
              <div class="number_error2" id="number_error2">You can't leave this empty!</div>
          </div>
          <br>
          <div class="Fonts">Username<br></div>
          <div class="casute_name">
            <input type="text" name="username" placeholder="Used for logging in" size="40">
          </div>

          <br>
          <div class="Fonts">Email<br></div>
          <div class="casute_name">
            <input type="text" name="email" placeholder="example@example.com" size="40">
          </div>

          <br>
          <div class="Fonts">Password<br></div>
          <div class="casute_name">
            <input type="password" name="password" size="40" required>
          </div>

          <br>
          <div class="Fonts">Confirm your password<br></div>
          <div class="casute_name">
            <input type="password" name="password2" size="40" required>
          </div>

          <br>
          <button type="submit" name="submit" id="submit_button">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
