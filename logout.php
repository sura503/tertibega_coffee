<?php 
session_start();
$_SESSION = array();
session_destroy();
header("Location:../index.php");
exit;
?>


<?php
/*	
	session_start();
	session_destroy();
	
		
		header("location:../index.php");
*/
?>