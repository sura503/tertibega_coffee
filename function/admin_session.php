<?php
// Method 1: Using session_status() (PHP 5.4.0+)
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['Tertibega_ID']))
	{
		//echo "session related error";
		echo "<script>window.location = 'index.php';</script>";
	}

?>




