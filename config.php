<?php

/**
 * Config.php
 * Application Database connection string.
 * Publisher - SiteStorms
 * Author - Dinesh Kumar Muthukrishnan
**/

// display all error except deprecated and notice  
	//error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
        error_reporting(0);

/* setting time zone */
	date_default_timezone_set('Asia/Kolkata');

/* setting access orgin to all */
	header('Access-Control-Allow-Origin: *');

	$db_host = "localhost";	$db_user = "primestarbeta";	$db_pass = "kWIAP(%uugBa";	$db_name = "primestarbeta";		$db_port = "3306";

/* Making connection with DB*/	


    $con=mysqli_connect("$db_host","$db_user","$db_pass","$db_name","$db_port");

	if( mysqli_connect_error() ){
		echo 'connect to database failed'.mysqli_connect_error();exit();
	}
	
	
	
	
	
?>
