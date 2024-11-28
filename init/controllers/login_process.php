<!-- <?php
		require_once "../model/class_model.php";;
	if(ISSET($_POST)){
		$conn = new class_model();
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$status = "Active";
	//	$role = "Administrator";
		
		$get_student = $conn->login_student($username, $password, $status);
		if($get_student['count'] > 0){
			session_start();
			$_SESSION['student_id'] = $get_student['student_id'];

			echo 1;
		}else{
			echo 0;
		}
	}
?> -->

<?php
require_once "../model/class_model.php";

if (isset($_POST)) {
    $conn = new class_model();
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // We will check for both 'Active' and 'Inactive' students in the login process
    $get_student = $conn->login_student($username, $password, 'Active');

    if ($get_student['count'] > 0) {
        session_start();
        $_SESSION['student_id'] = $get_student['student_id'];

        if ($get_student['status'] == 'inactive') {
            // Redirect to change password page if the account is inactive
            echo 'inactive';
        } else {
            // Account is active, proceed to the student dashboard
            echo 'active';
        }
    } else {
        echo 0; // Invalid login credentials
    }
}
?>


