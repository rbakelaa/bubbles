<?php
include('_layout.php');
echoLayoutTop();
?>

<?php
$fName;
$lName;
$email;
$pass;
$passConfirm;

$fNameErr = $lNameErr = $emailErr = $passErr = $passConfirmErr = "";

$validInput = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	//validate fName input
	if (empty($_POST["fName"])) {
		$fNameErr = "First name is required";

		$validInput = false;
	} else {
		$fName = $_POST["fName"];

		// check if fName only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$fName)) {
			$fNameErr = "Only letters and white space allowed"; 

			$validInput = false;
		}
	}

	//validate lName input
	if (empty($_POST["lName"])) {
		$lNameErr = "Last name is required";

		$validInput = false;
	} else {
		$lName = $_POST["lName"];

		// check if lName only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$lName)) {
			$lNameErr = "Only letters and white space allowed"; 

			$validInput = false;
		}
	}

	//valid email input
	if (empty($_POST["email"])) {
		$emailErr = "Name is required";

		$validInput = false;
	} else {
		$email = $_POST["email"];

    	// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email address"; 

			$validInput = false;
		}
	}

	//valid pass input
	if (empty($_POST["pass"])) {
		$passErr = "Password is required";

		$validInput = false;
	} else {
		$pass = $_POST["pass"];

		if ($pass < 8) {

			$passErr = "Password must be atleast 8 characters"; 
			$validInput = false;

		}elseif (!preg_match('@[A-Z]@', $pass)) {

			$passErr = "Password must contain atleast 1 captial"; 
			$validInput = false;

		} elseif (!preg_match('@[a-z]@', $pass)) {

			$passErr = "Password must contain atleast 1 lowcase"; 
			$validInput = false;

		} elseif (!preg_match('@[0-9]@', $pass)) {

			$passErr = "Password must contain atleast 1 number"; 
			$validInput = false;
		}
	}

	//check if passwords match
	if ($_POST["pass"] != $_POST["passConfirm"]){
		$passConfirmErr = "Passwords did not match";
		$validInput = false;
	}
}

?>

<form action="" method="post">

	<p>First name <br> <input type="text" name="fName"> <?php echo $fNameErr;?></p>
	<p>Last name <br> <input type="text" name="lName"> <?php echo $lNameErr;?></p>
	<p>Email <br> <input type="text" name="email"> <?php echo $emailErr;?></p>
	<p>Password <br> <input type="password" name="pass"> <?php echo $passErr;?></p>
	<p>Password confirmation <br> <input type="password" name="passConfirm"> <?php echo $passConfirmErr;?></p>

	<input type="submit" value="Register">
</form>

<?php
echoLayoutBottom();
?>