<?php
//Include GP config file && User class
include_once 'gpConfig.php';
include_once 'User.php';

if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();
	
	//Initialize User class
	$user = new User();
	
	//Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'link'          => $gpUserProfile['link']
    );
    $userData = $user->checkUser($gpUserData);
	
	//Storing user data into session
	$_SESSION['userData'] = $userData;
	
	//Render facebook profile data
    if(!empty($userData)){
        //header('Location: http://srv1.cinedia.net/gd.php?oathID='.$userData['oauth_uid'].'&userN='.$userData['first_name'].'&usrL='.$userData['last_name'].'&locale='.$userData['locale']);
        $output = '<h1>Google+ Profile Details </h1>';
        $output .= '<img src="'.$userData['picture'].'" width="300" height="220">';
        $output .= '<br/>Google ID : ' . $userData['oauth_uid'];
        $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
        $output .= '<br/>Email : ' . $userData['email'];
        $output .= '<br/>Gender : ' . $userData['gender'];
        $output .= '<br/>Locale : ' . $userData['locale'];
        $output .= '<br/>Logged in with : Google';
        $output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Google+ Page</a>';
        $output .= '<br/>Logout from <a href="logout.php">Google</a>'; 
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
	$authUrl = $gClient->createAuthUrl();
	$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';
}

?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Api Login Page</title>
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
            

            <h1 class="text-center">API LOGIN</h1>
            <div class="form-header">
                <i class="fa fa-user"></i>
            </div>

            <form id="login-form" method="post" class="form-signin" role="form" action="#" > 
               <?
               
               if(empty($userData)){ ?> <a style="margin-bottom: 17px" class="btn btn-default google" href="<?php $authUrl = $gClient->createAuthUrl(); echo filter_var($authUrl, FILTER_SANITIZE_URL);?>"> <i class="fa fa-google modal-icons"></i> Sign In with Google </a>
               <?}
                
                else { ?> 
                        <? echo "<br>Please copy this AuthID and paste while you are starting the REST API <br> Your AuthID:<b> ".$aID ."</b><br>"; ?>
                        <a style="margin-bottom: 17px; margin-top: 17px; margin-left: 10%;" class="btn btn-default google text-center" href="logout.php"> <i class="fa fa-google modal-icons"></i> Sign Out </a>
                    <?}

                ?>
             
            </form>
            <div class="form-footer">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <i class="fa fa-lock"></i>
                        <a href="https://accounts.google.com/signin/usernamerecovery"> Forgot password? </a>
                    
                    </div>
                    
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <i class="fa fa-check"></i>
                        <a href="https://accounts.google.com/SignUp"> Sign Up </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /container -->
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/login.js"></script>
  </body>
</html>



