<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('main_header/header.php');
include('left_sidebar/sidebar.php');

include('../init/model/config/connection2.php');

// Verify database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title"><i class="fa fa-fw fa-chart-bar"></i> Reports </h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Reports</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Monthly Summary of Document Requests</h5>
                    <div class="card-body">
                        <canvas id="documentRequestChart" style="width: 100%; height: 260px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Summary of Document Requests by Document Name</h5>
                    <div class="card-body">
                        <canvas id="documentNameChart" style="width: 100%; height: 260px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="../assets/vendor/dist/chart.umd.js"></script>
<script src="../assets/libs/js/main-js.js"></script>

<script>
    $(document).ready(function() {
        // Check if the canvas element exists
        var canvas = document.getElementById('documentRequestChart');
        if (!canvas) {
            console.error('Canvas element not found');
            return;
        }

        var ctx = canvas.getContext('2d');
        
        <?php
        try {
            $totalRequests = $conn->query("SELECT COUNT(*) as total FROM tbl_documentrequest")->fetch_assoc()['total'] ?? 0;
            $received = $conn->query("SELECT COUNT(*) as total FROM tbl_documentrequest WHERE status = 'Received'")->fetch_assoc()['total'] ?? 0;
            $processing = $conn->query("SELECT COUNT(*) as total FROM tbl_documentrequest WHERE status = 'Processing'")->fetch_assoc()['total'] ?? 0;
            $releasing = $conn->query("SELECT COUNT(*) as total FROM tbl_documentrequest WHERE status = 'Releasing'")->fetch_assoc()['total'] ?? 0;
            $released = $conn->query("SELECT COUNT(*) as total FROM tbl_documentrequest WHERE status = 'Released'")->fetch_assoc()['total'] ?? 0;
        } catch (Exception $e) {
            $totalRequests = $received = $processing = $releasing = $released = 0;
        }
        ?>

        try {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Total Requests', 'Received', 'Processing', 'Releasing', 'Released'],
                    datasets: [{
                        label: 'Document Requests',
                        data: [<?php echo "$totalRequests, $received, $processing, $releasing, $released"; ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 1,
                            ticks: {
                                callback: function(value) {
                                    if (Number.isInteger(value)) {
                                        return value;
                                    }
                                }
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating chart:', error);
        }

        // Check if the canvas element exists
        var canvasName = document.getElementById('documentNameChart');
        if (!canvasName) {
            console.error('Canvas element not found');
            return;
        }

        var ctxName = canvasName.getContext('2d');
        
        <?php
        try {
            $documentNames = [];
            $documentCounts = [];
            $result = $conn->query("SELECT document_name, COUNT(*) as total FROM tbl_documentrequest GROUP BY document_name");
            while ($row = $result->fetch_assoc()) {
                $documentNames[] = $row['document_name'];
                $documentCounts[] = $row['total'];
            }
        } catch (Exception $e) {
            $documentNames = [];
            $documentCounts = [];
        }
        ?>

        try {
            new Chart(ctxName, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($documentNames); ?>,
                    datasets: [{
                        label: 'Document Requests',
                        data: <?php echo json_encode($documentCounts); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 1,
                            ticks: {
                                callback: function(value) {
                                    if (Number.isInteger(value)) {
                                        return value;
                                    }
                                }
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating chart:', error);
        }
    });
</script>
