    <?php include('main_header/header.php'); ?>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <?php include('left_sidebar/sidebar.php'); ?>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title"><i class="fa fa-fw fa-tachometer-alt"></i> Dashboard </h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <!-- metric -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php 
                                $conn = new class_model();
                                $cstudent = $conn->count_numberoftotalrequest();
                            ?>
                            <?php foreach ($cstudent as $row): ?>
                            <div class="d-inline-block">
                                <h5 class="text-muted"><b>Number of Total Request</b></h5>
                                <h2 class="mb-0"><?= $row['count_request']; ?></h2>
                            </div>
                            <div class="float-right icon-circle-medium icon-box-lg mt-1" style="background-color:#1269AF">
                                <i class="fa fa-layer-group fa-fw fa-sm text-info" style="color:white !important"></i>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <a href="request.php" class="btn btn-primary" style="background-color:#1269AF">View</a>
                    </div>
                </div>
                <!-- metric -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php 
                                $conn = new class_model();
                                $cstudent = $conn->count_numberoftotalreceived();
                            ?>
                            <?php foreach ($cstudent as $row): ?>
                            <div class="d-inline-block">
                                <h5 class="text-muted"><b>New Request</b></h5>
                                <h2 class="mb-0"><?= $row['count_received']; ?></h2>
                            </div>
                            <div class="float-right icon-circle-medium icon-box-lg mt-1" style="background-color:#1269AF">
                                <i class="fa fa-bell fa-fw fa-sm text-info" style="color: white !important"></i>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <a href="request.php" class="btn btn-primary" style="background-color:#1269AF">View</a>
                    </div>
                </div>
                <!-- metric -->

                  <!-- metric -->
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php 
                                $conn = new class_model();
                                $cstudent = $conn->count_numberoftotalprocessing();
                            ?>
                            <?php foreach ($cstudent as $row): ?>
                            <div class="d-inline-block">
                                <h5 class="text-muted"><b>Processing</b></h5>
                                <h2 class="mb-0"><?= $row['count_received']; ?></h2>
                            </div>
                            <div class="float-right icon-circle-medium icon-box-lg mt-1" style="background-color:#1269AF">
                                <i class="fa fa-bell fa-fw fa-sm text-info" style="color: white !important"></i>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <a href="request.php" class="btn btn-primary" style="background-color:#1269AF">View</a>
                    </div>
                </div>
                <!-- metric -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php 
                                $conn = new class_model();
                                $cstudent = $conn->count_numberofreleased();
                            ?>
                            <?php foreach ($cstudent as $row): ?>
                            <div class="d-inline-block">
                                <h5 class="text-muted"><b>Releasing</b></h5>
                                <h2 class="mb-0"><?= $row['count_released']; ?></h2>
                            </div>
                            <div class="float-right icon-circle-medium icon-box-lg mt-1" style="background-color:#1269AF">
                                <i class="fa fa-calendar-check fa-fw fa-sm text-info" style="color:white !important"></i>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <a href="request.php" class="btn btn-primary" style="background-color:#1269AF">View</a>
                    </div>
                </div>
                <!-- metric -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php 
                                $conn = new class_model();
                                $cstudent = $conn->count_released();
                            ?>
                            <?php foreach ($cstudent as $row): ?>
                            <div class="d-inline-block">
                                <h5 class="text-muted"><b>Released</b></h5>
                                <h2 class="mb-0"><?= $row['count_released']; ?></h2>
                            </div>
                            <div class="float-right icon-circle-medium icon-box-lg mt-1" style="background-color:#1269AF">
                                <i class="fa fa-calendar-check fa-fw fa-sm text-info" style="color:white !important"></i>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <a href="request.php" class="btn btn-primary" style="background-color:#1269AF">View</a>
                    </div>
                </div>
                <!-- metric -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php 
                                $conn = new class_model();
                                $cstudent = $conn->count_released();
                            ?>
                            <?php foreach ($cstudent as $row): ?>
                            <div class="d-inline-block">
                                <h5 class="text-muted"><b>Declined</b></h5>
                                <h2 class="mb-0"><?= $row['count_released']; ?></h2>
                            </div>
                            <div class="float-right icon-circle-medium icon-box-lg mt-1" style="background-color:#1269AF">
                                <i class="fa fa-calendar-check fa-fw fa-sm text-info" style="color:white !important"></i>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <a href="request.php" class="btn btn-primary" style="background-color:#1269AF">View</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 js-->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstrap bundle js-->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- chartjs js-->
    <script src="../assets/vendor/charts/charts-bundle/Chart.bundle.js"></script>
    <script src="../assets/vendor/charts/charts-bundle/chartjs.js"></script>

    <!-- main js-->
    <script src="../assets/libs/js/main-js.js"></script>
    <!-- dashboard sales js-->
    
    <script type="text/javascript">
        $(document).ready(function(){
            var firstName = $('#firstName').text();
            var lastName = $('#lastName').text();
            var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
            var profileImage = $('#profileImage').text(intials);
        });
    </script>

    <script>
    $(document).ready(function(){

        function load_unseen_notification(view = '')
        {
            $.ajax({
                url:"../init/controllers/fetch.php",
                method:"POST",
                data:{view:view},
                dataType:"json",
                success:function(data)
                {
                    $('.dropdown-menu_1').html(data.notification);
                    if(data.unseen_notification > 0)
                    {
                        $('.count').html(data.unseen_notification);
                    }
                }
            });
        }

        load_unseen_notification();

        $(document).on('click', '.dropdown-toggle', function(){
            $('.count').html('');
            load_unseen_notification('yes');
        });

        setInterval(function(){ 
            load_unseen_notification();; 
        }, 5000);

    });
    </script>
    </body>

    </html>
