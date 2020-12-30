<?php
// request progress 1: not yet seen, 2: approved or not approve 3: in excution 4:excutted, 5:reported completed. 

session_start();
// error_reporting(0);
include('../Classes/DBController.php');
include('../Classes/Staff_class.php');
include('../Classes/Requests_class.php');
include('../Classes/Notification_class.php');
include('../Classes/Organisation_class.php');
include('../Classes/Report_class.php');

$stf_role = 3;
// $_SESSION['role'];
$staf_id = 2;
// $_SESSION['stf_id'];
$college_id = 1;

// check authentication
$organisation = new Organisation();

// instantiate request

$request = new Request();
$request_instance = $request->getAllRequestsByStaff($staf_id);
$college_requests = $request->getAllRequestsByCollege($college_id);
// getting data to pre-fill the form
$staff = new Staff();
$staff_details = $staff->getStaffById($staf_id);
// $staff_hod_details = $staff->getStaff_HODbyDept($staff_details[0]['dept_id']);
// $staff_dean_details = $staff->getStaff_DeanbySchool($staff_details[0]['scl_id']);
// $staff_principal_details = $staff->getStaff_Principalbycollege($staff_details[0]['coll_id']);
$staff_HR_details = $staff->getStaff_HRbycollege($staff_details[0]['coll_id']);

$All_college_staffs = $staff->getAllStaff_in_college($college_id);

//  echo json_encode(array("staff_id" =>$staff_details[0]["stf_id"], "depertement" => $staff_details[0]["dept_id"], "college_id" => $staff_details[0]['coll_id'])  );
$_SESSION['userlogin'] = isset($staff_details[0]['username']) ? $staff_details[0]['username'] : $staff_details[0]['stf_email'];
 ?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>URSTMS-Staff</title>
  <style type="text/css">



.preLoader{
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
}

div.row-flex-container{
     display: flex;
     margin: 10px 0px;
     flex-direction: row;
     font-size: 100%;   
    }

   .colomn-flex-left{
     flex: 0 0 165px;

   }
   .colomn-flex-right{
     place-items: start;
     display: flex;
     flex: 1;
     flex-wrap: nowrap;
     /* justify-content: space-around; */
    
   }
    .colomn-flex-middle{
     display: flex;
     min-width: 30%;
     place-items: start;
     flex-wrap: nowrap;
     justify-content: space-around;
    }
   
   div.row-flex-container.has-long-label .colomn-flex-left{
    flex: 0 1 200px;
    

   }
   .colomn-flex-right label{
     margin: 1em 1em;     
   }
   .row-flex-container{
    /* float: right; */
     
   }
   .column-flex-container{
    
    margin-right: 10px auto;
    display: flex; 
    flex-direction: column;
     
   }


   


  </style>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

  <!-- from jewerly -->
  <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">

  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <!-- <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/morris.css"> -->
  <link rel="stylesheet" type="text/css" href="../app-assets/fonts/simple-line-icons/style.css">

  <!-- <link rel="stylesheet" type="text/css" href="../includes/regform-36/css/add-new-staff.css"> -->
 <link rel="stylesheet" type="text/css" href="../app-assets/css/new-customized.css"> 


<script src="../app-assets/js/scripts/html2canvas.js" type="text/javascript"></script>

 <!-- from jewery temperate -->
 <!-- boot table -->
 <link rel="stylesheet" type="text/css" href="css/data-table/bootstrap-table.css">
<!-- css -->
<link rel="stylesheet" type="text/css" href="css/style.css">

<link rel="stylesheet" href="css/font-awesome.min.css">


<!-- forms -->
    <!-- modals CSS
		============================================ -->
    <!-- <link rel="stylesheet" href="css/modals.css"> -->
    <!-- forms CSS
		============================================ -->
    <!-- <link rel="stylesheet" href="css/form/all-type-forms.css"> -->


<!-- forms -->
    <!-- modals CSS
		============================================ -->
    <!-- <link rel="stylesheet" href="css/modals.css"> -->
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">

    <!-- for select chosen -->
    <link rel="stylesheet" href="css/chosen/bootstrap-chosen.css">

    <!-- date picker -->
    <link rel="stylesheet" href="css/datapicker/datepicker3.css">

     <!-- from jewery temperate -->
 <!-- boot table -->
  <link rel="stylesheet" type="text/css" href="css/data-table/bootstrap-table.css">
  <!-- css -->
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <link rel="stylesheet" href="css/font-awesome.min.css">



<!-- notifications -->

   <!-- notifications CSS
		============================================ -->
    <link rel="stylesheet" href="css/notifications/Lobibox.min.css">
    <link rel="stylesheet" href="css/notifications/notifications.css">
   



</head>

<body style="color: #000000" class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">



  <!-- fixed-top-->
   <?php include_once('principal-componets/principal_header.php'); ?>
 <!-- always at left -->
   <?php require_once('principal-componets/principal-left-bar.php');?>



  <div class="app-content content">
    <div sty class="content-wrapper">
    <div class="content-body">

        <!-- Revenue, Hit Rate & Deals -->
        <!-- all requests -->
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-sm-3  ">
            <div class="card pull-up">
              <div class="card-content">
                   <a href="hod-disapprove.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-center">
                <?php 
                $Pending_requests = [];
                $Pending_requests_number = 0;
               if ($college_requests != null) {
                   foreach ($college_requests as $key => $value) {
                       if ($college_requests[$key]["principal_sansation"] == 0) {
                           $Pending_requests[] = $college_requests;
                       }
                   }
                $Pending_requests_number =  count($Pending_requests);

               }


                
                ?>
                    <h2 class="success"><b><?php echo htmlentities($Pending_requests_number);?></b></h2>
                      <h4><b>Pending</b></h4>
                    </div>
                    <div>
                 <i class="icon-book-open info font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-secondary" role="progressbar" style="width: 100%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="90"></div>
                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>

     <!-- Approved --->
    
          <div class="col-xl-3 col-lg-3 col-sm-3  ">
            <div class="card pull-up">
              <div class="card-content">
                <a href="hod-approved.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-center">
                    <?php 

                        $Approved_requests = [];
                        $Approved_requests_number = 0;
                        if ($college_requests != null) {
                        foreach ($college_requests as $key => $value) {
                            if ($college_requests[$key]["principal_sansation"] == 1) {
                                $Approved_requests[] = $college_requests;
                            }
                        }
                        $Approved_requests_number =  count($Approved_requests);
                        
                        }
                    ?>
                   <h2 class="success approved-number"> <b> <?php echo htmlentities($Approved_requests_number);?> </b></h2>
                      <h4><b>Approved</b></h4>
                    </div>
                    <div>
                  <i class="icon-notebook info font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar sm-gradient-x-secondary" role="progressbar" style="width: 100%"
                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                </a>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-3 col-sm-3  ">
            <div class="card pull-up">
              <div class="card-content">
                 <a>
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-center">
                    <?php 

                        $Disapproved_requests = [];
                        $Disapproved_requests_number = 0;
                        if ($college_requests != null) {
                        foreach ($college_requests as $key => $value) {
                            if ($college_requests[$key]["principal_sansation"] == 2) {
                                $Disapproved_requests[] = $college_requests;
                            }
                        }
                        $Disapproved_requests_number =  count($Disapproved_requests);

                        }
                    ?>

                    <h2 class="success"><b><?php echo htmlentities($Disapproved_requests_number );?> </b></h2>
                      <h4><b>Disapproved</b></h4>
                    </div>
                    <div>
                      <i class="icon-user-follow info font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-secondary" role="progressbar" style="width: 100%"
                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>



          <div title="in excutin at host places" class="col-xl-3 col-lg-3 col-sm-3  ">
            <div class="card pull-up">
              <div class="card-content">
                 <a .php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-center">
                <?php 
                

                $InExcution_requests = [];
                $InExcution_requests_number = 0;
                if ($college_requests != null) {
                foreach ($college_requests as $key => $value) {
                    if ($college_requests[$key]["progress"] == 3) {
                        $InExcution_requests[] = $college_requests;
                    }
                }
                $InExcution_requests_number =  count($InExcution_requests);

                }
                ?>

           <h2 class="success"> <b><?php echo htmlentities($InExcution_requests_number);?></b></h2>
                      <h4><b>In Excution</b></h4>
                    </div>
                    <div>
                      <i class="icon-direction info font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-secondary" role="progressbar" style="width: 100%"
                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>
                    
          </div>

          <?php if (isset($_GET['option']) AND $_GET['option'] == "change-password"):  
        include_once('../change-password.php');
        

        else:
          ?>
       <div class="content-body">
           <!-- table start -->

       <div class="data-table-area mg-tb-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1 class="">ALL <span class="table-project-n">REQUESTS</span> Records </h1>
                                </div>

                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar">
                                        <select class="form-control">
                                        <option value="">Export Basic</option>
                                        <option value="all">Export All</option>
                                        <option value="selected">Export Selected</option>
                                      </select>

                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>

                                            <tr>
                                            <th data-field="state" data-checkbox="true"></th>
                                            <!-- <th data-field="counts" >#</th> -->
                                            <th data-field="request_id" >req ID</th>
                                            <th data-field="firstName" >First name</th>
                                            <!-- <th data-field="lastName" >Last name</th> -->
                                            <th data-field="position" >Position</th>
                                            <th data-field="departure" >Deperture</th>
                                            <th data-field="return" >Prev. Action</th>
                                            <th data-field="status" >Status</th>
                                            <th data-field="action"  class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty($college_requests)):
                                          $cont_rows=1;
                                          foreach($college_requests as $key => $value):
                                            ?>
                                            <tr>
                                            <td></td>
                                        <!-- <td><?php// echo htmlentities($cont_rows);?></td> -->
                                        <td><?php echo htmlentities($college_requests[$key]["req_id"]);?></td>                
                                        <td><?php echo htmlentities($college_requests[$key]["stf_fname"]);?></td>
                                        <!-- <td><?php// echo htmlentities($college_requests[$key]["stf_lname"]);?></td> -->
                                        <td><?php echo htmlentities($college_requests[$key]["role_name"]);?></td>
                                        <td><?php echo htmlentities($college_requests[$key]["req_departure"]);?></td>
                                        <td>
                                        <?php if($college_requests[$key]['role_id'] != 6): 
                                          if($college_requests[$key]['Dean_id'] == null ){ echo '<span title="This Request hasn\'t reacted from previous level (departement)"=>Not reacted</span>';}
                                          else{
                                            if($college_requests[$key]['dean_sansation'] == 1){ echo '<span class="">approved</span>'; }
                                            if($college_requests[$key]['dean_sansation'] == 2){ echo '<span class="">disapproved</span>'; }
                                          }
                                        endif; ?>
                                        </td>
                                        <td>
                                        <?php 
                                        if($college_requests[$key]["principal_sansation"] == 2){echo '<span class="bg-warning">Disapproved</span>';}

                                        if($college_requests[$key]["principal_sansation"] == 1){echo '<span class="bg-success">Approved</span>';}
                                        ?>

                                        <?php  if($college_requests[$key]["principal_id"] == NULL) : ?> 
                                        <input data-target="#action-on-request" req-id="<?php echo htmlentities($college_requests[$key]["req_id"]); ?>" style="margin: 0px ;padding: 8px;" type="button"   class="btn-disabled btn-sm border-0 btn-primary do-action-button <?php echo $college_requests[$key]['dean_sansation'] == 1 ? 'disabled' : '';?>" value="Do Action" data-toggle="modal"/>
                                        <?php endif; ?>
                                        </td>

                                    <td >
                                    <input data-target="#Request-view-details" req-id="<?php echo htmlentities($college_requests[$key]["req_id"]) ?>" style="margin: 0px ;padding: 3px;" type="button" class="btn btn-info btn-glow principal-view-staff-request-details" value="View" data-toggle="modal" > 

                                  </td>
                                            </tr>
                                          <?php  endforeach; endif;?>
                                           
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!-- table end -->
     
        <!-- <div class="row">
  

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="sparkline11-list responsive-mg-b-30">
                            <div class="sparkline11-hd">
                                <div class="main-sparkline11-hd">
                                    <h1>Modal Login <span class="basic-ds-n">Form</span></h1>
                                </div>
                            </div>
                            <div class="sparkline11-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="modal-bootstrap modal-login-form">
                                                <a class="zoomInDown mg-t" href="#" data-toggle="modal" data-target="#admin-add-staff">Modal Login Form</a>
                                            </div>
                                            <div id="admin-add-staff" class="modal modal-adminpro-general modal-zoomInDown fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-close-area modal-close-df">
                                                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="modal-login-form-inner">
                                                            <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="notification-list shadow-reset nt-mg-b-30">
                            <div class="alert-title">
                                <h2>Notifications Sticky (without delay)</h2>
                                <p>Notifications Sticky (without delay) Can be closed by clicking on it.</p>
                            </div>
                            <div class="notification-bt responsive-btn">
                                <button id="basicDefaultNoDelay" class="btn btn-default">Default</button>
                                <button id="basicInfoNoDelay" class="btn btn-info">Info</button>
                                <button id="basicWarningNoDelay" class="btn btn-warning">Warning</button>
                                <button id="basicErrorNoDelay" class="btn btn-danger">Error</button>
                                <button id="basicSuccessNoDelay" class="btn btn-success">Success</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="notification-list shadow-reset nt-mg-b-30">
                            <div class="alert-title">
                                <h2>Notifications Alternative position</h2>
                                <p>Notifications Alternative position Can be closed by clicking on it.</p>
                            </div>
                            <div class="notification-bt responsive-btn">
                                <button id="basicInfoPosition" class="btn btn-info">Info</button>
                                <button id="basicWarningPosition" class="btn btn-warning">Warning</button>
                                <button id="basicErrorPosition" class="btn btn-danger">Error</button>
                                <button id="basicSuccessPosition" class="btn btn-success">Success</button>
                            </div>
                        </div>
                    </div>
                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="login-social-inner">
                                                                            <a href="#" class="button btn-social facebook span-left"> <span><i class="fa fa-facebook"></i></span> Facebook </a>
                                                                            <a href="#" class="button btn-social twitter span-left"> <span><i class="fa fa-twitter"></i></span> Twitter </a>
                                                                            <a href="#" class="button btn-social googleplus span-left"> <span><i class="fa fa-google-plus"></i></span> Google+ </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="basic-login-inner modal-basic-inner">
                                                                            <h3>Sign In</h3>
                                                                            <p>Register User can get sign in from here</p>
                                                                            <form action="#">
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2">Email</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <input type="email" class="form-control" placeholder="Enter Email" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2">Password</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <input type="password" class="form-control" placeholder="password" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="login-btn-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <label>
                                                                                          <input type="checkbox" class="i-checks"> Remember me </label>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <div class="login-horizental">
                                                                                                <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Sign In</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                </div>-->


        </div>
        </div>
        </div>
  





    <!-- request details preview start -->

       <div  style="" id="Request-view-details" class="container-fluid modal modal-adminpro-general fullwidth-popup-InformationproModal fadeIn " role="dialog">
       <div class="modal-dialog modal-lg " role="document" >
          <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>REQUEST DETAILS</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div style="margin: 0px; padding: 0px;" class="modal-body" id="request_detail">

             </div>
            </div>
          </div>
      </div>




<!-- request form modal start -->



<div class="modal fade bd-example-modal-lg" id="request-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>REQUEST FORM</b></h5>
        <button typls -a
        e="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <?php include_once("request-form.php"); ?>  
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- act on request by Dean-> form modal start -->

<div  style="z-index:9999" class="modal bd-example-modal-lg1 dean-do-action-on-request" id="action-on-request" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title center" id="exampleModalLongTitle"><b> React to this request </b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="action-on-request-form">

     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




</div>

<!-- pre-loader for waiting  -->

<div id="wait" style="z-index:100;display:none;width:80px;height:80px;border:none;position:fixed;top:45%;left:45%; background-color: #3f6ff0;"><img class="preLoader" src='ajax-loader.gif' width="80" height="80" /><br>wait..</div>

<!-- End of Report Form -->       
<?php include('../includes/footer.php');?>

  <!-- BEGIN VENDOR JS-->
  <script src="../app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <!-- <script src="../app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script> -->
  <!-- <script src="../app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script> -->
  <!-- <script src="../app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script> -->
  <!-- <script src="../app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script> -->
  <!-- <script src="../app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js" -->
  <!-- type="text/javascript"></script> -->

  <!-- BEGIN MODERN JS-->


  <script src="../app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="../app-assets/js/core/app.js" type="text/javascript"></script>
  <!-- defined -->
  <script src="../app-assets/js/customJs.js" type="text/javascript"></script>
  
  <!-- END MODERN JS-->

  <!-- js bootstrap table from jwrly template -->
  <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <!-- <script src="js/data-table/bootstrap-table-editable.js"></script> -->
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>



            <!-- datapicker JS
		============================================ -->
    <script src="js/datapicker/bootstrap-datepicker.js"></script>
    <script src="js/datapicker/datepicker-active.js"></script>
    <!-- input-mask JS
		============================================ -->
    <script src="js/input-mask/jasny-bootstrap.min.js"></script>
    <!-- chosen JS
		============================================ -->
    <script src="js/chosen/chosen.jquery.js"></script>
    <script src="js/chosen/chosen-active.js"></script>    
    <!-- notification JS
		============================================ -->
    <script src="js/notifications/Lobibox.js"></script>
    <script src="js/notifications/notification-active.js"></script>

    

 <script>
     

// dean view the single staff request

$('#table').on('click', '.principal-view-staff-request-details', function(){
           var reqId = $(this).attr("req-id");
           var staf_id = <?php echo $staf_id; ?>;        
           console.log(staf_id +" " +reqId);
                  
                $.ajax({  
                url:"../scripts/staff-request-details.php", 
                method:"post",  
                data:{req_id:reqId, staf_id:staf_id},
                success:function(data){
                  $('#request_detail').html(data);
                  let takeActionOnRequest = '<a style="margin: 0px ;padding: 3px;" reqId="'+reqId+'" tabindex="0" data-toggle="popover"  class="btn btn-primary view-give-sansation" role="button" data-trigger="click">Do Reaction</a>';     

                  $.ajax(
                    {
                      url: '../scripts/track-my-request.php',
                      method:"POST",
                      data: {req_id:reqId},
                      success:function(response)
                      {
                        let data_formulated = JSON.parse(response);
                        console.log(data_formulated);
                        if(data_formulated.principal_reacted) //check if principal has received the request
                        {
                          if(data_formulated.all_about_request.principal_reacted = 1)
                          {
                            $('#hold-viwer-action').html('<div class="alert alert-success mb-2" role="alert"> you have <strong>Approved </strong>this request</div></>');
                          }
                          else
                          {
                            $('#hold-viwer-action').html('<div class="alert alert-success mb-2" role="alert"> you have <strong>Disapproved </strong>this request</div></>');
                          }
                        }
                        else
                        {
                          
                          // $('#hold-viwer-action').html(takeActionOnRequest);

                        }
                      // $('#dataModal').modal("show");
                 }  
           }); 

          } 
           });  

});

// priincipal reaction on request

$('#table').on('click', '.do-action-button', function(){
           var reqId = $(this).attr("req-id");
           var staf_id = <?php echo $staf_id; ?>;        
          //  console.log(staf_id +" " +reqId);
                  
                $.ajax({
                url:"../scripts/track-my-request.php", 
                method:"POST",  
                data:{req_id:reqId},
                success:function(data){
                   let data_formulated = JSON.parse(data);
                  //  console.log(data_formulated);
                  // console.log(data_formulated.all_about_request.dean_sansation);

                  if(!data_formulated.principal_reacted){
                  let form_dean_sansation = '<form name="remark" method="post"><div style="text-align: center;"><select id="principal_sansation" name="principal_sansation" style="color:black; display:inline-block; max-width: 200px;" class="form-control" name="status" required> <option value="">Choose your option</option> <option value="1">Approved</option> <option value="2">Not Approved</option> </select></div> <input type="hidden" id="Req-Dean-Ids" class="Req-Dean-Ids" name="Req-Dean-Ids" req_id="'+reqId+'" principal_id="'+staf_id+' "> <textarea  placeholder="leave the comment here" id="action_comment" class="form-control m-t-2" name="action_comment" rows="5" required></textarea> <div class="text-center"> <button onclick="Principal_Do_direct_ActionOnRequest()" type="button" class="btn pt-0 mt-1 btn-blue m-b-xs Do_direct_ActionOnRequest" name="submitAction" value="Send sansation">Send sansation</button> </div></form>';
                  $('#action-on-request-form').html(form_dean_sansation);  
                  
                  }
                  else  
                  {
                    let message = '<h4 class="bg-success" > This Request '+data_formulated.all_about_request.principal_sansation == 1 || data_formulated.all_about_request.principal_sansation == true? " Approved " : " Disapproved" +'</h4>'
                  $('#action-on-request-form').html(message);

                  }
                    
                 }  
           });  

});



   // take action on request. for direct action in table 

   function Principal_Do_direct_ActionOnRequest(){
    errors_array = [];
    var principal_id = $('#Req-Dean-Ids').attr("principal_id");
    var req_id = $('#Req-Dean-Ids').attr("req_id");
    var principal_comment=$('#action_comment').val();
    var principal_sansation=$('#principal_sansation').children(":selected").attr("value");

    if(principal_comment == null || principal_comment == ""){
      errors_array.push("comment field can't be empty");
    }
    if(principal_sansation == null || principal_sansation == "")
    {
      errors_array.push("choose to approve or not");
    }    
    if(errors_array.length != 0){

      Lobibox.notify('warning',{
      sound: false,
      width: 400,
      position: 'top right',
      msg: errors_array
  });
    }
    else{
    $.post("action-on-request/principal-action-on-request.php",{req_id: req_id,principal_comment: principal_comment, principal_sansation: principal_sansation, principal_id:principal_id},
    function(data) {
      console.log(data);
      let actionFedback = JSON.parse(data);
      console.log(actionFedback);
      if(actionFedback)
      {
        Lobibox.notify('success',{
        sound: false,
        width: 400,
        position: 'top right',
        msg: 'Thank you sansation sent/ we will Notify a requestor'
  });

      }
      else{
        Lobibox.notify('error',{
        sound: false,
        width: 400,
        position: 'top right',
        msg: 'Thank you sansation not set / server error'
       });
      }

    });
    }
    }



 </script>


</body>
</html>
<!-- <?php// endif;?>  -->