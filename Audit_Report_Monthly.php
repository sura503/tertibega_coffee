<?php 
session_start();
include("function/admin_session.php");
include("db/dbconn.php");
?>

<?php


//$result = $conn->query($sql);




//   calculate current date profits 
	
$profit_sql = "SELECT SUM(TotalAmount) AS TodayProfit FROM sales as a WHERE SaleDate = CURDATE() ";

$profit_result = $conn->query($profit_sql);

$today_profit = 0;



?>




<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
<style>   
   body {
  font-family: 'lato', sans-serif;
}
.container {
  max-width: 1000px;
  margin-left: auto;
  margin-right: auto;
  padding-left: 10px;
  padding-right: 10px;
}

h2 {
  font-size: 26px;
  margin: 20px 0;
  text-align: center;
  small {
    font-size: 0.5em;
  }
}

.responsive-table {
  li {
    border-radius: 3px;
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    margin-bottom: 25px;
  }
  .table-header {
    background-color: #95A5A6;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }
  .table-row {
    background-color: #ffffff;
    box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
  }
  .col-1 {
    flex-basis: 25%;
  }
  .col-2 {
    flex-basis: 25%;
  }
  .col-3 {
    flex-basis: 25%;
  }
  .col-4 {
    flex-basis: 25%;
  }
  .col-5 {
    flex-basis: 25%;
  }
  
  @media all and (max-width: 767px) {
    .table-header {
      display: none;
    }
    .table-row{
      
    }
    li {
      display: block;
    }
    .col {
      
      flex-basis: 100%;
      
    }
    .col {
      display: flex;
      padding: 10px 0;
      &:before {
        color: #6C7A89;
        padding-right: 10px;
        content: attr(data-label);
        flex-basis: 50%;
        text-align: right;
      }
    }
  }
}


</style>	

<body>

<!-- HTML
<header class="header">
  <a href="#" class="logo">Tertibega Coffee</a>
  <nav class="nav-links">
    <a href="#home" >Home</a>
    <a href="sell_info_rec_food.php">Add Sell</a>
    <a href="add_expense_page">Add Expense</a>
    <a href="#contact" class="active">Report</a>
  </nav>
 </header>

 -->
 
 
<header>
<?php include('header/report_header.php'); ?> 
</header> 
<div>
  <nav class="report-nav">
 
  <?php include('header/report_sub_header_1.php'); ?> 
 
</nav>
</div>


<br/>
<br/>
<br/>






<div>
<br/>
<br/>
<br/>
<br/>
</div>

<div>

<?php
$conn = new mysqli("localhost", "root", "", "tertibega_coffee");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql="SELECT 
    s.Year,
    s.Month,
    COALESCE(s.MonthlySales, 0) AS MonthlySales,
    COALESCE(e.MonthlyExpense, 0) AS MonthlyExpense,
    COALESCE(s.MonthlySales, 0) - COALESCE(e.MonthlyExpense, 0) AS MonthlyProfit
FROM 
    (
        SELECT 
            YEAR(SaleDate) AS Year,
            MONTH(SaleDate) AS Month,
            SUM(TotalAmount) AS MonthlySales
        FROM 
            sales
        WHERE 
            SaleDate >= '2025-01-01'  -- your default start date
        GROUP BY 
            Year,
            Month
    ) s
LEFT JOIN
    (
        SELECT 
            YEAR(date_of_rec) AS Year,
            MONTH(date_of_rec) AS Month,
            SUM(Prod_Total_Price) AS MonthlyExpense
        FROM 
            expense_tbl
        WHERE 
            date_of_rec >= '2025-01-01'  -- your default start date
        GROUP BY 
            Year,
            Month
    ) e
ON s.Year = e.Year AND s.Month = e.Month
ORDER BY 
    s.Year, s.Month desc;";


?>

</head>
<body>

<br/>
<div>



			

<div class="container">
  <h2>Transaction Audit Report <small>Monthly</small></h2>
  <br/>
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">Year </div>
      <div class="col col-2">Month</div>
      <div class="col col-3">Monthly Sales</div>
      <div class="col col-4">Monthly Expense</div>
      <div class="col col-5">Monthly Profit</div>
    </li>
	

<?php

   $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

   while ($row = mysqli_fetch_assoc($result)) {
		
		
		
     echo "<li class='table-row'>";
      echo "<div class='col col-1' data-label='Job Id'>". htmlspecialchars($row["Year"]) ."</div>";
      echo " <div class='col col-2' data-label='Customer Name'>" . htmlspecialchars($row["Month"]) .  "</div>";
      echo "<div class='col col-3' data-label='Amount'>"  . htmlspecialchars($row["MonthlySales"]) . "</div>";
      echo "<div class='col col-4' data-label='Payment Status'>" . htmlspecialchars($row["MonthlyExpense"]) ." ETB </div>";
      echo "<div class='col col-5' style='font-weight: bold;' data-label='Payment Status'>" . htmlspecialchars($row["MonthlyProfit"]) . " ETB</div>";
     echo "</li>";


    }

	?>
</div>





</div>


</body>
</html>


