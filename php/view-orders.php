<?php
include('includes/layout.php');
echoLayoutTop();
?>

			<div class = "container2 page2">

<?php
				//Database information
 				$server = 'localhost';
 				$user = 'root';
 				$password = '';
 				$database = 'bubbles';
 
 				// connect to Database
 				$connection = mysql_connect($server, $user, $password);
 				
 				//select database
 				mysql_select_db($database);

 				//get results from database
				$result = mysql_query("SELECT * FROM orders ") or die (mysql_error());  

				//add table to a div with the id orders
				echo '<div id = "orders">';

				echo ' <form action="" method="post">';

				//beginning of table
				echo "<table cellpadding='10'>";

				//table headings
				echo "
				<tr>
					<th>#</th>
					<th>Name</th>					
					<th>Phone</th>
					<th>Due Date</th>
					<th>Email</th>	
					<th>Pages</th>
					<th>Copies</th>					
					<th>Ink</th>
					<th>Sides</th>
					<th>Size</th>
					<th>Color</th>
					<th>Weight</th>
					<th>Finishing</th>
					<th>Method</th>
					<th>Status</th>
					<th>Comments</th>
					<th></th>
					<th></th>
				</tr>";

				// loop through results of database query, displaying them in the table
				while($row = mysql_fetch_array($result)) 
				{
				
					// echo out the contents from the database of each row into a table
					echo "<tr>";
					echo '<td>' . $row['id'] . '</td>';
					echo '<td>' . $row['name'] . '</td>';
					echo '<td>' . $row['phone'] . '</td>';
					echo '<td>' . $row['due_date'] . '</td>';
					echo '<td>' . $row['email'] . '</td>';
					echo '<td>' . $row['numOfPages'] . '</td>';
					echo '<td>' . $row['numOfCopies'] . '</td>';
					echo '<td>' . $row['color'] . '</td>';
					echo '<td>' . $row['doubleSided'] . '</td>';
					echo '<td>' . $row['paper_size'] . '</td>';
					echo '<td>' . $row['paper_color'] . '</td>';
					echo '<td>' . $row['weight'] . '	</td>';
					echo '<td>' . $row['finishing']. '</td>';					
					echo '<td>' . $row['payment_method']. '</td>';
					echo '<td><p>' . $row['status']. '</p></td>';
					echo '<td><p>' . $row['comments']. '</p></td>';
					echo '<td><a href="http://localhost/bubbles/php/edit-orders.php?id=' . $row['id'] . '">Edit</a></td>';
					echo '<td><a href="http://localhost/bubbles/php/remove-orders.php?id=' . $row['id'] . '" onclick="return confirm(' . "'Are you sure you want to delete this order?'".')">Delete</a></td>';
					echo "</tr>";	
					echo "<tr></tr>";		
				} 

				// close table
				echo "</table>";

				
				echo $row['comment'];

				echo '</div>';
				echo '</br>';
				
				?>
			</div>

<?php

echoLayoutBottom();
 

 ?>  

