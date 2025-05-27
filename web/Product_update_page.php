<style>
.update-table {
  margin: 20px auto;
  width: 80%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
  margin-bottom: 20px;
  border-radius:0px;
  
}

.update-table th,
.update-table td {
  border: 0px solid #ccc;
  padding: 8px 12px;
  text-align: left;
}

.update-table thead {
  background-color: #f4f4f4;
}

.update-table tbody tr:nth-child(even) {
  background-color: #fafafa;
}

.update-table tbody tr:nth-child(odd) {
  background-color: #fafafa;
}


.update-table input[type="text"],input[type="number"] {
  width: 95%;
  padding: 6px 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 14px;
  box-sizing: border-box;
}

.update-table input[type="text"]:focus {
  border-color: #66afe9;
  outline: none;
  box-shadow: 0 0 5px rgba(102, 175, 233, 0.6);
}


.update-btn {
  background-color: #28a745;       /* Green background */
  color: white;                    /* White text */
  padding: 15px 40px;              /* Top-bottom and left-right padding */
  border: none;                   /* Remove default border */
  border-radius: 5px;              /* Rounded corners */
  font-size: 16px;                 /* Readable font size */
  font-weight: bold;               /* Bold text */
  cursor: pointer;                /* Pointer cursor on hover */
  transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Smooth hover effect */
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
  float:right;
  margin-right: 150px;
}

.update-btn:hover {
  background-color: #218838;       /* Darker green on hover */
  box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15); /* Slightly stronger shadow */
}


</style>
<body>

 
<header>
<?php include('header/report_header.php'); ?> 
</header> 
<div>
  <nav class="report-nav">
 
  <?php include('header/product_sub_header_1.php'); ?> 
 
</nav>
</div>


<?php
// Database connection (update credentials as needed)
include('db/dbconn.php');

// Fetch data
$result = $conn->query("SELECT * from  product_list_rec"); // Replace 'users' with your table name

echo '<form action="Product_update_view_page.php" method="post">';

echo "<table class='update-table'>";

echo '<thead>';
echo '<tr><th> Prodcut ID</th><th>Product Name</th><th>Product Category</th><th> Unit Price </th> </tr>';
echo '</thead>';
echo '<tbody>';


while ($row = $result->fetch_assoc()) {
    $id = htmlspecialchars($row['ProductID']);
	$ProductName = htmlspecialchars($row["ProductName"]);
	$Category= htmlspecialchars($row["Catagory"]); 
	$Unit_Price= htmlspecialchars($row["Unit_Price"]); 
	
	echo "<tr>";
    echo "<td>$id</td>";		
    echo "<td> <input type='text' name='data[$id][ProductName]' value='$ProductName'></td>";
    echo "<td> <input type='text' name='data[$id][Category]' value='$Category'></td>";
    echo "<td> <input type='number' name='data[$id][Unit_Price]' value='$Unit_Price'></td>";
    echo "</tr>";
}
echo "</table>";
echo '<input type="submit" name="submit" value="Update" class="update-btn">';
echo '</form>';
echo "<br/>";
echo "<br/>";
echo "<br/>";
?>


</body>