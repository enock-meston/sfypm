<?php
session_start();
$error = "";
$msg = "";
include('../include/config.php');

error_reporting(0);
if (strlen($_SESSION['sID']) == 0) {
    header('location:../login.php');
} else {


    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>View</title>

    <!-- Custom fonts for this template-->
    <link href="../plugins/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../plugins/css/sb-admin-2.css" rel="stylesheet">
    <link rel="shortcut icon" href="../plugins/img/mcmlogopng.png" type="image/x-icon">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php 
            include 'include/sidebar.php';
       ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">



                <?php 
                        include 'include/topbar.php'
                   ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h4>
                            View Project's Page
                        </h4>
                    </div>
                    <!-- /.container-fluid -->


                    <div class="row">
                        <div class="col-sm-6">
                            <!---Success Message--->
                            <?php if($msg){ ?>
                            <div class="alert alert-success" role="alert">
                                <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                            </div>
                            <?php } ?>
                            <!---Error Message--->
                            <?php if($error){ ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($error);?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!--PROJECT  tables -->
                    <?php
                        $projectID = $_GET['on'];
                        $sqlView = mysqli_query($con,"SELECT * FROM `tblprojectcanvas` WHERE cid='$projectID'");
                        $data = mysqli_fetch_assoc($sqlView);
                        
                    ?>
                    <!-- DataTales Example -->

                    <div class="card shadow col-sm-12">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <?php echo $data['title'] ." FROM ". $data['groupNumber'];?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <tr>
                                        <th>Problem
                                            <textarea readonly placeholder="<?php echo $data['Problem'];?>"
                                                class="form-control" id="form4Example3" rows="4"></textarea>
                                        </th>
                                        <th>Solution
                                            <textarea readonly placeholder="<?php echo $data['Solution'];?>"
                                                class="form-control" id="form4Example3" rows="4"></textarea>
                                        </th>
                                        <th>Unique Value Proposition
                                            <textarea readonly
                                                placeholder="<?php echo $data['UniqueValueProposition'];?>"
                                                class="form-control" id="form4Example3" rows="4"></textarea>
                                        </th>
                                        <th>Unfair Advantage
                                            <textarea readonly placeholder="<?php echo $data['UnfairAdvantage'];?>"
                                                class="form-control" id="form4Example3" rows="4"></textarea>
                                        </th>
                                        <th>Customer Segments
                                            <textarea readonly placeholder="<?php echo $data['CustomerSegments'];?>"
                                                class="form-control" id="form4Example3" rows="4"></textarea>
                                        </th>

                                    </tr>
                                    <tr>
                                        <td>Existing Alternatives
                                            <textarea readonly placeholder="<?php echo $data['ExistingAlternatives'];?>"
                                                class="form-control" id="form4Example3" rows="4"></textarea>
                                        </td>
                                        <td>Key Metrics
                                            <textarea readonly placeholder="<?php echo $data['KeyMetrics'];?>"
                                                class="form-control" id="form4Example3" rows="4"></textarea>
                                        </td>
                                        <td>High-Level Concept
                                            <textarea readonly placeholder="<?php echo $data['HighLevelConcept'];?>"
                                                class="form-control" id="form4Example3" rows="4"></textarea>
                                        </td>
                                        <td>Channels
                                            <textarea readonly placeholder="<?php echo $data['Channels'];?>"
                                                class="form-control" id="form4Example3" rows="4"></textarea>
                                        </td>
                                        <td>Early Adopters
                                            <textarea readonly placeholder="<?php echo $data['EarlyAdopters'];?>"
                                                class="form-control" id="form4Example3" rows="4"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cost Structure
                                            <textarea readonly placeholder="<?php echo $data['CostStructure'];?>"
                                                class="form-control" id="form4Example3" rows="4"></textarea>
                                        </td>
                                        <td>Revenue Structure
                                            <textarea readonly placeholder="<?php echo $data['RevenueStructure'];?>"
                                                class="form-control" id="form4Example3" rows="4"></textarea>
                                        </td>
                                    </tr>


                                </table>
                            </div>
                        </div>
                        <!--end USERS  tables -->

                    </div>

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php 
                include 'include/footer.php';
           ?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>


        <!-- Bootstrap core JavaScript-->
        <script src="../plugins/vendor/jquery/jquery.min.js"></script>
        <script src="../plugins/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../plugins/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../plugins/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="../plugins/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../plugins/js/demo/datatables-demo.js"></script>

</body>

</html>

<?php 
    } 
?>