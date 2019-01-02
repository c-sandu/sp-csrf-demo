<?php
   include('session.php');

   ini_set('display_errors', 'On');
   error_reporting(E_ALL | E_STRICT);
?>
<!doctype html>
<html>
<head>
<script src="cookies.js"></script>

<meta charset="utf-8">
<title>Home</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css_stylesheet_global.css">
</head>

<style>
  table { table-layout: fixed; }
  .box {
    width: 300px;
    border: 1px solid rgb(231,230,214);
    border-radius: 7px;
    padding: 10px;
    margin: 5px;
  }
 .a1{
    text-decoration: none!important;
    font-size: 17px;
    color: #C4BFB4;
  }
 .a1:hover{
    color: rgb(58,64,67);
  }

  .a2{
     text-decoration: none!important;
     font-size: 12px;
     color: #C4BFB4;
   }
   .a2:hover{
     color: rgb(58,64,67);
   }
   .jumbotron{
     width: 920px;
     background-color: #E8E9EE;
   }

</style>


<body>
<?php
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
?>

<div style="color:rgb(231,230,214);background-color:rgb(232,76,60);text-align:center;padding:50px 80px;text-align: justify;">
  <div class="container">
  <div class="row">
    <div class="col-sm-4">
      <p><b>Welcome to bit Upload !</b></p>
      <p>Share your images with others and let them know what you think!</p>
      <p>Or insert logo here.</p>
    </div>
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
      <div class = "box">
        <p><?php echo $_SESSION['login_user'];?></p>
        <p class="small">likesNumber<br>postsNumber</p>
        <table>
          <tr>
            <th width="146" scope="col"><a href="acc_settings.php" class="a2">Account Settings</a></th>
            <th width="146" scope="col"><a href="Log_out.php" class="a2">Log out</a></th>
          </tr>
        </table>
      </div>
    </div>
  </div>
  </div>
</div>

<center>
  <table>
    <tr>
      <th width="146" height="76" scope="col"><a href="upload.php" class="a1">Upload</a></th>
      <th width="162" scope="col"><a href="index.php" class="a1">NewsFeed</a></th>
      <th width="146" scope="col"><a href="" class="a1">About</a></th>
      <th width="146" scope="col"><a href="" class="a1">Search</a></th>
      <th width="146" scope="col"><a href="" class="a1">Help</a></th>
    </tr>
  </table>
</center>

<div class = "container">
  <?php
    include("db_connect.php");
    $sql = "SELECT * FROM posts ORDER BY date desc";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = mysqli_fetch_array($result)) {
        $current_uid = $row['userId'];
        $sql2 = "SELECT firstname,lastname FROM users WHERE userId = '$current_uid'";
        $result2 = $conn->query($sql2);
        if($result2->num_rows > 0) {
          $row2 = $result2->fetch_assoc();
          $user_fname = $row2["firstname"];
          $user_lname = $row2["lastname"];
          $intcounter = $row['likes_no'];
          $date = $row['date'];
          $descript = $row['description'];
          echo '<div class="jumbotron">';
          echo '<div class="row">';
          echo '<div class="col-sm-7">';
          echo '<p>'.$user_fname.' '.$user_lname.'<br>'.$date.'</p>';
          echo '<p>'.$descript.'</p>';
          echo '<img src='.$row['path'].' width="800" height="550">';
          //echo '<img src="https://svgsilh.com/svg/1289418.svg" width="50" height="50">'.' '.$intcounter;
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
      }
    }
  ?>
				<!--if ($result->num_rows > 0) {
          while($row = mysqli_fetch_array($result)) {-->

            <!--  <tr>
                  <td><//?php echo $row['Id']?></td>
                  <td><//?php echo $row['Name']?></td>
              </tr>-->

</div>

</body>
</html>
