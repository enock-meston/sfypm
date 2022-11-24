<?php
session_start();
$error = "";
$msg = "";
include('../include/config.php');

error_reporting(0);
if (strlen($_SESSION['sID']) == 0) {
    header('location:../login.php');
} else {


    // if (isset($_POST['saveproject'])) {
    //     $title = $_POST['title'];
    //     $ownerOne = $_POST['ownerone'];
    //     $ownerTwo = $_POST['ownertwo'];
    //     $AcademicYear = $_POST['academicyear'];
    //     $supervisor = $_POST['supervisor'];
       

    //           // images
    //     $img_name = $_FILES['file']['name'];
    //     $img_size = $_FILES['file']['size'];
    //     $tmp_name = $_FILES['file']['tmp_name'];
    //     $error = $_FILES['file']['error'];

    //     $status = '1';
    //     $sql = mysqli_query($con,"SELECT * FROM `tblprojectcanvas` WHERE title='$title'");
    //     $result = mysqli_num_rows($sql);

    //     if ($result > 0) {
    //         $error = "project tilte is already In! try another one.";
    //     }else {
    //         $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    //         $img_ex_lc = strtolower($img_ex);
    //         $new_img_name = uniqid("FILE-", true).$title.'.'.$img_ex_lc;
    //         $img_upload_path = 'pdfBooks/'.$new_img_name;

    //         if (move_uploaded_file($tmp_name, $img_upload_path)) {
    //         $query = mysqli_query($con,"INSERT INTO `tbl_projectbook`(`title`, `owner_One`, 
    //         `Owner_two`, `AccademicYear`, `SuperVisorName`, `bookPath`,`status`) VALUES 
    //         ('$title','$ownerOne','$ownerTwo','$AcademicYear','$supervisor','$img_upload_path','$status')");
    //         if ($query) {
    //             $msg ="Project is now Added !";
    //         } else {
    //             $error = "There is Error in Query !";
    //         }
    //     }else {
    //         $error ="Not uploaded!";
    //      }
            
    //     }
    // }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>project</title>

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
                            Project's Page
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

                    <!-- <div class="row">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#CategoryModal">Add <i
                                class="fas fa-fw fa-plus"></i></a>
                    </div> -->
                    <hr>
                    <h4> Book LIST</h4>
                    <!--PROJECT  tables -->
                    <!-- DataTales Example -->
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"> Book Projects</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>N0</th>
                                            <th>Title</th>
                                            <th>Student One</th>
                                            <th>Student Two</th>
                                            <th>Academic Year</th>
                                            <th>SuperVisor Name</th>
                                            <th>Book</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>N0</th>
                                            <th>Title</th>
                                            <th>Student One</th>
                                            <th>Student Two</th>
                                            <th>Academic Year</th>
                                            <th>SuperVisor Name</th>
                                            <th>Book</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <tr>
                                            <?php 
                                            $query = mysqli_query($con,"SELECT * FROM `tbl_ProjectBook` WHERE Status=1");
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
                                            <td><?php echo $row1['owner_One'];?></td>
                                            <td><?php echo $row1['Owner_two'];?></td>
                                            <td><?php echo $row1['AccademicYear'];?></td>
                                            <td><?php echo $row1['SuperVisorName'];?></td>
                                            <td>
                                            
                                                <?php 
                                                $link =$row1['bookPath'];
                                                ?>
                                                
                                                <a href="<?php print $link; ?>" class="btn-outline-success px-10"><i class="fas fa-fw fa-download"></i></td>
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
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" name="title" required class="form-control form-control-user"
                                            id="exampleInputEmail" placeholder="Project Title">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="ownerone" required class="form-control form-control-user"
                                            id="exampleInputEmail" placeholder="Student One">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="ownertwo" required class="form-control form-control-user"
                                            id="exampleInputEmail" placeholder="Student Two">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="academicyear" required class="form-control form-control-user"
                                            id="exampleInputEmail" placeholder="Academic Year Examle: 2019-2020">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="supervisor" required class="form-control form-control-user"
                                            id="exampleInputEmail" placeholder="Supervisor's Name Owner">
                                    </div>
                                    <div class="form-group">
                                        <label for=""> upload pdf file only accepted <sup> <span style="color:red;">*</span></sup></label>
                                        <input type="file" name="file" required class="form-control form-control-user" accept=".pdf">
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