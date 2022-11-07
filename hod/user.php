<?php
session_start();
$error = "";
$msg = "";
include('../include/config.php');

error_reporting(0);
if (strlen($_SESSION['email']) == 0) {
    header('location:../login.php');
} else {


    if (isset($_POST['saveUser'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $type = $_POST['type'];
        if ($type == "") {
            $error = "please Select user Type";
        }else {
            $hashpassword=password_hash($password, PASSWORD_BCRYPT);
            $query = mysqli_query($con,"INSERT INTO `tbl_users`(`email`, `password`, `userType`, `status`) 
            VALUES ('$email','$hashpassword','$type','1')");
            if ($query) {
                $msg ="User is now Added !";
                send_mail("New account","
                Hello Dear User has email $email,

                <br>in order to be logged in to SFYPM use your email and this Default password : $password <br>
                click here to continue.
                <br><br><br>
                Thank you!
                
                ",$email);
            } else {
                $error = "There is Error in Query !";
            }
            
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

    <title>User</title>

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
                            User's Page
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
                    <h4>User List</h4>
                    <!--USERS  tables -->
                    <!-- DataTales Example -->
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">User List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>N0</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>phone Number</th>
                                            <th>email</th>
                                            <th>User Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>N0</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>phone Number</th>
                                            <th>email</th>
                                            <th>User Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <tr>
                                            <?php 
                                            $query = mysqli_query($con,"SELECT * FROM `tbl_users` WHERE 1");
                                            if (mysqli_num_rows($query)<=0) {
                                                ?>
                                            <h1 style="color: red;">No data Founds !</h1>
                                            <?php
                                            } else {
                                              
                                            $number=1;
                                                while ($row1 = mysqli_fetch_array($query)) {
                                                     
                                        
                                        ?>
                                            <td><?php echo $number;?></td>
                                            <td><?php echo $row1['fname'];?></td>
                                            <td><?php echo $row1['lname'];?></td>
                                            <td><?php echo $row1['phoneNumber'];?></td>
                                            <td><?php echo $row1['email'];?></td>
                                            <td><?php echo $row1['userType'];?></td>
                                            <td>
                                                <a href="" class="btn btn-success"><span
                                                        class='badge bg-danger'>Suspend</span></a>
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
                        <h5 class="modal-title" id="exampleModalLabel">New User(Default account) </h5>
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
                                        <input type="email" name="email" required class="form-control form-control-user"
                                            id="exampleInputEmail" placeholder="Email Address">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <select name="type" id="" class="form-control">
                                                <option value="">Select user Type</option>
                                                <option value="HOF">Project Team Leader</option>
                                                <option value="super">SUPERVISOR</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" name="password" required
                                                class="form-control form-control-user" id="exampleRepeatPassword"
                                                placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="save" name="saveUser">
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