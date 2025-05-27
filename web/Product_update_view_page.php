
<?php

$conn = new mysqli("localhost", "root", "", "tertibega_coffee");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['submit']) && isset($_POST['data'])) {
    foreach ($_POST['data'] as $id => $fields) {
        // Sanitize each input
        $ProductName = $conn->real_escape_string($fields['ProductName']);
        $Category = $conn->real_escape_string($fields['Category']);
        $Unit_Price = $conn->real_escape_string($fields['Unit_Price']);
       
        // pdate query (replace 'products' with your actual table name)
        $sql = "UPDATE product_list_rec SET 
                    ProductName = '$ProductName', 
                    Category = '$Category', 
                    Unit_Price = '$Unit_Price'
                WHERE ProductID = $id";

        if (!$conn->query($sql)) {
            echo "Error updating record with ProductID $id: " . $conn->error . "<br>";
        }
    }
  //  include(":Product_update_view_page.php");
  
	
?>


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
  padding-top:25px;
  text-align: left;
}

.update-table thead {
  background-color: #f4f4f4;
}

.update-table tbody tr:nth-child(even) {
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
$conn = new mysqli("localhost", "root", "", "tertibega_coffee");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data
$result = $conn->query("SELECT * from  product_list_rec"); // Replace 'users' with your table name
  echo "<br/>";
  echo "<br/>";
  echo "<center> <h3 style='color:green'> Records updated successfully! </h3> </center>";

echo "<table class='update-table'>";

echo '<thead>';
echo '<tr><th> Prodcut ID</th><th>Product Name</th><th>Product Category</th><th> Unit Price </th> </tr>';
echo '</thead>';
echo '<tbody>';


while ($row = $result->fetch_assoc()) {
    $id = htmlspecialchars($row['ProductID']);
	$ProductName = htmlspecialchars($row["ProductName"]);
	$Category= htmlspecialchars($row["Category"]); 
	$Unit_Price= htmlspecialchars($row["Unit_Price"]); 
	
	echo "<tr>";
    echo "<td>$id</td>";		
    echo "<td> <p> $ProductName </p></td>";
    echo "<td> <p> $Category </p></td>";
    echo "<td> <p> $Unit_Price </p></td>";
    echo "</tr>";
}
echo "</table>";


}
else 
	echo "fatal error ";
   
die();


?>
