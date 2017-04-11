<?php

	function connect()	{
		$host="";
		$user="";
		$pass="";
		$data="";
		$con=@mysql_connect($host,$user,$pass);
		if (!$con) {
			go("404.php");
			die();
		}else{
			$DB=@mysql_select_db($data,$con);				
				if (!$DB) {
					go("404.php");
					die();
				}
			}
		return $con;
	}

	function disconnect(){
		if (!mysql_close(connect())) {
			go("404.php");
			die();
		}else{
			return true;
		}
	}

	function request($sql){		
		if (isset($sql)) {
			if (connect()) {
				$return=@mysql_query($sql);				
				disconnect();
				return $return;
			}
		}
	}

	function get_row_count($par){	
		
		return mysql_num_rows($par);
	}

	function get_array($par){

		return @mysql_fetch_assoc($par);
	}
	
	function create_session($par){
		if($par!=""){
			foreach ($par as $p => $v) {
				$_SESSION[$p]=$v;
			}
			return true;
		}else{
			return false;
		}	
	}

	function get_session($par){
		if ($_SESSION!="") {					
			if (@$_SESSION[$par]) {
				return $_SESSION[$par];
			}
			else{
				return false;
			}
		}else{
			return false;
		}
	}

	function go($par,$time=0){
		if ($time==0) {
			header("Location: {$par}");
		}else{
			header("Refresh: {$time}; url={$par}");
		}
	}
		
	function get_user_name(){
		
		echo get_session("username");
	}

	function get_user_picture(){
		
		echo get_session("picture");
	}
	
	function logoff(){
		ob_start();
		ob_clean();
		session_destroy();
	  	go("index.php");
	}

	function system_message($id,$message,$subject){
		$date=date('Y-m-d H:i:s');				
		$send=request("INSERT into messages(message_sender,message_receiver,message,subject,date) values(0,'$id','$message','$subject','$date') ");
	}

	function info_to_admin($id){
    	$message="Event with id $id is reached the maximum joiners.";
    	if(if_event_alert_exist($id)==0){

    		$send=request("INSERT into system_messages(message,message_id) values('$message','$id') ");           	
    	}
    }

	function send_message($sender,$receiver,$message,$subject){			
		$date=date('Y-m-d H:i:s');
    	if ($message!="") {
    		$send=request("INSERT into messages(message_sender,message_receiver,message,subject,date) values('$sender','$receiver','$message','$subject','$date') ");
            	if ($send) {
            		echo "<script>alert('Message Sended !');</script>";
            	}else{
            		echo "<script>alert('Problem Occured !');</script>";
            }
    	}else{
    			echo "<script>alert('Message field cannot be empty !');</script>";
    	}
    }

    function if_event_id_exist($event_id){
    	$check = request("SELECT id FROM events Where id='$event_id'");
    	return get_row_count($check);
    }

    function if_user_id_exist($user_id){
    	$check = request("SELECT id FROM user Where id='$user_id'");
    	return get_row_count($check);
    }

    function if_message_id_exist($id){
    	$check = request("SELECT message_id FROM messages Where message_id='$id'");
    	return get_row_count($check);
    }

 	function if_event_alert_exist($id){
 		$check = request("SELECT * FROM system_messages Where message_id='$id'");
    	return get_row_count($check);
    }

    function get_user_id(){

		$name=get_session("username");		
		$request=request("SELECT id from user where username='$name'");
		$arr=get_array($request);
		$id=$arr["id"];		
		return $id;
    }

   	function get_message_sender_name($id){
   		if ($id==0) {
			return "EventGuide";
		}
   		$check = request("SELECT * FROM user Where id='$id'");
		$array = get_array($check);		
		return $array["username"];
   	}
	
	function get_user_name_by_id($id){
		$check = request("SELECT * FROM user Where id='$id'");
		$array = get_array($check);
		return $array["username"];
	}

	function if_event_reached_maximum($id){
    		$check = request("SELECT * FROM events Where id='$id'");
    		$arr=get_array($check);
    		if ($arr["quoata"]==$arr["joiners"]) {
    			info_to_admin($id);
    			return true;
    		}else{
    			return false;
    		}
    }	

    function increase_event_joiners($event_id){
    	$request=request("SELECT joiners from events where id='$event_id'");
		$arr=get_array($request);
		$joiners=$arr["joiners"];
		$joiners=$joiners+1;	
    	$update=request("UPDATE events set				
				joiners='$joiners' where id='$event_id'");
    }

    function increase_event_counter($user_id){
    	$request=request("SELECT events from user where id='$user_id'");
		$arr=get_array($request);
		$event=$arr["events"];
		$event=$event+1;	
    	$update=request("UPDATE user set				
				events='$event' where id='$user_id'");
    }

    function decrease_event_joiners($event_id){
    	$request=request("SELECT joiners from events where id='$event_id'");
		$arr=get_array($request);
		$joiners=$arr["joiners"];
		$joiners=$joiners-1;	
    	$update=request("UPDATE events set				
				joiners='$joiners' where id='$event_id'");
    }

    function decrease_event_counter($user_id){
    	$request=request("SELECT events from user where id='$user_id'");
		$arr=get_array($request);
		$event=$arr["events"];
		$event=$event-1;	
    	$update=request("UPDATE user set				
				events='$event' where id='$user_id'");
    }

    function get_all_events(){
    	$list=request( "SELECT * from events"); 
    	return $list;
    }

    function search_keyword($keyword){
    	$list=request( "SELECT * FROM events WHERE description LIKE '%$keyword%' or name LIKE '%$keyword%' or type LIKE '%$keyword%'"); 
    	return $list;
    }

    function get_event_by_id($id){
    	$request = request("select * from events where id='$id'");
    	$array   = get_array($request);
    	return $array;
    }
?>


</script>