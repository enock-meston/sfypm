<?php
session_start();
include '../include/config.php';
error_reporting(0);
if (strlen($_SESSION['sID']) == 0) {
    header('location: index.php');
} else {

    if ($_GET['reque']) {
        $studentID = $_GET['reque'];
        $me = $_SESSION['sID'];  

        $checkStudent = mysqli_query($con,"SELECT * FROM `tbl_group` WHERE 
        (`studentOne` = '$studentID' OR `studentTwo` ='$studentID') OR 
        (`studentOne` = '$me' OR `studentTwo` ='$me') OR `studentTwo` ='$me' OR `studentTwo` ='$studentID' OR 
        `studentOne` = '$studentID' OR `studentOne` = '$me' AND status='1'");

        $result = mysqli_num_rows($checkStudent);
        if ($result > 0) {
            $error = "One of you have a Group";
        }elseif($studentID == $_SESSION['sID']){
            $error = " HAHAHAHAHA! You can't Make Request to You!";
        } else {
            $groupNumber =date('i').rand(1000,9999);
            if (mysqli_query($con,"INSERT INTO `tbl_group`(`groupNumber`, `studentOne`, `studentTwo`,`status`) 
            VALUES ('$groupNumber','$studentID','".$_SESSION['sID']."','1')")) {
                $msg = "Now Your Request Sent";
            } else {
                $error ="Query Problem";
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
                        
                      

                        $gn = $_SESSION['gn'];

                                    $selectSupervisor = mysqli_query($con,"SELECT tbl_group.superVisorID as SID,
                                    tbl_users.fname as FN,tbl_users.lname as LN, tbl_group.groupNumber as GRN 
                                    from tbl_group LEFT JOIN tbl_users ON tbl_users.uid = tbl_group.superVisorID 
                                    WHERE tbl_group.groupNumber='$gn'");
                                    $data = mysqli_fetch_array($selectSupervisor);
                                    if ($data['LN'] == "" || $data['FN'] == "" || $data['LN'] == null || $data['FN'] == null) {
                                        echo "Not Yet being given a Supervisor";
                                    } else {
                                        
                                        echo "OUR SUPERVISOR: ". $data['LN'] ." ".$data['FN'];
                                    }
                                    
                                    
                                    
                                    // echo $_SESSION['gn'];

                        while ($row=mysqli_fetch_array($sqlGroup)) {
                           $_SESSION['gn'] =$row['groupNumber'];
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

                    <h4>Student List</h4>
                    <form method="POST">
                        <div class="form-group">
                            <div class="input-group">
                                <input name="student" type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search Student..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" name="searchBTN" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Content Row -->
                    <div class="row">



                        <br>
                        <!-- message block -->
                        <div class="col-sm-12">
                            <!---Success Message--->
                            <?php if ($msg) { ?>
                            <div class="alert alert-success" role="alert">
                                <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                            </div>
                            <?php } ?>

                            <!---Error Message--->
                            <?php if ($error) { ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                            </div>
                            <?php } ?>
                        </div>
                        <!--ends of message block -->
                        <!-- select Project -->
                        <?php


                            if (isset($_POST['searchBTN'])) {
                              $student = $_POST['student'];
                              
                            
                            $selectRoom= mysqli_query($con,"SELECT * FROM `tbl_students` 
                            WHERE fname LIKE '%$student%' OR lname LIKE '%$student%' OR 
                            reg_number LIKE '%$student%' AND status='1'");

                            while ($row=mysqli_fetch_array($selectRoom)) {
                            
                            ?>
                        <div class="col-md-4">
                            <div class="card">
                                <center>
                                    <br>
                                    <img style="width: 5rem;" src="../plugins/img/undraw_profile.svg"
                                        class="card-img-top" alt="Student's Profile" />
                                </center>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo "Names: ". $row['fname'] ."  ". $row['lname'];?>
                                    </h5>
                                    <p class="card-text"
                                        style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                        <?php echo "Reg.Number: ". htmlentities($row['reg_number']);?>
                                    </p>
                                    <a href="group.php?reque=<?php echo $row['sID'];?>"
                                        class="btn btn-primary">Request</a>
                                </div>
                            </div> <br>
                        </div>

                        <!--end select Project -->
                        <?php 
                                } 
                            }else {
                                $selectRoom= mysqli_query($con,"SELECT * FROM `tbl_students` 
                            WHERE fname LIKE '%$student%' OR lname LIKE '%$student%' OR 
                            reg_number LIKE '%$student%' AND status='1'");

                            while ($row=mysqli_fetch_array($selectRoom)) {
                            
                            ?>
                        <div class="col-md-4">
                            <div class="card">
                                <center>
                                    <br>
                                    <img style="width: 5rem;" src="../plugins/img/undraw_profile.svg"
                                        class="card-img-top" alt="Student's Profile" />
                                </center>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo "Names: ". $row['fname'] ."  ". $row['lname'];?>
                                    </h5>
                                    <p class="card-text"
                                        style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                        <?php echo "Reg.Number: ". htmlentities($row['reg_number']);?>
                                    </p>
                                    <a href="group.php?reque=<?php echo $row['sID'];?>"
                                        class="btn btn-primary">Request</a>
                                </div>
                            </div> <br>
                        </div>

                        <!--end select Project -->
                        <?php 
                                } 
                            
                        ?>
                    </div>
                    <?php
                            }
                        ?>
                </div>
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