<?php 
session_start();
include("function/admin_session.php");
include("db/dbconn.php");
?>

<?php


// Dummy logged-in user ID (use actual session value in real apps)

$user_id = $_SESSION['Tertibega_ID'] ?? 1; // Fallback for demo
echo $user_id;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['change_password'])) {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if ($new !== $confirm) {
        die("New passwords do not match.");
    }

    // Get user's current hashed password from DB
    $stmt = $conn->prepare("SELECT User_Pass FROM login_user WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verify current password
    if (!password_verify($current, $hashed_password)) {
        die("Current password is incorrect.");
    }

    // Hash new password
    $new_hashed = password_hash($new, PASSWORD_DEFAULT);

    // Update password in DB
    $update = $conn->prepare("UPDATE login_user SET User_Pass = ? WHERE user_id = ?");
    $update->bind_param("si", $new_hashed, $user_id);
    if ($update->execute()) {
        echo "<script> alert('Password Changed successfully. !!! '); </script>";
		echo "<script>window.location = 'index.php';</script>";
    } else {
        echo "Error updating password.";
    }

    $update->close();
}

$conn->close();
?>


