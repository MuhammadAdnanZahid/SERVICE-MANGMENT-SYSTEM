<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "sms";

// Create db Concetion

 $conn = new mysqli ($db_host,$db_user,$db_password,$db_name);

//  checking Connection
  
   if($conn->connect_error){
       die("Connection Failed");
   } 
//    else{
//        echo "Connect Successful";
//    }

?>