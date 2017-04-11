
<?php
session_start();
ob_start();
ob_flush();
require '../functions/functions.php';
require '../functions/functions.user.php';
if (isset($_GET["id"])) {
    $id      = $_GET["id"];
    $array   = get_event_by_id($id);
    
} else {
    go("404.php");
}
?>
<?php
if (isset($_POST["join"])) {
    $user_id = get_user_id();
    join_event($user_id, $id);
} else if (isset($_POST["remove"])) {
    
    $user_id = get_user_id();
    remove_event($user_id, $id);
}
?>


<!DOCTYPE html>
<html lang="en">
<?php 
include 'includes/head.php'; 
include 'includes/header.php'; 
include 'includes/js.php'; 
?>

<body>
    <!-- container section start -->
    <section id="container" class="">

        <br>
        <br>
        <br>
        <br>
        <br>
        <!--Events-->
        <div class="event">
            <img src="../<?php echo $array['picture'] ?>" class="eventPicture" />
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
                <?php echo 'Total joiners :'.$array[ 'joiners']?>
                <br>
                <div class="btn-group">

                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Joiners <span class="caret"></span> </button>
                    <ul class="dropdown-menu">
                        <?php 
                        	$receivers=array(); $event_id=$_GET[ "id"]; 
                        	$list=request( "SELECT * FROM user_event where event='$event_id'"); 
                        	while($arr2=get_array($list)){ 
                        			$user_id=$arr2[ 'user']; 
                        			$req=request( "SELECT * from user where id='$user_id'"); 
                        			while($arr=get_array($req)){ ?>
                        <li>
                            <a href="profile.php?id=<?php echo $user_id ?>">
                                <?php echo $arr[ "username"]?>
                            </a>
                        </li>
                        <?php 
                    	} 

                        } ?>

                    </ul>
                </div>
            </div>
            <div class="map">
                <?php echo '<iframe src="'.$array[ 'location']. '" width="950" height="750" frameborder="0" style="border:0"></iframe>' ?>
            </div>
            <?php 
            	$user_id=get_user_id(); 
            	$event_id=$_GET[ "id"]; 
            	$check=request( "SELECT user,event FROM user_event Where user='$user_id' and event='$event_id'"); 
            	if (get_row_count($check)==0){ ?>
            <div>
                <form action="" method="post">
                    <button name="join" type="submit" class="btn btn-info btn-lg btn-block" style="font-size:31px">JOIN</button>
                </form>
            </div>
            <?php }else{ ?>
            <div>
                <form action="" method="post">
                    <button name="remove" type="submit" class="btn btn-danger btn-lg btn-block" style="font-size:31px">REMOVE</button>
                </form>
            </div>
            <?php }?>



        </div>
    </section>
</body>

</html>