<?php
session_start();
ob_start();
ob_flush();
require 'functions/functions.php';
require 'functions/functions.user.php';
if (session_control(get_session("username"), get_session("userpass"))) {
    go("User");
}

if (isset($_POST["search"])) {
    $keyword = $_POST["search"];
    go("index.php?search=$keyword");
} else {
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Event Guide">
    <meta name="author" content="SabriAkkas,SezerKarakaya">
    <meta name="keyword" content="">
    <!--ADD KEYWORDS -->
    <link rel="shortcut icon" href="img/shortcut.png">
    <!--SHORTCUT ICON -->
    <title>Welcome To Event Guide</title>
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
    <style>
        #border {
            border-radius: 25px;
            border: 1px solid #BCBCBC;
            margin-bottom: 30px;
            margin: 25px;
            margin-left: 30px;
        }
    </style>
</head>
<body>
    <!-- container section start -->
    <section id="container" class="">
        <!--header start-->
        <header class="header dark-bg">
            <!--logo start-->
            <a href="index.php" class="logo">Event<span class="lite">Guide</span></a>
            <!--logo end-->
            <div class="nav search-row" id="top_menu">
                <!--  search form start -->
                <ul class="nav top-menu">
                    <li>
                        <form class="navbar-form" method="post">
                            <input class="form-control" name="search" placeholder="Search" type="text">
                        </form>
                    </li>
                </ul>
                <!--  search form end -->
            </div>
            <div class="top-nav notification-row">
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">                  
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a class="btn btn-primary" href="login.php" title="Event Guide">Login</a>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
        </header>
        <!--header end-->
        <!--main content start-->
            <section class=" wrapper">
                <div class="row" align="center">
                    <?php 
                        if (isset($_GET[ "search"])) { 
                            $keyword=$_GET[ "search"]; 
                            $list=search_keyword($keyword);
                        }else{ 
                            $list=get_all_events();
                        } 
                        if (get_row_count($list)) { 
                            while($arr=get_array($list)) { ?>
                    <a href="event.php?id=<?php echo $arr['id']; ?>">
                        <div class="col-lg-4" id="border" style="width: 580px">
                            <div class="col-lg-12" style="padding-bottom : 15px">
                                <?PHP echo '<img src="'.$arr[ "picture"]. '" width="100%" height="340px">' ?>
                            </div>
                            <div class="col-lg-12" style="font-size:16px; color:#535353" align="center">
                                <i class="icon_clock_alt"></i> &nbsp;
                                <?PHP echo $arr[ "date"]?>
                            </div>
                            <div class="col-lg-12" style="font-size:22px; color:#000; padding-top:8px" align="center">
                                <?PHP echo $arr[ "name"]?>
                            </div>
                            <div class="col-lg-6" align="center" style="padding-top : 8px; padding-bottom:30px">
                                <i class="icon_pin"></i> &nbsp;
                                <?php echo $arr[ "place"] ?>
                            </div>
                            <div class="col-lg-6" align="center" style="padding-top : 8px;padding-bottom:30px">
                                <i class="icon_tags_alt"></i> &nbsp;
                                <?PHP echo $arr[ "type"]?>
                            </div>
                        </div>
                    </a>
                    <?php 
                        }
                     }else{
                    ?>
                    <h1>No result founded !</h1>
                    <a href="index.php">Return Home Page</a>
                    <?php 
                        } 
                    ?>
                </div>
            </section>
        <!--main content end-->
    </section>
    <!-- container section end -->
    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
</body>
</html>

