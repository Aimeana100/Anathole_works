<?php
 session_start();
//Database Configuration File

// error_reporting(0);

//  include ('handle_login.php');

 include('Classes/DBController.php');
 include('Classes/Staff_class.php');


  $wrongemail = "";
  $wrongpassword = "";


 
  if(isset($_POST['login']))
  {
    $uname =$_POST['username'];
    $upassword=$_POST['password'];
    $fetchedUserData = array();
    
    $staff = new Staff();
    $fetchedUserData = $staff->getUserData($uname);
    
    if(!empty($fetchedUserData)){
    $fetchedUserData = $staff->getUserDataByCreditials($uname,$upassword);
        
    if(!empty($fetchedUserData)){
      if($staff->VerfyPassword($uname, $upassword)){
        $_SESSION['stf_id'] = $fetchedUserData[0]['stf_id'];
        $_SESSION['userlogin'] = isset($fetchedUserData[0]['username']) ? $fetchedUserData[0]['username'] : $fetchedUserData[0]['stf_email'];
        $user_role = $fetchedUserData[0]['role_id'];

        switch ($user_role) {
          case '7':
            $departement_id = $fetchedUserData[0]['dept_id'];
             $_SESSION['dept_id'] = $departement_id;
             $_SESSION['role'] = $user_role;
             header('Location: head-of-departement/index.php');
          break;
          
          case '6':
            $_SESSION['dean_id'] = $fetchedUserData[0]['stf_id'];
            $_SESSION['dept_id'] = $fetchedUserData[0]['scl_id'];
            header('Location: dean-of-school/index.php');
          break;
          case '3':
            $_SESSION['dept_id'] = $fetchedUserData[0]['coll_id'];
            header('Location: super-admins.php');
          break;
      
          
          default:
          $_SESSION['stfId'] = $fetchedUserData[0]['stf_id'];
          $_SESSION['role'] = $user_role;
          header('Location: staff/index.php');
          break;
        }
        
        

      }
      else{
        $wrongpassword="You entered wrong password.";
      }

    }
    
  }
  else{
    $wrongemail = "User not registered with us."; 
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
 
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <div class="text-black card-title text-center">
                 Form Staff Login
                  </div>
                  <h6 class="card-subtitle line-on-side text-black text-center font-small-3 pt-2">
                    <span>Enter your details</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
 <?php if($wrongpassword):?>                   
<div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
<span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<strong>Oh  </strong> <?php echo htmlentities($wrongpassword); ?>
  </div>
<?php endif;?>

 <?php if($wrongemail):?>                   
<div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
<span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<strong>Oh ! </strong> <?php echo htmlentities($wrongemail); ?>
  </div>
  
<?php endif;?>



<form class="form-horizontal" method="post">
                      

<fieldset class="form-group position-relative has-icon-left">
<input value="<?php echo isset($_GET['username']) ? $_GET['username'] : null ?>" type="text" class="form-control input-lg" id="username" name="username" placeholder="Your Username" tabindex="1" required data-validation-required-message="Please enter your username.">
<div class="form-control-position"><i class="ft-user"></i>
</div>
<div class="help-block font-small-3"></div>
</fieldset>
                      

<fieldset class="form-group position-relative has-icon-left">
<input type="password" class="form-control input-lg" id="password" name="password" placeholder="Enter Password" tabindex="2" required data-validation-required-message="Please enter valid passwords.">
<div class="form-control-position"><i class="la la-key"></i></div>
<div class="help-block font-small-3"></div>
 </fieldset>
                      


                      

<button type="submit" class="btn btn-primary btn-block btn-lg" name="login"><i class="ft-unlock"></i> Login</button>
</form>
<<<<<<< HEAD
<div class="text-center mt-1" ><a href="./forgot-password.php">Forgot password/ request new</div>
                  
=======
    <br>
    <div class="text-center">
      <a href="password_forgot.php" > I forgot my password</a> <i class="ft-lock"></i>

    </div>
      

>>>>>>> 56ab0e79cbee2be36472b6133527736b4981e7d7
</div>
</div>

              </div>
            </div>
          </div>
        </section>
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