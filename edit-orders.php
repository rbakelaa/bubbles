
<?php
 // creates the edit record form
 function renderForm($id, $username,$firstname, $lastname, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 </head>
 <body>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
	 echo '<div style="color:red;">'.$error.'</div>';
 }
 ?> 
 
 <div id = "main_page">
 <div class = "container page"> 
 <form action="" method="post">
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
 <div>
 <p><strong>Name: 	 *</strong> <input type="text" name="name" value="<?php echo $name; ?>"/><br/></p>
 <p><strong>Due Date (ex: yyyy-mm-dd):  *</strong> <input type="text" name="dueDate" value="<?php echo $dueDate; ?>"/><br/></p>
 <p><strong># of Pages  *</strong> <input type="text" name="numOfPages" value="<?php echo $numOfPages; ?>"/><br/></p>
 <p><strong># of Copies  *</strong> <input type="text" name="numOfPages" value="<?php echo $numOfCopies; ?>"/><br/></p>
 <p><strong>Paper Size *</strong>
	 					<select name = "paperSize" value="<?php echo $paperSize; ?>">
							<option value="8.5x11in">8.5x11in</option>
							<option value="8.5x14in">8.5x14in</option>
							<option value="11x17in">11x17in</option>
						</select><br/></p>
 <p><strong>Paper Color *</strong> 
 						<select name = "paperColor" value="<?php echo $paperColor; ?>">
							<option value = "pulsar pink">Pulsar Pink</option>
							<option value = "fireball fuchsia">Fireball Fuchsia</option>
							<option value = "plasma pink">Plasma Pink</option>
							<option value = "re-entry red">Re-entry Red</option>
							<option value = "rocket red">Rocket Red</option>
							<option value = "cosmic orange">Cosmic Orange</option>
							<option value = "galaxy gold">Galaxy Gold</option>
							<option value = "solar yellow">Solar Yellow</option>
							<option value = "venus violet">Venus Violet</option>
							<option value = "planetary purple">Planetary Purple</option>
							<option value = "celestial blue">Celestial Blue</option>
							<option value = "lunar blue">Lunar Blue</option>
							<option value = "gamma green">Gamma Green</option>
							<option value = "martian green">Martian Green</option>
							<option value = "terra green">Terra Green</option>
							<option value = "lift-off lemmon">Lift-off Lemon</option>
						</select><br/></p>
 <p><strong>Weight *</strong> 
 					<select name = "weight" value="<?php echo $weight; ?>">
						<option value="20lbs">20lbs</option>
						<option value="60lbs">60lbs</option>
						<option value="65lbs">65lbs</option>
					</select>	<br/></p>
 <p><strong>Finishing *</strong>	
 					<select name = "finishing" value="<?php echo $finishing; ?>">
						<option value="none">None</option>
						<option value="cutting">Cutting</option>
						<option value="folding">Folding</option>
						<option value="quaters">Quaters</option>
						<option value="binding">Bindings</option>
					</select>	<br/></p>
 <p><strong>Payment method *</strong> 	
 					<select name = "paymentMethod" value="<?php echo $paymentMethod; ?>">
						<option value="Cash">Cash</option>
						<option value="Credit">Credit</option>
						<option value="Check">Check</option>
						<option value="Wilscard">Wilscard</option>
					</select>	<br/></p>
 <p><strong>Ink Color *</strong> 
 					<select name = "inkColor" value="<?php echo $inkColor; ?>">
						<option value="Black">Black</option>
						<option value="White">White</option>
					</select><br/></p>
 <p><strong>Double Sided? *</strong> 	
 					<select name = "doubleSided" value="<?php echo $doubleSided; ?>">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>	<br/></p>
 <input type="submit" name="submit" value="Submit">
 </div>
 </div>
 </div>
 </form> 
 </body>
 </html> 
 <?php
 }



 // connect to the database
 // Database Variables 
 $server = 'localhost';
 $user = 'root';
 $pass = '';
 $db = 'bubbles';
 
 // Connect to Database
 $connection = mysql_connect($server, $user, $pass) or die ("Could not connect to server ... \n" . mysql_error ());
 mysql_select_db($db) or die ("Could not connect to database ... \n" . mysql_error ());
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['id']))
 {
 	//get form data, making sure it is valid
 	$name = $_POST["name"];
 	$dueDate = $_POST["dueDate"];
 	$numOfPages = $_POST["numOfPages"];
  	$numOfCopies = $_POST["numOfCopies"];
   	$paperSize = $_POST["paperSize"];
    $paperColor = $_POST["paperColor"];
   	$weight = $_POST["weight"];
    $finishing = $_POST["finishing"];
    $paymentMethod = $_POST["paymentMethod"];
    $printColor = $_POST["printColor"];
    $doubleSided = $_POST["doubleSided"];
    $comment = mysql_real_escape_string($_POST["comment"]);
 
 // check that firstname/lastname fields are both filled in
 if ($name == '' || $dueDate == '' || $numOfPages == '' || $numOfCopies == '')
 {
 	// generate error message
 	$error = 'Please fill in all required fields!';
 
 	//error, display form
	renderForm($name,
 		 			$dueDate,
 		 			$numOfPages,
 		 			$numOfCopies,
 		 			$paperSize,
 		 			$paperColor,
 		 			$weight,
 		 			$finishing,
 		 			$paymentMethod,
 		 			$inkColor,
 		 			$doubleSided,
 		 			$error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE orders SET name = '$name', due_date ='$dueDate', numOfPages ='$numOfPages',  WHERE id='$id'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: http://localhost/websiteryanbakelaar/ControlPanel/ManageUsers/manage-users.php"); 
 }
 }
 else
 {
 // if the 'id' isn't valid, display an error
 echo 'Error!';
 }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
 {
 // query db
 $id = $_GET['id'];
 $result = mysql_query("SELECT * FROM users WHERE id= '$id' ")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $username = $row['username'];
 $firstname = $row['firstname'];
 $lastname = $row['lastname'];
 
 // show form
 renderForm($id, $username, $firstname, $lastname, '');
 }
 else
 // if no match, display result
 {
 echo "No results!";
 }
 }
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 {
 echo 'Error!';
 }
 }
?>
<?php include("../../Layout/footer.php");?>