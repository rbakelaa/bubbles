<!--
********************************************************************************************
																						   *
	Author: Ryan Bakelaaar & Andrew Smith																   *
																						   *
	Database Applications Project														   *
																						   *
	Description: This website allows users to register, login, and reset their password.   *
				 The user will have administrative privileges if authorized by site owner. *
				 It also allows users to purchase items and add them into a shopping cart  *
	                                                                                       *
	File name: change-password.php                                                         *
	                                                                                       *
	File description: This page displays and processes the change password form.           *
	                                                                                       *
********************************************************************************************
-->

<?php include('includes/layout.php'); echoLayoutTop();?>

<?php

$empty = "";
$changed = "";
$confirm = "";
$wrong = "";

if($_SERVER['REQUEST_METHOD'] === 'POST')
{

	$userID = $_SESSION['userID'];
	//get POST variables
	$OldPass = $_POST['OldPass'];
	$NewPass = $_POST['NewPass'];
	$ReNewPass = $_POST['ReNewPass'];
	
	//Database info
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bubbles";

	//Connect to database
	$conn = new mysqli($servername, $username, $password, $dbname);

	//has the password
	$HashedOldPass = md5($OldPass);

	//query the database searching for a row that has $userID and $oldPass
	$sql = "SELECT * FROM `employees` WHERE `id` = '$userID' AND `password` = '$HashedOldPass'";
	$result = mysqli_query($conn, $sql);

	//If password is in the database
	if (mysqli_num_rows($result) > 0)
	{
		//If new pass is empty display an error message
		if (empty($NewPass))
		{
			$empty = "Fill in empty field!";
		}
		else if (empty ($ReNewPass))
		{
			$empty = "Fill in empty field!";

		}
		//Assign the user a temporary password if all fields are entered
		else 
		{
			//If the passwords match assign the user a temporary password
			if($NewPass == $ReNewPass)
			{
				$hashedPass = md5($NewPass); //Hash the temporary password in the database
				$sql = "UPDATE employees SET password='$hashedPass' WHERE id=$userID"; //Update the database with the temporary password
				//Assign the temporary password to the database
				if ($conn->query($sql)) 
				{				
					$changed = "Your password has been changed.";
				}
			}
			else
			{
				$confirm = "Your confirmed password did not match.";
			}
		}
	} 
	else 
	{
		$wrong = "Enter your old password.";
	}
	
}
?>

<?php

if (!isset($_SESSION['username']))
{

?>
<div class = "container page"> 
	<form method="POST">
		<h2>Change Password<h2>
			<p>Enter Old Password:</p>
			<p><input type = "password" name = "OldPass" size = "25" placeholder = "Enter old password"><b class = "red"> <?php echo $empty;?></b></p>
			<p>Enter New Password:</p>
			<p><input type = "password" name = "NewPass" size = "25" placeholder = "Enter password"><b class = "red"> <?php echo $empty;?></b></p>
			<p>Re-enter New Password:</p>
			<p><input type = "password" name = "ReNewPass" size = "25" placeholder = "Enter password"><b class = "red"> <?php echo $empty;?></b></p>
			
			<input type="submit" value="Submit">

			<p><?php echo $changed; echo $wrong; echo $confirm?></p>
	</form> 
</div>

<?php

}
else
{

?>
	<div class = "container page">

	<p>You must <a href = "http://localhost/bubbles/php/regular-login.php">login</a> to change your password</p> 

	</div>

<?php

}

?>

<?php echoLayoutBottom();?>

</body>
</html>