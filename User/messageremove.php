<?php
session_start();
ob_start();
ob_flush();
require '../functions/functions.php';
require '../functions/functions.user.php';
//session control starts

if (!session_control(get_session("username"), get_session("userpass"))) {
    go("login.php");
}
//session control end   

$id= $_GET["id"];
$result = delete_message($id);

if ($result) { 
    go("index.php");
    
} else {
    echo "<script>alert('Problem Occured !');</script>";
    
}

?>