<?php
session_start();
require_once "../model/class_model.php";

if (!isset($_SESSION['student_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $student_id = $_SESSION['student_id'];
    $conn = new class_model();

    // Update the password and set the account status to 'Active' without hashing
    $query = "UPDATE `tbl_student` SET `password` = ?, `account_status` = 'Active' WHERE `student_id` = ?";
    $stmt = $conn->conn->prepare($query);
    $stmt->bind_param("ss", $new_password, $student_id);
    if ($stmt->execute()) {
        // Redirect to the student dashboard after successful password change
        header('Location: student/index.php');
        exit();
    } else {
        echo "Error updating password.";
    }
}
?>

<form method="POST">
    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" required>
    <button type="submit">Change Password</button>
</form>
