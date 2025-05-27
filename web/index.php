
<style>
/* Reset default styles */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* Page background */
body {
  background:#337a76 ;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Centered login box */
.login-container {
  background-color: #ffffff;
  padding: 40px 30px;
  border-radius: 15px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
  width: 100%;
  max-width: 400px;
}

/* Form elements */
.login-form h2 {
  margin-bottom: 10px;
  color: #333;
  font-size: 24px;
  text-align: center;
}

.login-form p {
  font-size: 0.95rem;
  color: #666;
  margin-bottom: 25px;
  text-align: center;
}

.login-form input[type="text"],
.login-form input[type="password"] {
  width: 100%;
  padding: 14px;
  margin-bottom: 18px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 0.95rem;
  transition: border 0.3s;
}

.login-form input:focus {
  border-color: #6c63ff;
  outline: none;
}

.login-form button {
  width: 100%;
  background-color: #337a76;
  color: #fff;
  padding: 14px;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.login-form button:hover {
  background-color: #574b90;
}

.extra-options {
  text-align: center;
  margin-top: 15px;
}

.extra-options a {
  font-size: 0.9rem;
  color: #6c63ff;
  text-decoration: none;
}

.extra-options a:hover {
  text-decoration: underline;
}

/* Responsive */
@media (max-width: 480px) {
  .login-container {
    padding: 30px 20px;
  }

  .login-form h2 {
    font-size: 20px;
  }
}

</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Tertibega coffee</title>
  <link rel="stylesheet" href="login.css" />
</head>
<body>
  <div class="login-container">
    <form class="login-form" action="function/admin_user_checker.php" method="POST">
      <h2>Welcome To Tertibega Coffee </h2>
	   <?php
        if (isset($_GET['error'])) {
            echo '<p style="color:red;">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        ?>
      <p>Please login to your account</p>

      <input type="text" name="User_name" placeholder="Username" required />
      <input type="password" name="My_Passwd" placeholder="Password" required />

      <button type="submit" name='btn_login'>Login</button>

      
    </form>
  </div>
</body>
</html>
