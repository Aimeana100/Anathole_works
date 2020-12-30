<?php
session_start();
// error_reporting(0);



include('../Classes/DBController.php');
include('../Classes/Staff_class.php');
include('../Classes/Requests_class.php');
include('../Classes/Notification_class.php');
include('../Classes/Organisation_class.php');
include('../Classes/Report_class.php');
include('../Classes/Login/Sessions_class.php');
include('../Classes/Login/Functions.php');

$session_instance = new Sessions();
$loginFunctions = new Functions();


  // if(((strlen($_SESSION['userlogin'])==0) OR (!isset($_SESSION['stf_id']) ) OR  (strlen($_SESSION['stf_id'])==0))):
  if(!$loginFunctions->checkLoginState($session_instance)):
    

  header('location:../index.php');

  else:
    // $_SESSION['userlogin'] = $_SESSION['user_username'];
    $stf_role = $_SESSION['role_id'];
    // $staf_id = 4;
    $staf_id = $_SESSION['user_id'];

    $staff = new Staff();
    $staff_details = $staff->getStaffById($_SESSION['user_id']);
    if($staff_details[0]['role_id'] != 3):

  header('location:../index.php');
  exit();
    else: 



// $stf_role = 3;
// $_SESSION['role'];

// $_SESSION['stf_id'];

// $college_id = 1;

// check authentication
$organisation = new Organisation();

// instantiate request
$request = new Request();
$request_instance = $request->getAllRequestsByStaff($staf_id);
// getting data to pre-fill the form
$staff = new Staff();
$staff_details = $staff->getStaffById($staf_id);
// $staff_hod_details = $staff->getStaff_HODbyDept($staff_details[0]['dept_id']);
// $staff_dean_details = $staff->getStaff_DeanbySchool($staff_details[0]['scl_id']);
// $staff_principal_details = $staff->getStaff_Principalbycollege($staff_details[0]['coll_id']);
$staff_HR_details = $staff->getStaff_HRbycollege($staff_details[0]['coll_id']);
$All_college_staffs = $staff->getAllStaff_in_college($staff_details[0]['coll_id']);

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


<script src="app-assets/js/scripts/html2canvas.js" type="text/javascript"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script> -->

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
    <link rel="stylesheet" href="css/form/all-type-forms.css">

    <!-- for select chosen -->
    <link rel="stylesheet" href="css/chosen/bootstrap-chosen.css">

    <!-- date picker -->
    <link rel="stylesheet" href="css/datapicker/datepicker3.css">

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
                            <div class="sparkline13-hd row">
                                <div class="main-sparkline13-hd co-6">
                                    <h1>ALL <span class="table-project-n">COLLEGES STAFFS</span> /<?php echo $staff_details[0]['coll_name']; ?></h1>
                                </div>
                                <div class="main-sparkline13-hd col-6 text-right ">
                                    <button class="btn-md m-b-r-0 b-0 add-staff float-right">
                                    <a class="zoomInDown mg-t secondary p-2" href="#" data-toggle="modal" data-target="#admin-add-staff">Add Staff</a>
                                    </button>
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
                                                <th data-field="id">S_ID</th>
                                                <th data-field="first-name" data-editable="true">First name</th>
                                                <th data-field="last-name" data-editable="true">Last name</th>
                                                <th data-field="position" data-editable="true">Position</th>
                                                <th data-field="departement" data-editable="true">Departement</th>
                                                <th data-field="Status" data-editable="true">Status</th>
                                                <th data-field="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty($All_college_staffs)):
                                          $cont_rows=1;
                                          foreach($All_college_staffs as $key => $value):
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $All_college_staffs[$key]["stf_id"]; ?></td>
                                                <td><?php echo $All_college_staffs[$key]["stf_fname"]; ?></td>
                                                <td><?php echo $All_college_staffs[$key]["stf_lname"]; ?></td>
                                                <td><?php echo $All_college_staffs[$key]["role_name"]; ?></td>
                                                <td><?php echo $All_college_staffs[$key]["dept_name"]; ?></td>
                                                <td><?php echo $All_college_staffs[$key]["statuses"]; ?></td>
                                                <td class="datatable-ct" >
                                                <input staff-id="<?php echo htmlentities($All_college_staffs[$key]["stf_id"]);  ?>" type="button" class="btn-sm border-0 current-staff-status <?php echo $All_college_staffs[$key]['statuses'] == 1 ? 'btn-success': 'btn-warning'; ?>" value="<?php echo $All_college_staffs[$key]['statuses'] == 1 ? 'Active': 'Disactive'; ?>" />
                                                </td>
                                            </tr>
                                            <?php endforeach; endif;?>

                                         </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- table end -->
      
                            <div class="sparkline11-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                              <div id="admin-add-staff" class="modal modal-adminpro-general modal-zoomInDown fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-close-area modal-close-df">
                                                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="modal-login-form-inner">
                                                                                                                             
                                                                        <div class="basic-login-inner modal-basic-inner">
                                                                            <h3>Add New Staff </h3>
                                                                            
                                                                            <form name="add-staff-form-fill" action="#">
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label for="Emp_id" class="login2">Staff Id | code</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <input type="text" type="text" name="Emp_id" class="Emp_id form-control" id="Emp_id" placeholder="Employee id" required />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2" for="first_name ">First name</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <input id="first_name" name="first_name" type="text" class="form-control" placeholder="first name" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2" for="last_name ">Lastrst name</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <input id="last_name" name="last_name" type="text" class="form-control" placeholder="last name" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                        <label for="gender" class="login2">Gender</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                        <select  id="gender" name="gender" data-placeholder="...select gender..." class="form-control chosen-seelect" tabindex="-1">
                                                                                          <option selected disabled value="">Select</option>
                                                                                          <option value="Male">Male</option>
                                                                                          <option value="Female">Female</option>                                                   
                                                                                      </select>                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                        <label for="Position" class="login2">Position</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                        <select id="position" name="Position"   data-placeholder="Choose a Position ..." class="chosen-select" tabindex="-1">
                                                                                          <option value="">Select</option>
                                                                                          <?php

                                                                                              $positions = $organisation->getAllPositions();
                                                                                              
                                                                                              if(!empty($positions)):
                                                                                              foreach($positions as $key => $value):
                                                                                           ?>
                                                                                                            
                                                                                            <option id="<?php  echo $positions[$key]['role_id']; ?>"> <?php echo $positions[$key]['role_name']; ?> </option>
                                                                                              
                                                                                            <?php  endforeach; endif; ?>
                                                                                              
                                                                                      </select>
                                                                                      </div>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                        <label for="Department" class="login2">Departement</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                        <select id="departement" name="Department"   data-placeholder="Choose a deptmnt ..." class="chosen-select" tabindex="-1">
                                                                                          <option value="">Select</option>
                                                                                          <?php
                                                                                            $departments = $organisation->getAllDepartments();
                                                                                            
                                                                                            if(!empty($departments)):
                                                                                            foreach($departments as $key => $value):
                                                                                                          ?>
                                                                                                            
                                                                                                            <option id="<?php echo $departments[$key]['dept_id'];?>"> <?php echo $departments[$key]['dept_name']; ?> </option>

                                                                                              <?php  endforeach; endif; ?>							  
                                                                                      </select>
                                                                                      </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label for="email" class="login2">Staff's Email</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <input onblur ="ValidateEmail(this)" type="text" name="email" id="email" class="form-control" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" title="NB. registered staff will find login creditial via this email 💯" placeholder="Staff Email" />
                                                                                            <span id="emailError" class="bg-red"></span>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label for="telphone" class="login2">Staff telphone</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <input type="text" name="telphone" id="telphone"  class="form-control" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" data-mask="(999) 999-9999" title="" placeholder="Staff phone" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                                                
                                                                                </div>



                                                                                <div class="login-btn-inner">
                                                                               <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <div class="login-horizental">
                                                                                                <input id="add-staff" type="button" onclick="AddStaff()" name="register"  class="btn btn-sm btn-primary login-submit-cs" value="Add Staff now" />
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
                  <?php endif; ?>
                       
                        
                    
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
     <?php// include_once("request-form.php"); ?>  
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>




  

<!-- Report form modal start -->

<div class="modal fade bd-example-modal-lg1 add-report" id="mission-report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b> FILL A REPORT FORM</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="reporot-form-container">

     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</div>

<!-- pre-loader for waiting  -->

<div id="wait" style="z-index:100;display:none;width:80px;height:80px;border:none;position:fixed;top:45%;left:45%; background-color: #3f6ff0;"><img class="preLoader" src='../ajax-loader.gif' width="80" height="80" /><br>wait..</div>

<!-- End of Report Form -->       
<?php include('../includes/footer.php');?>

  <!-- BEGIN VENDOR JS-->
  <script src="../app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="../app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
  <script src="../app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
  <script src="../app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
  <script src="../app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
  <script src="../app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js" type="text/javascript"></script>

  <!-- BEGIN MODERN JS-->

  <script src="../app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="../app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="../app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <!-- END MODERN JS-->

  <!-- js bootstrap table from jwrly template -->
  <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
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

    <!-- notifications -->
    <!-- notification JS
		============================================ -->
    <script src="js/notifications/Lobibox.js"></script>
    <!-- <script src="js/notifications/notification-active.js"></script> -->
    <!-- custom js -->
  <script src="../app-assets/js/customJs.js" type="text/javascript"></script>


 <script>


 // hod view the single staff request

 
$('#table tbody').on( 'click', 'td input.current-staff-status', function () {
  if(confirm('you are about to change staff status')){
  var thisButton = $(this);
  // var this_table_data = $(this).closest()
  // var name = $(this).closest('td');
  // console.log(name);
  var current_status = $(this).attr("value");
  var staffId = $(this).attr("staff-id");
  var newstatus = "";
  $.ajax({  
                url:"../scripts/change-staff-status.php", 
                method:"post",  
                data:{staff_id:staffId},
                success:function(data){
                  console.log(data);
                  data =  JSON.parse(data);
                  let newStatus = data.status;
                  thisButton.removeClass(newStatus == 1 ? 'btn-warning' : 'btn-success');
                  thisButton.addClass(newStatus == 1 ? 'btn-success' : 'btn-warning');
                  thisButton.val(newStatus == 1 ? "Active" : "Deactive");
            }  
           });
          }
} );





function ValidateEmail(obj){
  // let Obj = obj;
  var emailValue = obj.value;
  
  var atpos = emailValue.indexOf("@");
  var dotpos = emailValue.lastIndexOf(".");
  var emailError = document.getElementById("emailError"); 

  if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= emailValue.length) {
    emailError.innerHTML = "Enter valid email Address";
  }
  else
  {
    verfyEmailDB(emailValue).then((data)=>{
      let mycalback = JSON.parse(data);
      if(mycalback.success){
      emailError.innerHTML = 'email has been already';
    }})

  }
}


async function verfyEmailDB(email)
{
  let Email = email;
  let result;
  try {
    result = await $.ajax({
    url: '../scripts/validate-email-DB-live.php',
    type: 'GET',
    data: {staff_email: Email}
  })
  return result;

  } catch (error) {
    console.log(error);    
  }  
}



   
 </script>
</body>
</html>
<?php endif; endif;?> 