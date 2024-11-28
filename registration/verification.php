<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "King123.";
$dbname = "onlineschooldocuments_db2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];

    $stmt = $conn->prepare("SELECT first_name FROM tbl_student WHERE studentID_no = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (!empty($row['first_name'])) {
            $error = "You already have an account. <a href='../index.php' class='btn btn-primary'>Login</a>";
        }
    } else {
        $stmt = $conn->prepare("SELECT first_name FROM mis_student WHERE studentID_no = ?");
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (empty($row['first_name'])) {
                $_SESSION['student_id'] = $student_id;
                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid student ID or You're not a PTC student.";
            }
        } else {
            $error = "Invalid student ID or You're not a PTC student.";
        }
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Verification</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
</head>
<body>
    <?php include('documents/main_header/header.php'); ?>
    <?php
    if (isset($_GET['verified']) && $_GET['verified'] == 'true') {
        echo "<div class='alert alert-success'>Student ID verified successfully.</div>";
    }
    ?>
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">
                            <center><i class="fa fa-fw fa-user-graduate"></i> <strong>Student Verification</strong></center>
                        </h2>
                        <div class="page-breadcrumb"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card influencer-profile-data">
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Student ID</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="text" id="student_id" name="student_id" required placeholder="0000-0000" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row text-right">
                                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                        <button class="btn btn-space btn-primary">Verify</button>
                                    </div>
                                </div>
                            </form>
                            <div id="alert-msg">
                                <?php
                                if ($error !== null) {
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/parsley/parsley.js"></script>
    <script src="../assets/libs/js/main-js.js"></script>
    <script>
        $(document).ready(function(){
            $('#student_id').on('input', function() {
                var value = $(this).val().replace(/\D/g, '');
                if (value.length > 4) {
                    value = value.substring(0, 4) + '-' + value.substring(4, 8);
                }
                $(this).val(value);
            });

            $('form').on('submit', function(e) {
                var value = $('#student_id').val().replace(/\D/g, '');
                if (value.length !== 8) {
                    e.preventDefault();
                    $('#alert-msg').html('<div class="alert alert-danger">Student ID must be 8 digits.</div>');
                }
            });
        });
    </script>
</body>
</html>
