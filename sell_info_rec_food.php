<?php 
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="css/header_main_css_1.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tertibega Coffee </title>
  <style>
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


    /* Basic reset */
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: #f4f7f8;
     justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

.form-container {
    /* Center the container */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    /* Size and spacing */
     width: auto;
    margin: 30px auto;
    padding: 10px 24px;
	
	
    /* Visual style */
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.10), 0 1.5px 4px rgba(0,0,0,0.07);
    border: 1px solid #e0e0e0;

    /* Optional: smooth transition for hover/focus */
    transition: box-shadow 0.2s;
}

    form {
      grid-template-columns: repeat(6, 1fr);
      gap: 15px;
      align-items: end;
    }
	
	.add-item {
		
		display: block;
	}

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      font-size: 0.9rem;
      color: #333;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"],
    input[type="date"],
    input[type="tel"],
    select {
      width: 100%;
      padding: 8px 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 0.9rem;
      transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="number"]:focus,
    input[type="date"]:focus,
    input[type="tel"]:focus,
    select:focus {
      border-color: #007BFF;
      outline: none;
    }

    /* Submit button spans all columns */
    button[type="submit"] {
      grid-column: span 6;
      padding: 12px;
      background-color: #007BFF;
      color: white;
      font-size: 1.1rem;
      font-weight: 700;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"][name="enter"]:hover {
      background-color: #0056b3;
    }
	
	input[type="submit"][name="enter"] {
	  background-color: #007BFF;  /* button background */
	  color: white;               /* text color */
	  border: none;               /* remove border */
	  padding: 10px 20px;         /* spacing inside button */
	  cursor: pointer;            /* pointer cursor on hover */
	  border-radius: 5px;         /* rounded corners */
	  font-size: 16px;            /* font size */
	}





    /* Responsive for smaller screens */
    @media (max-width: 700px) {
      form {
        grid-template-columns: 1fr 1fr;
      }
      button[type="submit"] {
        grid-column: span 2;
      }
    }

    @media (max-width: 400px) {
      form {
        grid-template-columns: 1fr;
      }
      button[type="submit"] {
        grid-column: span 1;
      }
    }
	
	
.link-container {
  display: flex;
  gap: 24px; /* space between links */
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-size: 1rem;
  
}

.styled-link {
  color: #4a90e2; /* base link color */
  text-decoration: none;
  padding: 8px 16px;
  border: 2px solid transparent;
  border-radius: 6px;
  transition: 
    color 0.3s ease, 
    background-color 0.3s ease, 
    border-color 0.3s ease;
  cursor: pointer;
}

.styled-link:link {
  color: #4a90e2;
}

.styled-link:visited {
  color: #7b61ff;
}

.styled-link:hover,
.styled-link:focus {
  color: #fff;
  background-color: #4a90e2;
  border-color: #4a90e2;
  outline: none;
  text-decoration: underline;
}

.styled-link:active {
  background-color: #3a6fc1;
  border-color: #3a6fc1;
   border-color: #4a90e2;
  color: #e0e0e0;
  text-decoration: none;
}

/* Accessibility: focus outline for keyboard users */
.styled-link:focus-visible {
  outline: 3px solid #ffa500;
  outline-offset: 2px;
}

.styled-link.active {
  background-color: #4a90e2;
  border-color: #4a90e2;
  color: #fff;
  cursor: default; /* Indicates it's the current page */
  text-decoration: none;
  pointer-events: none; /* Optional: disables clicking on active link */
}


  </style>
</head>



<body>

<!-- HTML -->
<header>
<?php include('header/add_sell_header.php'); ?> 
</header> 
<div>

  <nav class="report-nav4">
 
 <div class="navbar">
  <a href="sell_info_rec_food.php" id="active-nv" >Tertibega Foods </a>
  <a href="sell_info_rec_drink.php" >Tertibega Drinks </a>
  <a href="Sell_Info_Report_Current_Date.php" > Sales History </a>
   
 

 
</div>
 
 
</nav>
</div>

<br/>
<br/>
<br/>
<center><h2> Tertibega Coffee Food Order Selection Page </h2> </center>

  <div class="form-container">
    <div>

<br/>


<br/>
</div>


	<form action="sell_info_Report.php" method="POST">
      <div class="add-item">
	    <label for="ProdName">Product Name </label>
		
	 <?php 

	


	 // Query to fetch id and value columns from your table
$sql = "SELECT ProductID,ProductName FROM product_list_rec where Product_Type=2 ORDER BY ProductID ASC";
$result = $conn->query($sql);

echo "<select name='Prod_ID' style='width:300px;' id='dropdown'>";
echo '<option value="" disabled selected>Select an option</option>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($row['ProductID']) . '">' . htmlspecialchars($row['ProductName']) . '</option>';
    }
}

echo '</select>';

$conn->close();
	 
	 
	 ?> 
	  </div>
	  <br/>
	  <br/>
      <div class="add-item">
        <label for="Amount"> Quantity </label>
        <input type="number" id="Tot_ammount"  name="Tot_ammount" required min="1" placeholder="Amount" required />
      </div>
	  
         <br/>
         <br/>
		 <div class="add-item">
		  <input type="submit"  name="enter" value="Submit" class="btn btn-primary" style="width:100%;"/>
		  </div>
    <br/>
    <br/>
	</form>
  </div>

  <br/>
  <br/>
  <br/>
  <br/>
  
</body>
</html>

