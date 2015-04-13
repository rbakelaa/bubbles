<?php
	
$error=''; // Variable To Store Error Message
session_start();
$_SESSION['logged_in'] = '0';


if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
	if (empty($_POST['username']) || empty($_POST['password'])) 
	{
		$error = "Username or Password is invalid";
	}
	else
	{
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect("localhost", "root", "");
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		// Selecting Database
		$db = mysql_select_db("bubbles", $connection);
		// SQL query to fetch information of registerd users and finds user match.
		$query = mysql_query("SELECT * FROM employees WHERE password='$password' AND username='$username'", $connection);
		$rows = mysql_num_rows($query);
		
		if ($rows == 1) 
		{
			$_SESSION['admin'] = 1;
			$_SESSION['logged_in'] = $username; // Initializing Session
			header("location: http://localhost/bubbles/index.php"); // Redirecting To Other Page
		} 
		else 
		{
			$_SESSION['admin'] = 0;
			$error = "Username or Password is invalid";
			header("location: http://localhost/bubbles/php/login.php");
		}
		mysql_close($connection); // Closing Connection

		if ($_SESSION['logged_in'] = $username)
		{

			header("location: http://localhost/bubbles/index.php");
		}
		else
		{
			header("location: http://localhost/bubbles/php/login.php");	
		}
	}
}
?>


<?php include_once('includes/layout.php'); echoLayoutTop();?>

		<!--Login form-->				
		<div class = "container page">
			<b><p>Login<p></b>
			<?php
				if(!isset($_SESSION['logged_in']))
				{
					echo "<p class='red'>Login failed</p>";
					session_destroy();
				}
			?>
			<form action = "" method = "post" autocorrect="off" autocomplete="off">
					<p>Username:</p>
					<p><input type = "text" name = "username" size = "25" placeholder = "Enter username"></p>
					<p>Password:</p>
					<p><input type = "password" name = "password" size = "25" placeholder = "Enter password"></p>
					<p><input type = "submit" name = "login" size = "25" value = "Login"></p>		
			</form>

			<?php

			echo $error;

			?>

			<!--Password reset link-->
			<p><a href = "reset-password.php">Forgot your password?</a></p>
		</div>

<?php echoLayoutBottom();?>