<?php
$conn = new mysqli("localhost", "root", "", "tertibega_coffee");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>





<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
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
	background: white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    border-radius: 12px;
    max-width: 400px;
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 12px;
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
  


form {
    background: #fff;
    max-width: 400px;
    margin: 50px auto;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 8px;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="number"], 
select {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background: #007bff;
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background: #0056b3;
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
  
</style>


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
 
  <?php include('header/product_sub_header_1.php'); ?> 
 
</nav>
</div>


<br/>
<br/>
<br/>



<?php

if(isset($_POST['submit']))
	{
		$Prod_Name = $_POST['Prod_Name'];
    $Product_Type = $_POST['Product_Type'];
    $Prodcut_Catgory = $_POST['Prodcut_Catgory'];
    $Unit_Price = $_POST['Unit_Price'];
	
$Data = "INSERT INTO product_list_rec(ProductName ,Product_Type,  Catagory, Unit_Price) VALUES 	('$Prod_Name',$Product_Type,'$Prodcut_Catgory','$Unit_Price' )";

$data1 = mysqli_query($conn,$Data); //// memberinfo data is inserted //////
					if($data1)
					{
					echo "<script> alert('data saved successfully'); </script>";
					}
					else
						echo "<script> alert('data not saved successfully'); </script>";
					
					
					
$sql22 = "SELECT ProductName ,Product_Type,  Catagory, Unit_Price  FROM product_list_rec order by ProductID desc LIMIT 1";
$result = $conn->query($sql22);

$row = $result ? $result->fetch_assoc() : null;
$conn->close();



 if ($row): 
 
 if($row['Product_Type']=="1")
 {
	 $Product_Type="Drink Product";
 }
 elseif($row['Product_Type']=="2")
 {
	 $Product_Type="Food Product";
 }
 ?>
 
 <br/>
 <br/>
 <br/>
 <br/>
 <br/>
  <div class="card">
    <h2>Expense Record</h2>
    <div class="field"><label>Product Name:</label> <span><?= htmlspecialchars($row['ProductName']) ?></span></div>
    <div class="field"><label>Product Type:</label> <span><?= htmlspecialchars($Product_Type) ?></span></div>
    <div class="field"><label>Product Category:</label> <span><?= htmlspecialchars($row['Catagory']) ?></span></div>
    <div class="field"><label>Unit Price:</label> <span><?= number_format($row['Unit_Price'], 2) ?> Birr </span></div>
    <div class="add"><center><a href='Product_Add_Page.php'> Add New Product </a> </center></div>
     </div>
<?php else:  
  echo "<p>No data found.</p>";
endif; 

}
else 
{
	echo "kill the process ";
	die();
}
?>



<br/>
<br/>
<br/>
<br/>
</div>


</body>
</html>


