<nav style="background: #0044cc" class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow ">

    <div class="navbar-wrapper">
      <div class="navbar-header">
          <!-- <p style="background: green; height: 20px;"></p> -->
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item mr-auto">
            <a class="navbar-brand" href="#">
                 
              <h3 class="brand-text">URSTMS</h3>
            </a>
          </li>
          <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
          <i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
          <li class="nav-item d-md-none">
            <a  class="nav-link open-navbar-container text-white " data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i>  </a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">

        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"> 
              <a class="nav-link nav-link-expand text-white text-bold-700 display-1 " href="#">
              Logged In As: <span style=" font-size: 24px"> <?php echo $staff_details[0]['role_name']; ?> </span> </a></li>

          </ul>
          <ul style="margin-right: 0px"  class="nav navbar-nav mr-0 float-right">
            <li id="username-profile" class="dropdown dropdown-user nav-item">
              <a style="background: white;color: black; border-top-left-radius: 5px; border-bottom-left-radius: 5px;height: 100%; border-right: 1px solid #0044cc" class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">
                  <span style="font-family: Archivo Black;" class=" text-bold-900"><?php echo htmlentities(ucfirst($staff_details[0]['stf_fname']));?></span>
                </span>
                <span class="avatar avatar-online bg-white" >
                  <img src="../app-assets/images/user-hod.png" alt="avatar"><i></i>
                </span>
              </a>

              <div class="dropdown-menu dropdown-menu-right">

              <a class="dropdown-item" href="change-password.php">
                  <i class="ft-inbox"></i> My Rquests / Inbox</a>  
                  <a data-target="#update-staff-profile-modal" class=" btn dropdown-item view-request-details" href="javascript:void(0)" data-toggle="modal">
                  <i class="ft-user"></i> Edit Profile</a>
                
                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="../logout.php"> <i class="ft-power"></i> Logout</a>
              </div>
            </li>

            <li id="username-profile"  style="background: white;" class="dropdown dropdown-notification nav-item">
              <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>
                <span class="badge badge-pill badge-default badge-success badge-default badge-up badge-glow">
                  <?php 

                $request = new Request();
                $request_instance = $request->getAllRequestsByStaff($staf_id);
                $count = 0;
                if(!empty($request_instance)){

                  foreach($request_instance as $key => $value){
                    if($request_instance[$key]["hod_sansation"] !=0 AND $request_instance[$key]["hod_sansation_notification"] == 0){$count = $count + 1;}
                    if($request_instance[$key]["dean_sansation"] !=0 AND $request_instance[$key]["dean_sansation_notification"] == 0){$count = $count + 1;}
                    if($request_instance[$key]["principal_sansation"] !=0 AND $request_instance[$key]["principal_sansation_notification"] == 0){$count = $count + 1;}

                }
                  
                }
                echo $count;
                
                ?>


                </span>
              </a>
              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <h6 class="dropdown-header m-0">
                    <span class="grey darken-2">Notifications</span>
                  </h6>
                  <span class="notification-tag badge badge-default badge-danger float-right m-0"><?php echo htmlentities($count);?> New</span>
                </li>
                <li class="scrollable-container media-list w-100">
          

               <?php

                    if(!empty($request_instance)):
                      foreach($request_instance as $key => $value):
                        
                        if($request_instance[$key]["principal_sansation"] !=0 AND $request_instance[$key]["principal_sansation_notification"] == 0):
    
                 ?>

                  <a  data-target="#Request-view-details" class="view-request-details" data-toggle="modal" req-id="<?php echo htmlentities($request_instance[$key]["req_id"]) ?>"  href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                      <div class="media-body">
                      <h6 class="media-heading">
                        <?php echo $request_instance[$key]["principal_sansation"] == 1 ? 'Principal <b><span class="text-success"> approved </span> </b > your request' : 'Principal <b><span class ="text-danger" >disapproved your request</span></b> your request';?>
                     </h6>
                        <p class="notification-text font-small-3 text-muted">
                    <a data-target="#Request-view-details" req-id="<?php echo htmlentities($request_instance[$key]["req_id"]) ?>" href="javascript:void(0)" class="btn  m-0 view-request-details" data-toggle="modal"><?php echo htmlentities($request_instance[$key]["req_id"]);?></a></p>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00"><?php echo htmlentities($request_instance[$key]["principal_action_date"]);?></time>
                        </small>
                      </div>
                    </div>
                  </a>
         

                <?php

                endif;
                           
                ?>                
              
               <?php 
               if($request_instance[$key]["dean_sansation"] !=0 AND $request_instance[$key]["dean_sansation_notification"] == 0):
               ?>

                  <a  data-target="#Request-view-details" class="view-request-details" data-toggle="modal" req-id="<?php echo htmlentities($request_instance[$key]["req_id"]) ?>"  href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                      <div class="media-body">
                      <h6 class="media-heading">
                        <?php echo $request_instance[$key]["dean_sansation"] == 1 ? 'Dean <b><span class="text-success"> approved </span> </b > your request' : 'Dean <b><span class ="text-danger" >disapproved your request</span></b>';?>
                     </h6>
                        <p class="notification-text font-small-3 text-muted">
                    <a data-target="#Request-view-details" req-id="<?php echo htmlentities($request_instance[$key]["req_id"]) ?>" href="javascript:void(0)" class="btn  m-0 view-request-details" data-toggle="modal"><?php echo htmlentities($request_instance[$key]["req_id"]);?></a> <span> waiting next Approval </span></p>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00"><?php echo htmlentities($request_instance[$key]["dean_action_date"]);?></time>
                        </small>
                      </div>
                    </div>
                  </a>
         

                <?php
                endif;
                ?>




               <?php
               if($request_instance[$key]["hod_sansation"] !=0 AND $request_instance[$key]["hod_sansation_notification"] == 0):
                 ?>

                  <a  data-target="#Request-view-details" class="view-request-details" data-toggle="modal" req-id="<?php echo htmlentities($request_instance[$key]["req_id"]) ?>" href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                      <div class="media-body">
                      <h6 class="media-heading">
                        <?php echo $request_instance[$key]["hod_sansation"] == 1 ? 'Hod <b><span class="text-success"> approved </span> </b > your request' : 'Hod <b><span class ="text-danger" >disapproved your request</span></b> your request';?>
                     </h6>
                        <p class="notification-text font-small-3 text-muted">
                    <a data-target="#Request-view-details" req-id="<?php echo htmlentities($request_instance[$key]["req_id"]) ?>" href="javascript:void(0)" class="btn m-0 view-request-details" data-toggle="modal" > <?php echo htmlentities($request_instance[$key]["req_id"]);?></a> <span> waiting next Approval </span></p>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00"><?php echo htmlentities($request_instance[$key]["hod_action_date"]);?></time>
                        </small>
                      </div>
                    </div>
                  </a>
         

                <?php

                endif;
                ?>







             <?php
                endforeach;
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