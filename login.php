<?php
session_start();
$error = "";
$msg = "";
include('include/config.php');

if (isset($_POST['loginbtn'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $select = mysqli_query($con, "SELECT * FROM admintbl WHERE email='" . trim($email) . "' OR 
    username='" . trim($email) . "' AND status='1'") or die(mysqli_error($con));

    if (mysqli_num_rows($select) ==1) {
        $row = mysqli_fetch_array($select);
        $pass = $row['password'];
        if ($pass == $password) {
            $_SESSION['adid'] = $row['caid'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['phonenumber'] = $row['phonenumber'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            header("location: dashboard.php");
        }else {
            $error = "Password does not match with any of account , Please try again later!!";
        }
    }else {
        $error = "Invalid user credintials , Please try again later!!";
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

    <title>Admin Login</title>

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

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Admin</h1>
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back To MCMF APP!</h1>
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
                                            <input type="text" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email or User Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                       
                                        <div class="form-group">
                                            <input type="submit" class="form-control btn btn-primary" name="loginbtn"
                                            value="Login">
                                        </div>
                                        <hr>
                                        
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
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