<?php 
include("db/dbconn.php");
?>

<style>
/* General reset for margin and padding */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Body and font settings */
body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
}

/* Header styling */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 40px;
  background-color: #333;
  color: #fff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Logo styling */
.logo {
  font-size: 24px;
  font-weight: bold;
  text-transform: uppercase;
  text-decoration: none;
  color: #fff;
  letter-spacing: 1px;
}

/* Navigation links styling */
.nav-links {
  display: flex;
  gap: 20px;
}

.nav-links a {
  text-decoration: none;
  color: #ddd;
  font-size: 16px;
  padding: 8px 16px;
  border-radius: 5px;
  transition: background-color 0.3s ease, color 0.3s ease;
}

.nav-links a:hover {
  background-color: #fff;
  color: #333;
}

/* Active link style */
.nav-links a.active {
  background-color: #ff5722;
  color: #fff;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
  .header {
    flex-direction: column;
    align-items: flex-start;
  }

  .nav-links {
    flex-direction: column;
    gap: 10px;
    margin-top: 20px;
  }

  .nav-links a {
    padding: 10px 20px;
  }
}
</style>


<header class="header">
  <a href="#" class="logo" >Tertibegna Coffee</a>
  <nav class="nav-links">
    <a href="#home" class="active">Home</a>
    <a href="sell_info_rec_food.php" >Add Sell</a>
    <a href="add_expense_page.php" >Add Expense</a>
    <a href="#contact" >Report</a>
  </nav>
 </header>