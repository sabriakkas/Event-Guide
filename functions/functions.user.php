<?php  
	function login($username,$userpass){
			if ($username=="" || $userpass=="") {
				echo "<script>alert('Please check your informations again!');</script>";
	            return false;
	        }else{
                $userpass=md5($userpass);
	            $check= request("SELECT username, userpass FROM user Where username='$username' and userpass='$userpass'");
	            if (get_row_count($check)>0) {
	                $arr=get_array($check);                       
	                $user=create_session(array('username'=>$arr["username"]));
	                $pass=create_session(array('userpass'=>$arr["userpass"]));
	                $ses=create_session(array('ses'=>md5($arr["userpass"].$_SERVER["REMOTE_ADDR"])));
	                if ($user==true and $pass==true and $ses==true) {                     
	                      
	                    return true;                         
	                }else{
	                	echo "<script>alert('Please check your informations again!');</script>";
	                    return false;
	                }                       
	            }else{
	            	echo "<script>alert('Please check your informations again!');</script>";
	                    return false;
	            }
	        }
	}
	
	function session_control($par,$par2){
			if ($par!="" and $par2!="") {
				$control=request("SELECT username, userpass FROM user Where username='{$par}' and userpass='{$par2}'");
				if (get_row_count($control)>0) {
					$arr=get_array($control);
					if($_SESSION["username"]==$arr["username"] and $_SESSION["ses"]==md5($arr["userpass"].$_SERVER["REMOTE_ADDR"])){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
	}

	function signup($username,$userpass,$confirm,$mail,$question,$answer){
		if (!empty($username)&&!empty($userpass)&&!empty($confirm)&&!empty($mail)&&!empty($question)&&!empty($answer)) {
			if ($userpass==$confirm) {
				$checkUserName = request("SHOW COLUMNS FROM user LIKE username Where username='{$username}'");
				$checkMail = request("SHOW COLUMNS FROM user LIKE mail Where mail='{$mail}'");
				
				if (!$checkUserName) {
					if (!$checkMail) {
                        $userpass=md5($userpass);
						$signup=request("INSERT into user(username,userpass,mail,picture,recovery_question,recovery_answer,phone,city,description) values
				 ('$username','$userpass','$mail','img/UserPictures/default.jpg','$question','$answer','No Information','No Information','No Information')");
				if ($signup) {
						echo "<script>alert('You get registered :)');</script>";
                        $new=request("SELECT * FROM user where username='$username'");
                        $arr=get_array($new);
                        $id=$arr["id"];
                        system_message($id,'Welcome to EventGuide thank you for registering.Have fun :)','No-Reply');
					return true;
				}
												
					}else{
						echo "<script>alert('This mail adress already registered!');</script>";
					}							
				
			}else{
				echo "<script>alert('Please try different username!');</script>";
			}
				
			}else{
				echo "<script>alert('Password does not match!');</script>";
			}
		}else{
				echo "<script>alert('Please fill all blanks !');</script>";
			}
	}
			
	function create_picture_path($picture){
       
        if ($picture["size"]<1024*1024) {
            if($picture["type"]=="image/jpeg") {
                    $file_name=$picture["name"];
                    $tag=array("as","rt","ty","yu","fg");
                    $extension=substr($file_name,-4,4);
                    $number=rand(1,10000);
                    $path="img/UserPictures/".$tag[rand(0,4)].$number.$extension;
                    if(move_uploaded_file($picture["tmp_name"],"../".$path)) {
                     //echo 'Dosya basariyla yuklendi.';
                     return $path;                    
                    } else {
                     //echo 'Dosya yuklenemedi.';
                    }
                   }else {
                    //echo 'Dosya yalnizca jpeg olabilir.';
                   }
                  }else {
                   //echo 'Dosya boyutu 1 MB i gecemez.';
                  }
    }

    function join_event($user_id,$event_id){
    	$check = request("SELECT user,event FROM user_event Where user='$user_id' and event='$event_id'");

    	if (get_row_count($check)==0) {
    		if (!if_event_reached_maximum($event_id)) { 		
    		$join=request("INSERT into user_event(user,event) values('$user_id','$event_id')");
    	if ($join) {
    		increase_event_joiners($event_id);
    		increase_event_counter($user_id);

             system_message($user_id,'You joined $event :)');
    		echo "<script>alert('You joined!');</script>";
    	}else{
    		echo "<script>alert('Fail!');</script>";
    	}
    	}else{
    		echo "<script>alert('This event reached maximum !');</script>";
    	}
        }else{
    		echo "<script>alert('You already joined this event.');</script>";
    	}	
    }

    function remove_event($user_id,$event_id){
    	$check = request("DELETE FROM user_event Where user='$user_id' and event='$event_id'");
    	if ($check) {
    		decrease_event_joiners($event_id);
    		decrease_event_counter($user_id);
    		echo "<script>alert('You removed this event !');</script>";
    	}
    }

    function update_profile($id,$name,$surname,$city,$bday,$mail,$phone,$password,$picture,$description){
    	
    	if ($password!="") {
    		$request=request("UPDATE user set password='$password'where id='$id'");
    	}
        $url=create_picture_path($picture);
    	if (!empty($url)) {
    		
    		$request=request("UPDATE user set picture='$url'where id='$id' ");
    	}

    	$request=request("UPDATE user set
    		name='$name',
    		surname='$surname',
    		city='$city',
    		birthday='$bday',
    		mail='$mail',
    		phone='$phone',
    		description='$description' where id='$id'");

    	if ($request) {
    		echo "<script>alert('Your profile updated !');</script>";   		
    		go("profile.php?id=$id",0.01);
    	}else{
    		echo "<script>alert('Fail!');</script>";
    	}
    }	
 
    function delete_message($id){

        $check = request("DELETE FROM messages Where message_id='$id'");
        if ($check) {   
            echo "<script>alert('You removed this message !');</script>";
            return true;
        }       
    }

    function forgot($username,$userpass,$confirm,$question,$answer){
        
        $check = request("SELECT * FROM user Where username='$username' and recovery_question='$question' and recovery_answer='$answer'");
        
        if (get_row_count($check)>0) {
           $arr=get_array($check);
 
            if ($userpass==$confirm&&$userpass!="") {
                $userpass=md5($userpass);
                $request=request("UPDATE user set userpass='$userpass'where username='$username'");
                if ($request) {
                    echo "<script>alert('You reset your password !');</script>";
                }else{

                }
            }else{
                    echo "<script>alert('Password does not match !');</script>";
            }
        }else{
               echo "<script>alert('Please check your informations !');</script>";
        }
    }

    function get_user_messages($user_id){
         $list=request( "SELECT * FROM messages where message_receiver='$user_id'");
         return $list;
    }

    

   

    
?>
