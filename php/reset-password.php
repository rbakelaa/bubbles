<!--
********************************************************************************************
																						   *
	Author: Ryan Bakelaaar & Andrew Smith												   *
																						   *
	Database Applications Project														   *
																						   *
	Description: This website allows users to register, login, and reset their password.   *
				 The user will have administrative privileges if authorized by site owner. *
				 It also allows users to purchase items and add them into a shopping cart  *
	                                                                                       *
	File name: forgot_password.php                                                         *
	                                                                                       *
	File description: This page displays step 1 of the password reset form.                *
	                                                                                       *
********************************************************************************************
-->

<?php include('includes/layout.php'); echoLayoutTop();?>

<!Doctype html>
<html>
<body>
		<div class = "container page"> 
		<!--Start of main page content-->
		
		<?php

		$error = "";
		
		//Check if the form has been submited
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
			$email = $_POST['email']; //Retrieve email info from field 
			$newPass = rand(100000000,999999999); //Generate a random pass between 100000000 and 999999999
			$hashedPass; //used to store the hash password

			$servername = "localhost"; //Set database server name  
			$username = "root"; //Set database user name 
			$password = ""; //Set database password
			$dbname = "bubbles"; //Set database name
			$conn = new mysqli($servername, $username, $password, $dbname); //Connect to the database

			//check if the database connect worked
			if ($conn->connect_error) 
			{
				die("Connection failed: " . $conn->connect_error);
			}
		
			//query the database to get users and store the results in $result
			$sql = "SELECT * FROM employees";
			$result = $conn->query($sql); 

			//if there were any reults
			if ($result->num_rows > 0) 
			{
				//go through each row of the result
				while($row = $result->fetch_assoc()) 
				{
					if($row['email'] == $email)
					{
						$userID = $row['id'];
						$username = $row['username'];
						$hashedPass = md5($newPass);
						$sql = "UPDATE employees SET password='$hashedPass' WHERE id=$userID";
				
						if ($conn->query($sql)) 
						{			

							if (isset($_SESSION['username']))
							{

								echo "<p>Your temporary password is $newPass. You can now <a href='http://localhost/bubbles/php/change-password.php'>change</a> your password.</p>";
							}
							else
							{
								echo "<p>Your temporary password is $newPass. You can now <a href='http://localhost/bubbles/php/regular-login.php'>login</a> to change your password.</p>";
							}	
						}
					}
				}
			}
			else 
			{
				$error = "Field is empty";
			}
			$conn->close();
		}
		?>
		
		<form method = "post">
			<p><b>Enter your email:</b></p>
			<p class = "red"><input type="text" name="email"><?php echo "&nbsp;" . $error;?></p>
			<p><input type="submit" value="Submit"></p>
		</form>	
		<!--End of main page content-->
		</div>
</body>
<?php echoLayoutBottom();?>
</html>