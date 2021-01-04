<?php
$wrongpassword = "";
$errorUserNotRegistered = "";
$errorPasswordDontMatch = "";
$msg = "";
if(isset($_POST['update-password']))
  {
    // instantiate staff
    $staff = new Staff();

  // instantiate request
    $request = new Request();
    $request_instance = $request->getAllRequestsByStaff($staf_id);

   // getting data to pre-fill the form

    $staff_details = $staff->getStaffById($staf_id);
    $staff_hod_details = $staff->getStaff_HODbyDept($staff_details[0]['dept_id']);
    $staff_dean_details = $staff->getStaff_DeanbySchool($staff_details[0]['scl_id']);
    $staff_principal_details = $staff->getStaff_Principalbycollege($staff_details[0]['coll_id']);
    $staff_HR_details = $staff->getStaff_HRbycollege($staff_details[0]['coll_id']);

    $logged_in_user_role = $staff_details[0]['role_id'];


    $username = $_SESSION['user_username'];
    // $stf_role = $_SESSION['role'];
    // $staf_id = $_SESSION['stf_id'];
       
    $currentpassword = $_POST['password'];
    $new_pass = $_POST['newpassword'];
    $confirm_password = $_POST['confirmpassword'];

    //hahing for new password
    $newpassword_hashed = password_hash($new_pass, PASSWORD_DEFAULT);

    if(password_verify($currentpassword, $staff_details[0]['password'])) {
                
      $res = $staff->Update_staff_Password($newpassword_hashed, $staf_id);      
      $msg = $res ." Your Password succesfully changed ";
  
    }
    else {
     $wrongpassword="Your current password is wrong "; 
    }
    if($new_pass != $confirm_password){
    $errorPasswordDontMatch = " Password doesnt match"; 
    }
    }

?>
      <div class="content-body h-100 row">
        <!-- <section class="flexbox-container"> -->
          <div class="col-12 h-80 d-flex align-items-center justify-content-center">
            <div class="col-md-8 col-sm-12 col-xs-12 col-lg-4 box-shadow100">
            <div class="card-header border-0">
              <div class="card border-grey border-lighten-3 m-0">
                   <h6 class="card-subtitle line-on-side text-black text-center font-small-3 pt-2">
                    <span>Enter your creditials</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                  

                  <?php if($wrongpassword):?> 
                
                  <div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
                  <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <strong></strong> <?php echo htmlentities($wrongpassword); ?>
                    </div>
                  <?php endif;?>

                  <?php if($errorPasswordDontMatch):?>                   
                  <div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
                  <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <strong></strong> <?php echo htmlentities($errorPasswordDontMatch); ?>
                    </div>
                  <?php endif;?>


                  <?php if($msg):?>                   
                  <div class="alert bg-success alert-icon-left alert-dismissible mb-2" role="alert">
                  <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <strong>Nice  </strong> <?php echo htmlentities($msg); ?>
                    </div>
                  <?php endif;?>

                  <?php if($errorUserNotRegistered):?>                   
                  <div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
                  <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <strong>Oh  ! </strong> <?php echo htmlentities($errorUserNotRegistered); ?>
                    </div>
                  <?php endif;?>



            <form class="form-horizontal" method="post">
                                  
            <div style="border:0px;"> <h5>Current Password</h></div>
            
            <fieldset class="form-group position-relative has-icon-left">
            <input type="password" class="form-control input-lg" id="password" name="password" placeholder="Current Password" tabindex="2" required data-validation-required-message="Please enter valid passwords.">
            <div class="form-control-position"><i class="la la-key"></i></div>
            <div class="help-block font-small-3"></div>
            </fieldset>

            <div style="border:0px;"> <h5>New Password</h></div>
            <fieldset class="form-group position-relative has-icon-left">
            <input id="newpassword" name="newpassword" type="password" class="form-control input-lg" placeholder="New Password" tabindex="2" required data-validation-required-message="Please enter valid passwords.">
            <div class="form-control-position"><i class="la la-key"></i></div>
            <div class="help-block font-small-3"></div>
            </fieldset>
                                  
            <div  style="border:0px;"> <h5>Comfirm Password</h></div>
            <fieldset class="form-group position-relative has-icon-left">
            <input id="confirmpassword" type="password" name="confirmpassword"  required class="form-control input-lg" placeholder="Comfirm Password" tabindex="2" required data-validation-required-message="Please enter valid passwords.">
            <div class="form-control-position"><i class="la la-key"></i></div>
            <div class="help-block font-small-3"></div>
            </fieldset>
               

<button type="submit" class="btn btn-primary btn-block btn-lg" name="update-password"><i class="ft-unlock"></i> Update Password</button>
</form>


<button onClick="window.history.back()" class="btn-sm" style=" display: absolute; float:right; margin: 5px auto"> back</button>
                    </div>
                    </div>

              </div>


            </div>
          </div>
        <!-- </section> -->
      </div>


  <!-- BEGIN VENDOR JS-->
  
  <!-- BEGIN VENDOR JS-->
  <!-- <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script> -->
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <!-- <script src="app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"
  type="text/javascript"></script> -->

  <!-- <script src="app-assets/data/jvector/visitor-data.js" type="text/javascript"></script> -->
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->

  <!-- <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script> -->
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <!-- <script src="app-assets/js/scripts/pages/dashboard-sales.js" type="text/javascript"></script> -->
  <!-- END PAGE LEVEL JS-->
  <!--scripts -->

