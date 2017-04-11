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
<style type="text/css">
  #border {
    border-radius: 25px;
    border: 1px solid #BCBCBC;
    margin-bottom : 30px;
    margin : 25px;
    margin-left:30px;
</style>
  <body>
     

     <section id="container">
          <section class=" wrapper">
          
             
             <div class="row" align="center">
              <?php 
               $user_id=get_user_id();                      
                       $list=request( "SELECT * FROM user_event where user='$user_id'");
                                                            
                              while($arr2=get_array($list)){
                                 $event_id =$arr2['event'];

                                 $sorgu = request("SELECT * from events where id='$event_id'");
               
                              while($arr=get_array($sorgu)){
                                
                               ?>
               
                  <div class="col-lg-4" id="border" style="width: 580px">
                   <a href="event.php?id=<?php echo $arr['id']; ?>">
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
            </a>          
                  </div>
          
        
          
         <?php }
         } ?>         
          </div>        
           
                                                      
          </section>
          </section>

     
          
          
  </body>
</html>
