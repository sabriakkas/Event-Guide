<?php
 if(isset($_POST["search"])){
              $keyword=$_POST["search"];
                  go("index.php?search=$keyword");
             }else{
 
             }
 ?>
 <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Nav Bar" data-placement="bottom"><i class="icon_menu"></i>
                </div>
            </div>
            <!--logo start-->
            <a href="index.php" class="logo">EventGuide <span class="lite">Administration</span></a>
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
                    <!-- inbox notificatoin start-->
                     <li id="mail_notificatoin_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon_mail"></i>
                            <span class="badge bg-important"><!-- get mail number from php--></span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                        <?php 
                             $user_id=get_user_id();                      
                                $list=request( "SELECT * FROM system_messages");
                                                            
                              while($arr=get_array($list)){ ?>
                             
                              <li>
                              <div class="row">
                                  <div class="col-lg-9">
                                      <a href="event.php?id=<?php echo $arr['message_id']?>"><?php echo $arr['message']?></a>
                                     
                                  </div>
                                   <!--custom inner script only for this page-->
                                            <script type="text/javascript">
                                                function del() {
                                                    if (confirm("Message will be deleted immediately.\nAre you sure ?")) {
                                                            document.location = "messageremove.php?id=<?php echo $arr['id']; ?>";
                                                    }
                                                }
                                            </script> 
                                  <div class="col-lg-3">
                                     <a class="btn btn-danger" name="delete"  onclick="del();">
                                                <i class="icon_close"></i>
                                            </a>
                                  </div>                                                   
                               
                            </li>                                                                        
                            
                            <?php
                            }
                            ?>
                            <li>
                                <a href="inbox.php">See all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox notificatoin end -->
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">                           
                            <span class="username"><?php get_user_name();?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            
                            <li>
                                <a href="#"><i class="icon_mail_alt"></i> My Inbox</a>
                            </li>                           
                            <li>
                                <a href="logoff.php" onclick=""><i class="icon_key_alt"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
        </header>