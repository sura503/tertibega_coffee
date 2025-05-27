<?php
session_start();
include("function/admin_session.php");
include("db/dbconn.php");



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
	text-align:center;
  }
  .col-2 {
    flex-basis: 25%;
	text-align:center;
  }
  .col-3 {
    flex-basis: 25%;
	text-align:center;
  }
  .col-4 {
    flex-basis: 25%;
	text-align:center;
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


</style>	
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tertibega Coffee</title>

</head>
<body>


<header>
<?php include('header/report_header.php'); ?> 
</header> 

<div>
  <nav class="report-nav4">
 
  <?php include('header/sell_report_sub_header.php'); ?> 
 
</nav>
</div>

<div>
<?php 



$Sql_Weekly=" SELECT
  YEAR(SaleDate) AS Year,
  WEEK(SaleDate, 1) AS Week_Number,  -- Week starts on Monday
  MIN(SaleDate) AS Week_Start_Date,
  MAX(SaleDate) AS Week_End_Date,
  SUM(TotalAmount) AS Total_Sales,
  AVG(TotalAmount) AS Average_Daily_Sales,
  COUNT(*) AS Number_of_Transactions
FROM
  sales
GROUP BY
  Year,
  Week_Number 
ORDER BY
  Year,
  Week_Number desc";		

$result = $conn->query($Sql_Weekly);



if ($result->num_rows > 0) {
	  
?>

<br/>
<br/>
<br/>
<div class="container">
  <h2> Weekly Sales Report </h2>
  <br/>
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">Year</div>
      <div class="col col-2">WeeK Start Date</div>
      <div class="col col-3">Week End Date</div>
      <div class="col col-4">Number of Transactions</div>
	   <div class="col col-4">Total Sales</div>
    </li>
	
	
<?php		  
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		echo " <li class='table-row'>";
      echo "<div class='col col-1' data-label='Year'>".htmlspecialchars($row["Year"])."</div>";
      echo "<div class='col col-2' data-label='Week Start Date'>".htmlspecialchars($row["Week_Start_Date"])."</div>";
      echo "<div class='col col-3' data-label='Week End Date'>". htmlspecialchars($row["Week_End_Date"])."</div>";
     echo "<div class='col col-4' data-label='Number of Transactions'>". htmlspecialchars($row["Number_of_Transactions"])." Orders</div>";
	    echo "<div class='col col-4' data-label='Total Sales'>". htmlspecialchars($row["Total_Sales"])." ETB </div>";
     echo "</li>";
    }

echo "</ul></div>";
}

else 
	echo "<p> There is no data to report</p>"

?>

<br/>
<br/>
<br/>
<br/>
</div>



</body>
</html>

