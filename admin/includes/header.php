
<nav style="background: #0044cc" class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow ">

    <div class="navbar-wrapper">
      <div class="navbar-header">
          <!-- <p style="background: green; height: 20px;"></p> -->
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item mr-auto">
            <a class="navbar-brand" href="dashboard.php">
                 
              <h3 class="brand-text">URSTMS</h3>
            </a>
          </li>
          <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
          <li class="nav-item d-md-none">
            <a  class="nav-link open-navbar-container text-white " data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">

        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block">
              <a class="nav-link nav-link-expand text-white " href="#">
              <i class="ficon ft-maximize"></i></a></li>

           
          </ul>
          <ul style="margin-right: 0px"  class="nav navbar-nav mr-0 float-right">
            <li id="username-profile" class="dropdown dropdown-user nav-item">
              <a style="background: white;color: black; border-top-left-radius: 5px; border-bottom-left-radius: 5px;height: 100%; border-right: 1px solid #0044cc" class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">
                <span style="font-family: Archivo Black;" class=" text-bold-900">
                    <?php echo htmlentities(ucfirst($_SESSION['userlogin']));?>
                  </span>
                </span>
                <span class="avatar avatar-online bg-white" >
                  <img src="app-assets/images/user-hod.png" alt="avatar"><i></i>
                </span>
              </a>

              <div class="dropdown-menu dropdown-menu-right">
               
                  <a class="dropdown-item" href="change-password.php">
                  <i class="ft-inbox"></i> My Rquests / Inbox</a>               
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="change-password.php">
                  <i class="ft-user"></i> Edit Profile</a>
                
                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="logout.php">
                  <i class="ft-power"></i> Logout</a>
              </div>
            </li>

            <li id="username-profile"  style="background: white;" class="dropdown dropdown-notification nav-item">
              <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>
                <span class="badge badge-pill badge-default badge-success badge-default badge-up badge-glow">
                  <?php 
     
    $number_of_request_to_display = Array();
    foreach($request_dept_instance  as $key => $value){
      if($request_dept_instance[$key]["req_status"] = 1 ){
        $number_of_request_to_display = $request_dept_instance;
      }
    }

    echo  count($number_of_request_to_display);
   

      ?>
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
            <li class="dropdown-menu-header">
              <h6 class="dropdown-header m-0">
                <span class="grey darken-2">Notifications</span>
              </h6>
              <span class="notification-tag badge badge-default badge-danger float-right m-0"><?php echo htmlentities(count($number_of_request_to_display));?> New</span>
            </li>
            <li class="scrollable-container media-list w-100">
<?php 
      if(!empty($number_of_request_to_display)):
    foreach($number_of_request_to_display as $key => $value):
    
?>

                  <a href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                      <div class="media-body">
                        <h6 class="media-heading">new pending request</h6>

                        <p class="notification-text font-small-3 text-muted">
                          
      <a href="contact-details.php?cid=<?php  
      echo htmlentities($number_of_request_to_display[0]["req_id"]);?>">
        <span> Req Id :</span>
        <?php echo htmlentities($number_of_request_to_display[$key]["req_id"]);?></a> 
      <span> by </span>
       <a href="contact-details.php?cid=<?php echo htmlentities($number_of_request_to_display[$key]["req_id"]);?>">
        <?php echo htmlentities($number_of_request_to_display[$key]["stf_fname"]." ".$number_of_request_to_display[$key]["stf_lname"]);?></a> </p>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00"><?php echo htmlentities($number_of_request_to_display[$key]["req_action_date"]);?></time>
                        </small>
                      </div>
                    </div>
                  </a>
         
      <?php
                  
endforeach;
else:
 ?>

                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i></div>
                      <div class="media-body">
                        <h6 class="media-heading yellow darken-3">No Notification</h6>
                    
                        
                      </div>
                    </div>

                <?php  

         endif;
               ?>
              
                </li>
           
              </ul>
            </li>
     
          </ul>
        </div>
      </div>
    </div>
  </nav>