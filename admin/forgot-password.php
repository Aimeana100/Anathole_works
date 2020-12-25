<?php
 session_start();
//Database Configuration File

// error_reporting(0);

//  include ('handle_login.php');

 include('Classes/DBController.php');
 include('Classes/Staff_class.php');
 include('Classes/Login/Functions.php');
 include('../mailer.php');

  $wrongemail = "";
  $password_reset = "";
 
  if(isset($_POST['reset']))
  {
    $email =$_POST['username'];
    $fetchedUserData = array();    
    $staff = new Staff();
    $fetchedUserData = $staff->getUserData($email);
    
    if(!empty($fetchedUserData)){
        $functions = new Functions();
        $new_pass = $functions->createString(10);
        $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);

            $first_name = $fetchedUserData[0]['stf_fname'];
			$subject = "URSTMS Password reset";
			$pmsg ="<strong> ".$first_name."</strong> Your creditials to USTMS are: <br> USERNAME: ".$email." <br>PASSWORD: "."<b>".$new_pass."</b><br> use them to <a href='http://localhost/PR/urstms/ContactForm/pro_urstms/admin/index.php?username=".$email."'>login</a> to URSMS and we advised you to change them within your account";
            $send_email = send_email($email,$pmsg,$first_name,$subject);
            
            if($send_email)
            {
                $changePass = $staff->resetPassword($email, $hashed_pass);
                if($changePass)
                {
                  $password_reset = "Reset successfully visit email to continue";
                }
                else{
                  $wrongemail = $changePass;
                }
            }
    }
    else
    {
        $wrongemail = "Email doesnn't match any user";
    }

    
  }    

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>URSTMS Staff Login
  </title>
  
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/icheck.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/custom.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/pages/login-register.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body  style=" background: #6A5ACD;" class="vertical-layout vertical-menu-modern 1-column bg-lighten-2 menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
 
      <div class="content-body h-100 row row">
        <!-- <section class="flexbox-container"> -->
          <div class="col-12 h-80 d-flex align-items-center justify-content-center">
            <div class="col-md-8 col-sm-12 col-xs-12 col-lg-4 box-shadow100">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <div class="text-black card-title text-center">
                 Form Staff Reset Password
                  </div>
                  <h6 class="card-subtitle line-on-side text-black text-center font-small-3 pt-2">
                    <span>Leave Your Email here</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">

 <?php if($wrongemail):?>                   
<div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
<span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<strong>Oh ! </strong> <?php echo htmlentities($wrongemail); ?>
  </div>
<?php endif;?>

<?php if($password_reset): ?>
<div class="alert bg-success alert-icon-left alert-dismissible mb-2" role="alert">
<span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<strong>Oh ! </strong> <?php echo htmlentities($password_reset); ?>
  </div>
  <script></script>
<?php endif;?>


<form class="form-horizontal" method="post">                      

<fieldset class="form-group position-relative has-icon-left">
<input type="text" class="form-control input-lg" id="username" name="username" placeholder="Your Email" tabindex="1" required data-validation-required-message="Please enter your email.">
<div class="form-control-position"><i class="ft-user"></i>
</div>
<div class="help-block font-small-3"></div>
</fieldset>              

<button type="submit" class="btn btn-primary btn-block btn-lg" name="reset"><i class="ft-lock"></i> Reset</button>
</form>
                  
</div>
</div>

              </div>
            </div>
          </div>
        <!-- </section> -->
      </div>


  <!-- BEGIN VENDOR JS-->
  <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="app-assets/js/scripts/forms/form-login-register.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS -->

  
</body>
</html>