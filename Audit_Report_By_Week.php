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
    flex-basis: 13%;
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
  .col-6 {
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



<div>
<br/>
<br/>
<br/>
<br/>
</div>

<div>

<?php

$sql=" 
SELECT 
    COALESCE(s.Year, e.Year) AS Year,
    COALESCE(s.WeekNumber, e.WeekNumber) AS WeekNumber,
    COALESCE(s.WeekStartDate, e.WeekStartDate) AS WeekStartDate,
    COALESCE(s.WeeklySales, 0) AS WeeklySales,
    COALESCE(e.WeeklyExpense, 0) AS WeeklyExpense,
    COALESCE(s.WeeklySales, 0) - COALESCE(e.WeeklyExpense, 0) AS WeeklyProfit
FROM 
    (
        SELECT 
            YEAR(SaleDate) AS Year,
            WEEK(SaleDate, 1) AS WeekNumber,
            DATE_ADD(SaleDate, INTERVAL(0 - WEEKDAY(SaleDate)) DAY) AS WeekStartDate,
            SUM(TotalAmount) AS WeeklySales
        FROM 
            sales
        WHERE 
            SaleDate >= '2025-01-01'
        GROUP BY 
            Year,
            WeekNumber
    ) s
LEFT JOIN
    (
        SELECT 
            YEAR(date_of_rec) AS Year,
            WEEK(date_of_rec, 1) AS WeekNumber,
            DATE_ADD(date_of_rec, INTERVAL(0 - WEEKDAY(date_of_rec)) DAY) AS WeekStartDate,
            SUM(Prod_Total_Price) AS WeeklyExpense
        FROM 
            expense_tbl
        WHERE 
            date_of_rec >= '2025-01-01'
        GROUP BY 
            Year,
            WeekNumber
    ) e
ON s.Year = e.Year AND s.WeekNumber = e.WeekNumber

UNION

SELECT 
    COALESCE(s.Year, e.Year) AS Year,
    COALESCE(s.WeekNumber, e.WeekNumber) AS WeekNumber,
    COALESCE(s.WeekStartDate, e.WeekStartDate) AS WeekStartDate,
    COALESCE(s.WeeklySales, 0) AS WeeklySales,
    COALESCE(e.WeeklyExpense, 0) AS WeeklyExpense,
    COALESCE(s.WeeklySales, 0) - COALESCE(e.WeeklyExpense, 0) AS WeeklyProfit
FROM 
    (
        SELECT 
            YEAR(SaleDate) AS Year,
            WEEK(SaleDate, 1) AS WeekNumber,
            DATE_ADD(SaleDate, INTERVAL(1 - WEEKDAY(SaleDate)) DAY) AS WeekStartDate,
            SUM(TotalAmount) AS WeeklySales
        FROM 
            sales
        WHERE 
            SaleDate >= '2025-01-01'
        GROUP BY 
            Year,
            WeekNumber
    ) s
RIGHT JOIN
    (
        SELECT 
            YEAR(date_of_rec) AS Year,
            WEEK(date_of_rec, 1) AS WeekNumber,
            DATE_ADD(date_of_rec, INTERVAL(1 - WEEKDAY(date_of_rec)) DAY) AS WeekStartDate,
			
            SUM(Prod_Total_Price) AS WeeklyExpense
        FROM 
            expense_tbl
        WHERE 
            date_of_rec >= '2025-01-01'
        GROUP BY 
            Year,
            WeekNumber
    ) e
ON s.Year = e.Year AND s.WeekNumber = e.WeekNumber
WHERE s.Year IS NULL
ORDER BY Year, WeekNumber desc; ";


?>

</head>
<body>
<center> <h3>  </h3> </center>
<br/>
<br/>
<div>


			

<div class="container">
  <h2>Transaction Audit Report <small>Weekly</small></h2>
  <br/>
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">Year </div>
      <div class="col col-2">Week Start Date</div>
      <div class="col col-3">Week Ends On</div>
      <div class="col col-4">Weekly Sales</div>
      <div class="col col-5">Weekly Expense</div>
      <div class="col col-6">Weekly Profit</div>
    </li>
	



 





<?php

   $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

   while ($row = mysqli_fetch_assoc($result)) {
		
		$date1 = new DateTime($row["WeekStartDate"]);
		$date = new DateTime($row["WeekStartDate"]);
		$date->modify('+6 days');
		$Ends_On = $date->format('Y-m-d');
		$Started_On = $date1->format('Y-m-d');

		
     echo "<li class='table-row'>";
      echo "<div class='col col-1' data-label='Year'>". htmlspecialchars($row["Year"]) ."</div>";
      echo " <div class='col col-2' data-label='Week Start Date'>" . htmlspecialchars($Started_On) . "</div>";
      echo "<div class='col col-3' data-label='Week Ends On'>" . htmlspecialchars($Ends_On) . "</div>";
      echo "<div class='col col-4' data-label='Weekly Sales'>" . htmlspecialchars($row["WeeklySales"]) . " ETB </div>";
      echo "<div class='col col-5' data-label='Weekly Expense'>" . htmlspecialchars($row["WeeklyExpense"]) . " ETB</div>";
      echo "<div class='col col-6' style='font-weight: bold;' data-label='Weekly Profit'>" . htmlspecialchars($row["WeeklyProfit"]) . " ETB</div>";
     echo "</li>";


    }

	?>
</div>


</body>
</html>


