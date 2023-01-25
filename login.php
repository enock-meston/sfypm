<?php
session_start();
$error = "";
$msg = "";
include('include/config.php');

if (isset($_POST['loginbtn'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $hashespas = password_hash($password, PASSWORD_BCRYPT);
    $select = mysqli_query($con, "SELECT * FROM tbl_users WHERE email='$email' AND status='1'") or die(mysqli_error($con));

    

    if ($_POST['type'] == "hod") {
        if (mysqli_num_rows($select) ==1) {
            $row = mysqli_fetch_array($select);
            $db_password = $row['password'];
        if (password_verify(mysqli_real_escape_string($con, trim($_POST['password'])), $db_password)) {
            $_SESSION['hodid'] = $row['uid'];
            $_SESSION['firstname'] = $row['fname'];
            $_SESSION['lastname'] = $row['lname'];
            $_SESSION['phonenumber'] = $row['phoneNumber'];
            $_SESSION['type'] = $row['userType'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['dept'] = $row['dept'];
            header("location: hod/dashboard.php");
        }else {
            $error = "Password does not match with any of account , Please try again later!!";
        }
        }else {
            $error = "Invalid user credintials , Please try again later!!";
        }
    }elseif ($_POST['type'] == "tml") {
        if (mysqli_num_rows($select) ==1) {
            $row = mysqli_fetch_array($select);
            $db_password = $row['password'];
        if (password_verify(mysqli_real_escape_string($con, trim($_POST['password'])), $db_password)) {
            $_SESSION['tml_id'] = $row['uid'];
            $_SESSION['tml_firstname'] = $row['fname'];
            $_SESSION['tml_lastname'] = $row['lname'];
            $_SESSION['tml_phonenumber'] = $row['phoneNumber'];
            $_SESSION['tml_type'] = $row['userType'];
            $_SESSION['tml_email'] = $row['email'];
            header("location: tml/dashboard.php");
        }else {
            $error = "Password does not match with any of account , Please try again later!!";
        }
    }else {
        $error = "Invalid user credintials , Please try again later!!";
    }
    }elseif ($_POST['type'] == "sadmin") {
        if (mysqli_num_rows($select) ==1) {
            $row = mysqli_fetch_array($select);
            $db_password = $row['password'];
        if (password_verify(mysqli_real_escape_string($con, trim($_POST['password'])), $db_password)) {
            $_SESSION['sadmin_id'] = $row['uid'];
            $_SESSION['sadmin_firstname'] = $row['fname'];
            $_SESSION['sadmin_lastname'] = $row['lname'];
            $_SESSION['sadmin_phonenumber'] = $row['phoneNumber'];
            $_SESSION['sadmin_type'] = $row['userType'];
            $_SESSION['sadmin_email'] = $row['email'];
            header("location: sadmin/dashboard.php");
            }else {
                $error = "Password does not match with any of account , Please try again later!!";
            }
        }else {
            $error = "Invalid user credintials , Please try again later!!";
        }
    }
    elseif ($_POST['type'] == "super") {
    if (mysqli_num_rows($select) ==1) {
        $row = mysqli_fetch_array($select);
        $db_password = $row['password'];
    if (password_verify(mysqli_real_escape_string($con, trim($_POST['password'])), $db_password)) {
        $_SESSION['super_id'] = $row['uid'];
        $_SESSION['super_firstname'] = $row['fname'];
        $_SESSION['super_lastname'] = $row['lname'];
        $_SESSION['super_phonenumber'] = $row['phoneNumber'];
        $_SESSION['super_type'] = $row['userType'];
        $_SESSION['super_email'] = $row['email'];
        header("location: supervisor/dashboard.php");
        }else {
            $error = "Password does not match with any of account , Please try again later!!";
        }
    }else {
        $error = "Invalid user credintials , Please try again later!!";
    }
    }else {
        $error = "User Type Not Selected and It is Required !";
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

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="plugins/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="plugins/css/sb-admin-2.css" rel="stylesheet">
    <link rel="shortcut icon" href="plugins/img/mcmlogopng.png" type="image/x-icon">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-12 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-8 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-4">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Staff</h1>
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back To SFYPM !</h1>
                                    </div>
                                    <!-- message -->
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
                                    <!-- end of message -->
                                    <form class="user" method="POST">

                                        <div class="form-group">
                                            <select name="type" id="" class="form-control">
                                                <option>Select your Type</option>
                                                <option value="sadmin">Sys. Admin</option>
                                                <option value="hod">HOD</option>
                                                <option value="tml">Team Leader</option>
                                                <option value="super">SUPERVISOR</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email or User Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Password">
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="form-control btn btn-primary" name="loginbtn"
                                                value="Login">
                                        </div>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="index.php">Back to Home</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="plugins/vendor/jquery/jquery.min.js"></script>
    <script src="plugins/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="pluginsvendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="pluginsjs/sb-admin-2.min.js"></script>

</body>

</html>