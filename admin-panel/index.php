<?php
session_start();
ob_clean();
ob_start();
ob_flush();
require '../functions/functions.php';
require '../functions/functions.admin.php';
//session control starts

if (!session_control(get_session("username"), get_session("userpass"))) {
    go("login.php");
}
//session control end   
?>

<!--HTML STARTS-->
<!DOCTYPE html>
<html lang="en">

 <?php 
       include 'include/head.php';
       include 'include/header.php';      
       include 'include/sidebar.php';
       include 'include/js.php';
 ?>   

<body>
    <!-- container section start -->
    <section id="container" class="">      
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
                            <li><i class="fa fa-bars"></i>Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- page start-->
                  <div class="row" align="center">
       <?php 
            
            if (isset($_GET["search"])) {
            $keyword=$_GET["search"];
            $list=request("SELECT * FROM events WHERE description LIKE '%$keyword%' or name LIKE '%$keyword%' or type LIKE '%$keyword%'");
            }else{
               $list=request( "SELECT * from events");
            }
              if (get_row_count($list)) {
               while($arr=get_array($list)) { 
                
                
                ?>
                <a href="event.php?id=<?php echo $arr['id']; ?>">
                  <div class="col-lg-4" id="border" style="width: 580px">
            <div class="col-lg-12" style="padding-bottom : 15px">
                            
              <?PHP echo '<img src="../'.$arr["picture"].'" width="100%" height="340px">' ?>
            </div>
            <div class="col-lg-12" style="font-size:16px; color:#535353" align="center">
              <i class="icon_clock_alt"></i>
              &nbsp;
              <?PHP echo $arr["date"]?>
            </div>
            <div class ="col-lg-12" style="font-size:22px; color:#000; padding-top:8px" align="center">
              <?PHP echo $arr["name"]?>
            </div>
            <div class="col-lg-6" align="center" style="padding-top : 8px; padding-bottom:30px">
              <i class="icon_pin"></i>
              &nbsp;
               <?php echo $arr["place"] ?>
            </div>
            <div class="col-lg-6" align="center" style="padding-top : 8px;padding-bottom:30px">
              <i class="icon_tags_alt"></i>
              &nbsp;
              <?PHP echo $arr["type"]?>
            </div>
            
                  </div>
          </a>
        <?php } 
         }else{?>
            <h1>No result founded !</h1>
            <a href="index.php">Return Home Page</a>
        <?php }
          ?>           
          </div> 
                <!-- page end-->
            </section>
        </section>
        <!--main content end-->
    </section>
    <!-- container section end --> 
</body>
</html>
<!--HTML ENDS-->