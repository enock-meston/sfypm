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

    <title>Messages</title>

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
                        Message
                    </h4>

                    <!-- /.container-fluid -->

                    <div class="row">

                    </div>
                    <hr>
                    <!--USERS  tables -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-12">
                        <div class="card-header py-12">
                            <h6 class="m-0 font-weight-bold text-primary"> New Messages</h6>
                        </div>
                        <div class="card-body">
                            <?php
                            $supervisorID = $_SESSION['super_id'];
                                $messqges = mysqli_query($con,"SELECT tbl_message.mid as mid,tbl_students.sID as sID,tbl_students.fname as StuFname,
                                tbl_students.lname as StuLname,tbl_users.lname as slname,
                                tbl_users.fname as sfname,tbl_message.messageMember as messageMember,
                                tbl_message.messageUser as messagUser FROM tbl_message LEFT JOIN 
                                tbl_students ON tbl_students.sID = tbl_message.memberID LEFT JOIN 
                                tbl_users ON tbl_message.userId = tbl_users.uid WHERE 
                                tbl_message.userId='$supervisorID' AND tbl_message.status=1");
                                while ($rowData = mysqli_fetch_array($messqges)) {
                            ?>

                            <div class="card mb-4">
                                <div class="card-header">
                                    Name: <?php echo $rowData['StuFname']." ".$rowData['StuLname'];?>
                                    <a href="chat.php?reply=<?php echo $rowData['sID'];?>">
                                        view Message
                                    </a>
                                </div>
                                <div class="card-body">
                                    <?php echo $rowData['messageMember']; ?>
                                </div>
                            </div>

                            <?php
                                }
                            ?>
                        </div>
                        <!--end mesages  tables -->

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