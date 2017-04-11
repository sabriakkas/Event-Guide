<?php
    session_start();
    ob_start();
    ob_flush();
     require '../functions/functions.php';   
     require '../functions/functions.user.php';        
            if(!session_control(get_session("username"),get_session("userpass"))){
              go("../login.php");
            }

            if (!isset($_GET["id"])) {
            	go("../404.php");
            }else{
            	if (if_user_id_exist($_GET["id"])==0) {
            		go("../404.php");
            	}else{
                $id=$_GET["id"];
                $request=request("SELECT * from user where id='$id'");
                $user=get_array($request);
              }
            }



            if (isset($_POST["save"])) {
              $id=$_GET["id"];
              $name=$_POST["name"];
              $surname=$_POST["surname"];
              $city=$_POST["city"];
              $bday=$_POST["birthday"];
              $mail=$_POST["mail"];
              $phone=$_POST["phone"];
              $password=$_POST["password"];
              $picture=$_FILES["picture"];
              $description=$_POST["description"];
   
             
              update_profile($id,$name,$surname,$city,$bday,$mail,$phone,$password,$picture,$description);
             

            	
            }
            else if(isset($_POST["send"])){
              $subject=$_POST["subject"];
            	$message=$_POST["message"];
            	$receiver=$_GET["id"];
            	$sender=get_user_id();            	
            	send_message($sender,$receiver,$message,$subject);           	
            }elseif (isset($_POST["cancel"])) {
            	echo "<script>alert('Canceled');</script>";
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
     <section id="container" class="">      
      <!--main content start-->     
          <section class="wrapper">
      
              <div class="row">
                <!-- profile-widget -->
                <div class="col-lg-12">
                    <div class="profile-widget profile-widget-info">
                          <div class="panel-body">
                            <div class="col-lg-2 col-sm-2">
                              <h4><?php echo $user["name"]." ".$user["surname"] ?></h4>               
                              <div class="follow-ava">
                                   <?php $userpic=$user["picture"];?>
                                        <img src="../<?php echo $userpic?>" alt="">
                              </div>                             
                            </div>                                                      
                          </div>
                    </div>
                </div>
              </div>
              <!-- page start-->
              <div class="row">
                 <div class="col-lg-12">
                    <section class="panel">
                          <header class="panel-heading tab-bg-info " style="padding-left: 0px">
                              <ul class="nav nav-tabs">
                                  <li class="active">
                                      <a data-toggle="tab" href="#profile">
                                          <i class="icon-home"></i>
                                          Profile
                                      </a>
                                  </li>                                 
                                  
                                  <?php if ($_GET["id"]==get_user_id()){ ?>
                                  	<li class="">
                                      <a data-toggle="tab" href="#edit-profile">
                                          <i class="icon-envelope"></i>
                                          Edit Profile
                                      </a>
                                  </li>
                                  <?php }
                                  	 ?>
                                  <?php if ($_GET["id"]!=get_user_id()){ ?>
                                  	<li class="">
                                      <a data-toggle="tab" href="#message">
                                          <i class="icon-envelope"></i>
                                          Message
                                      </a>
                                  </li>

                                  <?php }
                                  	 ?>
                              </ul>
                          </header>
                          <div class="panel-body">
                              <div class="tab-content">                                 
                                  <!-- profile -->
                                  <div id="profile" class="tab-pane active">
                                    <section class="panel">
                                     <div class="bio-graph-heading">
                                               <?php echo $user["description"] ?> 
                                          </div>
                                      <div class="panel-body bio-graph-info">
                                          <h1>Profile</h1>
                                          <div class="row">
                                              <div class="bio-row">
                                                        <p><span>First Name </span>: <?php echo $user["name"] ?> </p>
                                                    </div>
                                                    <div class="bio-row">
                                                        <p><span>Last Name </span>: <?php echo $user["surname"] ?></p>
                                                    </div>
                                                    <div class="bio-row">
                                                        <p><span>Birthday</span>: <?php echo $user["birthday"] ?></p>
                                                    </div>
                                                    <div class="bio-row">
                                                        <p><span>City</span>: <?php echo $user["city"] ?></p>
                                                    </div>                                                    
                                                    <div class="bio-row">
                                                        <p><span>Email </span>: <?php echo $user["mail"] ?></p>
                                                    </div>
                                                    <div class="bio-row">
                                                        <p><span>Mobile </span>: <?php echo $user["phone"] ?></p>
                                                    </div>
                                                    <div class="bio-row">
                                                        <p><span>Events </span>: <?php echo $user["events"] ?></p>
                                                    </div>
                                                    <div class="bio-row">
                                                        <p><span>Username </span>: <?php echo $user["username"] ?></p>
                                                    </div>
                                          </div>
                                      </div>
                                    </section>
                                      <section>
                                          <div class="row">                                              
                                          </div>
                                      </section>
                                  </div>
                                  <!-- message-->
                                  <div id="message" class="tab-pane">
                                    <section class="panel">
                                     
                                      <div class="panel-body bio-graph-info">
                                          <h1>Send Message</h1>
                                          <form class="form-horizontal" method="post" action="profile.php?id=<?php echo $_GET["id"] ?>">        
                                                     <div class="form-group">
                                                      <label class="col-lg-2 control-label">From: </label>
                                                      <div class="col-lg-6" >
                                                          <?php 
                                                          $from=get_user_name();
                                                          echo $from ?>
                                                      </div>
                                                  </div> 
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">To:</label>
                                                      <div class="col-lg-6" >
                                                          <?php 
                                                          $from=get_user_name_by_id($_GET["id"]);
                                                          echo $from 
                                                          ?>
                                                      </div>
                                                  </div>
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
                                      </div>
                                    </section>
                                      
                                  </div>
                                  <!-- edit-profile -->
                                  <div id="edit-profile" class="tab-pane">
                                    <section class="panel">                                          
                                          <div class="panel-body bio-graph-info">
                                              <h1> Profile Info</h1>
                                              <form class="form-horizontal" method="post" action="profile.php?id=<?php echo $_GET["id"]?>" enctype="multipart/form-data">                                                  
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">First Name</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" name="name" class="form-control" placeholder="" value="<?php echo $user["name"] ?>">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Last Name</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" name="surname"  class="form-control"  placeholder=" " value="<?php echo $user["surname"] ?>">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">City</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" name="city" class="form-control" id="city" placeholder=" " value="<?php echo $user["city"] ?>">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Birthday</label>
                                                      <div class="col-lg-6">
                                                          <input type="date" name="birthday" class="form-control" id="b-day" placeholder=" " value="<?php echo $user["birthday"] ?>">
                                                      </div>
                                                  </div>
                                                  
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Email</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" name="mail" class="form-control" id="email" placeholder=" " value="<?php echo $user["mail"] ?>">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Mobile</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" name="phone" class="form-control" id="mobile" placeholder=" " value="<?php echo $user["phone"] ?>">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Password</label>
                                                      <div class="col-lg-6">
                                                          <input type="password" name="password" id="password" class="form-control" >
                                                         
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Profile Picture</label>
                                                      <div class="col-lg-6">
                                                           <input type="file" id="picture" name="picture" size="78">
                                                      </div>
                                                  </div>                                                   
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">About Me</label>
                                                      <div class="col-lg-6">
                                                          <textarea name="description" id="" class="form-control"
                                                          style="resize:none; " cols="30" rows="5"><?php echo $user["description"] ?></textarea>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <div class="col-lg-offset-2 col-lg-10">
                                                          <button type="submit" name="save" class="btn btn-primary">Save</button>
                                                          <button type="submit" name="cancel" class="btn btn-danger">Cancel</button>
                                                      </div>
                                                  </div>
                                              </form>
                                          </div>
                                      </section>
                                  </div>
                              </div>
                          </div>
                      </section>
                 </div>
              </div>
              <!-- page end-->
          </section>
      <!--main content end-->
  </section>
  <!-- container section end -->
  </body>
</html>
