<?php
    session_start();
    ob_start();
    ob_flush();
     require '../functions/functions.php';   
     require '../functions/functions.user.php';        
            if(!session_control(get_session("username"),get_session("userpass"))){
              go("../login.php");
            }
            
            if (isset($_GET["id"])) {
  				$id=$_GET["id"];
            if (if_message_id_exist($id)==0) {
  				go("../404.php");
  			}
              }
?>

<!DOCTYPE html>
<html lang="en">
<?php 
  include 'includes/head.php';
 include 'includes/header.php';
  include 'includes/js.php';
  if (isset($_GET["id"])) {
  	$id=$_GET["id"];



  	if (isset($_POST["send"])) { 	  	  
  	  			$id=$_GET["id"];
  	  			$list=request( "SELECT * FROM messages where message_id='$id'");
                 $arr=get_array($list);
                $receiver=$arr["message_sender"];
  	  			$message=$_POST["message"];  				 
            	$sender=get_user_id();
            	$subject=$_POST["subject"];           	
            	send_message($sender,$receiver,$message,$subject);           	
            }elseif (isset($_POST["cancel"])) {
            	echo "<script>alert('Canceled');</script>";
            } 
    

?>
  <body>
     
      <section id="container" class="">      
      <!--main content start-->     
          <section class="wrapper">
         <div id="message" class="tab-pane">
                                    <section class="panel">                                     
                                      <div class="panel-body bio-graph-info">
                                          <h1>Message</h1>
                                                  <form class="form-horizontal" method="post">                                                
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">From:</label>
                                                      <div class="col-lg-6" >
                                                         <?php 
                                                          	$id=$_GET["id"];
                                                          		 $list=request( "SELECT * FROM messages where message_id='$id'");
                                                          		 $arr=get_array($list);
                                                                 if (get_message_sender_name($arr['message_sender'])!="EventGuide"){
                                                               ?>
                                                                <a href="profile.php?id=<?php echo $arr['message_sender'] ?>">
                                                          		<?php echo get_message_sender_name($arr['message_sender']);?> 
                                                           </a>
                                                           <?php
                                                           } 
                                                           else{
                                                              echo get_message_sender_name($arr['message_sender']);
                                                           }  ?>            
                                                      </div>
                                                  </div> 
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Subject</label>
                                                      <div class="col-lg-6">
                                                          	<?php 
                                                          	$id=$_GET["id"];
                                                          		 $list=request( "SELECT * FROM messages where message_id='$id'");
                                                          		 $arr=get_array($list);
                                                          		 echo $arr["subject"];
                                                           ?>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Message</label>
                                                      <div class="col-lg-6">
                                                          	<?php 
                                                          	$id=$_GET["id"];
                                                          		 $list=request( "SELECT * FROM messages where message_id='$id'");
                                                          		 $arr=get_array($list);
                                                          		 echo $arr["message"];
                                                           ?>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Time</label>
                                                      <div class="col-lg-6">
                                                          	<?php 
                                                          	$id=$_GET["id"];
                                                          		 $list=request( "SELECT * FROM messages where message_id='$id'");
                                                          		 $arr=get_array($list);
                                                          		 echo $arr["date"];
                                                           ?>
                                                      </div>
                                                  </div> 
                                                  <?php if (get_message_sender_name($arr['message_sender'])!="EventGuide"){?>
                                                      
                                                  <h1>Reply</h1> 
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Subject</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" name="subject"  class="form-control" >
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


                                                  	<?php } ?>
                                                  	
                                                  
                                                  
                                      </div>
                                    </section>
                                      
                                  </div>




          </section>
          </section>
  </body>
 <?php }else{ ?>
 <body>
      <!--custom inner style only for this page-->
    <style type="text/css">
        th,
        tr {
            width: 25%;
            text-align: center;
        }
    </style>  
   <section id="container" class="">      
      <!--main content start-->     
          <section class="wrapper">
			<div class="col-lg-12">
                <section class="panel">                                   
                    <table class="table table-striped table-advance table-hover" >
                         <tbody>
                            <tr>                                
                                <th>From</th>
								<th>Date</th>
								<th>Subject</th>
								<th>Action</th>
                            </tr>
                            <?php 
                                    $user_id=get_user_id();                      
                                $list=request( "SELECT * FROM messages where message_receiver='$user_id'");
                                        while($arr=get_array($list)) { ?>
							<tr>
								<th width="30%"><?php echo get_message_sender_name($arr['message_sender'])?></th>
								<th width="31%"><?php echo $arr['date']?></th>
								<th width="31%"><?php echo $arr['subject']?></th>
								<th>
									<div class="btn-group">
										
										<a class="btn btn-primary" href="inbox.php?id=<?php echo $arr["message_id"] ?>">
                                                Read
                                            </a>
                                             <!--custom inner script only for this page-->
                                            <script type="text/javascript">
                                                function del() {
                                                    if (confirm("Message will be deleted immediately.\nAre you sure ?")) {
                                                            document.location = "messageremove.php?id=<?php echo $arr['message_id']; ?>";
                                                    }
                                                }
                                            </script>                      
                                            <a class="btn btn-danger" name="eventpage" onclick="del();">
                                                Delete
                                            </a>
										
									</div>
								</th>
							</tr>
							<?php } ?>
                         </tbody>
                    </table>                                            
                </section>
            </div>
          </section>
    </section>
  </body>
 	
 <?php }
 ?>
</html>
