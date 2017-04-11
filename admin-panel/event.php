<?php
session_start();
ob_start();
    ob_flush();
require '../functions/functions.php';
require '../functions/functions.admin.php';
//session control starts 

if (!session_control(get_session("username"), get_session("userpass"))) {
    go("login.php");
}
//session control end
if (isset($_GET["id"])) {
    $id      = $_GET["id"];
    $request = request("select * from events where id='$id'");
    $array   = get_array($request);
    
} else {
    go("../404.php");
}
if (if_event_id_exist($_GET["id"])==0) {
    go("../404.php");
}     
?>

<!DOCTYPE html>
<html lang="en">
<?php 
include 'include/head.php'; 
include 'include/header.php'; 
include 'include/sidebar.php'; 
include 'include/js.php'; ?>
<body>
    <!-- container section start -->
    <section id="container" class="">
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i><a href="index.php">Home</a>
                            </li>
                            <li><i class="fa fa-bars"></i>Events</li>
                        </ol>
                    </div>
                </div>
                <!-- page start-->
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="event">
                    <img src="../<?php echo $array[ 'picture'] ?>" class="eventPicture" />
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
                        <?php echo 'Total joiners : '.$array['joiners'].' '?>
                    </div>
                    <div class="map">
                        <?php echo '<iframe src="'.$array[ 'location']. '" width="950" height="750" frameborder="0" style="border:0"></iframe>' ?>
                    </div>
                </div>
                <!-- page end-->
            </section>
        </section>
        <!--main content end-->
    </section>
</body>
</html>

