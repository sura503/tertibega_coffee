<?php 
session_start();
include("function/admin_session.php");
include("db/dbconn.php");
?>


<?php
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


/* Container for the entire financial summary */
.financial-summary {
  width: 90%;
  margin: 20px auto;
  padding: 50px;
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
  color: #f1f1f1;
  background-color: #12a39a;
  padding: 10px;
  border-radius: 3px;
  text-align: center;
}

.net-profit .value {
  color: white;
  font-size: 18px;
}



.report-nav {
	float:left;
	display:block;

}	
.report-nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  gap: 20px; /* space between links */
}

.report-nav li {
  /* Optional: style list items */
}

.report-link {
  text-decoration: none;
  color: #2c3e50;
  font-weight: 600;
  padding: 8px 12px;
  border-radius: 5px;
  transition: background-color 0.3s ease, color 0.3s ease;
}

.report-link:hover,
.report-link:focus {
  background-color: #4a90e2;
  color: white;
  outline: none;
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

.nav-links a {
  color: white;
  text-decoration: none;
  margin-left: 20px;
  font-size: 16px;
  padding: 8px 12px;
  border-radius: 4px;
  transition: background-color 0.3s ease;
}

.nav-links a:hover {
  background-color: #575757;
}

.nav-links a.active {
  background-color: #04AA6D;
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


form {
  max-width: 70%;
  margin: 50px auto;
  padding: 50px ;
  background-color: #f5f7fa;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.05);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  display: flex;
  gap: 15px;
  align-items: center;
  justify-content: center;
}

input[type="date"] {
  flex: 1;
  padding: 10px 12px;
  font-size: 16px;
  border: 1.5px solid #ccc;
  border-radius: 6px;
  background-color: #fff;
  transition: border-color 0.3s ease;
  cursor: pointer;
}

select {
  flex: 1;
  padding: 10px 12px;
  font-size: 16px;
  border: 1.5px solid #ccc;
  border-radius: 6px;
  background-color: #fff;
  transition: border-color 0.3s ease;
  cursor: pointer;
}


input[type="date"]:focus {
  border-color: #007bff;
  outline: none;
  box-shadow: 0 0 6px rgba(0, 123, 255, 0.5);
}

button[type="submit"] {
  padding: 11px 22px;
  font-size: 16px;
  font-weight: 600;
  color: #fff;
  background-color: #007bff;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
  background-color: #0056b3;
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
 
  <?php include('header/report_sub_header_1.php'); ?> 
 
</nav>
</div>



<br/>
<br/>


<center> <h3> Search Audit Report </h3> </center>

<form method="POST" action="">

  <div> From : <input type="date" name="from_date" required /> </div>
   <div> To : <input type="date" name="to_date" required /> </div>
   <button type="submit" name="search">Search</button> 
</form>



<div>
<?php 
if (isset($_POST['search'])) {
    $DateStrted = $_POST['from_date'];
    $DateEnds = $_POST['to_date'];

    if ($DateStrted <= $DateEnds) {
        // Convert to DateTime objects and format
        $DateStrtedObj = new DateTime($DateStrted);
        $DateEndsObj = new DateTime($DateEnds);

        $from_date = $DateStrtedObj->format('Y-m-d');
        $to_date = $DateEndsObj->format('Y-m-d');

        // Your SQL query as a string
        $sql2 = "
        SELECT
            (SELECT COALESCE(SUM(TotalAmount), 0) 
             FROM sales 
             WHERE SaleDate BETWEEN '$from_date' AND '$to_date') AS TotalSales,

            (SELECT COALESCE(SUM(Prod_Total_Price), 0) 
             FROM expense_tbl 
             WHERE date_of_rec BETWEEN '$from_date' AND '$to_date') AS TotalExpenses,

            (
                (SELECT COALESCE(SUM(TotalAmount), 0) 
                 FROM sales 
                 WHERE SaleDate BETWEEN '$from_date' AND '$to_date')
                -
                (SELECT COALESCE(SUM(Prod_Total_Price), 0) 
                 FROM expense_tbl 
                 WHERE date_of_rec BETWEEN '$from_date' AND '$to_date')
            ) AS ProfitOrLoss;
        ";

        // Assuming you have a MySQLi connection in $conn
        $result = $conn->query($sql2);

        if ($result) {
			if(isset($result)) {
            $row = $result->fetch_assoc();

            $Searched_Sales = $row['TotalSales'] !== null ? $row['TotalSales'] : 0;
            $Searched_Expense = $row['TotalExpenses'] !== null ? $row['TotalExpenses'] : 0;
            $Profit_Report = $row['ProfitOrLoss'] !== null ? $row['ProfitOrLoss'] : 0;

            // Now you can use these variables as needed
 ?>          
 

	
	<center> <h3> Today's Audit Report </h3> </center>
<br/>
<br/>
<div class="financial-summary">
  <div class="financial-item">
    <span class="label"> Total Income:</span>
    <span class="value"> <?php echo  number_format($Searched_Sales, 2) ?>  ETB</span>
  </div>
  <div class="financial-item">
    <span class="label">Total Expense:</span>
    <span class="value"> <?php echo " - ". number_format($Searched_Expense, 2) ?> ETB</span>
  </div>
  <div class="financial-item net-profit">
    <span class="label" style="color:white;">Net Profit:</span>
    <span class="value"><?php echo number_format($Profit_Report, 2) ?> ETB</span>
  </div>
</div>



<?php 
			}
			else {
				
				echo "no data found for the listed date";
			}
		
		} else {
            echo "Error in query: " . $conn->error;
        }
   
 } else {
        echo "Start date must be earlier than or equal to end date.";
    }
}

?>

</div>


</body>
</html>


