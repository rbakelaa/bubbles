<?php
include('_layout.php');
echoLayoutTop();
?>


<form action"" method="post">
	<p>Name: 							<br /> <input type="text" name="name"/></p>
	<p>Phone: 							<br /> <input type="text" name="phone"/></p>
	<p>Email: 							<br /> <input type="text" name="email"/></p>
	<p>Due Date (ex: yyyy-mm-dd): 		<br /> <input type="datetime" name="dueDate" /></p>
	<p># of Pages 						<br /> <input type="number" name="numOfPages" /></p>
	<p># of Copies 						<br /> <input type="number" name="numOfCopies" /></p>
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
	<p>Print in color? (Y/N); 	<br /><input type="checkbox" value = "Y" name="printColor" class="checkbox" /> </p>
	<p>Double sided? (Y/N); 	<br /><input type="checkbox" value = "Y" name="doubleSided" class="checkbox" /> </p>
	<p><input type="submit" value="Submit Order" /></p>

<?php

 
 //Check if the form has been submitted. If it has, start to process the form and save it to the database
 if ($_SERVER['REQUEST_METHOD'] === 'POST'){
 	 //Define database attributes
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'bubbles';

	//Connect to the database
	$conn = new mysqli($servername, $username, $password, $dbname);

 	//Get form data to make sure it's valid
 	$name = $_POST["name"];
 	$phone = $_POST["phone"];
 	$email = $_POST["email"];
 	$dueDate = $_POST["dueDate"];
 	$numOfPages = $_POST["numOfPages"];
  	$numOfCopies = $_POST["numOfCopies"];
   	$paperSize = $_POST["paperSize"];
    $paperColor = $_POST["paperColor"];
   	$weight = $_POST["weight"];
    $finishing = $_POST["finishing"];
    $paymentMethod = $_POST["paymentMethod"];

    if(isset($_POST["printColor"])){
   		$printColor = $_POST["printColor"];    	
    }else{
    	$printColor = "N";
    }

    if(isset($_POST["doubleSided"])){
   		$doubleSided = $_POST["doubleSided"];   	
    }else{
    	$doubleSided = "N";
    }

	$sql = "INSERT INTO orders 
	   	(name,
	   	phone,
	   	email,
	    due_date,
	    numOfPages,
	    numOfCopies,
	    paper_color,
	    paper_size,
	    weight,
	    finishing,
	    payment_method,
	    color,
	    doubleSided)     
		VALUES 
		('$name',
		'$phone',
		'$email',
	    '$dueDate',
	    '$numOfPages',
	    '$numOfCopies',
	    '$paperSize',
	    '$paperColor',
	    '$weight',
	    '$finishing',
	    '$paymentMethod',
	    '$printColor',
	    '$doubleSided')";

	if ($conn->multi_query($sql) === TRUE) {
	    echo "New records created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
?>

</form>

<?php
echoLayoutBottom();
?>