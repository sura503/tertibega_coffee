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
    font-family: Arial, sans-serif;
    margin: 20px;
    padding: 0;
    background-color: #f4f4f4;
  }
  .container {
    max-width: 600px;
    margin: auto;
    background: white;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    border-radius: 8px;
  }
  h2 {
    text-align: center;
    color: #333;
  }
 
 form {
    display: flex;
    flex-direction: column;
  }
  .record {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
   
    padding-bottom: 25px;
	
  }
  .record input[type="text"],
  .record input[type="number"],
  .record .Product_Type
  
  {
	  height:40px;
    flex: 1 1 45%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  
  option {
	  font-size:15px;
  }
  
  p{
	  flex: 1 1 5%;
    padding-top: 10px;
    padding-left: 20px;
        border-radius: 4px;
  }
  
  
    .submit-btn {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
  }
  .submit-btn:hover {
    background-color: #0056b3;
  }
  @media (max-width: 480px) {
    .record input[type="text"],
    .record input[type="number"] {
      flex: 1 1 100%;
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



<div class="container">
<br/>
  <h2>Register New Product</h2>
  
  <br/>
  <br/>
  <br/>
  <form id="multiRecordForm" method="post" action="save_product_Page.php">
    <div class="record">
      <p> Product Name: </p>
       <input type="text" name="Prod_Name" class="Prod_Name" placeholder="Enter Product Name" required>
    </div>
	
	 <div class="record">
      <p> Product Type: </p>
	  <select id="Prod_category" class="Product_Type" name="Product_Type">
      	  <option>  </option>
      	  <option value="1"> Drink Product </option>
      	  <option value="2"> Food Product </option>
      	   </select>
		   
    </div>
	 <div class="record">
      <p> Product Catagory: </p>
      <input type="text" name="Prodcut_Catgory" placeholder="Product Category" required>
    </div>
	
	 <div class="record">
      <p> Unit Price: </p>
      <input type="number" name="Unit_Price" placeholder="Enter number" required>
    </div>
	    <button type="submit" name="submit" class="submit-btn">Submit</button>
  </form>
</div>


<br/>
<br/>
<br/>
<br/>
</div>


</body>
</html>


