<?php	session_start();
		$_SESSION['defaultsite']=1;

		#----- Errot Reporting Settings-----#
			 error_reporting (E_ALL ^ E_NOTICE);
			//error_reporting(0);
		
		#-----include app_configuration-----#
		require_once("app_configurations/dbcon.php");
		// require_once("app_configurations/functions.php");
		
?>		