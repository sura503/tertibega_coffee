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
			margin-top:100px;
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

		

<?php

if (isset($_POST['submit'])) {
	$username = trim($_POST['username']);
	$FistName = trim($_POST['FistName']);
	$LastName = trim($_POST['LastName']);
	$Phone_number = trim($_POST['Phone_number']);
    $password = $_POST['password1'];
	$User_status=1000;
    // Basic validation
    if (empty($username) || empty($password)) {
        die("Please fill in all fields.");
    }

    // Check if username already exists
    $check = $conn->prepare("SELECT user_id FROM login_user WHERE User_Name = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        die("Username already exists.");
    }
    $check->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    // Insert new user
$stmt = $conn->prepare("INSERT INTO login_user (User_Name, User_Pass, Phone_No, Usr_First_Name, Usr_Last_Name, User_status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $username, $hashed_password, $Phone_number, $FistName, $LastName, $User_status);

    if ($stmt->execute()) {
        echo "<div class='message'>User created successfully!</div>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>


