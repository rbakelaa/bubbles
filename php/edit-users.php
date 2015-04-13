
<?php include("includes/layout.php"); echoLayoutTop();?>
<?php
 // creates the edit record form
 function renderForm($id, $username,$firstname, $lastname, $admin_level,$error)
 {
 ?>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="color:red;">'.$error.'</div>';
 }
 ?> 
 <body>
 <div class = "container page"> 
 <form action="" method="post">
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
 <p><strong>User Name: *</strong> <input type="text" name="username" value="<?php echo $username; ?>"/><br/></p>
 <p><strong>First Name: *</strong> <input type="text" name="firstname" value="<?php echo $firstname; ?>"/><br/></p>
 <p><strong>Last Name: *</strong> <input type="text" name="lastname" value="<?php echo $lastname; ?>"/><br/></p>
 <p><select name = "admin_level">
		<?php
		//select drop down select name and db table 
		$sql = "SELECT admin FROM employees";
		//create a query in the database
		$result = mysql_query($sql);
		//fetch the associated value in the table and display it in the dropdown
	  	while ($row = mysql_fetch_array($result)) 
	  	{
				echo "<option value='" . $row['admin_level'] ."'>" . $row['admin_level'] ."</option>";
		}
		?>

	<option value="0">Employee</option>
	<option value="1">Administrator</option>
</select>	
 <input type="submit" name="submit" value="Submit">
 </form> 
 </div>
 </body> 
 <?php
 }



 // connect to the database
 // Database Variables 
 $server = 'localhost';
 $user = 'root';
 $pass = '';
 $db = 'bubbles';
 
 // Connect to Database
 $connection = mysql_connect($server, $user, $pass) or die  (mysql_error ());
 mysql_select_db($db) or die (mysql_error ());
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['id']))
 {
 // get form data, making sure it is valid
 $id = $_POST['id'];
 $username = mysql_real_escape_string(htmlspecialchars($_POST['username']));
 $firstname = mysql_real_escape_string(htmlspecialchars($_POST['firstname']));
 $lastname = mysql_real_escape_string(htmlspecialchars($_POST['lastname']));
 $admin_level = mysql_real_escape_string(htmlspecialchars($_POST['admin_level']));
 
 // check that firstname/lastname fields are both filled in
 if ($username == '' || $firstname == '' || $lastname == '')
 {
 // generate error message
 $error = 'Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $username, $firstname, $lastname, $admin_level, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT INTO `employees`(`id`,`firstname`,`lastname`,`username`'password',`admin`) VALUES ('$first_name','$last_name','$user_name','$password','$admin_level')")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: http://localhost/bubbles/php/view-users.php"); 
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
 $result = mysql_query("SELECT * FROM employees WHERE id= '$id' ")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $username = $row['username'];
 $firstname = $row['firstname'];
 $lastname = $row['lastname'];
 $admin_level = $row['admin_level'];
 
 // show form
 renderForm($id, $username, $firstname, $lastname,$admin_level, '');
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
<?php echoLayoutBottom();?>