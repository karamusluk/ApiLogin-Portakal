<?php

$servername = "localhost";
$username = "newuser";
$password = "password1!Q";
$dbname = "dgmed";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$listt = array();
$result = $conn->query("SELECT ip FROM client_IP WHERE type='default'");

$listRange = array();
$resultRange = $conn->query("SELECT ip FROM client_IP WHERE type='range'");

$oauth = array();
$oauthResult = $conn->query("SELECT oauth_uid FROM users");



if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
  		$listt[] = $row['ip'];
    }
}

if ($resultRange->num_rows > 0) {

    while($row = $resultRange->fetch_assoc()) {
  		$listRange[] = $row['ip'];
    }
}


if ($oauthResult->num_rows > 0) {

    while($row = $oauthResult->fetch_assoc()) {
  		$oauth[] = $row['oauth_uid'];
    }
}

$err_msg = "";
echo $_SERVER['REMOTE_ADDR'];
//in_array(substr($_SERVER['REMOTE_ADDR'], 0, strrpos($_SERVER['REMOTE_ADDR'], '.')), $listRange)


if (in_array($_SERVER['REMOTE_ADDR'],$listt) || in_array(substr($_SERVER['REMOTE_ADDR'], 0, strrpos($_SERVER['REMOTE_ADDR'], '.')), $listRange)){

    if (in_array($_GET['oathID'],$oauth)){
		  header('Location: http://138.197.138.136:3456');
	  }
	  else{
		  $err_msg = "You haven't registered to System before. You need to Register from <a href='/' style='color:brown'>this</a> link.<br>In case you cannot register pelase contact with Administator.";
	  }   
}

else{

	$err_msg = "Your IP is not allowed to access this System. Contact Administator.";
}



$conn->close();

?>







<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Api Error</title>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="http://demo.smarttutorials.net/twitter/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="http://demo.smarttutorials.net/twitter/css/login.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://demo.smarttutorials.net/twitter/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://demo.smarttutorials.net/twitter/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
              <div class="login-form">
            

            <h1 class="text-center" style="color:red">API ERR </h1>
            <div class="form-header">
                <i class="fa fa-user"></i>
            </div>
            <form id="login-form" method="post" class="form-signin" role="form" action="#" >
            <h2 class="text-center" style="font-size: 15px; margin-bottom: 17px; margin-top: 5px;"><?php echo  $err_msg;?></h2> 
            </form>
        </div>
    </div>
    <!-- /container -->
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/login.js"></script>
  </body>
</html>

