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

$id     = $_GET["id"];
$result = delete_event($id);

if ($result) {
    //echo "<script>alert('Event Deleted Succesfully !');</script>"; 
    go("listevents.php");
    
} else {
    echo "<script>alert('Problem Occured !');</script>";
    
}

?>