<?php
include('_layout.php');
echoLayoutTop();
?>


<?php
 
// creates the order form
function renderForm($name, 
					$dueDate,
					$numOfPages,
					$numOfCopies,
					$paperSize,
					$paperColor,
					$weight,
					$finishing,
					$paymentMethod,
					$printColor,
					$doubleSided,
					$comment,
					$error)
{

	// if there are any errors, display them
 	if ($error != '')
 	{
 		echo '<div style="color:red;">'.$error.'</div>';
 	}
 ?>  


<form action"" method="post">
	<div class="floatLeft">
					<p>Name: 							<br /> <input type="text" name="name"/></p>
					<p>Due Date (ex: yyyy-mm-dd): 		<br /> <input type="datetime" name="dueDate" /></p>
					<p># of Pages 						<br /> <input type="number" name="numOfPages" /></p>
					<p># of Copies 						<br /> <input type="number" name="numOfCopies" /></p>
				</div>
				<div class="floatLeft">	
					<p>Paper Size<br /> 
					<select name = "paperSize">
						<option value="8.5 x 11in">8.5 x 11 inches</option>
						<option value="8.5 x 14in">8.5 x 14 inches</option>
						<option value="11 x 17in">11 x 17 inches</option>
					</select>			
					</p>
					<p>Paper Color<br /> 
					<select name = "paperColor">
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
					<option value="20lbs">20lbs</option>
					<option value="60lbs">60lbs</option>
					<option value="65lbs">65lbs</option>
					</select>			
					</p>
					<p>Finishing<br /> 
				<select name = "finishing">
					<option value="none">None</option>
					<option value="cutting">Cutting</option>
					<option value="folding">Folding</option>
					<option value="quaters">Quaters</option>
					<option value="binding">Bindings</option>
				</select>			
				</p>
				<p>Payment method<br /> 
				<select name = "paymentMethod">
					<option value="Cash">Cash</option>
					<option value="Credit">Credit</option>
					<option value="Check">Check</option>
					<option value="Wilscard">Wilscard</option>
				</select>			
				</p>
				<p>Print BW/C<br /> 
				<select name = "printColor">
					<option value="Black">Black</option>
					<option value="White">White</option>
					<option value="Color">Color</option>
				</select>			
				</p>
				</div>
				<div class="floatLeft">
	<p>Double sided? (Y/N); 	<br /><input type="checkbox" value = "Yes" name="doubleSided" class="checkbox" /> </p>
	<p>Comment (Cannot exceed 200 characters):<br />
  	<textarea name="comment"></textarea><br />
  	</p>
	<input type="submit" value="Submit Order" />
	</div>

	<?php 

 }
 
 //Define database attributes
 $server = 'localhost';
 $user = 'root';
 $pass = '';
 $database = 'bubbles';

 //Connect to the database
 $connection = mysql_connect($server, $user, $pass) or die ("Could not connect to server ... \n" . mysql_error ());
 
 //Select the database name
 $select = mysql_select_db($database) or die ("Could not connect to database ... \n" . mysql_error ());
 
 //Check if the form has been submitted. If it has, start to process the form and save it to the database
 if ($_SERVER['REQUEST_METHOD'] === 'POST')
 { 
 	//Get form data to make sure it's valid
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

    //Check if input fields are missing
 	if ($name == '' || $dueDate == '' || $numOfPages == '' || $numOfCopies == '' || $comment == '')
 	{
 	     //Generate error message
		 $error = 'Please fill in all fields!';
 
 		 //If any of the fields are blank display the form again
 		 renderForm($name,
 		 			$dueDate,
 		 			$numOfPages,
 		 			$numOfCopies,
 		 			$paperSize,
 		 			$paperColor,
 		 			$weight,
 		 			$finishing,
 		 			$paymentMethod,
 		 			$printColor,
 		 			$doubleSided,
 		 			$comment,
 		 			$error);

 	}

 		if(isset($doubleSided))
 		{

 				$doubleSided = 'Y';
 		}
 		else
 		{
 				$doubleSided = 'N';

 				//Insert form data into the database or die if there is an error
				$sql = "INSERT INTO orders 
								   (name,
					 			    due_date,
					 			    numOfPages,
					 			    numOfCopies,
					 			    paper_size,
					 			    paper_color,
					 			    weight,
					 			    finishing,
					 			    payment_method,
					 			    color,
					 			    doubleSided,
					 			    comments) 
 				            
 				  			VALUES ('$name',
 				  				    '$dueDate',
 				  				    '$numOfPages',
 				  				    '$numOfCopies',
 				  				    '$paperSize',
 				  				    '$paperColor',
 				  				    '$weight',
 				  				    '$finishing',
 				  				    '$paymentMethod',
 				  				    '$printColor',
 				  				    '$doubleSided',
 				  				    '$comment')" or die (mysql_error());	

				mysql_real_escape_string($sql);

				//Query the what ever the user inputs in to the database
 				$result = mysql_query($sql) or die (mysql_error());

 
 				//Once the form has been submitted, redirect back to the orders page
 				header("Location: http://localhost/bubbles/place-order.php"); 

 		}

 }
 else
 {
 	 //Display the form if it hasn't been submitted
 	renderForm('','','','','','','','','','','','','');
 }

?>

</form>

<?php
echoLayoutBottom();
?>