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
//add new event starts 
if (isset($_POST["createEvent"])) {
    $name        = $_POST["eventName"];
    $type        = $_POST["eventType"];
    $date        = $_POST["eventDate"];
    $location    = $_POST["eventLocation"];
    $place       = $_POST["eventPlace"];
    $description = $_POST["eventDescription"];
    $quoata      = $_POST["eventQuota"];
    $picture     = $_FILES["eventPicture"];
    $contact     = $_POST["eventContact"];
    if (add_new_event($name, $type, $date, $location, $place, $description, $quoata, $picture, $contact)) {
        echo "<script>alert('Event Added Succesfully');</script>";
        go("listevents.php", 0.001);
    } else {
        echo "<script>alert('Event error');</script>";
    }
} //add new event end 
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
                            <li><i class="fa fa-bars"></i>Add Event</li>
                        </ol>
                    </div>
                </div>
                <!-- page start-->
                <div id="edit-profile" class="tab-pane">
                    <section class="panel">
                        <div class="panel-body bio-graph-info">
                            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="addevent.php">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Event Name</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="eventName" name="eventName">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Event Type</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="eventType" name="eventType">
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
                                        <input type="text" class="form-control" id="eventLocation" name="eventLocation" placeholder="Enter a map url">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Event Place</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="eventPlace" name="eventPlace">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Event Description</label>
                                    <div class="col-lg-6">
                                        <textarea name="eventDescription" id="eventDescription" class="form-control" style="resize: none" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Event Quota</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="eventQuota" name="eventQuota">
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
                                        <input type="text" class="form-control" id="eventContact" name="eventContact">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-primary" name="createEvent">Save</button>
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