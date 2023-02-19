<?php
session_start();
include('connection.php');

//logout
include('logout.php');

//remember me
include('remember.php');
if ($_SERVER['REQUEST_METHOD'] === "POST") {
	if (empty($_POST['email'])) {
		$emailError = 'Email is empty';
	} else {
		$email = $_POST['email'];

		// validating the email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailError = 'Invalid email';
		}
	}
	if (empty($_POST['message'])) {
		$messageError = 'Message is empty';
	} else {
		$message = $_POST['message'];
	}
	if (empty($emailError) && empty($messageError)) {
		$date = date("l jS \of F Y h:i:s A");

		$emailBody = "
			<html>
			<head>
				<title>$email is contacting you</title>
			</head>
			<body style=\"background-color:#fafafa;\">
				<div style=\"padding:20px;\">
					Date: <span style=\"color:#888\">$date</span>
					<br>
					Email: <span style=\"color:#888\">$email</span>
					<br>
					Message: <div style=\"color:#888\">$message</div>
				</div>
			</body>
			</html>
		";

		$headers = 	'From: Contact Form <gouidisv@gmail.com>' . "\r\n" .
    				"Reply-To: $email" . "\r\n" .
    				"MIME-Version: 1.0\r\n" .
					"Content-Type: text/html; charset=iso-8859-1\r\n";

		$to = 'valgouidgaming@hotmail.com';
		$subject = 'Contacting you';

		if (mail($to, $subject, $emailBody, $headers)) {
			$sent = true;
		}
	}
}
?>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Sharing Website</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="styling.css" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/sunny/jquery-ui.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
      <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyA3asd83RLLYcr-7Z1IJ7M_W7f15YEp7s0&libraries=places"></script>
	<style type="text/css">
  .footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: gray;
   color: #363636;
   text-align: center;
 }

 .row {
    margin: 100px 0px; padding:0px;
    color: #FFFFFF;
    align:center;

 }
   #container{
       margin-top:120px;
   }

   #notePad, #allNotes, #done, .delete{
       display: none;
   }

   textarea{
       width: 100%;
       max-width: 100%;
       font-size: 16px;
       line-height: 1.5em;
       border-left-width: 20px;
       border-color: #CA3DD9;
       color: #CA3DD9;
       background-color: #FBEFFF;
       padding: 10px;

   }

   .noteheader{
       border: 1px solid grey;
       border-radius: 10px;
       margin-bottom: 10px;
       cursor: pointer;
       padding: 0 10px;
       background: linear-gradient(#FFFFFF,#ECEAE7);
   }

   .text{
       font-size: 20px;
       overflow: hidden;
       white-space: nowrap;
       text-overflow: ellipsis;
   }

   .timetext{
       overflow: hidden;
       white-space: nowrap;
       text-overflow: ellipsis;
   }
   .notes{
       margin-bottom: 100px;
   }

   #googleMap{
       width: 300px;
       height: 200px;
       margin: 30px auto;
   }
   .modal{
       z-index: 20;
   }
   .modal-backdrop{
       z-index: 10;
   }
   #spinner{
     display: none;
     position: fixed;
     top: 0;
     left: 0;
     bottom: 0;
     right: 0;
     height: 85px;
     text-align: center;
     margin: auto;
     z-index: 1100;
 }
   .checkbox{
       margin-bottom: 10px;
   }
   .trip{
       border:1px solid grey;
       border-radius: 10px;
       margin-bottom:10px;
       background: linear-gradient(#ECE9E6, #FFFFFF);
       padding: 10px;
   }
   .price{
       font-size:1.5em;
   }
   .departure, .destination{
       font-size:1.5em;
   }
   .perseat{
       font-size:0.5em;
 /*        text-align:right;*/
   }
   .time{
       margin-top:10px;
   }
   .notrips{
       text-align:center;
   }
   .trips{
       margin-top: 20px;
   }
   .previewing2{
       margin: auto;
       height: 20px;
       border-radius: 50%;
   }
     #mytrips{
       margin-bottom: 100px;
     }
.message {

	margin-top: 450px;
	margin-left: 400px;
}
.submit{
	width: 30%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 15px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
	float: right;
}

	</style>

</head>
<body>
  <!--form-->
        <div class="container">
    <div class="row">
            <form method="POST" class="col-md-6 col-md-offset-3" role="form">
              <h2 class="form-group">Contact Us</h2>
        <div class="form-group">
          <label for="exampleInputEmail1">Name *</label>
          <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter your name" required="">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email Address *</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your Email" required="">
        </div>
        <div class="form-group">
        <label for="exampleInputEmail1">Message *</label>
        <textarea class="form-control" name="message" rows="3" placeholder="Enter Your Message"></textarea>
        <button type="submit" class="submit">Submit</button>
      </form>
    </div>

        <!--Navigation Bar-->
        <?php
        if(isset($_SESSION["user_id"])){
            include("navigationbarconnected.php");
        }else{
            include("navigationbarnotconnected.php");
        }
        ?>





<?php if (isset($emailError) || isset($messageError)) : ?>
	<div class="message" id="error-message">
		<?php
			echo isset($emailError) ? $emailError . '<br>' : '';
			echo isset($messageError) ? $messageError . '<br>' : '';
		?>
	</div>
<?php endif; ?>


<?php if (isset($sent) && $sent === true) : ?>
	<div class="message" id="done-message">
		Your message was succesfully submitted
	</div>
<?php endif; ?>
<!-- Footer-->
	<div class="footer">
			<div class="container">
					<p>Chrysovalantis-Savvas Gouidis Copyright &copy; 2020-<?php $today = date("Y"); echo $today?>.</p>
			</div>
	</div>
	<!--Spinner-->
	<div id="spinner">
		 <img src='ajax-loader.gif' width="20" height="20" />
		 <br>Loading..
	</div>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="map.js"></script>
<script src="javascript.js"></script>

</body>
</html>
