

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
    padding: 15px 30px;
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
    flex-basis: 40%;
  }
  .col-2 {
    flex-basis: 25%;
	text-align:center;
  }
  .col-3 {
    flex-basis: 15%;
	text-align:center;
	
  }
  .col-4 {
    flex-basis: 15%;
	text-align:center;
  }
  
   .col-5 {
    flex-basis: 15%;
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


<?php



$sql2 = "SELECT Sales_ID, e.ProductName, SaleDate, SaleTime, Quantity, a.Unit_Price, TotalAmount 
        FROM sales as a, product_list_rec as e 
        WHERE a.ProductID = e.ProductID 
        ORDER BY SaleTime DESC ";
		
		
$sql = "SELECT 
    e.ProductID,
    e.ProductName as Prod_Name,
    a.SaleTime as Seles_On ,
    a.Quantity AS Quantity,
    a.TotalAmount AS TotalSeles,
	a.Unit_Price
FROM sales AS a
INNER JOIN product_list_rec AS e 
    ON a.ProductID = e.ProductID
	where SaleDate = CURDATE()
ORDER BY Seles_On DESC; ";	


$result = $conn->query($sql);




//   calculate current date profits 
	
	
$profit_sql = "
SELECT Sum(s.TotalAmount) AS TodayProfit 
        FROM sales s
        JOIN product_list_rec a ON s.ProductID = a.ProductID
        WHERE s.SaleDate = CURDATE() ";

$profit_result = $conn->query($profit_sql);

$today_profit = 0;



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tertibega Coffee</title>

</head>
<body>

 <br/>
 <br/>

<div class="container">
<br/>
<br/>
<br/>
<h2>Daily All Products Seles Summary </h2>
<ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">Product Name</div>
      <div class="col col-2">Date</div>
      <div class="col col-3"> Quantity </div>
      <div class="col col-4">Unit Price</div>
      <div class="col col-5">Total Price</div>
    </li>
	
  
     
      
       
<?php
if ($result->num_rows > 0) {
	   // output data of each row
    while($row = $result->fetch_assoc()) {
	echo " <li class='table-row'>";
	echo " <div class='col col-1' data-label='Product Name'>".htmlspecialchars($row['Prod_Name'])."</div>";
    echo " <div class='col col-2' data-label='Date'>". htmlspecialchars($row['Seles_On']) ."</div>";
	echo "<div class='col col-3' data-label='Quantity'>" .htmlspecialchars($row['Quantity']) ."</div>";
	echo  "<div class='col col-4' data-label='Unit Price'>". htmlspecialchars($row["Unit_Price"]) ." ETB</div>";
	echo " <div class='col col-4' data-label='Total Price'>".htmlspecialchars($row["TotalSeles"])." ETB </div>";	
    echo " </li>";	
    }
   
	


} else {
    echo "No Sales records found on Today.";
}
echo " </ul> </div> ";


if ($profit_result && $profit_result->num_rows > 0) {
    $row = $profit_result->fetch_assoc();
    $today_profit = $row['TodayProfit'] !== null ? $row['TodayProfit'] : 0;
	echo "<h4 style='float:right;padding-right:15%;'>Today's Total Income: ". number_format($today_profit, 2). " ETB </h4>";

}
?>

</ul>
</div>
 
<br/>
<br/>
<br/>
<br/>
<?php

$sql2 = "SELECT 
    e.ProductID,
    e.ProductName as Prod_Name,
    SUM(a.Quantity) AS TotalQuantitySold,
    SUM(a.TotalAmount) AS TotalRevenue,
	a.Unit_Price
FROM sales AS a
INNER JOIN product_list_rec AS e 
    ON a.ProductID = e.ProductID
	where SaleDate = CURDATE() and Product_Type = 1
GROUP BY e.ProductID, e.ProductName
ORDER BY TotalQuantitySold DESC; ";	


$result2 = $conn->query($sql2);



//   calculate current date profits 
	
$profit_sql = "
SELECT Sum(s.TotalAmount) AS TodayProfit 
        FROM sales s
        JOIN product_list_rec a ON s.ProductID = a.ProductID
        WHERE s.SaleDate = CURDATE() 
          AND a.Product_Type = 1
";

$profit_result = $conn->query($profit_sql);

$today_profit = 0;


if ($result2->num_rows > 0) {
	
	if ($result2->num_rows > 0) {
		
?>
<h2>Drink Sales Product Summary </h2>
<div class="container">
<ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">Product Name</div>
      <div class="col col-3"> Quantity </div>
      <div class="col col-4">Unit Price</div>
      <div class="col col-5">Total Price</div>
    </li>
		
<?php
    while($row1 = $result2->fetch_assoc()) {
	echo " <li class='table-row'>";
	echo " <div class='col col-1' data-label='Prod Name'>".htmlspecialchars($row1['Prod_Name'])."</div>";
    echo " <div class='col col-2' data-label='Quantity Sold'>". htmlspecialchars($row1['TotalQuantitySold']) ."</div>";
	echo "<div class='col col-3' data-label='Unit Price'>" .htmlspecialchars($row1['Unit_Price']) ."</div>";
	echo  "<div class='col col-4' data-label='Total Revenue'>". htmlspecialchars($row1["TotalRevenue"]) ." ETB</div>";
    echo "</li>";	
    }
echo "</ul> </div>";		
}

 else {
    echo "No Sales records found on Today.";
}
}

if ($profit_result && $profit_result->num_rows > 0) {
    $row = $profit_result->fetch_assoc();
    $today_profit = $row['TodayProfit'] !== null ? $row['TodayProfit'] : 0;
	echo "<h4 style='float:right;padding-right:15%;'>Today's Drinks Total Income: ". number_format($today_profit, 2). " ETB </h4>";
 echo "</br>";	
 echo "</br>";	
 echo "</br>";	

}

?>



<?php

$sql2 = "SELECT 
    e.ProductID,
    e.ProductName as Prod_Name,
    SUM(a.Quantity) AS TotalQuantitySold,
    SUM(a.TotalAmount) AS TotalRevenue,
	a.Unit_Price
FROM sales AS a
INNER JOIN product_list_rec AS e 
    ON a.ProductID = e.ProductID
	where SaleDate = CURDATE() and Product_Type = 2
GROUP BY e.ProductID, e.ProductName
ORDER BY TotalQuantitySold DESC; ";	


$result2 = $conn->query($sql2);



//   calculate current date profits 
	
$profit_sql = "
SELECT Sum(s.TotalAmount) AS TodayProfit 
        FROM sales s
        JOIN product_list_rec a ON s.ProductID = a.ProductID
        WHERE s.SaleDate = CURDATE() 
          AND a.Product_Type = 1
";

$profit_result = $conn->query($profit_sql);

$today_profit = 0;


if ($result2->num_rows > 0) {
	
	if ($result2->num_rows > 0) {
		
?>
<br/>
<br/>
<br/>
<h2>Today's Food Sales Summary </h2>
<div class="container">
<ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">Product Name</div>
      <div class="col col-3"> Quantity </div>
      <div class="col col-4">Unit Price</div>
      <div class="col col-5">Total Price</div>
    </li>
		
<?php
    while($row1 = $result2->fetch_assoc()) {
	echo " <li class='table-row'>";
	echo " <div class='col col-1' data-label='Prod_Name'>".htmlspecialchars($row1['Prod_Name'])."</div>";
    echo " <div class='col col-2' data-label='Quantity Sold'>". htmlspecialchars($row1['TotalQuantitySold']) ."</div>";
	echo "<div class='col col-3' data-label='Unit Price'>" .htmlspecialchars($row1['Unit_Price']) ."</div>";
	echo  "<div class='col col-4' data-label='TotalRevenue'>". htmlspecialchars($row1["TotalRevenue"]) ." ETB</div>";
    echo "</li>";	
    }
echo "</ul> </div>";		
}

 else {
    echo "No Sales records found on Today.";
}
}

if ($profit_result && $profit_result->num_rows > 0) {
    $row = $profit_result->fetch_assoc();
    $today_profit = $row['TodayProfit'] !== null ? $row['TodayProfit'] : 0;
	echo "<h4 style='float:right;padding-right:15%;'> Today's Drinks Total Income: ". number_format($today_profit, 2). " ETB </h4>";
	

}

?>



</body>
