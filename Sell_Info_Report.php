<?php
$conn = new mysqli("localhost", "root", "", "tertibega_coffee");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['enter']))

	{
    
$Prod_Id = $_POST['Prod_ID'];
$Quantity = $_POST['Tot_ammount'];


		
			$result1=$conn->query("SELECT Unit_Price FROM product_list_rec WHERE ProductID = $Prod_Id ")
				or die ('cannot login' . mysqli_error());
			$row=$result1->fetch_array  ();
			$run_num_rows = $result1->num_rows;
							
						if ($run_num_rows > 0 )
						{
							$Prod_Unit = $row['Unit_Price'];
						$Total_Price = ($Quantity)*($Prod_Unit);
						$insert_stmt = $conn->prepare("INSERT INTO sales(ProductID, Quantity, Unit_Price, TotalAmount) VALUES ($Prod_Id, $Quantity,$Prod_Unit, $Total_Price)");
							
							if ($insert_stmt->execute()) {
				
				//echo "<br/> <br/> <br/><br/> <center><h3 class='success-message'> you have successfully recorded the Sell transactions </h3><br/> </center>";
				#header ("location:sell_info_Report.php");
				
			} else {
				echo "Error: " . $conn->error;
			}
							
							
						}
						else 
							echo "<script> alert('data not saved  !!! '); </script>";
	}			
					




$sql = "SELECT Sales_ID, e.ProductName, SaleDate, SaleTime, Quantity, a.Unit_Price, TotalAmount 
        FROM sales as a, product_list_rec as e 
        WHERE a.ProductID = e.ProductID 
        ORDER BY SaleTime DESC limit 1";

$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
	
  body {
	 font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #f0f2f5;
  justify-content: center;   /* centers horizontally */
  align-items: center;       /* centers vertically */
  height: 100vh;             /* full viewport height */
  margin: 0;                 /* remove default margin */
  padding: 0;   
  }
  
  .card {
	  margin-left: auto;
     margin-right: auto;
     margin-top: 60px;
	background: white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    border-radius: 12px;
    max-width: 400px;
    padding: 24px;
    flex-direction: column;
    gap: 12px;
	display: flex;
  height: 50vh;           /* full viewport height */
  
  }
  .card h2 {
    margin: 0 0 12px 0;
    color: #333;
  }
  .field {
    display: flex;
    justify-content: space-between;
    font-size: 1rem;
    color: #555;
  }
  .field label {
    font-weight: 600;
    color: #222;
  }
  .timestamp {
    margin-top: 16px;
    font-size: 0.85rem;
    color: #888;
    text-align: right;
    font-style: italic;
  }
  

a.button-like {
  display: inline-block;
  padding: 10px 20px;
  background-color: #4E9CAF;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  font-weight: bold;
  text-align: center;
  cursor: pointer;
}

a.button-like:hover {
  background-color: #367a8b;
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
  width: 90%;
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

/* For very small screens: stack table rows */

  table, thead, tbody, th, td, tr {
    display: block;
	width: auto;
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


		
	
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tertibega Coffee</title>
  <style>
  

	
    </style>
</head>
<body>

<!-- HTML -->



<header>
<?php include('header/add_sell_header.php'); ?> 
</header> 

<div>
  <nav class="report-nav4">
 
  <?php include('header/sell_report_sub_header.php'); ?> 
 
</nav>
</div>







<?php


if ($result->num_rows > 0) { 
    
/*	echo "<center> <table id='data_fetch'>
         <tr> <td> <b>Saved Order Detail </b></td></tr>";
    // output data of each row  */
    while($row = $result->fetch_assoc()) {
		
		?>
 <div class="card">
    <h3 style='color:green;text-align:center;'> Sales Records Successfully </h3>
	<br/>
    <div class="field"><label>Product Name:</label> <span><?= htmlspecialchars($row['ProductName']) ?></span></div>
    <div class="field"><label>Order Quantity:</label> <span><?= $row['Quantity'] ." Order "?></span></div>
    <div class="field"><label>Unit Price:</label> <span> <?= number_format($row['Unit_Price'], 2) ?> Birr</span></div>
    <div class="field"><label>TotalAmount:</label> <span><?= htmlspecialchars($row['TotalAmount']) ?>Birr</span></div>
    <div class="timestamp">Recorded on: <?= date("F j, Y, g:i a", strtotime($row['SaleTime'])) ?></div>
  </div>


<?php

}
}


  /*      echo "<tr><td> <b> Product Name : </b>" . htmlspecialchars($row["ProductName"]) . "</td> </tr>
               <tr> <td><b>  Sale Date :</b>" . htmlspecialchars($row["SaleTime"]) . "</td></tr>
                <tr><td> <b> Quantity :</b>" . htmlspecialchars($row["Quantity"]) . "</td> </tr>
                <tr><td><b> Unit Price : </b>" . htmlspecialchars(number_format($row["Unit_Price"], 2)) . " ETB </td>
                <tr><td><b> Total Amount :</b>" . htmlspecialchars(number_format($row["TotalAmount"], 2)) . " ETB </td> </tr>
				<tr><td> <a  href='sell_info_rec_food.php' class='button-like'> Add New Order </a> </td></tr>
    
	    ";
 */


  
	
	


	
	// Query to calculate today's total profit

//} 


?>  
  
</body>
</html>