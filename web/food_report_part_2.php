<?php
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
	where SaleDate = CURDATE() and Product_Type=2
GROUP BY e.ProductID, e.ProductName
ORDER BY TotalQuantitySold DESC; ";	



$result = $conn->query($sql);




//   calculate current date profits 
	
	
$profit_sql = "
SELECT Sum(s.TotalAmount) AS TodayProfit 
        FROM sales s
        JOIN product_list_rec a ON s.ProductID = a.ProductID
        WHERE s.SaleDate = CURDATE() 
          AND a.Product_Type = 2
";

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
  font-size: 24px;
  margin: 15px 0;
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
    font-size: 12px;
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
    flex-basis: 15%;
  }
  .col-3 {
    flex-basis: 10%;
  }
  .col-4 {
    flex-basis: 15%;
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

<br/>
<br/>
 
<?php
if ($result->num_rows > 0) {
	
?>


<div class="container">
  <h2> Today's all Sales History </h2>
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">Product Name</div>
      <div class="col col-2"> Order Count </div>
      <div class="col col-3">Unit Price</div>
      <div class="col col-4">Total Price</div>
    </li>
   
				
				
<?php

    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		
	echo " <li class='table-row'>"; 
     echo "<div class='col col-1' data-label='Product Name '>". htmlspecialchars($row["Prod_Name"]) ."</div>";
     echo "<div class='col col-2' data-label='Total Order'>". htmlspecialchars($row["TotalQuantitySold"]) . " Order</div>";
      echo "<div class='col col-3' data-label='Unit Price'>" .htmlspecialchars($row["Unit_Price"])  . " ETB </div>";
      echo "<div class='col col-4' data-label='Total Price'>". htmlspecialchars(number_format($row["TotalRevenue"], 2)) . " ETB</div>";
       echo " </li> ";
    }
  echo " </ul> </div>";
	


} else {
    echo "No Sales records found on Today.";
}




if ($profit_result && $profit_result->num_rows > 0) {
    $row = $profit_result->fetch_assoc();
    $today_profit = $row['TodayProfit'] !== null ? $row['TodayProfit'] : 0;
	echo "<h4 style='text-align:right;padding-right:20%;'>Today's Total Sales Income: ". number_format($today_profit, 2). " ETB </h4>";

}
?>





 
 
<br/>
<br/>
<br/>
<br/>
</body>