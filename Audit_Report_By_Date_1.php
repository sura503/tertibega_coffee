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

	  	/* CSS */
.header {
  position: fixed;     /* Fix header to viewport */
  top: 0;              /* Align to top */
  left: 0;             /* Align to left */
  width: 95%;         /* Full width */
  background-color: #333;
  padding: 15px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  z-index: 1000;       /* Make sure it stays on top */
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

	  	/* CSS */
.header {
  position: fixed;     /* Fix header to viewport */
  top: 0;              /* Align to top */
  left: 0;             /* Align to left */
  width: 100%;         /* Full width */
  background-color: #333;
  padding: 15px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  z-index: 1000;       /* Make sure it stays on top */
position: sticky;
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
	margin-top:1%;
	font-size:10px;
}
}

/* *****************************************************************  */	





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


if ($profit_result && $expense_result->num_rows > 0) {
	
	
    $row1 = $profit_result->fetch_assoc();
    $row2 = $expense_result->fetch_assoc();
    $today_profit = $row1['TodayProfit'] !== null ? $row1['TodayProfit'] : 0;
    $today_expense = $row2['TodayExpense'] !== null ? $row2['TodayExpense'] : 0;
	$net_profit = 0;
	$net_profit = $today_profit - $today_expense;
	



$find_profit = "SELECT 
    SUM(TotalAmount) AS TodayProfit, 
    SaleDate AS Date
FROM sales
GROUP BY date(SaleDate)
ORDER BY SaleDate;";

# sum the expense data of the same in the array 

	
$find_expense = "SELECT Sum(Prod_Total_Price) AS TodayExpense, date_of_rec as 'Date'
        FROM expense_tbl 
        group by DATE(date_of_rec) order by date_of_rec ";
		


?>

</head>
<body>
<center> <h3> Today's Audit Report </h3> </center>
<br/>
<br/>
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
    <span class="label" style="color:white;">Today's Net Profit:</span>
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