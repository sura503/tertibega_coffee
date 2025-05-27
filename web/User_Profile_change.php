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


<br/>
<br/>
<br/>

<div class="change-password-form">
    <h2>Change Password</h2>
    <form action="user_change_password.php" method="post" id="changePasswordForm">
        <input type="password" name="current_password" placeholder="Current Password" required>
        <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm New Password" required>
        <span id="password-message" style="font-size: 0.9em;"></span><br>
        <button type="submit" name="change_password" id="submitBtn">Change Password</button>
    </form>
</div>


</body>
</html>





<script>
document.addEventListener('DOMContentLoaded', function () {
    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('confirm_password');
    const message = document.getElementById('password-message');
    const submitBtn = document.getElementById('submitBtn');

    function checkPasswordMatch() {
        if (confirmPassword.value === "") {
            message.textContent = "";
            submitBtn.disabled = false;
            return;
        }

        if (newPassword.value === confirmPassword.value) {
            message.textContent = "Passwords match ✅";
            message.style.color = "green";
            submitBtn.disabled = false;
        } else {
            message.textContent = "Passwords do not match ❌";
            message.style.color = "red";
            submitBtn.disabled = true;
        }
    }

    newPassword.addEventListener('input', checkPasswordMatch);
    confirmPassword.addEventListener('input', checkPasswordMatch);
});
</script>
