<?php function echoLayoutTop()
{ 

?>

<html>
<head>

		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="http://localhost/bubbles/css/style.css">

		<title>Student Print Services</title>

				<div id = "header">

				<div class="menu-wrap">
				<nav class="menu">
			        <ul class="clearfix">
			        	<li><p>Student Print Services</p></li>
			            <li><a href="http://localhost/bubbles/index.php">Home</a></li>
			            <li><a href="http://localhost/bubbles/php/place-order.php">Place Order</a></li>
			            	
						<li><a href="http://localhost/bubbles/php/login.php">Employees</a></li>
						<li>		

				            <a href="#">Controls<span class="arrow"></span></a>

				            	<ul class="sub-menu">

			            		<li>
			                    	<a id = "account" align = "center">Control Panel</a>
			                    </li>	
			                   
			                    <li>
			                    	<a href="http://localhost/bubbles/php/view-orders.php"><b class = "red">>></b> Customer Orders</a>
			                    </li>          
									
			                    <li>
			                    	<a href="http://localhost/bubbles/php/view-users.php"><b class = "red">>></b> Employee List</a>
			                    </li>
			
			                	<li>
			                    	<a href="http://localhost/bubbles/php/change-password.php"><b class = "red">>></b> Change Password</a>
			                    </li>
			
			                    <li>
			                    	<a href="http://localhost/bubbles/php/reset-password.php"><b class = "red">>></b> Reset Password</a>
			                    </li>

			                    <li>
			                    	<a href="http://localhost/bubbles/php/logout.php"><b class = "red">>></b> Sign Out</a>
			                    </li>
					            
					            </ul>
					        </li>

			        	</ul>
    			</nav>
				</div>
				</div>
				</div>
	
</head>



<?php 
}

function echoLayoutBottom()
{ 
?>

<footer>
<div id = "footer">
	<center><p>Copyright (C) 2015: Student Print Services</p></center>
</div>
</footer>
</html>

<?php 
} 
?>
