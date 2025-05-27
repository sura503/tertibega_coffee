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
    padding: 25px 30px;
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
    flex-basis: 30%;
  }
  .col-2 {
    flex-basis: 25%;
  }
  .col-3 {
    flex-basis: 25%;
  }
  .col-4 {
    flex-basis: 25%;
  }
  .col-5 {
    flex-basis: 25%;
  }
  .col-6 {
    flex-basis: 25%;
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
 
  <?php include('header/product_sub_header_1.php'); ?> 
 
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
$conn = new mysqli("localhost", "root", "", "tertibega_coffee");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$sql=" 
SELECT * from  product_list_rec where Product_Type = 1 order by Product_Type,Catagory";

?>

</head>
<body>

<br/>
<div>






<?php

   $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				 	

?>




<div class="container">
  <h2>Tertibega Coffee Product's <small>Drink Beverages </small></h2>
  <br/>
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">Product Name </div>
      <div class="col col-2">Category</div>
      <div class="col col-3">Unit Price</div>
      <div class="col col-4">Product Type</div>
      <div class="col col-5">Prodcut State</div>
    </li>
	



<?php


	 
	 
         
   while ($row = mysqli_fetch_assoc($result)) {
		
		
 
	 
	 if($row["Product_Type"] == 1 )
	 {
		 $Product_Type= "Drink Product";
	 }
	 else if ($row["Product_Type"] == 2 )
	 {
		$Product_Type= "Food Product"; 
	 }
	 
	 

   
    // output data of each row
    //while($row = $result->fetch_assoc()) {
       	  echo "<li class='table-row'>";
      echo "<div class='col col-1' data-label='Product Name'>". htmlspecialchars($row["ProductName"]) ."</div>";
      echo "<div class='col col-2' data-label='Category'>". htmlspecialchars($row["Catagory"]) ."</div>";
      echo "<div class='col col-3' data-label='Unit Price'>". htmlspecialchars($row["Unit_Price"]) ." ETB </div>";
     echo "<div class='col col-4' data-label='Product Type'>" . htmlspecialchars($Product_Type) . " </div>";

     echo "</li>";
    }
    echo "</table> </center>";
	?>
</div>
<br/>
<br/>
<br/>




</div>
<br/>
<br/>
<br/>

</body>
</html>


