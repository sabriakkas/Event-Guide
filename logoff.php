<?php
 
        
	session_start(); 
	ob_start();
    ob_flush();	
    require 'functions/functions.php';
    go("index.php");
 		session_destroy();
	  	
  ?>