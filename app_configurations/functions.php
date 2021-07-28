<?php  @session_start();
// error_reporting(E_ALL);
date_default_timezone_set('Asia/Karachi');
################### SITE DATA ####################
function siteData(){
	global $tprefix, $dbconn;
	$qry	=	"select * from ".$tprefix."site";
	$result =	$dbconn->query($qry);
	return	mysqli_fetch_assoc($result);

}


################### USER LOGIN ###################
function validateLogin($name,$pass){
			global $tprefix, $dbconn;
			
			$name = mysqli_real_escape_string($dbconn,stripslashes($name)); 
			$pass = mysqli_real_escape_string($dbconn,stripslashes($pass));
			$pass=substr(md5($pass), 0,15);
			
			$qy			=	"select * from ".$tprefix."cmsusers where username='$name' AND password like '$pass%' HAVING status='Active'";
			$numRecs	=	$dbconn->query($qy);
			$num		=	mysqli_num_rows($numRecs);
			if($num>0){	
				while($data=mysqli_fetch_object($numRecs)){
					$_SESSION['appuser']	=	 $data->name;
					$_SESSION['uid'] 		=	 $data->userid;
					$_SESSION['role'] 		=	 $data->role;
					$_SESSION['ustatus'] 	=	 $data->status;
					$_SESSION['username'] 	=	 $data->username;
					$_SESSION['uimg'] 		=	 $data->userimg;
					$_SESSION['rights'] 	=	 $data->user_rights;
					$_SESSION['partnerid']	=	$data->partner_id;
					$_SESSION['esms'] 		=	 '';
					$_SESSION['siteid'] 	=	 1;
				}
				return true;
			}
			else {
				return false;
			}
} 

################# CMS USERS ##########################
function manageMembers(){
	global $tprefix, $dbconn;
	$userid			=	$_POST['cid'];
 	$name			=	$_POST['member_name'];
 	$email		 	=	$_POST['email'];
 	$username		=	$_POST['username'];
 	$password		=	$_POST['password'];
 	$salt			=	$_POST['salt'];
 	$prevuserimg	=	$_POST['prevuserimg'];
 	$status			=	$_POST['status'];
 	$role			=	$_POST['role'];
	$createdon		=	date("Y-m-d H:m:s", time());
	
	
	if(isset($_POST['cp_check']) && $_POST['cp_check']=='change_password')
	$password	=	md5($password);
	else if($salt=='')
	$password	=	md5($password);
	else
	$password	=	$salt;
	
	if($_FILES['userimg']['tmp_name']){		
			$file_name 	=	time().'_'.$_FILES['userimg']['name'];
            $file_tmp 	=	$_FILES['userimg']['tmp_name'];
			
			if(move_uploaded_file($file_tmp,"assets/users/".$file_name))
				$userimg	=	$file_name;
			else
				$userimg	=	$prevuserimg;
	}else
				$userimg	=	$prevuserimg;
	

	
	$qry 				=	$tprefix.'cmsusers set  
							name			=	"'.$name.'",
							email		 	=	"'.$email.'",
							username		=	"'.$username.'",
							password		=	"'.$password.'",
							role			=	"'.$role.'",
							status			=	"'.$status.'",
							userimg			=	"'.$userimg.'"';

	if($userid>0){
		$qry	= " UPDATE ".$qry. ',updatedon  = "'.$createdon.'"'." WHERE userid = ".$userid;
	}
	else{
			$qry	= " INSERT INTO ".$qry. ',createdon = "'.$createdon.'"';
	}

	if($dbconn->query($qry))
			return true;	
	else	return false;
}
function usersListings($tid){
	global $tprefix, $dbconn;
	
	if(isset($_REQUEST['d']) and $_REQUEST['d']>0)
		$dbconn->query('delete from '.$tprefix.'cmsusers where userid='.$_REQUEST['d']);

	if($tid==0)
		$query = "select * from ".$tprefix."cmsusers where userid>1";
	else
		$query = 'select * from '.$tprefix.'cmsusers where userid='.$tid;
		
	$result =	$dbconn->query($query);
	if($tid==0)
		return $result;
	else 
	return mysqli_fetch_assoc($result);
}
function getuserProfile($currentUserId){
	global $tprefix, $dbconn;
	$result =	$dbconn->query("select * from ".$tprefix."cmsusers where userid=".$currentUserId);
	return mysqli_fetch_assoc($result);
}
function updateuserProfile(){
	global $tprefix, $dbconn;
	$currentUserId	=	$_POST['cuserid']; 
	$name			=	$_POST['name'];
	$username		=	$_POST['username'];
	$email			=	$_POST['email'];
	
	if(isset($_POST['cp_check'])>0){
	$password		=	substr(md5($_POST['password']), 0,15);	
	$query			=	"	update ".$tprefix."cmsusers set
							name		=	'$name',
							username	=	'$username',
							email		=	'$email',
							password	=	'$password'
							where 
							userid		=	$currentUserId
						";
	}
	else{
		$query		=	"	update ".$tprefix."cmsusers set
							name		=	'$name',
							username	=	'$username',
							email		=	'$email'
					 		where 
							userid		=	$currentUserId
						";
	}
	if($dbconn->query($query))	return true;	else	return false;
}


function sysActions($action,$val){
	global $tprefix, $dbconn;
	if($action=='del' and $val>0){
		if($dbconn->query('delete from '.$tprefix.'cmsusers where userid='.$val))
			return true;
		else
			return false;
	}
	else if($action=='edit' and $val>0){
		 $query = 'select * from '.$tprefix.'cmsusers where userid='.$val;		
		$result =	$dbconn->query($query);
		 $_SESSION['myobject'] = mysqli_fetch_assoc($result); 
			return ' ';
	    
	}
	else if($action=='edit' and $val==0){
		 $_SESSION['myobject'] = array('member_name' =>'' );
			return ' ';
	    
	}
}
######################## SETTINGS ################################
function manageSettings(){
   global $tprefix, $dbconn;

   $gsid   = $_POST['gsid'];
   $setting_title = $_POST['setting_title'];
   $setting_phone  = $_POST['setting_phone'];
   $setting_email = $_POST['setting_email'];
   $checkout_time = $_POST['checkout_time'];
   $setting_deduction = $_POST['setting_deduction'];
   $setting_address = $_POST['setting_address'];
   $person_contact = $_POST['person_contact'];
   $setting_des = $_POST['setting_des'];
    $prevsettingimg	=	$_POST['prevuserimg'];
   $createdon  = date("Y-m-d H:m:s",time());


if($_FILES['setting_img']['tmp_name']){		
			$file_name 	=	time().'_'.$_FILES['setting_img']['name'];
            $file_tmp 	=	$_FILES['setting_img']['tmp_name'];
			
			if(move_uploaded_file($file_tmp,"assets/img/setting/".$file_name))
				$setting_img	=	$file_name;
			else
				$setting_img	=	$prevsettingimg;
	}else
				$setting_img	=	$prevsettingimg;


   	$kry = $tprefix.'settings set
   	          setting_title = "'.$setting_title.'",
   	          setting_phone = "'.$setting_phone.'",
   	          setting_email ="'.$setting_email.'",
   	          checkout_time ="'.$checkout_time.'",
   	          setting_deduction ="'.$setting_deduction.'",
   	          setting_address ="'.$setting_address.'",
   	          person_contact ="'.$person_contact.'",
   	          designation ="'.$setting_des.'",
   	          setting_img ="'.$setting_img.'"
   	          ';

   	 if ($gsid>0) {
   	 	// $kry	= " UPDATE ".$kry. ',updatedon  = "'.$createdon.'"'." WHERE sid = ".$sid;
   	 	$kry	= " UPDATE ".$kry." WHERE gsid = ".$gsid;
   	 }
   	 else{
   	 	// $kry    = " INSERT INTO ".$Kry. ',createdon ="'.$createdon.'"';
   	 	$kry	= " INSERT INTO ".$kry. ',createdon = "'.$createdon.'"';
   	 }

   	 if ($dbconn->query($kry)){
   	 	return true;
   	 }
   	 else{
   	 	return false;
   	 }
}

function getsettings($currentUserId){
	global $tprefix, $dbconn;
	$result =	$dbconn->query("select * from ".$tprefix."settings where gsid=".$currentUserId);
	return mysqli_fetch_assoc($result);
}


function formSettingsActions($action,$val){
	global $tprefix, $dbconn;
	if($action=='del' and $val>0){
		if($dbconn->query('delete from '.$tprefix.'settings where gsid='.$val))
			return true;
		else
			return false;
	}
	else if($action=='edit' and $val>0){
		 $query = 'select * from '.$tprefix.'settings where gsid='.$val;		
		$result =	$dbconn->query($query);
		 $_SESSION['myobject'] = mysqli_fetch_assoc($result); 
			return ' ';
	    
	}
	else if($action=='edit' and $val==0){
		 $_SESSION['myobject'] = array('setting_title' =>'' );
			return ' ';
	    
	}
}

function settingListings($tid){
	global $tprefix, $dbconn;
	
	if(isset($_REQUEST['d']) and $_REQUEST['d']>0){
		$dbconn->query('delete from '.$tprefix.'settings where gsid='.$_REQUEST['d']);
		
	}

	if($tid==0)
		$query = "select * from ".$tprefix."settings where gsid>=1";
	else
		$query = 'select * from '.$tprefix.'settings where gsid='.$tid;
		
	$result =	$dbconn->query($query);
	if($tid==0)
		return $result;
	else 
	return $result;
}


######################## AMENITIES ################################
function manageAmenities(){
   global $tprefix, $dbconn;

   $ameniti_id   = $_POST['ameniti_id'];
   $ameniti_name = $_POST['ameniti_name'];
   $ameniti_status  = $_POST['ameniti_status'];
   $ameniti_des =  htmlentities($_POST['ameniti_des']);
   $createdon  = date("Y-m-d H:m:s",time());


   	$kry = $tprefix.'amenities set
   	          ameniti_name = "'.$ameniti_name.'",
   	          ameniti_status = "'.$ameniti_status.'",
   	          ameniti_des ="'.$ameniti_des.'"
   	          ';

   	 if ($ameniti_id>0) {
   	 	// $kry	= " UPDATE ".$kry. ',updatedon  = "'.$createdon.'"'." WHERE sid = ".$sid;
   	 	$kry	= " UPDATE ".$kry." WHERE ameniti_id = ".$ameniti_id;
   	 }
   	 else{
   	 	// $kry    = " INSERT INTO ".$Kry. ',createdon ="'.$createdon.'"';
   	 	$kry	= " INSERT INTO ".$kry. ',createdon = "'.$createdon.'"';
   	 }

   	 if ($dbconn->query($kry)){
   	 	return true;
   	 }
   	 else{
   	 	return false;
   	 }
}

function getamenities($currentUserId){
	global $tprefix, $dbconn;
  $result =	$dbconn->query("select * from ".$tprefix."amenities where ameniti_id=".$currentUserId);
	return mysqli_fetch_assoc($result);
}


function amenitiesActions($action,$val){
	global $tprefix, $dbconn;
	if($action=='del' and $val>0){
		if($dbconn->query('delete from '.$tprefix.'amenities where ameniti_id='.$val))
			return true;
		else
			return false;
	}
	else if($action=='edit' and $val>0){
		 $query = 'select * from '.$tprefix.'amenities where ameniti_id='.$val;		
		$result =	$dbconn->query($query);
		 $_SESSION['myobject'] = mysqli_fetch_assoc($result); 
			return ' ';
	    
	}
	else if($action=='edit' and $val==0){
		 $_SESSION['myobject'] = array('ameniti_name' =>'' );
			return ' ';
	    
	}
}

function amenitiesListings($tid){
	global $tprefix, $dbconn;
	
	if(isset($_REQUEST['d']) and $_REQUEST['d']>0){
		$dbconn->query('delete from '.$tprefix.'amenities where ameniti_id='.$_REQUEST['d']);
		
	}

	if($tid==0)
		$query = "select * from ".$tprefix."amenities where ameniti_id>=1";
	else
		$query = 'select * from '.$tprefix.'amenities where ameniti_id='.$tid;
		
	$result =	$dbconn->query($query);
	if($tid==0)
		return $result;
	else 
	return $result;
}

######################## Paid Service ################################
function managePaidServices(){
   global $tprefix, $dbconn;

   $psid   = $_POST['psid'];
   $paidservice_title = $_POST['paidservice_title'];
   $price_type  = $_POST['price_type'];
   $price = $_POST['price'];
   $status = $_POST['status'];
   $service_des = htmlentities($_POST['service_des']);
   $createdon  = date("Y-m-d H:m:s",time());


   	$kry = $tprefix.'paidservices set
   	          paidservice_title = "'.$paidservice_title.'",
   	          price_type = "'.$price_type.'",
   	          price ="'.$price.'",
   	          status ="'.$status.'",
   	          service_des ="'.$service_des.'"
   	          ';

   	 if ($psid>0) {
   	 	// $kry	= " UPDATE ".$kry. ',updatedon  = "'.$createdon.'"'." WHERE sid = ".$sid;
   	 	$kry	= " UPDATE ".$kry." WHERE psid = ".$psid;
   	 }
   	 else{
   	 	// $kry    = " INSERT INTO ".$Kry. ',createdon ="'.$createdon.'"';
   	 	$kry	= " INSERT INTO ".$kry. ',createdon = "'.$createdon.'"';
   	 }

   	 if ($dbconn->query($kry)){
   	 	return true;
   	 }
   	 else{
   	 	return false;
   	 }
}

function getpaidServices($currentUserId){
	global $tprefix, $dbconn;
	$result =	$dbconn->query("select * from ".$tprefix."paidservices where psid=".$currentUserId);
	return mysqli_fetch_assoc($result);
}


function paidServiceActions($action,$val){
	global $tprefix, $dbconn;
	if($action=='del' and $val>0){
		if($dbconn->query('delete from '.$tprefix.'paidservices where psid='.$val))
			return true;
		else
			return false;
	}
	else if($action=='edit' and $val>0){
		 $query = 'select * from '.$tprefix.'paidservices where psid='.$val;		
		$result =	$dbconn->query($query);
		 $_SESSION['myobject'] = mysqli_fetch_assoc($result); 
			return ' ';
	    
	}
	else if($action=='edit' and $val==0){
		 $_SESSION['myobject'] = array('paidservice_title' =>'' );
			return ' ';
	    
	}
}

function paidServiceListings($tid){
	global $tprefix, $dbconn;
	
	if(isset($_REQUEST['d']) and $_REQUEST['d']>0){
		$dbconn->query('delete from '.$tprefix.'paidservices where psid='.$_REQUEST['d']);
		
	}

	if($tid==0)
		$query = "select * from ".$tprefix."paidservices where psid>=1";
	else
		$query = 'select * from '.$tprefix.'paidservices where psid='.$tid;
		
	$result =	$dbconn->query($query);
	if($tid==0)
		return $result;
	else 
	    return $result;
}


######################## House Keeping ################################
function managehousekeeping(){
   global $tprefix, $dbconn;

   $hkid   = $_POST['hkid'];
   $housekeeping_name = $_POST['housekeeping_name'];
   $status  = $_POST['status'];
   $createdon  = date("Y-m-d H:m:s",time());


   	$kry = $tprefix.'housekeeping set
   	          housekeeping_name = "'.$housekeeping_name.'",
   	          status = "'.$status.'"
   	          
   	          ';

   	 if ($hkid>0) {
   	 	// $kry	= " UPDATE ".$kry. ',updatedon  = "'.$createdon.'"'." WHERE sid = ".$sid;
   	 	$kry	= " UPDATE ".$kry." WHERE hkid = ".$hkid;
   	 }
   	 else{
   	 	// $kry    = " INSERT INTO ".$Kry. ',createdon ="'.$createdon.'"';
   	 	$kry	= " INSERT INTO ".$kry. ',createdon = "'.$createdon.'"';
   	 }

   	 if ($dbconn->query($kry)){
   	 	return true;
   	 }
   	 else{
   	 	return false;
   	 }
}

function gethousekeeping($currentUserId){
	global $tprefix, $dbconn;
	$result =	$dbconn->query("select * from ".$tprefix."housekeeping where hkid=".$currentUserId);
	return mysqli_fetch_assoc($result);
}


function housekeepingActions($action,$val){
	global $tprefix, $dbconn;
	if($action=='del' and $val>0){
		if($dbconn->query('delete from '.$tprefix.'housekeeping where hkid='.$val))
			return true;
		else
			return false;
	}
	else if($action=='edit' and $val>0){
		 $query = 'select * from '.$tprefix.'housekeeping where hkid='.$val;		
		$result =	$dbconn->query($query);
		 $_SESSION['myobject'] = mysqli_fetch_assoc($result); 
			return ' ';
	    
	}
	else if($action=='edit' and $val==0){
		 $_SESSION['myobject'] = array('housekeeping_name' =>'' );
			return ' ';
	    
	}
}

function housekeepingListings($tid){
	global $tprefix, $dbconn;
	
	if(isset($_REQUEST['d']) and $_REQUEST['d']>0){
		$dbconn->query('delete from '.$tprefix.'housekeeping where hkid='.$_REQUEST['d']);
		
	}

	if($tid==0)
		$query = "select * from ".$tprefix."housekeeping where hkid>=1";
	else
		$query = 'select * from '.$tprefix.'housekeeping where hkid='.$tid;
		
	$result =	$dbconn->query($query);
	if($tid==0)
		return $result;
	else 
	    return $result;
}


######################## Floor ################################
function manageFloor(){
   global $tprefix, $dbconn;

   $fid   = $_POST['fid'];
   $floor_title = $_POST['floor_title'];
   $floor_number  = $_POST['floor_number'];
   $floor_des = htmlentities($_POST['floor_des']);
   $createdon  = date("Y-m-d H:m:s",time());


   	$kry = $tprefix.'floor set
   	          floor_title = "'.$floor_title.'",
   	          floor_number = "'.$floor_number.'",
   	          floor_des ="'.$floor_des.'"
   	          ';

   	 if ($fid>0) {
   	 	// $kry	= " UPDATE ".$kry. ',updatedon  = "'.$createdon.'"'." WHERE sid = ".$sid;
   	 	$kry	= " UPDATE ".$kry." WHERE fid = ".$fid;
   	 }
   	 else{
   	 	// $kry    = " INSERT INTO ".$Kry. ',createdon ="'.$createdon.'"';
   	 	$kry	= " INSERT INTO ".$kry. ',createdon = "'.$createdon.'"';
   	 }

   	 if ($dbconn->query($kry)){
   	 	return true;
   	 }
   	 else{
   	 	return false;
   	 }
}

function getfloor($currentUserId){
	global $tprefix, $dbconn;
	$result =	$dbconn->query("select * from ".$tprefix."floor where fid=".$currentUserId);
	return mysqli_fetch_assoc($result);
}


function floorActions($action,$val){
	global $tprefix, $dbconn;
	if($action=='del' and $val>0){
		if($dbconn->query('delete from '.$tprefix.'floor where fid='.$val))
			return true;
		else
			return false;
	}
	else if($action=='edit' and $val>0){
		 $query = 'select * from '.$tprefix.'floor where fid='.$val;		
		$result =	$dbconn->query($query);
		 $_SESSION['myobject'] = mysqli_fetch_assoc($result); 
			return ' ';
	    
	}
	else if($action=='edit' and $val==0){
		 $_SESSION['myobject'] = array('floor_title' =>'' );
			return ' ';
	    
	}
}

function floorListings($tid){
	global $tprefix, $dbconn;
	
	if(isset($_REQUEST['d']) and $_REQUEST['d']>0){
		$dbconn->query('delete from '.$tprefix.'floor where fid='.$_REQUEST['d']);
		
	}

	if($tid==0)
		$query = "select * from ".$tprefix."floor where fid>=1";
	else
		$query = 'select * from '.$tprefix.'floor where fid='.$tid;
		
	$result =	$dbconn->query($query);
	if($tid==0)
		return $result;
	else 
	    return $result;
}

######################## ROOM TYPE ################################
function manageRoomtype(){
   global $tprefix, $dbconn;

   $rtid   = $_POST['rtid'];
   $roomtype_title = $_POST['roomtype_title'];
   $short_code  = $_POST['short_code'];
   $amenities = $_POST['amenities'];
   $base_price = $_POST['base_price'];
   $roomtype_des =  htmlentities($_POST['roomtype_des']);
   $createdon  = date("Y-m-d H:m:s",time());


   	$kry = $tprefix.'roomtype set
   	          roomtype_title = "'.$roomtype_title.'",
   	          short_code = "'.$short_code.'",
   	          amenities = "'.$amenities.'",
   	          base_price = "'.$base_price.'",
   	          roomtype_des ="'.$roomtype_des.'"
   	          ';

   	 if ($rtid>0) {
   	 	// $kry	= " UPDATE ".$kry. ',updatedon  = "'.$createdon.'"'." WHERE sid = ".$sid;
   	 	$kry	= " UPDATE ".$kry." WHERE rtid = ".$rtid;
   	 }
   	 else{
   	 	// $kry    = " INSERT INTO ".$Kry. ',createdon ="'.$createdon.'"';
   	 	$kry	= " INSERT INTO ".$kry. ',createdon = "'.$createdon.'"';
   	 }

   	 if ($dbconn->query($kry)){
   	 	return true;
   	 }
   	 else{
   	 	return false;
   	 }
}

function getroomtype($currentUserId){
	global $tprefix, $dbconn;
  $result =	$dbconn->query("select * from ".$tprefix."roomtype where rtid=".$currentUserId);
	return mysqli_fetch_assoc($result);
}


function rtActions($action,$val){
	global $tprefix, $dbconn;
	if($action=='del' and $val>0){
		if($dbconn->query('delete from '.$tprefix.'roomtype where rtid='.$val))
			return true;
		else
			return false;
	}
	else if($action=='edit' and $val>0){
		 $query = 'select * from '.$tprefix.'roomtype where rtid='.$val;		
		$result =	$dbconn->query($query);
		 $_SESSION['myobject'] = mysqli_fetch_assoc($result); 
			return ' ';
	    
	}
	else if($action=='edit' and $val==0){
		 $_SESSION['myobject'] = array('roomtype_title' =>'' );
			return ' ';
	    
	}
}

function roomtypeListings($tid){
	global $tprefix, $dbconn;
	
	if(isset($_REQUEST['d']) and $_REQUEST['d']>0){
		$dbconn->query('delete from '.$tprefix.'roomtype where rtid='.$_REQUEST['d']);
		
	}

	if($tid==0)
		$query = "select * from ".$tprefix."roomtype where rtid>=1";
	else
		$query = 'select * from '.$tprefix.'roomtype where rtid='.$tid;
		
	$result =	$dbconn->query($query);
	if($tid==0)
		return $result;
	else 
	return $result;
}

######################## ROOM ################################
function manageRoom(){
	global $dbconn, $tprefix;

	$room_id = $_POST['room_id'];
	$room_number = $_POST['room_number'];
	$room_type = $_POST['room_type'];
	$room_floor = $_POST['room_floor'];
	$room_status = $_POST['room_status'];
	$bed_type = $_POST['bed_type'];
	$room_capacity = $_POST['room_capacity'];
	$prevuserimg = $_POST['prevuserimg'];
	$room_des = htmlentities($_POST['room_des']);
	$createdon  = date("Y-m-d H:m:s",time());

	if($_FILES['room_image']['tmp_name']){		
			$file_name 	=	time().'_'.$_FILES['room_image']['name'];
            $file_tmp 	=	$_FILES['room_image']['tmp_name'];
			
			if(move_uploaded_file($file_tmp,"assets/img/room/".$file_name))
				$room_image	=	$file_name;
			else
				$room_image	=	$prevuserimg;
	}else
				$room_image	=	$prevuserimg;


    $kry = $tprefix.'room set
   	          room_number = "'.$room_number.'",
   	          room_type = "'.$room_type.'",
   	          room_floor = "'.$room_floor.'",
   	          room_status = "'.$room_status.'",
   	          bed_type = "'.$bed_type.'",
   	          room_capacity = "'.$room_capacity.'",
   	          room_image = "'.$room_image.'",
   	          room_des ="'.$room_des.'"
   	          ';

   	 if ($room_id>0) {
   	 	// $kry	= " UPDATE ".$kry. ',updatedon  = "'.$createdon.'"'." WHERE sid = ".$sid;
   	 	$kry	= " UPDATE ".$kry." WHERE room_id = ".$room_id;
   	 }
   	 else{
   	 	// $kry    = " INSERT INTO ".$Kry. ',createdon ="'.$createdon.'"';
   	 	$kry	= " INSERT INTO ".$kry. ',createdon = "'.$createdon.'"';
   	 }

   	 if ($dbconn->query($kry)){
   	 	return true;
   	 }
   	 else{
   	 	return false;
   	 }
}

function getroom($currentUserId){
	global $tprefix, $dbconn;
  $result =	$dbconn->query("select * from ".$tprefix."room where room_id=".$currentUserId);
	return mysqli_fetch_assoc($result);
}


function roomActions($action,$val){
	global $tprefix, $dbconn;
	if($action=='del' and $val>0){
		if($dbconn->query('delete from '.$tprefix.'room where room_id='.$val))
			return true;
		else
			return false;
	}
	else if($action=='edit' and $val>0){
		 $query = 'select * from '.$tprefix.'room where room_id='.$val;		
		$result =	$dbconn->query($query);
		 $_SESSION['myobject'] = mysqli_fetch_assoc($result); 
			return ' ';
	    
	}
	else if($action=='edit' and $val==0){
		 $_SESSION['myobject'] = array('room_number' =>'' );
			return ' ';
	    
	}
}

function roomListings($tid){
	global $tprefix, $dbconn;
	
	if(isset($_REQUEST['d']) and $_REQUEST['d']>0){
		$dbconn->query('delete from '.$tprefix.'room where room_id='.$_REQUEST['d']);
		
	}

	if($tid==0)
		$query = "select * from ".$tprefix."room where room_id>=1";
	else
		$query = 'select * from '.$tprefix.'room where room_id='.$tid;
		
	$result =	$dbconn->query($query);
	if($tid==0)
		return $result;
	else 
	return $result;
}


######################## Guest Details ################################
function manageGuest(){
	global $dbconn, $tprefix;

	$gdid  = $_POST['gdid'];
	$guest_name = $_POST['guest_name'];
	$father_name = $_POST['father_name'];
	$guest_gender = $_POST['guest_gender'];
	$date_of_birth = $_POST['date_of_birth'];
	$guest_email = $_POST['guest_email'];
	$mobile_number = $_POST['mobile_number'];
	$guest_country = $_POST['guest_country'];
	$guest_city = $_POST['guest_city'];
	$guest_address = $_POST['guest_address'];
	$id_type = $_POST['id_type'];
	$id_number = $_POST['id_number'];
	$vechile_number = $_POST['vechile_number'];
	$guest_type = $_POST['guest_type'];
	$guest_profession = $_POST['guest_profession'];
	$guest_organization = $_POST['guest_organization'];
	$total_adult = $_POST['total_adult'];
	$total_child = $_POST['total_child'];
	$visit_purpose = $_POST['visit_purpose'];
	$preupload_doc = $_POST['preupload_doc'];
	$createdon  = date("Y-m-d H:m:s",time());

	// ---------------- For PDF
  $targetdir = "assets/img/doc/";
  $file = $_FILES['upload_doc']['name'];
  $fileName = implode(',',$file);
  if (!empty($file)) {
  	foreach ($file as $key => $value) {
  		$targetFilePath = $targetdir.$value;
  		if(move_uploaded_file($_FILES['upload_doc']['tmp_name'][$key], $targetFilePath)){
  			$upload_doc = $fileName;
  			str_replace(' ', '_',$file);
  		}
  		else{
  			
  			$upload_doc = $preupload_doc;
  			$upload_doc = implode('',$preupload_doc);
  			
  		}
  		}
  	}
  	if($upload_doc == ''){
  		$upload_doc = $preupload_doc;
  	}else{
  		rtrim($upload_doc,',');
  	}
  	


    $kry = $tprefix.'guestdetails set
   	          guest_name = "'.$guest_name.'",
   	          father_name = "'.$father_name.'",
   	          guest_gender = "'.$guest_gender.'",
   	          date_of_birth = "'.$date_of_birth.'",
   	          guest_email = "'.$guest_email.'",
   	          mobile_number = "'.$mobile_number.'",
   	          guest_country = "'.$guest_country.'",
   	          guest_city = "'.$guest_city.'",
   	          guest_address = "'.$guest_address.'",
   	          id_type = "'.$id_type.'",
   	          id_number = "'.$id_number.'",
   	          vechile_number = "'.$vechile_number.'",
   	          guest_type = "'.$guest_type.'",
   	          guest_profession = "'.$guest_profession.'",
   	          guest_organization = "'.$guest_organization.'",
   	          total_adult = "'.$total_adult.'",
   	          total_child = "'.$total_child.'",
   	          visit_purpose = "'.$visit_purpose.'",
   	          upload_doc ="'.$upload_doc.'"
   	          ';

   	 if ($gdid>0) {
   	 	// $kry	= " UPDATE ".$kry. ',updatedon  = "'.$createdon.'"'." WHERE sid = ".$sid;
   	 	$kry	= " UPDATE ".$kry." WHERE gdid = ".$gdid;
   	 }
   	 else{
   	 	// $kry    = " INSERT INTO ".$Kry. ',createdon ="'.$createdon.'"';
   	 	$kry	= " INSERT INTO ".$kry. ',createdon = "'.$createdon.'"';
   	 }

   	 if ($dbconn->query($kry)){
   	 	return true;
   	 }
   	 else{
   	 	return false;
   	 }
}

	function getguest($currentUserId){
		global $tprefix, $dbconn;
	  $result =	$dbconn->query("select * from ".$tprefix."guestdetails where gdid=".$currentUserId);
		return mysqli_fetch_assoc($result);
	}


	function guestActions($action,$val){
		global $tprefix, $dbconn;
		if($action=='del' and $val>0){
			if($dbconn->query('delete from '.$tprefix.'guestdetails where gdid='.$val))
				return true;
			else
				return false;
		}
		else if($action=='edit' and $val>0){
			 $query = 'select * from '.$tprefix.'guestdetails where gdid='.$val;		
			$result =	$dbconn->query($query);
			 $_SESSION['myobject'] = mysqli_fetch_assoc($result); 
				return ' ';
		    
		}
		else if($action=='edit' and $val==0){
			 $_SESSION['myobject'] = array('guest_name' =>'' );
				return ' ';
		    
		}
	}

	function guestListings($tid){
		global $tprefix, $dbconn;
		
		if(isset($_REQUEST['d']) and $_REQUEST['d']>0){
			$dbconn->query('delete from '.$tprefix.'guestdetails where gdid='.$_REQUEST['d']);
			
		}

		if($tid==0)
			$query = "select * from ".$tprefix."guestdetails where gdid>=1";
		else
			$query = 'select * from '.$tprefix.'guestdetails where gdid='.$tid;
			
		$result =	$dbconn->query($query);
		if($tid==0)
			return $result;
		else 
		return $result;
	}

######################## Coupens ################################
function manageCoupen(){
   global $tprefix, $dbconn;

   $coupen_id    = $_POST['coupen_id'];
   $coupen_name = $_POST['coupen_name'];
   $coupen_code  = $_POST['coupen_code'];
   $coupen_type  = $_POST['coupen_type'];
   $coupen_price  = $_POST['coupen_price'];
   $coupen_qnt  = $_POST['coupen_qnt'];
   $coupen_to  = $_POST['coupen_to'];
   $coupen_from  = $_POST['coupen_from'];
   $coupen_des  = $_POST['coupen_des'];
   $createdon  = date("Y-m-d H:m:s",time());


   	$kry = $tprefix.'coupen set
   	          coupen_name = "'.$coupen_name.'",
   	          coupen_code = "'.$coupen_code.'",
   	          coupen_type = "'.$coupen_type.'",
   	          coupen_price ="'.$coupen_price.'",
   	          coupen_qnt ="'.$coupen_qnt.'",
   	          coupen_to ="'.$coupen_to.'",
   	          coupen_from ="'.$coupen_from.'",
   	          coupen_des ="'.$coupen_des.'"
   	          ';

   	 if ($coupen_id>0) {
   	 	// $kry	= " UPDATE ".$kry. ',updatedon  = "'.$createdon.'"'." WHERE sid = ".$sid;
   	 	$kry	= " UPDATE ".$kry." WHERE coupen_id = ".$coupen_id;
   	 }
   	 else{
   	 	// $kry    = " INSERT INTO ".$Kry. ',createdon ="'.$createdon.'"';
   	 	$kry	= " INSERT INTO ".$kry. ',createdon = "'.$createdon.'"';
   	 }

   	 if ($dbconn->query($kry)){
   	 	return true;
   	 }
   	 else{
   	 	return false;
   	 }
}

function getcoupen($currentUserId){
	global $tprefix, $dbconn;
  $result =	$dbconn->query("select * from ".$tprefix."coupen where coupen_id=".$currentUserId);
	return mysqli_fetch_assoc($result);
}


function coupenActions($action,$val){
	global $tprefix, $dbconn;
	if($action=='del' and $val>0){
		if($dbconn->query('delete from '.$tprefix.'coupen where coupen_id='.$val))
			return true;
		else
			return false;
	}
	else if($action=='edit' and $val>0){
		 $query = 'select * from '.$tprefix.'coupen where coupen_id='.$val;		
		$result =	$dbconn->query($query);
		 $_SESSION['myobject'] = mysqli_fetch_assoc($result); 
			return ' ';
	    
	}
	else if($action=='edit' and $val==0){
		 $_SESSION['myobject'] = array('coupen_name' =>'' );
			return ' ';
	    
	}
}

function coupenListings($tid){
	global $tprefix, $dbconn;
	
	if(isset($_REQUEST['d']) and $_REQUEST['d']>0){
		$dbconn->query('delete from '.$tprefix.'coupen where coupen_id='.$_REQUEST['d']);
		
	}

	if($tid==0)
		$query = "select * from ".$tprefix."coupen where coupen_id>=1";
	else
		$query = 'select * from '.$tprefix.'coupen where coupen_id='.$tid;
		
	$result =	$dbconn->query($query);
	if($tid==0)
		return $result;
	else 
	return $result;
}


######################## Agents ################################
function manageAgent(){
   global $tprefix, $dbconn;

   $agent_id    = $_POST['agent_id'];
   $agent_title = $_POST['agent_title'];
   $phone_number  = $_POST['phone_number'];
   $agent_email  = $_POST['agent_email'];
   $agent_status  = $_POST['agent_status'];
   $createdon  = date("Y-m-d H:m:s",time());


   	$kry = $tprefix.'agent set
   	          agent_title = "'.$agent_title.'",
   	          phone_number = "'.$phone_number.'",
   	          agent_email ="'.$agent_email.'",
   	          agent_status ="'.$agent_status.'"
   	          ';

   	 if ($agent_id>0) {
   	 	// $kry	= " UPDATE ".$kry. ',updatedon  = "'.$createdon.'"'." WHERE sid = ".$sid;
   	 	$kry	= " UPDATE ".$kry." WHERE agent_id = ".$agent_id;
   	 }
   	 else{
   	 	// $kry    = " INSERT INTO ".$Kry. ',createdon ="'.$createdon.'"';
   	 	$kry	= " INSERT INTO ".$kry. ',createdon = "'.$createdon.'"';
   	 }

   	 if ($dbconn->query($kry)){
   	 	return true;
   	 }
   	 else{
   	 	return false;
   	 }
}

function getagent($currentUserId){
	global $tprefix, $dbconn;
  $result =	$dbconn->query("select * from ".$tprefix."agent where agent_id=".$currentUserId);
	return mysqli_fetch_assoc($result);
}


function agentActions($action,$val){
	global $tprefix, $dbconn;
	if($action=='del' and $val>0){
		if($dbconn->query('delete from '.$tprefix.'agent where agent_id='.$val))
			return true;
		else
			return false;
	}
	else if($action=='edit' and $val>0){
		 $query = 'select * from '.$tprefix.'agent where agent_id='.$val;		
		$result =	$dbconn->query($query);
		 $_SESSION['myobject'] = mysqli_fetch_assoc($result); 
			return ' ';
	    
	}
	else if($action=='edit' and $val==0){
		 $_SESSION['myobject'] = array('agent_title' =>'' );
			return ' ';
	    
	}
}

function agentListings($tid){
	global $tprefix, $dbconn;
	
	if(isset($_REQUEST['d']) and $_REQUEST['d']>0){
		$dbconn->query('delete from '.$tprefix.'agent where agent_id='.$_REQUEST['d']);
		
	}

	if($tid==0)
		$query = "select * from ".$tprefix."agent where agent_id>=1";
	else
		$query = 'select * from '.$tprefix.'agent where agent_id='.$tid;
		
	$result =	$dbconn->query($query);
	if($tid==0)
		return $result;
	else 
	return $result;
}

######################## Booking ################################
function manageBooking(){
   global $tprefix, $dbconn;

   $booking_id     = $_POST['booking_id'];
   $check_in_date = $_POST['check_in_date'];
   $check_out_date  = $_POST['check_out_date'];
   $booking_date  = $_POST['booking_date'];
   $booking_by_userid  = $_POST['booking_by_userid'];
   $createdon  = date("Y-m-d H:m:s",time());


   	$kry = $tprefix.'booking set
   	          check_in_date = "'.$check_in_date.'",
   	          check_out_date = "'.$check_out_date.'",
   	          booking_date ="'.$booking_date.'",
   	          booking_by_userid ="'.$booking_by_userid.'"
   	          ';

   	 if ($booking_id>0) {
   	 	// $kry	= " UPDATE ".$kry. ',updatedon  = "'.$createdon.'"'." WHERE sid = ".$sid;
   	 	$kry	= " UPDATE ".$kry." WHERE booking_id = ".$booking_id;
   	 }
   	 else{
   	 	// $kry    = " INSERT INTO ".$Kry. ',createdon ="'.$createdon.'"';
   	 	$kry	= " INSERT INTO ".$kry. ',createdon = "'.$createdon.'"';
   	 }

   	 if ($dbconn->query($kry)){
   	 	return true;
   	 }
   	 else{
   	 	return false;
   	 }
}

function getbooking($currentUserId){
	global $tprefix, $dbconn;
  $result =	$dbconn->query("select * from ".$tprefix."booking where booking_id=".$currentUserId);
	return mysqli_fetch_assoc($result);
}


function bookingActions($action,$val){
	global $tprefix, $dbconn;
	if($action=='del' and $val>0){
		if($dbconn->query('delete from '.$tprefix.'booking where booking_id='.$val))
			return true;
		else
			return false;
	}
	else if($action=='edit' and $val>0){
		 $query = 'select * from '.$tprefix.'booking where booking_id='.$val;		
		$result =	$dbconn->query($query);
		 $_SESSION['myobject'] = mysqli_fetch_assoc($result); 
			return ' ';
	    
	}
	else if($action=='edit' and $val==0){
		 $_SESSION['myobject'] = array('check_in_date' =>'' );
			return ' ';
	    
	}
}

function bookingListings($tid){
	global $tprefix, $dbconn;
	
	if(isset($_REQUEST['d']) and $_REQUEST['d']>0){
		$dbconn->query('delete from '.$tprefix.'booking where booking_id='.$_REQUEST['d']);
		
	}

	if($tid==0)
		$query = "select * from ".$tprefix."booking where booking_id>=1";
	else
		$query = 'select * from '.$tprefix.'booking where booking_id='.$tid;
		
	$result =	$dbconn->query($query);
	if($tid==0)
		return $result;
	else 
	return $result;
}

######################## PRACTICE ################################
function managePractice(){
	global $tprefix, $dbconn;

	$pracid = $_POST['pracid'];
	$practice_title = $_POST['practice_title'];
	$practice_status =$_POST['practice_status'];
	$practice_root = $_POST['practice_root'];
	$root = implode(',',$practice_root);
	$practice_behaviour =$_POST['practice_behaviour'];
	$text_desc = htmlentities($_POST['text_desc']);
	$prepractice_pdf = $_POST['prepractice_pdf'];
    $prevusericon = $_POST['prevusericon'];
	$userid = $_SESSION['uid'];
	$createdon = date("Y-m-d H:m:s",time());


	// ---------------- For Icon 
   if($_FILES['practice_icon']['tmp_name']){
   	$file_name = time().'_'.$_FILES['practice_icon']['name'];
   	$file_tmp =$_FILES['practice_icon']['tmp_name'];

   	if (move_uploaded_file($file_tmp,"../imgs/projectimg/".$file_name)) {
   		   $practice_icon = $file_name;
   	}else{
   		$practice_icon = $prevusericon;
   	}
   }
   else{	
   	   $practice_icon = $prevusericon;
   	}
// ---------------- For PDF
  $targetdir = "../imgs/projectimg/pdf/";
  $file = $_FILES['practice_pdf']['name'];
  $fileName = implode(',',$file);
  if (!empty($file)) {
  	foreach ($file as $key => $value) {
  		$targetFilePath = $targetdir.$value;
  		if(move_uploaded_file($_FILES['practice_pdf']['tmp_name'][$key], $targetFilePath)){
  			$practice_pdf = $fileName;
  			$practice_pdf.=','.$fileName;
  			rtrim($practice_pdf,',');
  		}
  		else{
  			
  			$practice_pdf = $prepractice_pdf;
  			rtrim($practice_pdf,',');
  		}
  		}
  	}
  	


  	     // trim($practice_pdf,','); 
  	// str_replace(',,',',',$practice_pdf);
  	
  	
	$data = $tprefix.'practice set 
					practice_title = "'.$practice_title.'",
					practice_status ="'.$practice_status.'",
					practice_root ="'.$root.'",
					practice_behaviour = "'.$practice_behaviour.'",
					text_desc = "'.$text_desc.'",
					practice_pdf ="'.$practice_pdf.'",
                    practice_icon ="'.$practice_icon.'",
					userid ="'.$userid.'"
					';

			if ($pracid>0) {
				$data = "UPDATE ".$data." where pracid = ".$pracid;

			}else{
				$data = "INSERT INTO ".$data.',createdon ="'.$createdon.'"';
							}

			if ($dbconn->query($data)) {
				return true;
			}else{
				echo $dbconn->error;
				return false;
			}
	
}

function getpractice($currentUserId){
	global $tprefix, $dbconn;
	$result =	$dbconn->query("select * from ".$tprefix."practice where pracid=".$currentUserId);
	return mysqli_fetch_assoc($result);
}
function formActions($action,$val){
	global $tprefix, $dbconn;
	if($action=='del' and $val>0){
		if($dbconn->query('delete from '.$tprefix.'practice where pracid='.$val))
			return true;
		else
			return false;
	}
	else if($action=='edit' and $val>0){
		 $query = 'select * from '.$tprefix.'practice where pracid='.$val;		
		$result =	$dbconn->query($query);
		 $_SESSION['myobject'] = mysqli_fetch_assoc($result); 
			return ' ';
	    
	}
	else if($action=='edit' and $val==0){
		 $_SESSION['myobject'] = array('practice_title' =>'' );
			return ' ';
	    
	}
}
	
function practiceListings($tid){
	global $tprefix, $dbconn;

	if($tid==0)
		$query = "select * from ".$tprefix."practice where pracid>=1";
	else
		$query = 'select * from '.$tprefix.'practice where pracid='.$tid;
		
	$result =	$dbconn->query($query);
	if($tid==0)
		return $result;
	else 
	    return $result;
}


######################## End Practice ################################




####################  DUPLICATE VALUES ##########################
function getDuplicateVal($val, $tbl, $field){
		global $tprefix;
		$resultSet 	= 	mysql_query('select * from '.$tprefix.$tbl.' where '.$field.' = "'.$val.'"');
		$num 		=	mysql_num_rows($resultSet);
		if($num>0) return true; else return false;
}

################# GET LISTS ################
function getLists($table, $displayField, $valueField,$selectedValue, $condition){
	global $tprefix, $dbconn;
 $query = "select $displayField, $valueField from ".$tprefix.$table.$condition;
	$list ='<option> </option>';
	$result =	$dbconn->query($query);
	while($al = mysqli_fetch_assoc($result)){	
		if($selectedValue == $al[$valueField]) $chk = 'selected'; else $chk='';
		$list .='<option value="'.$al[$valueField].'" '.$chk.'>'.$al[$displayField].'</option>';
	}
	
	return $list;
}
function getQryArray($table, $displayField, $condition){
	global $tprefix, $dbconn;
	$list ='';
	 $query = "select $displayField from ".$tprefix.$table.$condition;
	$result =	$dbconn->query($query);
	return $result;// =	mysql_query($query);

}

################# GET SINGLE VALUE ################
function getSingleValue($table, $requiredField, $condition){
	global $tprefix, $dbconn;
	$list ='';
	 $query = "select $requiredField as cval from ".$tprefix.$table.$condition;
	$result =	$dbconn->query($query);
	if(@mysqli_num_rows($result)>0){	
		$al = mysqli_fetch_assoc($result);
		$list = $al['cval'];
	}
	return $list;
}

################# SET SINGLE VALUE ################
function setSingleValue($table, $targetField, $val, $condition){
	global $tprefix;
	$query = "update ".$tprefix.$table." set ".$targetField." = '".$val."' ".$condition;
	if(mysql_query($query)){	
		return true;
	}else
	return false;
}
############### SUGGESTS ################
function getSuggests($tblname, $fieldName){
	global $tprefix;
	$lists	=	'';
	$result = mysql_query('select distinct '.$fieldName.' from '.$tprefix.$tblname);
	while($str = mysql_fetch_assoc($result)){
		$lists .='"'.$str[''.$fieldName.''].'",';
	}
	return substr($lists,0,strlen($lists)-1);
	
}

?>
