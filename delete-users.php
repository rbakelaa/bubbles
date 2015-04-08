<?php

 // connect to the database
 $server = 'localhost';
 $user = 'root';
 $pass = '';
 $db = 'bubbles';

 $connection = mysql_connect($server, $user, $pass) or die ("Could not connect to server ... \n" . mysql_error ());
 
 mysql_select_db($db) or die ("Could not connect to database ... \n" . mysql_error ());
 
 // check if the 'id' variable is set in URL, and check that it is valid
 if (isset($_GET['id']) && is_numeric($_GET['id']))
 {
 	// get id value
 	$id = $_GET['id'];
 
 	// delete the entry
 	$result = mysql_query("DELETE FROM employees WHERE id = '$id'") or die(mysql_error()); 
 
 	// redirect back to the view page
 	header("Location: http://localhost/bubbles/view-users.php");

 }
 else
 {
 	// if id isn't set, or isn't valid, redirect back to view page
    header("Location: http://localhost/bubbles/view-users.php");  
 }
 
?>