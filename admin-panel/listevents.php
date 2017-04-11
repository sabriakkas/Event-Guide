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
                            <li><i class="fa fa-bars"></i>List Events</li>
                        </ol>
                    </div>
                </div>
                <!-- page start-->
                <div class="col-lg-12">
                    <section class="panel">
                        <table class="table table-striped table-advance table-hover">
                            <tbody>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Date</th>
                                    <th>Place</th>
                                    <th>Contact</th>
                                    <th>Number Of Joiners</th>
                                    <th>Quota</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                                <?php 
                                    $list=request( "SELECT * from events"); 
                                        while($arr=get_array($list)) { ?>
                                <tr>
                                    <th>
                                        <?PHP echo $arr[ "name"]?>
                                    </th>
                                    <th>
                                        <?PHP echo $arr[ "date"]?>
                                    </th>
                                    <th>
                                        <?PHP echo $arr[ "place"]?>
                                    </th>
                                    <th>
                                        <?PHP echo $arr[ "contact"]?>
                                    </th>
                                    <th>
                                        <?php echo $arr[ "joiners"]?>
                                    </th>
                                    <th>
                                        <?PHP echo $arr[ "quoata"]?>
                                    </th>
                                    <th>
                                        <?PHP echo $arr[ "type"]?>
                                    </th>

                                    <th>
                                        <div class="btn-group">
                                            <a class="btn btn-info" name="eventpage" href="event.php?id=<?php echo $arr['id']; ?>" onclick="">
                                                <i class="icon_folder-alt"></i>
                                            </a>

                                            <a class="btn btn-warning" name="message" href="event_joiners.php?id=<?php echo $arr['id']; ?>">
                                                <i class="icon_mail"></i>
                                            </a>

                                            <a class="btn btn-success" href="eventupdate.php?id=<?php echo $arr['id']; ?>">
                                                <i class="icon_pencil-edit_alt"></i>
                                            </a>
                                             <!--custom inner script only for this page-->
                                            <script type="text/javascript">
                                                function del() {
                                                    if (confirm("Event will be deleted immediately.\nAre you sure ?")) {
                                                            document.location = "eventremove.php?id=<?php echo $arr['id']; ?>";
                                                    }
                                                }
                                            </script>                                           
                                            <a class="btn btn-danger" name="delete" onclick="del();">
                                                <i class="icon_close_alt2"></i>
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