<?php
include('_layout.php');
echoLayoutTop();
?>
				
				<?php


				if ($_SERVER['REQUEST_METHOD'] === 'GET') {
					if(isset($_GET['statusMsg'])){
						echo "<p>New employee added.</p>";
					}
				}

				 // Database Variables 
 				$server = 'localhost';
 				$user = 'root';
 				$pass = '';
 				$db = 'bubbles';
 
 				// Connect to Database
 				$connection = mysql_connect($server, $user, $pass) or die ("Could not connect to server ... \n" . mysql_error ());
 				mysql_select_db($db) or die ("Could not connect to database ... \n" . mysql_error ());

 				// get results from database
				$result = mysql_query("SELECT * FROM employees") or die(mysql_error()); 
	
				echo '<div id = "orders">';
				echo "<table cellpadding='10'>";
				echo "<tr><th>User Name</th><th>First Name</th> <th>Last Name</th><th></th></tr>";

				// loop through results of database query, displaying them in the table
				while($row = mysql_fetch_array( $result )) 
				{
		
					// echo out the contents of each row into a table
					echo "<tr>";
					echo '<td>' . $row['username'] . '</td>';
					echo '<td>' . $row['firstname'] . '</td>';
					echo '<td>' . $row['lastname'] . '</td>';
					echo '<td><a href="http://localhost/bubbles/delete-users.php?id=' . $row['id'] . '" onclick="return confirm(' . "'Are you sure you want to delete this order?'".')">Delete</a></td>';
					echo "</tr>";
					echo "<tr></tr>"; 
				} 

				// close table>
				echo "</table>";
				echo '</div>';
				echo "</br>";

				echo '<center><td><a href="http://localhost/bubbles/add-users.php">Add an Employee</a></td></center>';	
				
				?>


<?php

	echoLayoutBottom();

?>