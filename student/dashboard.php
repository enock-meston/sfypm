<?php
session_start();
include '../include/config.php';
error_reporting(0);
if (strlen($_SESSION['sID']) == 0) {
    header('location: index.php');
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

            <!-- Main Content -->
            <div id="content">



                <?php 
                        include 'include/topbar.php'
                   ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">
                    <div class="card shadow mb-12">
                        <div class="card-header py-12">
                            <h6 class="m-0 font-weight-bold text-primary"> New Comment</h6>
                        </div>
                        <div class="card-body">
                            <?php
                            $MyId = $_SESSION['sID'];

                            // get groupID
                                $groupNumber = mysqli_query($con,"SELECT * FROM `tbl_group` WHERE 
                                studentOne='$MyId' OR studentTwo='$MyId'");
                                $rowData = mysqli_fetch_array($groupNumber);
                                $groupID = $rowData['gid'];
                                $groupNumber = $rowData['groupNumber'];
                                // 
                                $selectCanvasID = mysqli_query($con,"SELECT * FROM `tblprojectcanvas` 
                                WHERE groupNumber='$groupNumber'");
                                $rowCanvas= mysqli_fetch_array($selectCanvasID);
                                $canvasID = $rowCanvas['cid'];

                                // select comment
                                $selectComment = mysqli_query($con,"SELECT * FROM `tbl_comment` WHERE postCanvasID='$canvasID'");
                                $rowComment= mysqli_fetch_array($selectComment);
                                $Comment = $rowComment['comment'];
                            ?>

                            <div class="card mb-4">
                                <div class="card-header">
                                    Comment:
                                </div>
                                <div class="card-body">
                                    <?php 
                                    
                                    echo $Comment ."<br>"; 
                                    
                                    if ($Comment != "" || $Comment != null) {
                                      ?>
                                        <a href="correct.php?proID=<?php echo $canvasID;?>">Edit your Canvas</a>
                                      <?php  
                                    }else {
                                        echo  "... Status Ok...";
                                    }
                                    ?>
                                </div>
                            </div>

                            <?php
                                // }
                            ?>
                        </div>
                        <!--end mesages  tables -->

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