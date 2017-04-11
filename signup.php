<?php
session_start();
ob_start();
ob_flush();
require 'functions/functions.php';
require 'functions/functions.user.php';
if (session_control(get_session("username"), get_session("userpass"))) {
    go("User");
}

if (isset($_POST["signup"])) {
    
    $username = $_POST["username"];
    $question = $_POST["question"];
    $answer   = $_POST["answer"];
    $userpass = $_POST["userpass"];
    $confirm  = $_POST["confirm"];
    $mail     = $_POST["mail"];
    
    if (signup($username, $userpass, $confirm, $mail, $question, $answer)) {
        go("User", 0.1);
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
            <p class="login-img"><i class="icon_lock-open_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key"></i></span>
                <input type="password" class="form-control"name="userpass" placeholder="Password">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key"></i></span>
                <input type="password" class="form-control"name="confirm" placeholder="Password">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_question"></i></span>
                <input type="text" class="form-control"name="question" placeholder="Security Question">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_pencil"></i></span>
                <input type="text" class="form-control"name="answer" placeholder="Answer">
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_mail"></i></span>
              <input type="mail" class="form-control" name="mail" placeholder="E-mail" autofocus>
            </div>                                             
            <button class="btn btn-primary btn-lg btn-block" name="signup"  type="submit">Sign Up</button> 
        </div>
      </form>
    </div>
  </body>
</html>
