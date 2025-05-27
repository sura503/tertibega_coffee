<?php
if (isset($_POST['btn_login']))  {

    include('../db/dbconn.php');	

    function validate($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $username = $_POST['User_name'];
    $password = validate($_POST['My_Passwd']);

    $sql = "SELECT * FROM login_user WHERE User_Name=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['User_Pass'])) {
            session_start();
            $_SESSION['Tertibega_ID'] = $row['user_id'];
            header("Location: ../tertibega_homepage.php");
            exit();
        } else {
            header("Location: ../index.php?error=Incorrect username or password");
            exit();
        }
    } else {
        header("Location: ../index.php?error=Incorrect username or password");
        exit();
    }

} else {
    // ❌ Don't echo anything here
    // ✅ Just redirect
    header("Location: ../index.php?error=Invalid access");
    exit();
}
?>
