 <!-- Topbar -->
 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

     <!-- Sidebar Toggle (Topbar) -->
     <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
         <i class="fa fa-bars"></i>
     </button>

     <!-- Topbar Search -->
     <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
         <div class="input-group">
             <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                 aria-label="Search" aria-describedby="basic-addon2">
             <div class="input-group-append">
                 <button class="btn btn-primary" type="button">
                     <i class="fas fa-search fa-sm"></i>
                 </button>
             </div>
         </div>
     </form>
     <!-- Topbar Navbar -->
     <ul class="navbar-nav ml-auto">

         <!-- Nav Item - Search Dropdown (Visible Only XS) -->
         <li class="nav-item dropdown no-arrow d-sm-none">
             <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false">
                 <i class="fas fa-search fa-fw"></i>
             </a>
             <!-- Dropdown - Messages -->
             <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                 aria-labelledby="searchDropdown">
                 <form class="form-inline mr-auto w-100 navbar-search">
                     <div class="input-group">
                         <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                             aria-label="Search" aria-describedby="basic-addon2">
                         <div class="input-group-append">
                             <button class="btn btn-primary" type="button">
                                 <i class="fas fa-search fa-sm"></i>
                             </button>
                         </div>
                     </div>
                 </form>
             </div>
         </li>


         <!--  -->
         <div class="topbar-divider d-none d-sm-block"></div>

         <!-- Nav Item - User Information -->
         <li class="nav-item dropdown no-arrow">
             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false">
                 <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['super_email']; ?></span>
                 <img class="img-profile rounded-circle" src="../plugins/img/undraw_profile.svg">
             </a>
             <!-- Dropdown - User Information -->
             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ProfileModal">
                     <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                     Profile
                 </a>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                     <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                     Logout
                 </a>
             </div>
         </li>

     </ul>

 </nav>
 <!-- End of Topbar -->


 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
             <div class="modal-footer">
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                 <a class="btn btn-primary" href="logout.php">Logout</a>
             </div>
         </div>
     </div>
 </div>


 <!-- profiles -->
 <div class="modal fade" id="ProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">
                     My Profile
                 </h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">

                 <center>
                     <img class="img-profile rounded-circle" src="../plugins/img/undraw_profile.svg"
                         style="width: 10rem;">
                 </center>
                 <br>
                 <hr>
                 <?php
                 $super_ID = $_SESSION['super_id'];
                        // update data 
                        if (isset($_POST['update'])) {
                            $fname = $_POST['fname'];
                            $lname = $_POST['lname'];
                            $phone = $_POST['phone'];
                            $email = $_POST['email'];

                            if (mysqli_query($con,"UPDATE `tbl_users` SET `fname`='$fname',`lname`='$lname',`phoneNumber`='$phone' WHERE uid='$super_ID'")) {
                                $msg = "Edited";
                            }else {
                                $error = "not edited";
                            }
                            
                        }
                        // view user  data 
                        
                        $query = mysqli_query($con,"SELECT * FROM `tbl_users` WHERE uid = '$super_ID'");
                        while ($row = mysqli_fetch_assoc($query)) {
                            
                        
                    ?>
                 <form method="POST">
                     <div class="form-group">
                         <input type="text" name="fname" value="<?php echo $row['fname'];?>" class="form-control">
                     </div>
                     <div class="form-group">
                         <input type="text" name="lname" value="<?php echo $row['lname'];?>" class="form-control">
                     </div>
                     <div class="form-group">
                         <input type="text" name="phone" value="<?php echo $row['phoneNumber'];?>" class="form-control">
                     </div>
                     <div class="form-group">
                         <input type="text" readonly name="email" value="<?php echo $row['email'];?>" class="form-control">
                     </div>
                     <div class="form-group">
                         <input type="submit" class="btn btn-primary" name="update" value="Edit">
                     </div>
                 </form>

                 <?php 
                        }
                    ?>
             </div>
             <div class="modal-footer">
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
             </div>
         </div>
     </div>
 </div>
 <!-- end of Profile -->