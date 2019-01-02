<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Upload</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css_stylesheet_global.css">
<style></style>
<script>
function checkLength(el) {
  var node = document.getElementById("number_error2");

  if (el.value.length <= 0) {
    node.classList.add("show");
  }
  if(el.value.length > 0){
     node.classList.remove("show");
  }
}
</script>

<body>
<?php
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
?>
<div class="container">
  <div class="jumbotron">
    <div class="row">
      <div class="col-sm-4">
        <form method="POST" action="upload.inc.php" id="descr">

          <div class="Fonts">Path<br></div>
          <div class="casute_name">
            <input type="text" name="path" placeholder="Enter URL" size="40" required>
          </div>
          <br>
          <button type="submit" name="submit" id="submit_button">Submit</button>
        </form>
      </div>

      <div class="col-sm-1">
      </div>

      <div class="col-sm-4">
        <div class="Fonts">Description<br></div>
        <div class="casute_name">
          <!--<input onblur="checkLength(this)" type="text" name="description" placeholder="Add a description" size="15">-->
          <textarea rows="5" cols="60" name="description" form="descr" placeholder="Enter a description.."></textarea>
          <!--<div class="number_error2" id="number_error2">You can't leave this empty!</div>-->
        </div>
      </div>

    </div>
  </div>

</div>
</body>
</html>
