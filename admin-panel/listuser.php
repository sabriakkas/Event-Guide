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
<!--inner css for this page only-->
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
                            <li><i class="fa fa-bars"></i>List Users</li>
                        </ol>
                    </div>
                </div>
                <!-- page start-->
                <div class="col-lg-12">
                    <section class="panel">
                        <table class="table table-striped table-advance table-hover">
                            <tbody class="list">
                                <tr>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>City</th>
                                    <th>Birthday</th>
                                    <th>Number Of Events</th>
                                    <th>Mail</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                </tr>
                                <?php 
                                    $list=request( "SELECT * from user"); 
                                        while($arr=get_array($list)) { 
                                ?>
                                <tr>
                                    <th>
                                        <?PHP echo $arr["name"]?>
                                    </th>
                                    <th>
                                        <?PHP echo $arr["surname"]?>
                                    </th>
                                    <th>
                                        <?PHP echo $arr["city"]?>
                                    </th>
                                    <th>
                                        <?PHP echo $arr["birthday"]?>
                                    </th>
                                    <th>
                                        <?php echo "0"?>
                                    </th>
                                    <th>
                                        <?PHP echo $arr["mail"]?>
                                    </th>
                                    <th>
                                        <?PHP echo $arr["username"]?>
                                    </th>
                                    <th>
                                        <div class="btn-group">
                                            <a class="btn btn-info" name="eventpage" href="user.php?id=<?php echo $arr['id']; ?>" onclick="">
                                                <i class="icon_folder-alt"></i>
                                            </a>                                           
                                        </div>
                                    </th>
                                </tr>
                                <?PHP } ?>
                            </tbody>
                        </table>
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