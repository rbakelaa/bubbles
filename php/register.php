<?php
include('includes/layout.php');
echoLayoutTop();
?>

<?php 
$usernameErr = "";
$firstnameErr = "";
$lastnameErr = "";
$emailErr = "";
$passwordErr = "";
$confirm_passwordErr = "";

$statusMsg = "";

$empty = "<b class = 'red'> Field cannot be empty</b>";
$validInput = true;

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	//Retrieve entered information
	$first_name = $_POST['firstname'];
	$last_name = $_POST['lastname'];
	$user_name = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];


	if (empty($_POST["username"])) 
	{
		$usernameErr = $empty;
		$validInput = false;
	} 
	else if (!preg_match("/^[a-zA-Z0-9]*$/",$user_name)) 
	{
        $usernameErr = "<b class = 'red'>Only letters and numbers allowed</b>"; 
		$validInput = false;
    }

	if (empty($_POST["firstname"])) 
	{
		$firstnameErr = $empty;	
		$validInput = false;
	} 
	else if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) 
	{
        $firstnameErr = "<b class = 'red'>Only letters and white space allowed</b>"; 
		$validInput = false;
    }
	if (empty($_POST["lastname"])) 
	{
		$lastnameErr = $empty;
		$validInput = false;
	} 
	else if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) 
	{
        $lastnameErr = "<b class = 'red'>Only letters and white space allowed</b>"; 
		$validInput = false;
    }
	if (empty($_POST["email"])) 
	{
		$emailErr = $empty;
		$validInput = false;
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
       	$emailErr = "<b class = 'red'>Invalid email format</b>"; 
		$validInput = false;
    }
	if (empty($_POST["password"]))
	{
		$passwordErr = $empty;
		$validInput = false;
	} 
	else if (!preg_match("/^[a-zA-Z0-9]*$/",$password))
	{
        $passwordErr = "<b class = 'red'>Only letters, numbers or symbols</b>"; 
		$validInput = false;
    }

	if (empty($_POST["confirm_password"])) 
	{
		$confirm_passwordErr = $empty;
		$validInput = false;
	}

	if($password != $confirm_password)
	{
		$confirm_passwordErr = "<b class = 'red'>Your passwords do not match</b>";
		$validInput = false;
	}

	if($validInput)
	{
		$password = md5($password); //Encrypt all passwords in database
		$database_connect = mysql_connect("localhost","root"); //Connect to database
		$database = mysql_select_db ("bubbles"); //Select database name
		$database_table = mysql_query("SELECT * FROM `employees`");//Select table
		$user_exists = false;//Set user exists to false
		
		//Fetch defined row in the database table
		while ($row = mysql_fetch_assoc($database_table))
		{
			//If username and email is already in the database
			if($row['username'] == $user_name or $row['email'] == $email)
			{
				//Set user exists to true
				$user_exists = true;
				//Display user already exists message
				$statusMsg = "<p class = 'red'>That user name already exists. Please choose a different one.</p>";
			}
		}
		//If user doesn't already exist
		if (!$user_exists)
		{
			//Insert the entered data into database
			mysql_query("INSERT INTO `employees`(`id`,`firstname`,`lastname`,`username`,`email`,`password`) VALUES (NULL,'$first_name','$last_name','$user_name','$email','$password')");
			//Display welcome message when registered
			$statusMsg = "<p>Welcome $user_name. Thanks for registering.";
		}
	}
}
?>

<?php
	
	if(!isset($_SESSION['username']))
	{	
		//if the user in not logged in then out the register and log in form
		echo $statusMsg;
?>
<!DOCTYPE <html></html>
<html>
<head>
	
</head>
<body>

<form method = "post">
					<b><p>User Registration</p></b>
					<p>User Name:</p>			<p><input type = "text" name = "username" size = "25" placeholder = "Enter user name"><?php echo $usernameErr;?></p>
					<p>First Name:</p>			<p><input type = "text" name = "firstname" size = "25" placeholder = "Enter first name"><?php echo $firstnameErr;?></p>
					<p>Last Name:</p>			<p><input type = "text" name = "lastname" size = "25" placeholder = "Enter last name"><?php echo $lastnameErr;?></p>
					<p>Email:</p>				<p><input type = "text" name = "email" size = "25" placeholder = "Enter email"><?php echo $emailErr;?></p>
					<p>Password:</p>			<p><input type = "password" name = "password" size = "25" placeholder = "Enter password"><?php echo $passwordErr;?></p>
					<p>Re-enter Password:</p>	<p><input type = "password" name = "confirm_password" size = "25" placeholder = "Re-enter password"><?php echo $confirm_passwordErr;?></p>
					<p><input type = "submit" name = "register" size = "25" value = "Register"></p></center>
			</form>
</body>
</html>

<?php

	}

	echoLayoutBottom();

?>