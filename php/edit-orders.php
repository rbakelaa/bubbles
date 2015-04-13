<?php include('includes/layout.php'); echoLayoutTop(); ?>

<?php

function displayForm($id,
					$name,
	 		 		$dueDate,
	 		 		$numOfPages,
	 		 		$numOfCopies,
	 		 		$paperSize,
	 		 		$paperColor,
	 		 		$weight,
	 		 		$finishing,
	 		 		$paymentMethod,
	 		 		$printColor,
	 		 		$comment,
	 		 		$status,
	 		 		$error)
{

?>
	 <body>
	 <div class = "container page">
	 <form action"" method="post">
	 	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		<div class="floatLeft">
						<p>Name: 							<br /> <input type="text" name="name" value="<?php echo $name; ?>"/></p>
						<p>Due Date (ex: yyyy-mm-dd): 		<br /> <input type="datetime" name="dueDate" value="<?php echo $dueDate; ?>" /></p>
						<p># of Pages 						<br /> <input type="number" name="numOfPages" value="<?php echo $numOfPages; ?>"/></p>
						<p># of Copies 						<br /> <input type="number" name="numOfCopies" value="<?php echo $numOfCopies; ?>"/></p>
					</div>
					<div class="floatLeft">	
						<p>Paper Size<br /> 
						<select name = "paperSize">
		<?php
		//select drop down select name and db table 
		$sql = "SELECT paper_size FROM orders";
		//create a query in the database
		$result = mysql_query($sql);
		//fetch the associated value in the table and display it in the dropdown
	  	while ($row = mysql_fetch_array($result)) 
	  	{
				echo "<option value='" . $row['paper_size'] ."'>" . $row['paper_size'] ."</option>";
		}
		?>

							<option value="8.5 x 11in">8.5 x 11 inches</option>
							<option value="8.5 x 14in">8.5 x 14 inches</option>
							<option value="11 x 17in">11 x 17 inches</option>
						</select>			
						</p>
						<p>Paper Color<br /> 
						<select name = "paperColor">
		<?php
		//select drop down select name and db table 
		$sql = "SELECT paper_color FROM orders";
		//create a query in the database
		$result = mysql_query($sql);
		//fetch the associated value in the table and display it in the dropdown
	  	while ($row = mysql_fetch_array($result)) 
	  	{
				echo "<option value='" . $row['paper_color'] ."'>" . $row['paper_color'] ."</option>";
		}
		?>
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
						</select>			
						</p>
						<p>Weight<br/> 
						<select name = "weight">
		<?php
		//select drop down select name and db table 
		$sql = "SELECT weight FROM orders";
		//create a query in the database
		$result = mysql_query($sql);
		//fetch the associated value in the table and display it in the dropdown
	  	while ($row = mysql_fetch_array($result)) 
	  	{
				echo "<option value='" . $row['weight'] ."'>" . $row['weight'] ."</option>";
		}
		?>
						<option value="20lbs">20lbs</option>
						<option value="60lbs">60lbs</option>
						<option value="65lbs">65lbs</option>
						</select>			
						</p>
						<p>Finishing<br /> 
					<select name = "finishing">
		<?php
		//select drop down select name and db table 
		$sql = "SELECT finishing FROM orders";
		//create a query in the database
		$result = mysql_query($sql);
		//fetch the associated value in the table and display it in the dropdown
	  	while ($row = mysql_fetch_array($result)) 
	  	{
				echo "<option value='" . $row['finishing'] ."'>" . $row['finishing'] ."</option>";
		}
		?>
						<option value="none">None</option>
						<option value="cutting">Cutting</option>
						<option value="folding">Folding</option>
						<option value="quaters">Quaters</option>
						<option value="binding">Bindings</option>
					</select>			
					</p>
					<p>Payment method<br /> 
					<select name = "paymentMethod">
		<?php
		//select drop down select name and db table 
		$sql = "SELECT payment_method FROM orders";
		//create a query in the database
		$result = mysql_query($sql);
		//fetch the associated value in the table and display it in the dropdown
		while ($row = mysql_fetch_array($result)) 
		{
   		   echo "<option value='" . $row['payment_method'] ."'>" . $row['payment_method'] ."</option>";
		}
		?>
						<option value="Cash">Cash</option>
						<option value="Credit">Credit</option>
						<option value="Check">Check</option>
						<option value="Wilscard">Wilscard</option>
					</select>			
					</p>
					<p>Print BW/C<br /> 
					<select name = "printColor">
		<?php
		//select drop down select name and db table
		$sql = "SELECT color FROM orders";
		//create a query in the database
		$result = mysql_query($sql);
		//fetch the associated value in the table and display it in the dropdown
	  	while ($row = mysql_fetch_array($result)) 
	  	{
				echo "<option value='" . $row['color'] ."'>" . $row['color'] ."</option>";
		}
		?>
						<option value="Black">Black</option>
						<option value="White">White</option>
						<option value="Color">Color</option>
					</select>
					</p>			
					</p>
					</div>
					<div class="floatLeft">
					<p>Status<br /> 
					<select name = "status">
		<?php
		//select drop down select name and db table
		$sql = "SELECT status FROM orders";
		//create a query in the database
		$result = mysql_query($sql);
		//fetch the associated value in the table and display it in the dropdown
		while ($row = mysql_fetch_array($result)) 
		{
   			echo "<option value='" . $row['status'] ."'>" . $row['status'] ."</option>";
		}
			?>
						<option value="Recieved">Received</option>
						<option value="In Progress">In Progress</option>
						<option value="Completed">Completed</option>
					</select>	
					<p>Comment (Cannot exceed 200 characters):<br />
				  	<textarea name="comment"></textarea><br />
				  	</p>
					<input type="submit" value="Edit Order" />
	 </div>
	</div>
	 </body>
<?php
//end of function
}

// connect to the database
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'bubbles';

//Connect to the database
$connection = mysql_connect($server, $user, $pass) or die (mysql_error ());

//Select the database name
$select = mysql_select_db($database) or die (mysql_error ()); 
 
// check if the form has been submitted. If it has, process the form and save it to the database
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{ 

	// confirm that the 'id' value is a valid integer before getting the form data
	if (is_numeric($_POST['id']))
	{

	  	//Get form data to make sure it's valid
	 	$id = $_POST["id"];
	 	$name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
	 	$dueDate = mysql_real_escape_string(htmlspecialchars($_POST['dueDate']));
	 	$numOfPages = mysql_real_escape_string(htmlspecialchars($_POST['numOfPages']));
	 	$numOfCopies = mysql_real_escape_string(htmlspecialchars($_POST['numOfCopies']));
	  	$paperSize = mysql_real_escape_string(htmlspecialchars($_POST['paperSize']));
	   	$paperColor = mysql_real_escape_string(htmlspecialchars($_POST['paperColor']));
	    $weight = mysql_real_escape_string(htmlspecialchars($_POST['weight']));
	   	$finishing = mysql_real_escape_string(htmlspecialchars($_POST['finishing']));
	    $paymentMethod = mysql_real_escape_string(htmlspecialchars($_POST['paymentMethod']));
	    $printColor = mysql_real_escape_string(htmlspecialchars($_POST['printColor']));
	    $status = mysql_real_escape_string(htmlspecialchars($_POST['status']));
	    $comment = mysql_real_escape_string(htmlspecialchars($_POST['comment']));
	 
	    // check that firstname/lastname fields are both filled in
		if ($name == '' || $dueDate == '' || $numOfPages == '' || $numOfCopies == '')
		{
			// generate error message
			$error = 'Please fill in all required fields!';

		    //error, display form
		    displayForm($id,
				       $name,
			 		   $dueDate,
			 		   $numOfPages,
			 		   $numOfCopies,
			 		   $paperSize,
			 		   $paperColor,
			 		   $weight,
			 		   $finishing,
			 		   $paymentMethod,
			 		   $printColor,
			 		   $comment,
			 		   $status,
			 		   $error);
		}
		else
		{
			//update table query	
			$sql = ("UPDATE orders SET `name` = '".$name."',
    								   due_date = '".$dueDate."',
								       numOfPages = '".$numOfPages."',
								       numOfCopies = '".$numOfCopies."',
								       paper_size = '".$paperSize."',
								       paper_color = '".$paperColor."',
								       weight = '".$weight."',
								       finishing = '".$finishing."',
								       payment_method = '".$paymentMethod."',
								       color = '".$printColor."',
								       comments = '".$comment."',
								      `status` = '".$status."' WHERE id = '".$id."'");
			//execute the query update
			mysql_query($sql) or die (mysql_error());

			// once saved, redirect back to the view page
			header("Location: http://localhost/Bubbles/view-orders.php"); 
		}
	}
	else
	{
	 	// if the 'id' isn't valid, display an error
	 	echo 'Error!';
	}
}
else
{
 	// if the form hasn't been submitted, get the data from the db and display the form
 
	// get the 'id' value from the URL (if it exists), making sure that it is valid 
	if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
	{
		// query db
		$id = $_GET['id'];
		$result = mysql_query("SELECT * FROM orders WHERE id = '$id'") or die(mysql_error()); 
		$row = mysql_fetch_array($result);
	 
	 	// check that the 'id' matches up with a row in the databse
		if($row)
		{
		 
			// get data from db
			$id = $row['id'];
	 		$name = $row['name'];
		 	$dueDate = $row['due_date'];
		 	$numOfPages = $row['numOfPages'];
		  	$numOfCopies = $row['numOfCopies'];
		   	$paperSize = $row['paper_size'];
		    $paperColor = $row['paper_color'];
		   	$weight = $row['weight'];
		    $finishing = $row['finishing'];
		    $paymentMethod = $row['payment_method'];
		    $printColor = $row['color'];
		    $status = $row['status'];
		    $comment = $row['comments'];
			 
			// show form
			displayForm($id,
				       $name,
			 		   $dueDate,
			 		   $numOfPages,
			 		   $numOfCopies,
			 		   $paperSize,
			 		   $paperColor,
			 		   $weight,
			 		   $finishing,
			 		   $paymentMethod,
			 		   $printColor,
			 		   $comment,
			 		   $status,
			 		   '');
		}
		else
		{
		 	// if no match, display result
		 	echo "No results!";
		}
	}
	else
	{
	 	// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
	 	echo 'Error!';
	}
}
?>

<?php echoLayoutBottom(); ?>