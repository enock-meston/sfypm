<?php
session_start();
$error = "";
$msg = "";
include('../include/config.php');

error_reporting(0);
if (strlen($_SESSION['tml_email']) == 0) {
    header('location:../login.php');
} else {


    if (isset($_POST['saveproject'])) {
        $title = $_POST['title'];
        $owner = $_POST['owner'];
        $status = '2';
        $sql = mysqli_query($con,"SELECT * FROM `tblprojectcanvas` WHERE title='$title'");
        $result = mysqli_num_rows($sql);

        if ($result > 0) {
            $error = "project tilte is already In! try another one.";
        }else {
            $query = mysqli_query($con,"INSERT INTO `tblprojectcanvas`(`groupNumber`, `title`,
            `Status`) VALUES ('$owner','$title','$status')");
            if ($query) {
                $msg ="Project is now Added !";
            } else {
                $error = "There is Error in Query !";
            }
            
        }
    }


    if ($_GET['appr']) {
       $id = $_GET['appr'];
       $aproveQuery= mysqli_query($con,"UPDATE `tblprojectcanvas` SET `Status`='1' WHERE cid ='$id'");
       if ($aproveQuery) {
        $msg = "approved";
       } else {
        $error = "Query Problem";
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

    <title>Approved</title>

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
                            Approved Project's Page
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

                    <div class="row">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#CategoryModal">Add <i
                                class="fas fa-fw fa-plus"></i></a>
                    </div>
                    <hr>
                    <h4> Approved PROJECT LIST</h4>
                    <!--PROJECT  tables -->
                    <!-- DataTales Example -->

                    <div class="card shadow col-sm-12">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"> Approved Projects</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>N0</th>
                                            <th>Title</th>
                                            <th>Project Owner</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>N0</th>
                                            <th>Title</th>
                                            <th>Project Owner</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <tr>
                                            <?php 
                                            $query = mysqli_query($con,"SELECT * FROM `tblprojectcanvas` WHERE Status=2");
                                            if (mysqli_num_rows($query)<=0) {
                                                ?>
                                            <h1 style="color: red;">No data Founds !</h1>
                                            <?php
                                            } else {
                                              
                                            $number=1;
                                                while ($row1 = mysqli_fetch_array($query)) {
                                                     
                                        
                                        ?>
                                            <td><?php echo $number;?></td>
                                            <td><?php echo $row1['title'];?></td>
                                            <td><?php echo $row1['groupNumber'];?></td>
                                            <td>
                                                <a href="viewOne.php?on=<?php echo $row1['cid'] ;?>"
                                                    class="badge badge-secondary"> <i class='fas fa-eye'
                                                        style='font-size:20px;color:red'></i> view</a>
                                              
                                            </td>
                                        </tr>
                                        <?php
                                       $number+=1;
                                                }

                                            }
                                       ?>
                                    </tbody>

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