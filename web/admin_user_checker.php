<?php
if (isset($_POST['btn_login']))  {

include('../db/dbconn.php');	
	

    function validate($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $username =$_POST['User_name'];
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
				session_start ();
				$_SESSION['Tertibega_ID'] = $row['user_id'];
                //$_SESSION['username'] = $row['username'];
                //$_SESSION['Tertibega_ID'] = $row['username'];
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
    }
 else {
	 echo "<script> alert(' Error Found !!! '); </script>";
    header("Location: ../index.php");
    exit();
}



/*

if (isset($_POST['btn_login']))
	

	{
		$username=$_POST['User_name'];
		$passd=$_POST['My_Passwd'];
       $password =$passd;

			$result=$conn->query("SELECT * FROM login_user WHERE User_Name='$username' AND User_Status=1000 ")
				or die ('cannot login' . mysqli_error());
			$row=$result->fetch_array  ();
			$run_num_rows = $result->num_rows;

						if ($run_num_rows > 0 )
						{
							session_start ();
							$_SESSION['Tertibega_ID'] = $row['user_id'];
							//header ("location:../tertibega_homepage.php");
							 header("Location: ../tertibega_homepage.php");
							exit;
							
						}
						else
							echo "<script> alert('Wrong User name or Password !!! '); </script>";


	}
	else 
	{	
	echo "error found ";
	}

// Example login validation function (replace with your actual logic)
function validate_login($user, $pass) {
    // For demo, accept only user: admin, pass: 1234
    return ($user === 'admin' && $pass === '1234');
}

*/
?>


