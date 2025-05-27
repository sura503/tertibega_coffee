<?php
include('db/dbconn.php');

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
    S.ProductID AS ProductID,
    P.ProductName AS ProductName,
    SUM(S.TotalAmount) AS TotalSalesAmount,
    SUM(S.Quantity) AS TotalQuantitySold,
    COUNT(S.Sales_ID) AS NumberOfSales
FROM sales AS S
JOIN product_list_rec AS P ON S.ProductID = P.ProductID
WHERE YEAR(S.SaleDate) = YEAR(CURDATE())
  AND WEEK(S.SaleDate, 1) = WEEK(CURDATE(), 1)
GROUP BY S.ProductID
ORDER BY TotalSalesAmount DESC
LIMIT 10;
";

	
$sql3 = "SELECT 
    S.ProductID AS ProductID,
    P.ProductName AS ProductName,
    SUM(S.TotalAmount) AS TotalSalesAmount,
    SUM(S.Quantity) AS TotalQuantitySold,
    COUNT(S.Sales_ID) AS NumberOfSales
FROM sales AS S
JOIN product_list_rec AS P ON S.ProductID = P.ProductID
WHERE YEAR(S.SaleDate) = YEAR(CURDATE())
  AND MONTH(S.SaleDate) = MONTH(CURDATE())
GROUP BY S.ProductID
ORDER BY TotalSalesAmount DESC
LIMIT 10;
";

$result = $conn->query($sql);
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);




//   calculate current date profits 
	
$profit_sql = "SELECT SUM(TotalAmount) AS TodayProfit FROM sales as a WHERE SaleDate = CURDATE() ";

$profit_result = $conn->query($profit_sql);

$today_profit = 0;



$expense_sql = "
SELECT Sum(Prod_Total_Price) AS TodayExpense
        FROM expense_tbl 
        WHERE DATE(date_of_rec) = CURDATE()
     
";

$expense_result = $conn->query($expense_sql);

$today_expense = 0;







// Query to get top 10 products by sales amount  


	


$sql = "SELECT 
            S.ProductID as ProductID,
			P.ProductName as Productname,
            SUM(TotalAmount) AS TotalSalesAmount,
            SUM(Quantity) AS TotalQuantitySold,
            COUNT(Sales_ID) AS NumberOfSales
        FROM sales as S, product_list_rec as P
		where S.ProductID = P.ProductID
        GROUP BY ProductID
        ORDER BY TotalSalesAmount DESC
        LIMIT 10";

$result = $conn->query($sql);
?>

<style>

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f6f8;
    margin: 0;
    padding: 0px;
}

.dashboard-widget {
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    max-width: 900px;
    margin: 0 auto;
}

.dashboard-widget h2 {
    margin-bottom: 20px;
    color: #333;
}

.sales-table {
    width: 100%;
    border-collapse: collapse;
}

.sales-table th, .sales-table td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #e0e0e0;
}

.sales-table th {
    background-color: #f0f2f5;
    color: #555;
}

.sales-table tr:hover {
    background-color: #f9f9f9;
}

.sales-table td {
    color: #333;
}


.financial-summary {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 20px;
    max-width: 900px;
    margin: 0 auto 30px;
}

.financial-item {
    flex: 1 1 30%;
    min-width: 250px;
    background-color: #f9fafc;
    padding: 15px 20px;
    border-radius: 10px;
    border-left: 5px solid #82b883;
    display: flex;
    flex-direction: column;
    justify-content: center;
    transition: box-shadow 0.3s;
}

.financial-item:hover {
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
}

.financial-item .label {
    font-weight: 600;
    color: #555;
    font-size: 0.95rem;
    margin-bottom: 5px;
}

.financial-item .value {
    font-size: 1.3rem;
    font-weight: bold;
    color: #82b883;
}

/* Special styling for Net Profit */
.financial-item.net-profit {
    border-left-color: #28a745; /* green */
}


.financial-item.net-profit .value {
    color: #28a745;
}


/**************************** Special styling for Net Profit two*/
.financial-item.net-profit2 {
    border-left-color: #b01a31; /* green */
}


.financial-item.net-profit2 .value {
    color: #b01a31;
}

/* Negative values (expense) */
.financial-item .value:contains('-') {
    color: #dc3545;
}

/* Responsive */
@media (max-width: 768p




</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Top 10 Sales Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
<?php include('header/HomePage_header.php'); ?> 
</header> 

<div>
  <nav class="report-nav4">
 
  <?php include('header/homepage_sub_header.php'); ?> 
 
</nav>
</div>


<br/>
<br/>
<br/>



 <?php
 	// Query to calculate today's total profit



if ($profit_result && $expense_result->num_rows > 0) {
	
	
    $row1 = $profit_result->fetch_assoc();
    $row2 = $expense_result->fetch_assoc();
    $today_profit = $row1['TodayProfit'] !== null ? $row1['TodayProfit'] : 0;
    $today_expense = $row2['TodayExpense'] !== null ? $row2['TodayExpense'] : 0;
	$net_profit = 0;
	$net_profit = $today_profit - $today_expense;
}
else {
	$today_profit=0;
	$today_expense=0;
	$net_profit=0;
}
?>




<div class="financial-summary">
  <div class="financial-item">
    <span class="label">Today's Total Income:</span>
    <span class="value"> <?php echo  number_format($today_profit, 2) ?>  ETB</span>
  </div>
  <div class="financial-item net-profit2">
    <span class="label">Today's Total Expense:</span>
    <span class="value"> <?php echo " - ". number_format($today_expense, 2) ?> ETB</span>
  </div>
  <div class="financial-item net-profit">
    <span class="label">Today's Net Profit:</span>
    <span class="value"><?php echo number_format($net_profit, 2) ?> ETB</span>
  </div>
</div>

<br/>
<br/>
<br/>
<div class="dashboard-widget">
    <h2>Top 10 Sales Products of the Day </h2>
    <table class="sales-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Product Name</th>
                <th>Total Sales (ETB)</th>
                <th>Total Quantity</th>
                <th>Sales Count</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rank = 1;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $rank++ . "</td>
                            <td>" . htmlspecialchars($row['Productname']) . "</td>
                            <td>" . $row['TotalQuantitySold'] . " Sold</td>
                            <td>" . $row['NumberOfSales'] . " Orders</td>
                          <td> <b>" . number_format($row['TotalSalesAmount'], 2) . " ETB </b></td>
						  </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No sales data available</td></tr>";
            }
			
			

 ?>

    </tbody>
    </table>
</div>


<br/>
<br/>
<br/>
<div class="dashboard-widget">
    <h2>Top 10 Sales Products of the Week </h2>
    <table class="sales-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Product ID</th>
                <th>Total Sales (ETB)</th>
                <th>Total Quantity</th>
                <th>Sales Count</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rank = 1;
            if ($result2->num_rows > 0) {
                while($row = $result2->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $rank++ . "</td>
                            <td>" . htmlspecialchars($row['ProductName']) . "</td>
                            <td>" . $row['TotalQuantitySold'] . " Sold</td>
                            <td>" . $row['NumberOfSales'] . " Orders</td>
							 <td> <b>" . number_format($row['TotalSalesAmount'], 2) . " ETB</b></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No sales data available</td></tr>";
			}
			

 ?>
        </tbody>
    </table>
</div>

<br/>
<br/>
<br/>


<div class="dashboard-widget">
    <h2>Top 10 Sales Products of the Month</h2>
    <table class="sales-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Product ID</th>
                <th>Total Sales (ETB)</th>
                <th>Total Quantity</th>
                <th>Sales Count</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rank = 1;
            if ($result3->num_rows > 0) {
                while($row = $result3->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $rank++ . "</td>
                            <td>" . htmlspecialchars($row['ProductName']) . "</td>
                             <td>" . $row['TotalQuantitySold'] . " Sold</td>
                            <td>" . $row['NumberOfSales'] . " Orders</td>
							 <td><b>" . number_format($row['TotalSalesAmount'], 2) . " ETB </b></td>
				</tr>"; }
            }  else {
                echo "<tr><td colspan='5'>No sales data available</td></tr>";
            }
			
			

 ?>
        </tbody>
    </table>
</div>


<br/>
<br/>
<br/>


</body>
</html>

<?php $conn->close(); ?>
