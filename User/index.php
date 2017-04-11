<?php
    session_start();
    ob_start();
    ob_flush();
     require '../functions/functions.php';   
     require '../functions/functions.user.php';        
            if(!session_control(get_session("username"),get_session("userpass"))){
              go("../login.php");
            }
            

              
?>

<!DOCTYPE html>
<html lang="en">
<?php 
  include 'includes/head.php';
  include 'includes/header.php';
  include 'includes/js.php';

?>
<style>
#border {
  border-radius: 25px;
  border: 1px solid #BCBCBC;
  margin-bottom : 30px;
  margin : 25px;
  margin-left:30px;
}
  </style>
  <body>
    <section id="container" class="">
      <!--header start-->
      
           
      <!--header end-->

      <!--sidebar start-->    
      <!--sidebar end-->
<section>
          <section class=" wrapper" >

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
           
                                                      
          </section>
          </section>
      <!--main content start-->
    
      <!--main content end-->
  </section>
  </body>
</html>
