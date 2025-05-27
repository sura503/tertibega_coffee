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



$expense_sql = "
SELECT Sum(Prod_Total_Price) AS TodayExpense
        FROM expense_tbl 
        WHERE DATE(date_of_rec) = CURDATE()
     
";

$expense_result = $conn->query($expense_sql);

$today_expense = 0;



?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
	

/* Container for the entire financial summary */
.financial-summary {
  width: 400px;
  margin: 20px auto;
  padding: 20px;
  background-color: #f4f7fa;
  border-radius: 8px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  font-family: 'Arial', sans-serif;
  color: #333;
}

/* Style for each financial item */
.financial-item {
  display: flex;
  justify-content: space-between;
  margin-bottom: 15px;
  padding: 10px 0;
  border-bottom: 1px solid #e1e8f0;
}

.financial-item:last-child {
  border-bottom: none;
}

.label {
  font-size: 16px;
  font-weight: bold;
  color: #555;
}

.value {
  font-size: 16px;
  font-weight: bold;
  color: #333;
}

.net-profit {
  font-size: 18px;
  color: #fff;
  background-color: #28a745;
  padding: 10px;
  border-radius: 5px;
  text-align: center;
}

.net-profit .value {
  color: white;
  font-size: 18px;
}





	.success-message {
  color: #155724;
  background-color: #d4edda;
  border: 1px solid #c3e6cb;
  padding: 10px 15px;
  border-radius: 5px;
  font-weight: bold;
  max-width: fit-content;
}

@media screen and (max-width: 480px) {
  .header {
    padding: 10px;
  }
  .header a {
    font-size: 14px;
    margin: 8px 0;
  }
}

.header .logo {
  color: white;
  font-size: 24px;
  font-weight: bold;
  text-decoration: none;
}



@media screen and (max-width: 768px) {
  .header {
    flex-direction: column;
    align-items: flex-start;
  }
  .header a {
    margin: 10px 0;
  }
}

/* Mobile phones */
@media screen and (max-width: 480px) {
  .header {
    padding: 10px;
  }
  .header a {
    font-size: 14px;
    margin: 8px 0;
  }
}



      #data_fetch  table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
      #data_fetch  th, td {
            border: 1px solid #999;
            padding: 8px 12px;
            text-align: left;
        }
      #data_fetch  th {
            background-color: #04AA6D;
            color: white;
        }
       #data_fetch tr:nth-child(even) {
            background-color: #f2f2f2;
        }
		
		

/* Base table styles */
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #999;
  padding: 8px 12px;
  text-align: left;
}

/* Allow horizontal scrolling on small screens */
.table-container {
  overflow-x: auto;
}

/* **************************** For very small screens: stack table rows ************************** */
@media only screen and (max-width: 600px) {
  table, thead, tbody, th, td, tr {
    display: block;
  }

  thead tr {
    display: none; /* Hide table headers */
  }

  tr {
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    padding: 10px;
  }

  td {
    border: none;
    position: relative;
    padding-left: 50%;
    white-space: normal;
    text-align: left;
  }

  /* Add labels before each cell using data-label attribute */
  td::before {
    content: attr(data-label);
    position: absolute;
    left: 10px;
    top: 10px;
    font-weight: bold;
    white-space: nowrap;
  }
  
  .report-nav {
	float:left;
	display:block;
	margin-top:10%;
	font-size:10px;
}
}

/* *****************************************************************  */	

/* Style the buttons that are used to open and close the accordion panel */
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  text-align: left;
  border: none;
  outline: none;
  transition: 0.4s;
}

/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.active, .accordion:hover {
  background-color: #ccc;
}

/* Style the accordion panel. Note: hidden by default */
.panel {
  padding: 0 18px;
  background-color: white;
  display: none;
  overflow: hidden;
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
	
?>

<div class="financial-summary">
  <div class="financial-item">
    <span class="label">Today's Total Income:</span>
    <span class="value"> <?php echo  number_format($today_profit, 2) ?>  ETB</span>
  </div>
  <div class="financial-item">
    <span class="label">Today's Total Expense:</span>
    <span class="value"> <?php echo " - ". number_format($today_expense, 2) ?> ETB</span>
  </div>
  <div class="financial-item net-profit">
    <span class="label">Today's Net Profit:</span>
    <span class="value"><?php echo number_format($net_profit, 2) ?> ETB</span>
  </div>
</div>

<?php
}
else 
	
echo "no result found";

?>
 
<br/>
<br/>
<br/>

</body>