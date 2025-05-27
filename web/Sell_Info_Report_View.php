<?php
session_start();
include("function/admin_session.php");
include("db/dbconn.php");


$sql2 = "SELECT Sales_ID, e.ProductName, SaleDate, SaleTime, Quantity, a.Unit_Price, TotalAmount 
        FROM sales as a, product_list_rec as e 
        WHERE a.ProductID = e.ProductID 
        ORDER BY SaleTime DESC ";
		
		
$sql = "SELECT 
    e.ProductID,
    e.ProductName as Prod_Name,
    SUM(a.Quantity) AS TotalQuantitySold,
    SUM(a.TotalAmount) AS TotalRevenue,
	a.Unit_Price
FROM sales AS a
INNER JOIN product_list_rec AS e 
    ON a.ProductID = e.ProductID
	where SaleDate = CURDATE()
GROUP BY e.ProductID, e.ProductName
ORDER BY TotalQuantitySold DESC; ";	

	
$sql2 = "SELECT 
    e.ProductID,
    e.ProductName as Prod_Name,
    SUM(a.Quantity) AS TotalQuantitySold,
    SUM(a.TotalAmount) AS TotalRevenue,
	a.Unit_Price
FROM sales AS a
INNER JOIN product_list_rec AS e 
    ON a.ProductID = e.ProductID
	where SaleDate = CURDATE()
GROUP BY e.ProductID, e.ProductName
ORDER BY TotalQuantitySold DESC; ";

$result = $conn->query($sql);




//   calculate current date profits 
	
$profit_sql = "SELECT SUM(TotalAmount) AS TodayProfit FROM sales as a WHERE SaleDate = CURDATE() ";

$profit_result = $conn->query($profit_sql);

$today_profit = 0;



?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>

<link rel="stylesheet" type="text/css" href="header_styles_main.css">
<link rel="stylesheet" type="text/css" href="report_styles_main_1.css">

</head>	
    <style>

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
 
  <?php include('header/report_sub_header_2.php'); ?> 
 
</nav>
</div>


<br/>
<br/>
<br/>

<h4 style="text-align:right;padding-right: 60px;"> <?php echo date('l, F j, Y'); ?>  Transactions History   </h4>

<br/>

<?php include 'food_report_part_4.php'; ?>

<button class="accordion">Today's all Sells History (All Transactions) </button>
<div class="panel">
  
  
<?php include 'food_report_part_5.php'; ?>
  
</div>



<button class="accordion">Today's Drink Sell Report </button>
<div class="panel">
 
 
<?php include 'food_report_part_1.php'; ?>
 <br/>
 <br/>
 
</div>


<button class="accordion">Today's Food Sell History </button>
<div class="panel">
  
  
<?php include 'food_report_part_2.php'; ?>

  
</div>




<button class="accordion">Today's Expense Report </button>
<div class="panel">

 <?php include 'food_report_part_3.php'; ?>
 
</div>






</body>
</html>


<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

</script>