<?php  

	function login($username,$userpass){
			if ($username=="" || $userpass=="") {
				echo "<script>alert('Please check your informations again!');</script>";
	            return false;
	        }else{
	            $check= request("SELECT username, userpass FROM admin Where username='$username' and userpass='$userpass'");
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
	            }
	        }
	}
	
	function session_control($par,$par2){
			if ($par!="" and $par2!="") {
				$control=request("SELECT username, userpass FROM admin Where username='{$par}' and userpass='{$par2}'");
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

	function add_new_event($name,$type,$date,$location,$place,$description,$quoata,$picture,$contact){
			
			$picture_path=create_picture_path($picture);
			if(!empty($name)&&!empty($type)&&!empty($date)&&!empty($location)&&!empty($place)&&!empty($description)&&!empty($quoata)&&!empty($picture)&&!empty($contact)){
	    		$add= request("INSERT into events(name,type,date,location,place,description,quoata,contact,picture) values('$name','$type','$date','$location','$place','$description','$quoata','$contact','$picture_path')");
	    		if ($add) {
	    			return true;		 
	    		}else{
	      			die();
	    		}
	  		}else{
	      		return false;
	    	}		
	}

	function update_event($name,$type,$date,$location,$place,$description,$quoata,$picture,$contact,$id){
			
			$picture_path=create_picture_path($picture);	
			if(!empty($name)&&!empty($type)&&!empty($date)&&!empty($location)&&!empty($place)&&!empty($description)&&!empty($quoata)&&!empty($picture)&&!empty($contact)){
	    		$update=request("UPDATE events set
				name='$name',
				type='$type' ,    
				location='$location',
				place='$place',
				description='$description',
				quoata='$quoata',
				picture='$picture_path',
				contact='$contact' where id='$id'");
	    		if ($update) {  
	    		return true;   	    			    	
	      			go("listevents.php",0);    
	    		}else{    	
	      			die();
	   			}
	  		}else{
	      		echo "<script>alert('Please Fill All Blanks !');</script>";
	    	}				   		
	}

	function delete_event($id){		
	    $delete=request("DELETE from events  where id='$id'");
	    if ($delete) {
	    	return true;
	    }else{
	    	return false;
	    }
	}

	function create_picture_path($picture){
       
        if ($picture["size"]<1024*1024) {
            if($picture["type"]=="image/jpeg") {
                    $file_name=$picture["name"];
                    $tag=array("as","rt","ty","yu","fg");
                    $extension=substr($file_name,-4,4);
                    $number=rand(1,10000);
                    $path="img/EventPictures/".$tag[rand(0,4)].$number.$extension;
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

    function delete_notification($id){

    	$check = request("DELETE FROM system_messages Where id='$id'");
    	if ($check) {   
    		echo "<script>alert('You removed this message !');</script>";
    		return true;
    	}    	
    }

    function send_group_message($receiver,$message,$event_id){
        $date=date('Y-m-d H:i:s');
        $list=request("SELECT * FROM events where id='$event_id'");
        $arr=get_array($list);
        $subject=$arr["name"];
        if(!empty($receiver)){
        if ($message!="") {
            $arrlength=count($receiver);
             for($x = 0; $x < $arrlength; $x++) {

                   $send=request("INSERT into messages(message_sender,message_receiver,message,subject,date) values(0,'$receiver[$x]','$message','$subject','$date') ");            
            }
            echo "<script>alert('Messages sent to all users !');</script>";
        }else{
                echo "<script>alert('Message field cannot be empty !');</script>";
        }
        }else{
        echo "<script>alert('No one joined this event !');</script>";
         }  
    }

   
?>

