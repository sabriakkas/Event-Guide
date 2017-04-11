<?php
session_start();
ob_start();
ob_flush();
require 'functions/functions.php';
require 'functions/functions.user.php';
if (session_control(get_session("username"), get_session("userpass"))) {
    go("User");
}

if (isset($_POST["login"])) {
    
    $username = $_POST["username"];
    $userpass = $_POST["userpass"];
    
    if (login($username, $userpass)) {
        go("User");
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <title>Event Guide</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Event Guide">
    <meta name="author" content="SabriAkkas,SezerKarakaya">
    <meta name="keyword" content=""><!--ADD KEYWORDS -->
    <link rel="shortcut icon" href="img/shortcut.png"><!--SHORTCUT ICON -->   
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
</head>
  <body class="login-img3-body">
    <div class="container"> 
      <form class="login-form" action="" method="post">        
        <div class="login-wrap">
        <div style="">         
        </div>
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control"name="userpass" placeholder="Password">
            </div>
            <label class="checkbox">
               <span class="pull-left"> <a href="signup.php">Sign Up</a></span>
                <span class="pull-right"> <a href="forgot.php"> Forgot Password?</a></span>
            </label>
            <label >                             
            </label>                     
            <button class="btn btn-primary btn-lg btn-block" name="login"  type="submit">Login</button> 
        </div>
      </form>
    </div>
  </body>
</html>
