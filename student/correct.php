<?php
session_start();
$error = "";
$msg = "";
include('../include/config.php');

error_reporting(0);
if (strlen($_SESSION['sID']) == 0) {
    header('location:../login.php');
} else {


    if(isset($_POST['updateBtn']))
    {
        $projectID = $_GET['proID'];
        $title = $_POST['title'];
        $Problem = $_POST['Problem'];
        $Solution = $_POST['Solution'];
        $UniqueValueProposition = $_POST['UniqueValueProposition'];
        $UnfairAdvantage = $_POST['UnfairAdvantage'];
        $CustomerSegments = $_POST['CustomerSegments'];
        $ExistingAlternatives = $_POST['ExistingAlternatives'];
        $KeyMetrics = $_POST['KeyMetrics'];
        $HighLevelConcept = $_POST['HighLevelConcept'];
        $Channels = $_POST['Channels'];
        $EarlyAdopters = $_POST['EarlyAdopters'];
        $CostStructure = $_POST['CostStructure'];
        $RevenueStructure = $_POST['RevenueStructure'];
        $Status = 1;
        $proID = $_POST['proID'];

            // $groupNumber =date('i').rand(1000,9999);
            if (mysqli_query($con,"UPDATE `tblprojectcanvas` SET 
            `title`='$title',`Problem`='$Problem',`Solution`='$Solution',`UniqueValueProposition`='$UniqueValueProposition',
            `UnfairAdvantage`='$UnfairAdvantage',`CustomerSegments`='$CustomerSegments',
            `ExistingAlternatives`='$ExistingAlternatives',`KeyMetrics`='$KeyMetrics',
            `HighLevelConcept`='$HighLevelConcept',`Channels`='$Channels',`EarlyAdopters`='$EarlyAdopters',
            `CostStructure`='$CostStructure',`RevenueStructure`='$RevenueStructure',`Status`='$Status' 
            WHERE cid='$projectID'")) {
                $msg = "Canvas Updated";
                mysqli_query($con,"DELETE FROM `tbl_comment` WHERE postCanvasID = '$proID'");

            } else {
                $error ="Query Problem";
            }
      
        }
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
                        $projectID = $_GET['proID'];
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
                            <form action="" method="POST">
                                <input type="text" name="title" class="form-control" value="<?php echo $data['title'];?>">
                                <input type="hidden" name="proID" class="form-control" value="<?php echo $projectID;?>">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <tr>
                                            <th>Problem
                                                <textarea name="Problem"
                                                    class="form-control" id="form4Example3" rows="4"><?php echo $data['Problem'];?></textarea>
                                            </th>
                                            <th>Solution
                                                <textarea name="Solution"
                                                    class="form-control" id="form4Example3" rows="4"><?php echo $data['Solution'];?></textarea>
                                            </th>
                                            <th>Unique Value Proposition
                                                <textarea name="UniqueValueProposition"
                                                    class="form-control" id="form4Example3" rows="4"><?php echo $data['UniqueValueProposition'];?></textarea>
                                            </th>
                                            <th>Unfair Advantage
                                                <textarea name="UnfairAdvantage"
                                                    class="form-control" id="form4Example3" rows="4"><?php echo $data['UnfairAdvantage'];?></textarea>
                                            </th>
                                            <th>Customer Segments
                                                <textarea name="CustomerSegments"
                                                    class="form-control" id="form4Example3" rows="4"><?php echo $data['CustomerSegments'];?></textarea>
                                            </th>

                                        </tr>
                                        <tr>
                                            <td>Existing Alternatives
                                                <textarea name="ExistingAlternatives"
                                                    class="form-control" id="form4Example3" rows="4"> <?php echo $data['ExistingAlternatives'];?></textarea>
                                            </td>
                                            <td>Key Metrics
                                                <textarea name="KeyMetrics"
                                                    class="form-control" id="form4Example3" rows="4"><?php echo $data['KeyMetrics'];?></textarea>
                                            </td>
                                            <td>High-Level Concept
                                                <textarea name="HighLevelConcept"
                                                    class="form-control" id="form4Example3" rows="4"><?php echo $data['HighLevelConcept'];?></textarea>
                                            </td>
                                            <td>Channels
                                                <textarea name="Channels"
                                                    class="form-control" id="form4Example3" rows="4"><?php echo $data['Channels'];?></textarea>
                                            </td>
                                            <td>Early Adopters
                                                <textarea name="EarlyAdopters"
                                                    class="form-control" id="form4Example3" rows="4"><?php echo $data['EarlyAdopters'];?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cost Structure
                                                <textarea name="CostStructure"
                                                    class="form-control" id="form4Example3" rows="4"><?php echo $data['CostStructure'];?></textarea>
                                            </td>
                                            <td>Revenue Structure
                                                <textarea name="RevenueStructure"
                                                    class="form-control" id="form4Example3" rows="4"><?php echo $data['RevenueStructure'];?></textarea>
                                            </td>

                                            <td>
                                                <input type="submit" name="updateBtn" value="Resend" class="btn btn-success">
                                            </td>
                                        </tr>


                                    </table>
                                </div>
                            </form>
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