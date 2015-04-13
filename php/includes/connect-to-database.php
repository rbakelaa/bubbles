<?php

	// Database Variables (edit with your own server information)
	$server = "localhost";
	$user = "root";
	$pass = "";
	$db = "bubbles";
	
	// Connect to Database
	$connection = mysql_connect($server, $user, $pass) or die (mysql_error ());
	mysql_select_db($db) or die (mysql_error ());


?>