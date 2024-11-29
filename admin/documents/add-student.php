    <?php include('main_header/header.php');?>

    <?php include('left_sidebar/sidebar.php');?>

    <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title"><i class="fa fa-fw fa-user-graduate"></i>  Add Student </h2>
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
                                        <input type="text" name="studentID_no" required="" placeholder="" class="form-control" maxlength="9" pattern="\d{4}-\d{4}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">First Name</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="text" name="first_name" required="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Middle Name</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="text" name="middle_name" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Last Name</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="text" name="last_name" required="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Course</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <select name="course" data-parsley-type="alphanum" type="text" id="course" required="" placeholder="" class="form-control">
                                            <option value="">&larr;Select Course &rarr;</option>
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
                                        <select name="year_level" data-parsley-type="alphanum" type="text" id="year_level" required="" placeholder="" class="form-control">
                                            <option value="">&larr;Year level &rarr;</option>
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
                                        <input data-parsley-type="alphanum" type="date" name="date_ofbirth" required="" placeholder="" class="form-control" min="1900-01-01" max="2099-12-31">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Gender</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <select name="gender" data-parsley-type="alphanum" type="text" id="gender" required="" placeholder="" class="form-control">
                                            <option value="">&larr;Select Gender &rarr;</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Complete Address</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <textarea rows="1" data-parsley-type="alphanum" type="text" name="complete_address" required="" placeholder="" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Email Address</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="email" name="email_address" required="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Mobile Number</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="text" name="mobile_number" minlength="11" maxlength="11" required="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-user-lock"></i> Account Info</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Student ID</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="text" name="username" required="" placeholder="" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Password</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-type="alphanum" type="password" name="password" required="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row text-right">
                                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                        <button class="btn btn-space btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
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
        $('#form').parsley();
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var firstName = $('#firstName').text();
            var lastName = $('#lastName').text();
            var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
            var profileImage = $('#profileImage').text(intials);
        });
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
                var course = $('#course option:selected').val();
                var year_level = $('#year_level option:selected').val();
                var date_ofbirth = $(this).find('input[name="date_ofbirth"]').val();
                var gender = $('#gender option:selected').val();
                var complete_address = $(this).find('textarea[name="complete_address"]').val();
                var email_address = $(this).find('input[name="email_address"]').val();
                var mobile_number = $(this).find('input[name="mobile_number"]').val(); 
                var username = $(this).find('input[name="username"]').val();
                var password = $(this).find('input[name="password"]').val();

                if (a === '' ||  b ===''||  d ===''||  course ==='' ||  year_level ===''||  date_ofbirth ==='' ||  gender ==='' ||  complete_address ==='' || email_address ==='' ||  mobile_number ==='' ||  username ==='' ||  password ===''){
                    $('#message').html('<div class="alert alert-danger"> Required All Fields!</div>');
                    window.scrollTo(0, 0);
                } else {
                    $.ajax({
                        url: '../init/controllers/add_student.php',
                        method: 'post',
                        data: {
                            studentID_no: a,
                            first_name: b,
                            middle_name: c,
                            last_name: d,
                            course: course,
                            year_level: year_level,
                            date_ofbirth: date_ofbirth,
                            gender: gender,
                            complete_address: complete_address,
                            email_address: email_address,
                            mobile_number: mobile_number,
                            username: username,
                            password: password,
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

            $('input[name="studentID_no"]').on('input', function() {
                var value = $(this).val().replace(/\D/g, '');
                if (value.length > 4) {
                    value = value.slice(0, 4) + '-' + value.slice(4, 8);
                }
                $(this).val(value);
                $('input[name="username"]').val(value);
            });
        });
    </script>
    </body>
    </html>
