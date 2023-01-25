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


    if(isset($_POST['importSubmit'])){
    
        // Allowed mime types
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        
        // Validate whether selected file is a CSV file
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
            
            // If the file is uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                
                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                
                // Skip the first line
                fgetcsv($csvFile);
                
                // Parse data from CSV file line by line
                while(($line = fgetcsv($csvFile)) !== FALSE){
                    // Get row data
                    $fname   = $line[0];
                    $lname  = $line[1];
                    $reg_number  = $line[2];
                    $email = $line[3];
                    $phoneNumber = $line[4];
                    $password = $line[5];
                    $Department = $line[6];
                    $Academic_Year = $line[7];
                    $status = $line[8];

                    
                    // Check whether member already exists in the database with the same email
                    $prevQuery = "SELECT * FROM tbl_students WHERE reg_number = '".$line[2]."' OR email = '".$line[3]."'";
                    $prevResult = mysqli_query($con,$prevQuery);
                    
                    if(mysqli_num_rows($prevResult) > 0){
                        // Update member data in the database
                        mysqli_query($con,"UPDATE `tbl_students` SET `fname`='$fname',`lname`='$lname',
                        `reg_number`='$reg_number',`email`='$email',`phoneNumber`='$phoneNumber',
                        `password`='".password_hash($password, PASSWORD_BCRYPT)."',`Department`='$Department',
                        `Academic_Year`='$Academic_Year',`status`='$status' WHERE email = '$email'");
                    }else{
                        // Insert member data in the database
                        mysqli_query($con,"INSERT INTO `tbl_students`(`fname`, `lname`, `reg_number`, `email`,
                         `phoneNumber`, `password`, `Department`, `Academic_Year`, `status`) 
                         VALUES ('$fname','$lname','$reg_number','$email',
                         '$phoneNumber','".password_hash($password, PASSWORD_BCRYPT)."','$Department','$Academic_Year','$status')");
                    }
                }
                
                // Close opened CSV file
                fclose($csvFile);
                $msg= "Success Added";
            }else{
                $error = "Something went wrong!";
            }
        }else{
            $error = "invalid_file";
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

    <title>Student</title>

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
                        Student's Page
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
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#StudentyModal">Add <i
                                class="fas fa-fw fa-plus"></i></a>
                    </div>
                    <!-- modal -->
                    <div class="modal fade" id="StudentyModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Student </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- transaction viewing Table -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <!-- form of adding Categories -->
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <input type="file" name="file" accept=".csv" class="form-contol" />
                                                    <input type="submit" class="btn btn-primary" name="importSubmit"
                                                        value="IMPORT">
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
                    <h4>User List</h4>
                    <!--USERS  tables -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-12">
                        <div class="card-header py-12">
                            <h6 class="m-0 font-weight-bold text-primary">Sudent List</h6>
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
                                            <th>Reg Number</th>
                                            <th>Department</th>
                                            <th>Academic Year</th>
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
                                            <th>Reg Number</th>
                                            <th>Department</th>
                                            <th>Academic Year</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <tr>
                                            <?php 
                                            $query = mysqli_query($con,"SELECT * FROM `tbl_students` WHERE status=1");
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
                                            <td><?php echo $row1['reg_number'];?></td>
                                            <td><?php echo $row1['Department'];?></td>
                                            <td><?php echo $row1['Academic_Year'];?></td>
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