<?php
session_start();
include("function/admin_session.php");
include("db/dbconn.php");




$sql3=" SELECT
    YEAR(date_of_rec) AS year,
    WEEK(date_of_rec, 1) AS week_number,
    MIN(date_of_rec) AS week_start_from,
    MAX(date_of_rec) AS week_ends_on,
    SUM(Prod_Total_Price) AS total_expense,
    COUNT(*) AS total_records
FROM
    expense_tbl
WHERE
    date_of_rec >= DATE_FORMAT(CURDATE(), '%Y-01-01')
GROUP BY
    YEAR(date_of_rec),
    WEEK(date_of_rec, 1)
ORDER BY
    year,
    week_number;
";



$result = $conn->query($sql3);




//   calculate current date profits 
	
$profit_sql = "SELECT SUM(TotalAmount) AS TodayProfit FROM sales as a WHERE SaleDate = CURDATE() ";

$profit_result = $conn->query($profit_sql);

$today_profit = 0;



?>



<?php


if (isset($_POST['search'])) {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    // Validate and sanitize dates if needed

    $sql = "SELECT s.TotalAmount AS TodayProfit, s.SaleTime
            FROM sales s
            JOIN product_list_rec a ON s.ProductID = a.ProductID
            WHERE s.SaleDate BETWEEN '$from_date' AND '$to_date'
              AND a.Product_Type = 1
            ORDER BY s.SaleTime DESC";

  
}
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
    flex-basis: 30%;
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
 
  <?php include('header/expense_report_sub_header.php'); ?> 
 
</nav>
</div>




<div class="container">
  <h2>Tertibega Coffee Expense Report's <small>Weekly Report </small></h2>
  <br/>
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">year </div>
      <div class="col col-1">Week Number </div>
      <div class="col col-2">Transaction starts </div>
      <div class="col col-3">Transacion ends </div>
      <div class="col col-4">Total Expense</div>
    </li>
	



<?php


	 
	 
         
   while ($row = mysqli_fetch_assoc($result)) {
		
		
     


     $formattedNumber = number_format($row['total_expense'], 2, '.', '');
    // output data of each row
    //while($row = $result->fetch_assoc()) {
       	  echo "<li class='table-row'>";
      echo "<div class='col col-1' data-label='Year'>". htmlspecialchars($row["year"]) ."</div>";
      echo "<div class='col col-2' data-label='Week Number:'> Week ". htmlspecialchars($row["week_number"]) ."</div>";
      echo "<div class='col col-3' data-label='Transaction starts'>". htmlspecialchars($row["week_start_from"]) ." </div>";
      echo "<div class='col col-3' data-label='Transacion ends :'>". htmlspecialchars($row["week_ends_on"]) ." </div>";
     echo "<div class='col col-4' data-label='Product Type'>" . htmlspecialchars($formattedNumber) . " ETB </div>";
     echo "</li>";
    }
    echo "</table> </center>";
	

	
	?>
</div>


<br/>
<br/>
<br/>
<br/>
</div>


</body>
</html>


