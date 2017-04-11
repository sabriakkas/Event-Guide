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
?>
<!--HTML STARTS-->
<!DOCTYPE html>
<html lang="en">
<?php 
include 'include/head.php'; 
include 'include/header.php'; 
include 'include/sidebar.php'; 
include 'include/js.php'; ?>
<body>
    <!--custom inner style only for this page-->
    <style type="text/css">
        th,
        tr {
            width: 11%;
            text-align: center;
        }
    </style>  
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
                            <li><i class="fa fa-bars"></i>Send Message</li>
                        </ol>
                    </div>
                </div>
                <!-- page start-->
                                                         <?php 
                                                        

                                                   ?>          
               <div id="message" class="tab-pane">
                                    <section class="panel">
                                     
                                      <div class="panel-body bio-graph-info">
                                          <h1>Send Message</h1>
                                          <form class="form-horizontal" method="post">                                                            
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">To:</label>
                                                      <div class="col-lg-6" >
                                                          <?php 

                                                            $receivers=array();
                                                               //$user_id=get_user_id();
                                                               $event_id=$_GET["id"];  

                                                                       $list=request( "SELECT * FROM user_event where event='$event_id'");
                                                                                                            
                                                                              while($arr2=get_array($list)){
                                                                                 $user_id =$arr2['user'];

                                                                                 $req = request("SELECT * from user where id='$user_id'");
                                                               
                                                                              while($arr=get_array($req)){
                                                                                echo $arr["username"]."-";
                                                                                array_push($receivers, $arr["id"]);
                                                                            }
                                                                        }   

                                                                        if (isset($_POST["send"])) {
                                                            $message=$_POST["message"];
                                                        send_group_message($receivers,$message,$event_id);
                                                        }                                                                                       
                                                                    ?>
               
                                                      </div>
                                                  </div>                                                                                                                       
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Message</label>
                                                      <div class="col-lg-6">
                                                          <textarea name="message"  class="form-control"
                                                          style="resize:none; " cols="30" rows="5"></textarea>
                                                      </div>
                                                  </div>
                                                 

                                                  <div class="form-group">
                                                      <div class="col-lg-offset-2 col-lg-10">
                                                          <button type="submit" name="send" class="btn btn-primary">Send</button>
                                                          <button type="submit" name="cancel" class="btn btn-danger">Cancel</button>
                                                      </div>
                                                  </div>
                                              </form>
                                      </div>
                                    </section>
                                      
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