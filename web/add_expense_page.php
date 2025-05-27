<?php 
session_start();
include("function/admin_session.php");
include("db/dbconn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Expense Registration Page </title>
    <link rel="stylesheet" href="styles.css">
	
<style>



body {
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
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
</head>
<body>



<!-- HTML -->


<header>
<?php include('header/add_expense_header.php'); ?> 
</header> 

<div>
  <nav class="report-nav4">
 
  <?php include('header/add_expense_sub_header.php'); ?> 
 
</nav>
</div>



<br/>
<br/>

    <center> <h3> Add Expense Record </h3> </center>
    <form action="expense_submit_form.php" method="post">
        <label for="Prod_Name">Product Name:</label>
        <input type="text" id="Prod_Name" name="Prod_Name" required>

        <label for="Product Catagory">Product Catagory:</label>
        <select  type='text' name='Prod_catagory' required>   
		<option>   </option>
		<option value='Food Product'> Food Product  </option>
		<option value='Drink Product'> Drink Product </option>
		<option value='House Rent'> House Rent  </option>
		<option value='Employee Salary'> Employee Salary  </option>
		<option value='Other'> Other </option>
				</select >
		
		<label for="Unit_Price">Unit Price:</label>
        <input type="number" id="Unit_Price" name="Unit_Price" required>


		<label for="amount">Amount:</label>
        
		<div class="input-row" style="align-items: center;">
       <input type="number" id="amount" name="amount" required min="1" placeholder="Enter amount">
      <select name="amount_option" required>
      
	  <option value="" disabled selected>Select option</option>
      <option value="Litter">Litter</option>
      <option value="KG">KG</option>
      <option value=" Items">Items</option>
      <option value="Month of Fees">Month of Fee</option>
    </select>
     </div>

  
        <label for="Remark_"> Remark :</label>
        <input type="text" id="Remark" name="Remark" required>

        <input type="submit" name='submit' value="Add Record">
    </form>
</body>
</html>
