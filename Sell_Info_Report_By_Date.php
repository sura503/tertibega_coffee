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
 
  <?php include('header/sell_report_sub_header.php'); ?> 
 
</nav>
</div>



<center> <h3>  Product Sells History Page </h3> </center>

<form method="POST" action="">
  <div> Catagory : <select name='Prod_catagory' required>  
                     <option >  </option>   
					<option value='= 2' > Food Products </option> 
					<option value='= 1' > Drink Products </option> 
					<option value='IN (1, 2)' > Both Products </option> 
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



$sql = "SELECT 
    e.ProductID,
    e.ProductName,
    SUM(a.Quantity) AS Quantity,
    SUM(a.TotalAmount) AS TotalAmount,
    AVG(a.Unit_Price) AS Unit_Price -- Assuming you want the average unit price
FROM sales AS a
INNER JOIN product_list_rec AS e 
    ON a.ProductID = e.ProductID
WHERE a.SaleDate BETWEEN '$from_date' AND '$to_date'
  AND e.Product_Type $Prod_Type
GROUP BY e.ProductID, e.ProductName
ORDER BY Quantity DESC;
";


	
$profit_sql = "SELECT SUM(TotalAmount) AS TodayProfit FROM sales as a INNER JOIN product_list_rec AS e 
    ON a.ProductID = e.ProductID WHERE SaleDate BETWEEN '$from_date' AND '$to_date' and e.Product_Type $Prod_Type ";

$profit_result = $conn->query($profit_sql);

$today_profit = 0;



   $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

 echo "<br/><br/><br/><br/><center> <h3>Product Seles Report Starting from $from_date - to - $to_date </h3><br/><table id='data_fetch' style='width:90%'>";
    echo "<tr>
							<th>Product Name</th>
							<th>Seles Quantity Sold</th>
            <th>Unit_Price</th>
            <th>TotalAmount</th>
                   
          </tr>";
   while ($row = mysqli_fetch_assoc($result)) {
		
//Sales_ID	SaleDate	SaleTime 	Quantity	Unit_Price	TotalAmount	ProductID	ProductID	ProductName	Category	Unit_Price	Product_Type	Prodcut_State
      //  echo "Profit: " . $row['TodayProfit'] . " | Time: " . $row['SaleTime'] . "<br>";
   // }
//}


   
    // output data of each row
    //while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["ProductName"]) . "</td>
               <td>" . htmlspecialchars($row["Quantity"]) . "</td>
				<td>" . htmlspecialchars($row["Unit_Price"]) . "</td>
                <td>" . htmlspecialchars($row["TotalAmount"]) . "</td>
              </tr>";
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