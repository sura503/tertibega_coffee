<?php 
include("db/dbconn.php");
?>
<head>
 <link rel="stylesheet" type="text/css" href="css/header_main_css_1.css">
</head>


<div class="navbar">
  <a href="tertibega_homepage.php" > Dashboard </a>
  
  
   <div class="dropdown" style="float: right;padding-right:60px;">
    <button class="dropbtn" id="active-nv">User Profile
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
	 <a href="User_Add_new.php">Add New User </a>
      <a href="User_Profile_change.php">Change Password</a>
      <a href="function/logout.php">Log out </a> 
  </div>
</div>


  
 
</div>