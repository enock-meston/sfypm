<?php
session_start();

$error = "";
$msg = "";
include('../include/config.php');
error_reporting(E_ALL);
ini_set("display_errors", 1);
error_reporting(0);
if (strlen($_SESSION['super_email']) == 0) {
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

    <title>Projects</title>

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
                        My Students And Their Projects Ideas
                    </h4>

                    <!-- /.container-fluid -->

                    <div class="row">

                    </div>
                    <hr>
                    <!--USERS  tables -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-12">

                        <div class="card-header py-12">
                            <h6 class="m-0 font-weight-bold text-primary"> Student Thier And Project Ideas</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php
                                    $supervisorID = $_SESSION['super_id'];
                                        $Project_Student = mysqli_query($con,"SELECT tbl_students.sID as sID, 
                                        tbl_students.fname as stfname,tbl_students.lname as stlname,
                                        tbl_students.reg_number as reg_number,tbl_students.email as stemail,
                                        tbl_students.phoneNumber as stPhone,tbl_group.groupNumber as groupNumber,
                                        tblprojectcanvas.title as title FROM tblprojectcanvas,tbl_group,tbl_students 
                                        WHERE tbl_group.superVisorID ='$supervisorID' AND tbl_group.groupNumber = tblprojectcanvas.groupNumber 
                                        AND (tbl_students.sID=tbl_group.studentOne OR tbl_students.sID=tbl_group.studentTwo);");
                                        $count=1;
                                        while ($rowData = mysqli_fetch_array($Project_Student)) {
                                            
                                ?>

                                <div class="card mb-4">
                                    <div class="card-header">
                                        <?php echo "No <b>". $count ."</b> :";?>
                                        Student Name :
                                        <b><?php echo $rowData['stfname'] ."  ".$rowData['stlname'] ; ?></b><br>
                                        <hr>
                                        Project Title: <b> <?php echo $rowData['title']; ?></b>
                                    </div>
                                    <div class="card-body">
                                        Has Group Code: <b> <?php echo $rowData['groupNumber'];?></b><br>
                                        Student email : <b><?php echo $rowData['stemail'];?></b><br>
                                        Student Phone Number: <b> <?php echo $rowData['stPhone'];?></b><br>
                                        Student Reg Number: <b> <?php echo $rowData['reg_number'];?></b><br>
                                    </div>
                                </div>

                                <?php
                                    $count +=1;
                                        }
                                        
                                    ?>
                            </div>
                            <!--end mesages  tables -->

                        </div>

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