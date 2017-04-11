<?php
session_start();
ob_start();
ob_flush();
require 'functions/functions.php';
if (isset($_GET["id"])) {
    $id      = $_GET["id"];
    $request = request("select * from events where id='$id'");
    $array   = get_array($request);
    
} else {
    go("404.php");
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
    <title>Event Guide</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Event Guide">
    <meta name="author" content="SabriAkkas,SezerKarakaya">
    <meta name="keyword" content="">
    <!--ADD KEYWORDS -->
    <link rel="shortcut icon" href="img/shortcut.png">
    <!--SHORTCUT ICON -->
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
    <link href="css/style-event.css" rel="stylesheet" />
</head>

<body>
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
                    <a class="btn btn-primary" href="login.php" title="Bootstrap 3 themes generator">Login</a>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <!-- notificatoin dropdown end-->
        </div>
    </header>
    <!-- container section start -->
    <section id="container" class="">
        <br>
        <br>
        <br>
        <br>
        <br>
        <!--Events-->
        <div class="event">
            <img src="<?php echo $array[ 'picture'] ?>" class="eventPicture" />
            <div class="eventName">
                <?php echo $array[ 'name']?>
            </div>
            <div class="eventDescription">
                <?php echo $array[ 'description']?>
            </div>
            <br>
            <div class="row" align="center" style="font-size:20px; color:#34AADC">
                <div class="col-lg-4">
                    <i class="icon_book_alt"></i>&nbsp;&nbsp;Type
                </div>
                <div class="col-lg-4">
                    <i class="icon_clock_alt"></i>&nbsp;&nbsp;Date
                </div>
                <div class="col-lg-4">
                    <i class="icon_mail_alt"></i>&nbsp;&nbsp;Contact
                </div>
            </div>
            <br>
            <div class="row" align="center" style="font-size:20px; color:#A7A7A7">
                <div class="col-lg-4">
                    <?php echo $array[ 'type']?>
                </div>
                <div class="col-lg-4">
                    <?php echo $array[ 'date']?>
                </div>
                <div class="col-lg-4">
                    <?php echo $array[ 'contact']?>
                </div>
            </div>
            <div class="eventJoiners">
                <?php echo 'Event limited with '.$array[ 'quoata']. ' person.' ?>
                <?php echo 'Total joiners :'.$array['joiners'] ?>
            </div>
            <div class="map">
                <?php echo '<iframe src="'.$array[ 'location']. '" width="950" height="750" frameborder="0" style="border:0"></iframe>' ?>
            </div>
        </div>
    </section>
</body>
<!-- javascripts -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- nice scroll -->
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<!--custome script for all page-->
<script src="js/scripts.js"></script>
</html>
