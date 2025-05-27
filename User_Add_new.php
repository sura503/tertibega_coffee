<?php 
session_start();
include("function/admin_session.php");
include("db/dbconn.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .change-password-form {
            background: #fff;
			padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
			margin-left: 40%;
			margin-right: 50%;
			  }

        .change-password-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .change-password-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .change-password-form button {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .change-password-form button:hover {
            background: #45a049;
        }

        .message {
            margin-top: 15px;
            text-align: center;
        }
		
		

        .add-user-form {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
				margin-left: 40%;
			margin-right: 50%;
			margin-top:50px;
        }

        .add-user-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .add-user-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .add-user-form button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-user-form button:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            margin-top: 15px;
        }
		
    </style>
</head>
<body>

<header>
<?php include('header/HomePage_header.php'); ?> 
</header> 

<div>
  <nav class="report-nav4">
 
  <?php include('header/homepage_sub_header2.php'); ?> 
 
</nav>
</div>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
    <style>
       
    </style>
</head>
<body>


	<div class="add-user-form">
    <h2>Add New User</h2>
    <form id="userForm" action="User_Add_new_Save.php" method="post">
        <input type="text" name="FistName" placeholder="Add First Name" required>
        <input type="text" name="LastName" placeholder="Add Last Name" required>
        <input type="number" name="Phone_number" placeholder="Phone_No" required>
		
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" id="password1" name="password1" placeholder="Password" required>
        <input type="password" id="password2" name="password2" placeholder="Retype the Password" required>
        <div id="passwordMessage" class="message"></div>
        <button type="submit" name="submit" id="submitBtn" disabled>Create User</button>
    </form>
</div>


</body>
</html>



<script>
    const password1 = document.getElementById("password1");
    const password2 = document.getElementById("password2");
    const message = document.getElementById("passwordMessage");
    const submitBtn = document.getElementById("submitBtn");

    function validatePasswords() {
        if (password1.value === "" || password2.value === "") {
            message.textContent = "";
            submitBtn.disabled = true;
            return;
        }

        if (password1.value === password2.value) {
            message.textContent = "Passwords match!";
            message.classList.remove("error");
            message.classList.add("success");
            submitBtn.disabled = false;
        } else {
            message.textContent = "Passwords do not match!";
            message.classList.remove("success");
            message.classList.add("error");
            submitBtn.disabled = true;
        }
    }

    password1.addEventListener("input", validatePasswords);
    password2.addEventListener("input", validatePasswords);
</script>


