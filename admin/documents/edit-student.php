    <?php include('main_header/header.php');?>

    <?php include('left_sidebar/sidebar.php');?>

    <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title"><i class="fa fa-fw fa-user-graduate"></i>  Edit Student </h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Student</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
            include '../init/model/config/connection2.php';
            $GET_studid = intval($_GET['student']);
            $student_number = $_GET['student-number'];
            $sql = "SELECT * FROM `tbl_student` WHERE `student_id`= ? AND studentID_no = ?";
            $stmt = $conn->prepare($sql); 
            $stmt->bind_param("is", $GET_studid, $student_number);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $studentID_no = $row['studentID_no'];
                $first_name = $row['first_name'];
                $middle_name = $row['middle_name'];
                $last_name = $row['last_name'];
                $courses = $row['course'];
                $year_level = $row['year_level'];
                $date_ofbirth = date('Y-m-d', strtotime($row['date_ofbirth']));
                $gender = $row['gender'];
                $complete_address = $row['complete_address'];
                $email_address = $row['email_address'];
                $mobile_number = $row['mobile_number'];
                $username = $row['username'];
                $password = $row['password'];
                $account_status = $row['account_status']; 
                $student_id = $row['student_id'];  
            ?>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card influencer-profile-data">
                        <div class="card-body">
                            <div class="" id="message"></div>
                            <form id="validationform" name="student_form" data-parsley-validate="" novalidate="" method="POST">
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-user"></i> Student Info</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Student ID</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="text" name="studentID_no" value="<?= $studentID_no; ?>" required="" placeholder="" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">First Name</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="text" name="first_name" value="<?= $first_name; ?>" required="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Middle Name</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="text" name="middle_name" value="<?= $middle_name; ?>" required="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Last Name</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="text" name="last_name" value="<?= $last_name; ?>" required="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Course</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <select data-parsley-type="alphanum" type="text" name="course" value="<?= $courses; ?>" id="course" required="" placeholder="" class="form-control">
                                            <option value="<?= $courses; ?>" hidden><?= $courses; ?></option>
                                            <option value="BSIT">BSIT</option>
                                            <option value="BSOA">BSOA</option>
                                            <option value="CCS">CCS</option>
                                            <option value="CHRM">CHRM</option>
                                            <option value="COA">COA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Year level</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <select data-parsley-type="alphanum" type="text" value="<?= $year_level; ?>" id="year_level" required="" placeholder="" class="form-control">
                                            <option value="<?= $year_level; ?>" hidden><?= $year_level; ?></option>
                                            <option value="1st Year">1st Year</option>
                                            <option value="2nd Year">2nd Year</option>
                                            <option value="3rd Year">3rd Year</option>
                                            <option value="4th Year">4th Year</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Date of Birth</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="date" value="<?php echo $date_ofbirth; ?>" name="date_ofbirth" required="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Gender</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <select data-parsley-type="alphanum" type="text" value="<?= $gender; ?>" id="gender" required="" placeholder="" class="form-control">
                                            <option value="<?= $gender; ?>" hidden><?= $gender; ?></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Complete Address</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <textarea rows="1" data-parsley-type="alphanum" type="text" name="complete_address" required="" placeholder="" class="form-control"><?= $complete_address; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Email Address</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="email" value="<?= $email_address; ?>" name="email_address" required="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Mobile Number</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="text" value="<?= $mobile_number;?>" name="mobile_number" minlength="11" maxlength="11" required="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-user-lock"></i> Account Info</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Student ID</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="text" value="<?= $username;?>" name="username" required="" placeholder="" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Password</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="passwrd" value="<?= $password; ?>" name="password" required="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Status</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <select data-parsley-type="alphanum" type="text" value="<?= $account_status; ?>" id="account_status" required="" placeholder="" class="form-control">
                                            <option value="<?= $account_status; ?>" hidden><?= $account_status; ?></option>
                                            <option value="Active" style="background-color: green;color: #fff">Active</option>
                                            <option value="Inactive" style="background-color: red;color: #fff">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row text-right">
                                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                        <input name="student_id" value="<?= $student_id; ?>" type="hidden">
                                        <button class="btn btn-space btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                            <?php } ?>
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
    <script type="text/javascript">
        $(document).ready(function(){
            var firstName = $('#firstName').text();
            var lastName = $('#lastName').text();
            var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
            var profileImage = $('#profileImage').text(intials);
        });
    </script>
    <script>
        $('#form').parsley();
    </script>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <script>
        $(document).ready(function() {
            $('form[name="student_form"]').on('submit', function(e){
                e.preventDefault();
                var a = $(this).find('input[name="studentID_no"]').val();
                var b = $(this).find('input[name="first_name"]').val();
                var c = $(this).find('input[name="middle_name"]').val();
                var d = $(this).find('input[name="last_name"]').val();
                var e = $('#course option:selected').val();
                var f = $('#year_level option:selected').val();
                var g = $(this).find('input[name="date_ofbirth"]').val();
                var h = $('#gender option:selected').val();
                var i = $(this).find('textarea[name="complete_address"]').val();
                var j = $(this).find('input[name="email_address"]').val();
                var k = $(this).find('input[name="mobile_number"]').val(); 
                var l = $(this).find('input[name="username"]').val();
                var m = $(this).find('input[name="password"]').val();
                var n = $('#account_status option:selected').val();
                const p = document.querySelector('input[name=student_id]').value;

                if (a === '' &&  b ==='' &&  c==='' &&  d ==='' &&  e ==='' &&  f ==='' &&  g ==='' &&  h ==='' &&  i ==='' &&  j ==='' &&  k==='' &&  l ==='' &&  m ===''){
                    $('#message').html('<div class="alert alert-danger"> Required All Fields!</div>');
                    window.scrollTo(0, 0);
                } else {
                    $.ajax({
                        url: '../init/controllers/edit_student.php',
                        method: 'post',
                        data: {
                            studentID_no: a,
                            first_name: b,
                            middle_name: c,
                            last_name: d,
                            course: e,
                            year_level: f,
                            date_ofbirth: g,
                            gender: h,
                            complete_address: i,
                            email_address: j,
                            mobile_number: k,
                            username: l,
                            password: m,
                            account_status: n,
                            student_id: p
                        },
                        success: function(response) {
                            $("#message").html(response);
                            window.scrollTo(0, 0);
                        },
                        error: function(response) {
                            console.log("Failed");
                        }
                    });
                }
            });
        });
    </script>
    </body>
    </html>
