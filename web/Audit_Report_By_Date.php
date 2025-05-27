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

.center-links {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 40px;
    margin-bottom: 40px;
}

.center-links a {
    text-decoration: none;
    color: #0078d7;
    background: #fff;
    padding: 14px 28px;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 500;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    transition: background 0.2s, transform 0.2s;
}

.center-links a:hover {
    background: #f1f1f1;
    transform: translateY(-2px) scale(1.04);
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
<br/>
<div>

  <nav class="report-nav">
  <ul>
    <li><a href="Sell_Info_Report_View.php" class="report-link">Today's Transactions Report</a></li>
    <li><a href="Sell_Info_Report_By_Date.php" class="report-link "> Seles History</a></li> 
	 <li><a href="Expense_Report_By_Date.php" class="report-link ">Expense History </a></li>
	<li><a href="/reports/inventory" class="report-link active">Audit Report</a></li>
    <li><a href="/reports/finance" class="report-link">Employee's Report</a></li>  </ul>
</nav>
</div>
<br/>
<br/>
<br/>

<div class="center-links">
  <a href='Audit_Report_By_Date_1.php'>Show all audit records</a>
  <a href='Audit_Report_By_Date.php'>Search audit by date</a>
</div>
  </center>


<form method="POST" action="">
  <div> Catagory : <select name='Prod_catagory' required>  
                     <option >  </option>   
					<option value="1" > All </option> 
					<option value='Food Product' > Food Products </option> 
					<option value='Drink Product' > Drink Products </option> 
					<option value='House Rent' > House Rent </option> 
					<option value='Employee Salary' > Employee Salary </option> 
					<option value='Other' > Other </option> 
					
					
			
          </select>  </div>
  <div> From : <input type="date" name="from_date" required /> </div>
   <div> To : <input type="date" name="to_date" required /> </div>
   <button type="submit" name="search">Search</button> 
</form>



<div>
<?php 

if (isset($_POST['search'])) {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $Prod_Type = $_POST['Prod_catagory'];

    // Validate and sanitize dates if needed

// Sales_ID	SaleDate	SaleTime Descending 1	Quantity	Unit_Price	TotalAmount	ProductID	ProductID	ProductName	Category	Unit_Price	Product_Type	Prodcut_State
    
	
	$sql2 = "SELECT *
            FROM sales s
            JOIN product_list_rec a ON s.ProductID = a.ProductID
            WHERE s.SaleDate BETWEEN '$from_date' AND '$to_date'
              AND a.Product_Type = 1
            ORDER BY s.SaleTime DESC";


$sql_food = "select Expense_ID, date_of_rec, Prod_Name, Prod_Unit_Price, 
 Amount, Prod_Total_Price, Expense_Category, Remark
FROM expense_tbl
   WHERE DATE(date_of_rec) = CURDATE()
ORDER BY date_of_rec ; ";	


if ($Prod_Type==1 ){

$sql = "Select Expense_ID, date_of_rec, Prod_Name, Prod_Unit_Price, 
 Amount, Prod_Total_Price, Expense_Category, Remark
FROM expense_tbl
   WHERE DATE(date_of_rec) BETWEEN '$from_date' AND '$to_date'
  ORDER BY Prod_Total_Price DESC;
";
} else 
{
#IN ('Food Product','Drink Product','House Rent','Employee Salary','Other')	
$sql = "Select Expense_ID, date_of_rec, Prod_Name, Prod_Unit_Price, 
 Amount, Prod_Total_Price, Expense_Category, Remark
FROM expense_tbl
   WHERE DATE(date_of_rec) BETWEEN '$from_date' AND '$to_date'
  AND Expense_Category = '$Prod_Type'
ORDER BY Prod_Total_Price DESC;
";
}

	
$profit_sql = "SELECT SUM(TotalAmount) AS TodayProfit FROM sales as a INNER JOIN product_list_rec AS e 
    ON a.ProductID = e.ProductID WHERE SaleDate BETWEEN '$from_date' AND '$to_date' and e.Product_Type $Prod_Type ";

$profit_result = $conn->query($profit_sql);

$today_profit = 0;



   $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

 echo "<br/><br/><br/><br/><center> <h3>Product Seles Report Starting from $from_date - to - $to_date </h3><br/><table id='data_fetch' style='width:90%'>";
   echo "<tr>
							<th>Product Name</th>
							<th>Records on </th>
                       <th> Category</th>
                       <th>Unit Price</th>
                       <th>Amount</th>
            <th>Total Paid Amount</th>
            <th>Remark</th>
            
          </tr>";
   while ($row = mysqli_fetch_assoc($result)) {
		
//Sales_ID	SaleDate	SaleTime 	Quantity	Unit_Price	TotalAmount	ProductID	ProductID	ProductName	Category	Unit_Price	Product_Type	Prodcut_State
      //  echo "Profit: " . $row['TodayProfit'] . " | Time: " . $row['SaleTime'] . "<br>";
   // }
//}

 
        echo "<tr>
                <td>" . htmlspecialchars($row["Prod_Name"]) . "</td>
                <td>" . htmlspecialchars($row["date_of_rec"]) . "</td>
                <td>" . htmlspecialchars($row["Expense_Category"]) . "</td>
                <td>  - " . htmlspecialchars($row["Prod_Unit_Price"]) . " ETB </td>
                <td>" . htmlspecialchars($row["Amount"]) . "</td>
                <td>  - " . htmlspecialchars($row["Prod_Total_Price"]) . " ETB </td>
                <td>" . htmlspecialchars($row["Remark"], 2) . "</td> </tr> ";
    }
   

    
	
	
	
	
	
    echo "</table> </center>";
	

if ($profit_result && $profit_result->num_rows > 0) {
    $row = $profit_result->fetch_assoc();
    $today_profit = $row['TodayProfit'] !== null ? $row['TodayProfit'] : 0;
	echo "<h3 style='text-align:right;padding-right:8%;'>Total Income: ". number_format($today_profit, 2). " ETB </h3>";
	}


}

?>

<br/>
<br/>
<br/>
<br/>
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