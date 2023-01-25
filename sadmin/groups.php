<?php
session_start();

$error = "";
$msg = "";
include('../include/config.php');
error_reporting(E_ALL);
ini_set("display_errors", 1);
error_reporting(0);
if (strlen($_SESSION['sadmin_id']) == 0) {
    header('location:../login.php');
} else {


    if(isset($_POST['makebtn'])){
        $superID = $_POST['superID'];
        $groupID = $_POST['groupID'];

            $queryUpdate = mysqli_query($con,"UPDATE `tbl_group` SET `superVisorID`=8,
             `status`=2 WHERE gid='$groupID'"); 
            //status = 2 means that group has supervisor
            if ($queryUpdate) {
                $msg = "Assigned !" . $groupID;
            }else {
                $error = " Update Query Problems !!";
            }
    }


    if (isset($_GET['del'])) {
        $groupid = $_GET['del'];
        $sqlSupending = mysqli_query($con,"UPDATE `tbl_group` SET `status`=0 WHERE gid='$groupid'");
        if ($sqlSupending) {
            $msg= "Group was been Removed or Inactive";
        }else {
            $error = "Something Went Wrong";
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

    <title>Group</title>

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
                    <h4>
                        Group's Page
                    </h4>

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
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#GroupyModal">Assign <i
                                class="fas fa-fw fa-equals"></i></a>
                    </div>
                    <!-- modal -->
                    <div class="modal fade" id="GroupyModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Assign Group to Member </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- transaction viewing Table -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <!-- form of adding Categories -->
                                            <form method="POST">
                                                <div class="form-group">

                                                    <select class="form-control" name="groupID" id="">
                                                        <option>Select Group</option>
                                                        <?php
                                                            $sqlGroup = mysqli_query($con,"SELECT * FROM `tbl_group` WHERE status='1'");
                                                
                                                            while ($rowGroup = mysqli_fetch_array($sqlGroup)) {
                                                                ?>
                                                        <option value="<?php echo $rowGroup['gid'];?>">
                                                            <?php echo $rowGroup['groupNumber'];?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select><br>

                                                    <select class="form-control" name="superID" id="">
                                                        <option>Select Supervisor</option>
                                                        <?php
                                                            $sqlGroup = mysqli_query($con,"SELECT * FROM `tbl_users` WHERE status='1' AND userType='super'");
                                                
                                                            while ($rowGroup = mysqli_fetch_array($sqlGroup)) {
                                                                ?>
                                                        <option value="<?php echo $rowGroup['uid'];?>">
                                                            <?php echo $rowGroup['fname']." ".$rowGroup['lname'];?>
                                                        </option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select><br>

                                                    <input type="submit" class="btn btn-primary" name="makebtn"
                                                        value="Save">
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
                    <!-- modal -->
                    <hr>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-12">
                        <div class="card-header py-12">
                            <h6 class="m-0 font-weight-bold text-primary">Groups</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>N0</th>
                                            <th>Group Number</th>
                                            <th>Group Member</th>
                                            <th>Supervisor</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>N0</th>
                                            <th>Group Number</th>
                                            <th>Group Members</th>
                                            <th>Supervisor</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <tr>
                                            <?php 
                                            $query = mysqli_query($con,"SELECT tbl_students.fname as StuFname,
                                            tbl_students.lname as StuLname, tbl_group.groupNumber as groupNumber,tbl_group.gid as gid,
                                             tbl_users.lname as slname,tbl_users.fname as sfname FROM `tbl_group` 
                                             LEFT JOIN tbl_students ON tbl_group.studentOne= tbl_students.sID OR 
                                             tbl_group.studentTwo= tbl_students.sID LEFT JOIN tbl_users ON 
                                             tbl_users.uid = tbl_group.superVisorID WHERE tbl_group.status='1' 
                                             OR tbl_group.status='2'");
                                            if (mysqli_num_rows($query)<=0) {
                                                ?>
                                            <h1 style="color: red;">No data Founds !</h1>
                                            <?php
                                            } else {
                                              
                                            $number=1;
                                                while ($row1 = mysqli_fetch_array($query)) {
                                                     
                                        
                                        ?>
                                            <td><?php echo $number;?></td>
                                            <td><?php echo $row1['groupNumber'];?></td>
                                            <td><?php echo $row1['StuFname'] . " ".$row1['StuLname'];?></td>
                                            <td><?php echo $row1['slname'] . " " . $row1['sfname'];?></td>
                                            <td>
                                                <a href="groups.php?del=<?php echo $row1['gid'];?>" class="btn btn-success"><span
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