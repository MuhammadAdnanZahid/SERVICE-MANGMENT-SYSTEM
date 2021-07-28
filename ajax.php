<?php 
require_once("app_configurations/db_settings.php");
require_once("app_configurations/functions.php");

#----------------------------------------------------------------Admin Login Form
	if(isset($_POST['lusername'])){ 		
		if(validateLogin($_POST['lusername'],$_POST['password'])){
			echo "authenticated";
		}
		else{
			$_SESSION['esms'] 		=	 'Please re-check your credentials...!';
		}
	}
#----------------------------------------------------------------ACCOUNT PROFILE 
if(isset($_POST['cuserid'])){
	if(updateuserProfile())
		echo $msg='Profile Updated!';
	else
		echo $msg='Profile Updated!';
} 
if (isset($_POST['sysactionz'])) {
	$resp = sysActions($_POST['sysactionz'],$_POST['sysvalz']);
	if($resp===true){
		echo $msg = 'Action Successfull.....';
	}
	else if($resp===false){
		echo $msg = 'Action Failed.....';
	}else{
		echo $resp;
	}
}
#----------------------------------------------------------------Site Data
if(isset($_POST['sitename'])){
	if(manageSiteData())
		echo $msg='Default Site Data Updated...!';
	else
		echo $msg='Action failed..!';
} 
#----------------------------------------------------------------Settings
if(isset($_POST['setting_title'])){
	if(manageSettings())
		echo $msg='Action successfull..!';
	else
		echo $msg='Action Failed..!';
} 

if (isset($_POST['settingactionz'])) {
	$resp = formSettingsActions($_POST['settingactionz'],$_POST['settingvalz']);
	
	if($resp===true){
		echo $msg = 'Action Successfull.....';
	}
	else if($resp===false){
		echo $msg = 'Action Failed.....';
	}else{
		echo $resp;
	}
}

#----------------------------------------------------------------Amenities
if(isset($_POST['ameniti_name'])){
	if(manageAmenities())
		echo $msg='Action successfull..!';
	else
		echo $msg='Action Failed..!';
} 

if (isset($_POST['Amenitiactionz'])) {
	$resp = amenitiesActions($_POST['Amenitiactionz'],$_POST['Amenitivalz']);
	if($resp===true){
		echo $msg = 'Action Successfull.....';
	}
	else if($resp===false){
		echo $msg = 'Action Failed.....';
	}else{
		echo $resp;
	}
}

#----------------------------------------------------------------Paid Services
if(isset($_POST['paidservice_title'])){
	if(managePaidServices())
		echo $msg='Action successfull..!';
	else
		echo $msg='Action Failed..!';
} 

if (isset($_POST['Paidactionz'])) {
	$resp = paidServiceActions($_POST['Paidactionz'],$_POST['paidvalz']);
	if($resp===true){
		echo $msg = 'Action Successfull.....';
	}
	else if($resp===false){
		echo $msg = 'Action Failed.....';
	}else{
		echo $resp;
	}
}

#----------------------------------------------------------------House Keeping
if(isset($_POST['housekeeping_name'])){
	if(managehousekeeping())
		echo $msg='Action successfull..!';
	else
		echo $msg='Action Failed..!';
} 

if (isset($_POST['hkactionz'])) {
	$resp = housekeepingActions($_POST['hkactionz'],$_POST['hkvalz']);
	if($resp===true){
		echo $msg = 'Action Successfull.....';
	}
	else if($resp===false){
		echo $msg = 'Action Failed.....';
	}else{
		echo $resp;
	}
}

#----------------------------------------------------------------Floor
if(isset($_POST['floor_title'])){
	if(manageFloor())
		echo $msg='Action successfull..!';
	else
		echo $msg='Action Failed..!';
} 

if (isset($_POST['flooractionz'])) {
	$resp = floorActions($_POST['flooractionz'],$_POST['floorvalz']);
	if($resp===true){
		echo $msg = 'Action Successfull.....';
	}
	else if($resp===false){
		echo $msg = 'Action Failed.....';
	}else{
		echo $resp;
	}
}

#----------------------------------------------------------------RoomType
if(isset($_POST['roomtype_title'])){
	if(manageRoomtype())
		echo $msg='Action successfull..!';
	else
		echo $msg='Action Failed..!';
} 

if (isset($_POST['rtactionz'])) {
	$resp = rtActions($_POST['rtactionz'],$_POST['rtvalz']);
	if($resp===true){
		echo $msg = 'Action Successfull.....';
	}
	else if($resp===false){
		echo $msg = 'Action Failed.....';
	}else{
		echo $resp;
	}
}

#------------------------------------------------------------ROOMS

if(isset($_POST['room_number'])){
	if(manageRoom())
		echo $msg='Action successfull..!';
	else
		echo $msg='Action Failed..!';
}

if(isset($_POST['roomactionz'])){
	$resp = roomActions($_POST['roomactionz'],$_POST['roomvalz']);
	if ($resp===true) {
		echo $msg = 'Action Successfull.....';
	}
	else if($resp===false){
		echo $msg = 'Action Failed.....';
	}else{
		echo $resp;
	}
}

#------------------------------------------------------------Guest Details

if(isset($_POST['guest_name'])){
	if(manageGuest())
		echo $msg='Action successfull..!';
	else
		echo $msg='Action Failed..!';
}

if(isset($_POST['guestactionz'])){
	$resp = guestActions($_POST['guestactionz'],$_POST['guestvalz']);
	if ($resp===true) {
		echo $msg = 'Action Successfull.....';
	}
	else if($resp===false){
		echo $msg = 'Action Failed.....';
	}else{
		echo $resp;
	}
}

#------------------------------------------------------------Agent Details

if(isset($_POST['agent_title'])){
	if(manageAgent())
		echo $msg='Action successfull..!';
	else
		echo $msg='Action Failed..!';
}

if(isset($_POST['agentactionz'])){
	$resp = agentActions($_POST['agentactionz'],$_POST['agentvalz']);
	if ($resp===true) {
		echo $msg = 'Action Successfull.....';
	}
	else if($resp===false){
		echo $msg = 'Action Failed.....';
	}else{
		echo $resp;
	}
}

#------------------------------------------------------------CoupenDetails

if(isset($_POST['coupen_name'])){
	if(manageCoupen())
		echo $msg='Action successfull..!';
	else
		echo $msg='Action Failed..!';
}

if(isset($_POST['coupenactionz'])){
	$resp = coupenActions($_POST['coupenactionz'],$_POST['coupenvalz']);
	if ($resp===true) {
		echo $msg = 'Action Successfull.....';
	}
	else if($resp===false){
		echo $msg = 'Action Failed.....';
	}else{
		echo $resp;
	}
}

#------------------------------------------------------------BookingDetails

if(isset($_POST['check_in_date'])){
	if(manageBooking())
		echo $msg='Action successfull..!';
	else
		echo $msg='Action Failed..!';
}

if(isset($_POST['bookingactionz'])){
	$resp = bookingActions($_POST['bookingactionz'],$_POST['bookingvalz']);
	if ($resp===true) {
		echo $msg = 'Action Successfull.....';
	}
	else if($resp===false){
		echo $msg = 'Action Failed.....';
	}else{
		echo $resp;
	}
}

// ----------------------------------------------------------Practice

if (isset($_POST['practice_title'])) {
	if(managePractice()){
		echo $msg = 'Action Successfull.....';
	}else{
		echo $mag = 'Action Failed';
	}
}

if (isset($_POST['formactionz'])) {
	$resp = formActions($_POST['formactionz'],$_POST['formvalz']);
	if($resp===true){
		echo $msg = 'Action Successfull.....';
	}
	else if($resp===false){
		echo $msg = 'Action Failed.....';
	}else{
		echo $resp;
	}
}














################### Banners ##################
if(isset($_POST['bnrheading'])){
	if(manageSliders())
		echo $msg='<div class="alert alert-info"> <button data-dismiss="alert" class="close" type="button">  <i class="icon-remove"></i></button>
            <strong style="color:#149e06">Action successfull..!</strong> <br></div>';
	else
		echo $msg='<div class="alert alert-warning"> <button data-dismiss="alert" class="close" type="button">  <i class="icon-remove"></i></button>
            <strong style="color:#F00">Action Failed..!</strong> <br></div>';
} 


################### ACCOUNT PROFILE ##################
if(isset($_POST['member_name'])){
	if(manageMembers())
		echo $msg='<div class="alert alert-info"> <button data-dismiss="alert" class="close" type="button">  <i class="icon-remove"></i></button>
            <strong style="color:#149e06">Action successfull..!</strong> <br></div>';
	else
		echo $msg='<div class="alert alert-warning"> <button data-dismiss="alert" class="close" type="button">  <i class="icon-remove"></i></button>
            <strong style="color:#F00">Action Failed..!</strong> <br></div>';
} 

################### PAGES FORM ##################
if(isset($_POST['pslug'])){
	if(managePages())
		echo $msg='<div class="alert alert-info"> <button data-dismiss="alert" class="close" type="button">  <i class="icon-remove"></i></button>
            <strong style="color:#149e06">Action successfull..!</strong> <br></div>';
	else
		echo $msg='<div class="alert alert-warning"> <button data-dismiss="alert" class="close" type="button">  <i class="icon-remove"></i></button>
            <strong style="color:#F00">Action Failed..!</strong> <br></div>';
} 
################### PIC GAL FORM ##################
if(isset($_POST['torp'])){
	if(manageGallaries())
		echo $msg='<div class="alert alert-info"> <button data-dismiss="alert" class="close" type="button">  <i class="icon-remove"></i></button>
            <strong style="color:#149e06">Action successfull..!</strong> <br></div>';
	else
		echo $msg='<div class="alert alert-warning"> <button data-dismiss="alert" class="close" type="button">  <i class="icon-remove"></i></button>
            <strong style="color:#F00">Action Failed..!</strong> <br></div>';
}  


################### TEMPLATES FORM ##################
if(isset($_POST['event_title'])){
	$event_title	=	$_POST['event_title'];
	$event_start 	=	$_POST['event_start']; 
	$event_end 		=	$_POST['event_end'];
	$event_allday 	=	$_POST['event_allday']; 
	$eid		 	=	$_POST['updateeventid']; 
	if(manageEvents($event_title,$event_start,$event_end,$event_allday ,$eid))
		echo $msg='ok';
	else
		echo $msg='err';
}
################### District Values #################
if(isset($_POST['partnerid'])){
	 echo getLists('partners_district', 'district_name', 'district_id',0, ' where partner_id='.$_POST['partnerid']);
}

################### eventssid #################
if(isset($_POST['eventssid'])){
	 echo getSingleValue('events', ' userid ', ' where eid='.$_POST['eventssid']);
}
if(isset($_POST['deleventid'])){
	//$x = $_POST['deleventid']-1;
	if(mysql_query('delete from aims_events where eid='.$_POST['deleventid'])); echo true;
	//if(mysql_query('delete from aims_events where eid = (select eid from (select eid from aims_events order by id limit $x-1,1) as t)'));
	
	
}




################### Duplicate Values #################
if(isset($_POST['duplicate'])){
	if(getDuplicateVal($_POST['duplicate'],$_POST['tbl'],$_POST['field'] ))
		echo $msg='duplicate';
	else
		echo $msg='ok';
}
?>