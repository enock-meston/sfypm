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
    if (isset($_POST['send'])) {
                        
        $messageTXT = $_POST['messageTXT'];
        $studentId = $_SESSION['super_id'];
        // // select my superVisor 
        $supervisorQuery = mysqli_query($con,"SELECT * FROM `tbl_group` WHERE studentOne = '$studentId' OR studentTwo ='$studentId'");
        $supervisor = mysqli_fetch_assoc($supervisorQuery);
        $supervisorID = $supervisor['superVisorID'];

        $SQLMessage = mysqli_query($con,"INSERT INTO `tbl_message`(`memberID`, `userId`, `messageMember`,`status`) 
        VALUES ('$studentId','$supervisorID','$messageTXT','1')");
         if($SQLMessage) {
            $msg = "sent";
         } else {
            $error = "not sent";
         }
     
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>chat app</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <a href="dashboard.php"> back</a>
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
    <div class="container">
        <div class="row clearfix">

            <div class="card">
                <div class="chat">
                    <div class="chat-header clearfix">
                        <div class="row">

                            <div class="col-lg-12">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                </a>
                                <div class="chat-about">
                                    <h6 class="m-b-0">
                                        <?php echo $_SESSION['super_firstname'] . " ". $_SESSION['super_lastname'];?>
                                    </h6>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-history" style="overflow-y: scroll; height:400px;">
                        <?php
                             $studentId = $_GET['reply'];
                             // // select my superVisor 
                             $supervisorQuery = mysqli_query($con,"SELECT * FROM `tbl_group` WHERE 
                             studentOne = '$studentId' OR studentTwo ='$studentId'");
                             $supervisor = mysqli_fetch_assoc($supervisorQuery);
                             $supervisorID = $supervisor['superVisorID'];

                             $selectMessage1 = mysqli_query($con,"SELECT tbl_students.fname as StuFname,
                             tbl_students.lname as StuLname,tbl_users.lname as slname,
                             tbl_users.fname as sfname,tbl_message.messageMember as messageMember,
                             tbl_message.messageUser as messagUser FROM tbl_message LEFT JOIN 
                             tbl_students ON tbl_students.sID = tbl_message.memberID LEFT JOIN 
                             tbl_users ON tbl_message.userId = tbl_users.uid WHERE 
                             tbl_message.userId='$supervisorID' AND tbl_message.memberID= '$studentId'");
                             
                             
                             
                             
                             
                             $selectMessageUser = mysqli_query($con,"SELECT tbl_students.fname as StuFname,
                             tbl_students.lname as StuLname,tbl_users.lname as slname,
                             tbl_users.fname as sfname,tbl_message.messageMember as messageMember,
                             tbl_message.messageUser as messageUser FROM tbl_message LEFT JOIN tbl_students ON 
                             tbl_students.sID = tbl_message.memberID LEFT JOIN tbl_users ON 
                             tbl_message.userId = tbl_users.uid WHERE tbl_message.memberID= '$studentId' 
                             AND tbl_message.userId='$supervisorID'");
                             

                             while ($rowData = mysqli_fetch_array($selectMessage1) AND $rowUserMessage = mysqli_fetch_array($selectMessageUser)) {
                                             
                        ?>
                        <ul class="m-b-0">

                            <li class="clearfix">
                                <div class="message-data">
                                    <span
                                        class="message-data-time"><?php echo $rowData['StuFname']. " ".$rowData['StuLname'];?></span>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                </div>
                                <div class="message my-message"> <?php echo $rowData['messageMember'];?>
                                </div>
                            </li>

                            <li class="clearfix">
                                <div class="message-data text-right">
                                    <span
                                        class="message-data-time"><?php echo $rowData['slname']. " ".$rowData['sfname'];?></span>
                                </div>
                                <div class="message other-message float-right"><?php echo $rowUserMessage['messageUser'];?></div>
                            </li>



                        </ul>
                        <?php
                        
                             }
                        ?>
                    </div>

                </div>
                <!-- form -->
                <form method="POST">
                    <div class="chat-message clearfix">
                        <div class="input-group mb-0">

                            <input type="text" name="messageTXT" class="form-control" placeholder="Enter text here...">
                            <button type="submit" class=" btn btn-primary fa fa-send" name="send">
                            </button>
                        </div>
                    </div>
                </form>
                <!-- end of form -->
            </div>

            <link rel="stylesheet" href="../plugins/css/chat.css">
            <script type="text/javascript">

            </script>
</body>

</html>



<?php 
    } 
?>