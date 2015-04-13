<?php
session_start();
session_destroy(); // Destroying All Sessions
header("Location: http://localhost/bubbles/index.php"); // Redirecting To Home Page

?>