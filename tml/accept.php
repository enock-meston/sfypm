<?php
session_start();
$error = "";
$msg = "";
include('../include/config.php');

error_reporting(0);
if (strlen($_SESSION['tml_email']) == 0) {
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

    <title>Pending</title>

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
                    <h4> Pending PROJECT LIST</h4>
                    <!--PROJECT  tables -->
                    <!-- DataTales Example -->

                    <div class="card shadow col-sm-12">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"> Pending Projects</h6>
                        </div>
                        <div class="card-body">
                            <?php 
                                $id = $_GET['idd'];
                                if (isset($_POST['accept'])) {
                                    # code...
                                    $comment = $_POST['comment'];
                                $update = mysqli_query($con,"UPDATE `tblprojectcanvas` SET `Status`='4' WHERE cid='$id'"); // 4 means project is accepted with condition
                                if($update){
                                    mysqli_query($con,"INSERT INTO `tblcomment`(`message`, `projectID`, `status`) 
                                    VALUES ('$comment','$id','1')");
                                    $msg = "Project Accepted with condition";
                                }else{
                                    $error= "";
                                }
                                }
                                ?>

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
                            <form action="" method="POST">
                                <textarea name="comment" required class="form-control" id="form4Example3"
                                    rows="4"></textarea>
                                <br>
                                <input type="submit" name="accept" value="send" class="btn btn-primary">
                            </form>
                        </div>
                        <!--end USERS  tables -->

                    </div>

                </div>
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


        <div class="modal fade" id="CategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Prevoius Project Idea </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- transaction viewing Table -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- form of adding Categories -->
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="title" required class="form-control form-control-user"
                                            id="exampleInputEmail" placeholder="Project Title">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="owner" required class="form-control form-control-user"
                                            id="exampleInputEmail" placeholder="Project Owner">
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="save" name="saveproject">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end of table -->
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>




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