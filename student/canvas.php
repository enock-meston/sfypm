<?php
session_start();
include '../include/config.php';
error_reporting(0);
if (strlen($_SESSION['sID']) == 0) {
    header('location: index.php');
} else {

    if (isset($_POST['sendbtn'])) {
        $groupNumber = $_POST['groupNumber'];
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

        // chech if you are in group 1st
        $ifYouAreInGroup = mysqli_query($con,"SELECT * FROM `tbl_group` WHERE `studentOne`='".$_SESSION['sID']."' 
        OR studentTwo='".$_SESSION['sID']."'");
        $data = mysqli_num_rows($ifYouAreInGroup);
        if ($data <=0) {
            $error = "Please Make Group 1st !";
        }else {
            
        $checkStudent = mysqli_query($con,"SELECT * FROM `tblprojectcanvas`
         WHERE `groupNumber` ='$groupNumber' OR title='$title'");

        $result = mysqli_num_rows($checkStudent);

        if ($result > 0) {
            $error = "Group Number or title Alread Used !!!";
        }else {
            // $groupNumber =date('i').rand(1000,9999);
            if (mysqli_query($con,"INSERT INTO `tblprojectcanvas`(`groupNumber`, 
            `title`, `Problem`, `Solution`, `UniqueValueProposition`, `UnfairAdvantage`,
             `CustomerSegments`, `ExistingAlternatives`, `KeyMetrics`, `HighLevelConcept`,
              `Channels`, `EarlyAdopters`, `CostStructure`, `RevenueStructure`,`Status`) 
              VALUES ('$groupNumber','$title','$Problem',
              '$Solution','$UniqueValueProposition','$UnfairAdvantage',
              '$CustomerSegments','$ExistingAlternatives','$KeyMetrics',
              '$HighLevelConcept','$Channels','$EarlyAdopters',
              '$CostStructure','$RevenueStructure','$Status')")) {
                $msg = "Canvas Sent";
            } else {
                $error ="Query Problem";
            }
            
        }//
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

    <title>Student-Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../plugins/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../plugins/css/sb-admin-2.css" rel="stylesheet">
    <link rel="shortcut icon" href="../plugins/img/logo.png" type="image/x-icon">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php 
            include 'include/sidebar.php';
       ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <?php 
                        include 'include/topbar.php'
                   ?>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <center>
                    <h6>My Group</h6>
                    <table style="text-align:center;">
                        <tr>
                            <th>Group N</th>
                            <th>Names</th>
                            <th> Reg Number</th>
                        </tr>
                        <?php
                        $sqlGroup = mysqli_query($con,"SELECT * FROM tbl_group LEFT JOIN tbl_students ON 
                        tbl_group.studentOne = tbl_students.sID OR tbl_group.studentTwo = tbl_students.sID 
                        WHERE tbl_group.studentOne = '".$_SESSION['sID']."' OR tbl_group.studentTwo = '".$_SESSION['sID']."'");
                        while ($row=mysqli_fetch_array($sqlGroup)) {
                            $_SESSION['groupNumber'] = $row['groupNumber'];
                            ?>
                        <tr>
                            <td><?php echo $row['groupNumber'];?></td>
                            <td><?php echo $row['fname'] ." - ". $row['lname'];?></td>
                            <td><?php echo $row['reg_number']; ?></td>
                        </tr>
                        <?php
                        }
                    ?>
                    </table>
                </center>
                <hr>
                <!-- Content Row -->
                <div class="col-sm-12">
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
                    <form method="POST">

                        <div class="card shadow mb-12">
                            <div class="card-header py-12">
                                <h6 class="m-0 font-weight-bold text-primary">Project Title :</h6>
                                <input type="text" required name="title" class="form-control">
                                <input type="hidden" name="groupNumber" value="<?php echo $_SESSION['groupNumber'];?>"
                                    class="form-control">
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <tr>
                                            <th>Problem
                                                <textarea name="Problem" required class="form-control" id="form4Example3"
                                                    rows="4"></textarea>
                                            </th>
                                            <th>Solution
                                                <textarea name="Solution" required class="form-control" id="form4Example3"
                                                    rows="4"></textarea>
                                            </th>
                                            <th>Unique Value Proposition
                                                <textarea name="UniqueValueProposition" required class="form-control"
                                                    id="form4Example3" rows="4"></textarea>
                                            </th>
                                            <th>Unfair Advantage
                                                <textarea name="UnfairAdvantage"required class="form-control" id="form4Example3"
                                                    rows="4"></textarea>
                                            </th>
                                            <th>Customer Segments
                                                <textarea name="CustomerSegments" required class="form-control"
                                                    id="form4Example3" rows="4"></textarea>
                                            </th>

                                        </tr>
                                        <tr>
                                            <td>Existing Alternatives
                                                <textarea name="ExistingAlternatives" class="form-control"
                                                    id="form4Example3" required rows="4"></textarea>
                                            </td>
                                            <td>Key Metrics
                                                <textarea name="KeyMetrics" required class="form-control" id="form4Example3"
                                                    rows="4"></textarea>
                                            </td>
                                            <td>High-Level Concept
                                                <textarea name="HighLevelConcept" required class="form-control"
                                                    id="form4Example3" rows="4"></textarea>
                                            </td>
                                            <td>Channels
                                                <textarea name="Channels" required class="form-control" id="form4Example3"
                                                    rows="4"></textarea>
                                            </td>
                                            <td>Early Adopters
                                                <textarea name="EarlyAdopters" required class="form-control" id="form4Example3"
                                                    rows="4"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cost Structure
                                                <textarea name="CostStructure" required class="form-control" id="form4Example3"
                                                    rows="4"></textarea>
                                            </td>
                                            <td>Revenue Structure
                                                <textarea name="RevenueStructure" required class="form-control"
                                                    id="form4Example3" rows="4"></textarea>
                                            </td>
                                            <td>
                                                <input type="submit" name="sendbtn" value="Apply"
                                                    class="btn btn-primary">
                                            </td>
                                        </tr>


                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- /.container-fluid -->

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
    <script src="../plugins/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../plugins/js/demo/chart-area-demo.js"></script>
    <script src="../plugins/js/demo/chart-pie-demo.js"></script>

</body>

</html>

<?php 
   } 
?>