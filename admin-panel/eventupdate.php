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
//update start        
if (isset($_GET["id"])) {
    $id      = $_GET["id"];
    $request = request("select * from events where id='$id'");
    $array   = get_array($request);
    if (isset($_POST["updateEvent"])) {
        $name        = $_POST["eventName"];
        $type        = $_POST["eventType"];
        $date        = $_POST["eventDate"];
        $location    = $_POST["eventLocation"];
        $place       = $_POST["eventPlace"];
        $description = $_POST["eventDescription"];
        $quoata      = $_POST["eventQuota"];
        $picture     = $_FILES["eventPicture"];
        $contact     = $_POST["eventContact"];
        if (update_event($name, $type, $date, $location, $place, $description, $quoata, $picture, $contact, $id)) {
            echo "<script>alert('Event Updated Succesfully');</script>";
            go("listevents.php", 0.001);
        }
    }
} else {
    go("../404.php");
}
//update end
?>
<!DOCTYPE html>
<html lang="en">
<?php 
include 'include/head.php'; 
include 'include/header.php'; 
include 'include/sidebar.php'; 
include 'include/js.php'; ?>
<body>
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
                            <li><i class="fa fa-bars"></i>Update Event</li>
                        </ol>
                    </div>
                </div>
                <!-- page start-->          
                <div id="edit-profile" class="tab-pane">
                    <section class="panel">
                        <div class="panel-body bio-graph-info">
                            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Event Name</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="eventName" name="eventName" value="<?php echo $array["name"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Event Type</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="eventType" name="eventType" value="<?php echo $array["type"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Event Date</label>
                                    <div class="col-lg-6">
                                        <input type="datetime-local" class="form-control" id="eventDate" name="eventDate">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Event Location</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="eventLocation" name="eventLocation" value="<?php echo $array["location"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Event Place</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="eventPlace" name="eventPlace" value="<?php echo $array["place"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Event Description</label>
                                    <div class="col-lg-6">
                                        <textarea name="eventDescription" id="eventDescription" class="form-control" style="resize: none" cols="30" rows="5"><?php echo $array["description"];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Event Quota</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="eventQuota" name="eventQuota" value="<?php echo $array["quoata"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Event Picture</label>
                                    <div class="col-lg-6">
                                        <input type="file" id="eventPicture" name="eventPicture">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Contact Number</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="eventContact" name="eventContact" value="<?php echo $array["contact"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-primary" name="updateEvent">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
                <!-- page end -->
            </section>
        </section>
        <!--main content end-->
    </section>
    <!-- container section end -->
</body>

</html>
