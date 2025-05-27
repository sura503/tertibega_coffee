<?php 
include("db/dbconn.php");
?>

<head>
 <link rel="stylesheet" type="text/css" href="css/header_main_css_1.css">
</head>


<div class="navbar">
  <a href="Sell_Info_Report_View.php" id="active-nv"> Transaction Report</a>
  
 
 <div class="dropdown">
    <button class="dropbtn">Sales Report
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="Sell_Info_Report_Current_Date.php">Daily Sales Report</a>
      <a href="Sell_Info_Report_This_Week.php">Weekly Sales Report</a>
      <a href="Sell_Info_Report_This_Month.php">Monthly Sales Report </a>
      <a href="Sell_Info_Report_By_Date.php">Search </a>
  </div>
</div>


  <div class="dropdown">
    <button class="dropbtn">Expense Report
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="Expense_Report_Current_Date.php">Daily Expense Report</a>
      <a href="Expense_Report_Current_Week.php">Weekly Expense Report </a>
      <a href="Expense_Report_Current_Month.php">Monthly Expense Report </a>
      <a href="Expense_Report_By_Date.php">Search </a>
  </div>
</div>

 <div class="dropdown">
    <button class="dropbtn active" >Transaction Audit Report
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <div class="dropdown-content">
      <a href="Audit_Report_By_Date_1.php">Daily Audit </a>
      <a href="Audit_Report_By_Week.php">Weekly Audit </a>
      <a href="Audit_Report_Monthly.php">Monthly Audit </a>
      <a href="Audit_Report_Search.php">Search </a>
  </div>
  </div>
</div>

 
  <div class="dropdown">
    <button class="dropbtn"> Service Related
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <div class="dropdown-content">
      <a href="Product_Detail_Page.php">Food Product Detail</a>
      <a href="Drink_Products_Detail_Page.php">Drink Product Detail</a>
      <a href="Product_update_page.php">Change Price</a>
       <a href="Product_Add_Page.php"> Add New Product </a>
  </div>
  </div>
</div>

 <a href="#home"> Employee Report</a>
 
</div>