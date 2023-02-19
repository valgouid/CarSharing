<?php
$user_id = $_SESSION['user_id'];

//get username and email
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if($count == 1){
    $row = mysqli_fetch_array($result, MYSQL_ASSOC);
    $username = $row['username'];
    $picture = $row['profilepicture'];
}else{
    echo "There was an error retrieving the username and email from the database";
}
?>

<nav role="navigation" class="navbar navbar-custom navbar-fixed-top">

  <div class="container-fluid">

      <div class="navbar-header">


          <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>

          </button>
      </div>
      <div class="navbar-collapse collapse" id="navbarCollapse">
          <ul class="nav navbar-nav">
              <li class="active"><a href="index.php">Car Sharing</a></li>
            <li class="active"><a href="contact.php">Contact us</a></li>
            <li><a href="mainpageloggedin.php">My Trips</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="index.php">
                    <?php
                        if(empty($picture)){
                            echo "<div class='image_preview'><img class='previewing2' src='noimage.png' /></div>";
                        }else{
                            echo "<div class='image_preview'><img class='previewing2' src='$picture' /></div>";
                        }

                      ?>
                  </a>
              </li>
              <li><b><?php echo $username?></b></a></li>
            <li><a href="index.php?logout=1">Log out</a></li>
          </ul>

      </div>
  </div>

</nav>
