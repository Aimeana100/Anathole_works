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
// $request_instance = $request->getAllRequestsByStaff($staf_id);
// getting data to pre-fill the form

$staff = new Staff();
$staff_details = $staff->getStaffById($staf_id);
// $staff_hod_details = $staff->getStaff_HODbyDept($staff_details[0]['dept_id']);
// $staff_dean_details = $staff->getStaff_DeanbySchool($staff_details[0]['scl_id']);
// $staff_principal_details = $staff->getStaff_Principalbycollege($staff_details[0]['coll_id']);

$staff_HR_details = $staff->getStaff_HRbycollege($staff_details[0]['coll_id']);
$All_schools = $organisation->getAllSchools();

//  echo json_encode(array("staff_id" =>$staff_details[0]["stf_id"], "depertement" => $staff_details[0]["dept_id"], "college_id" => $staff_details[0]['coll_id'])  );
// $_SESSION['userlogin'] = isset($staff_details[0]['username']) ? $staff_details[0]['username'] : $staff_details[0]['stf_email'];
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
                                    <h1>ALL <span class="table-project-n"> SCHOOLS </span></h1>
                                </div>
                                <div class="main-sparkline13-hd col-10 text-right ">
                                    <button class="btn-md m-b-r-0 b-0 add-staff float-right">
                                    <a class="zoomInDown mg-t secondary p-2" href="#" data-toggle="modal" data-target="#admin-add-college">Add School</a>
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
                                                <th data-field="id">school_ID</th>
                                                <th data-field="school-name" data-editable="true">school name</th>
                                                <th data-field="college-name" data-editable="true">college name</th>
                                                <!-- <th data-field="principal-name" data-editable="true">Principal name</th> -->
                                                <th data-field="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty($All_schools)):
                                          $cont_rows=1;
                                          foreach($All_schools as $key => $value):
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $All_schools[$key]["scl_id"]; ?></td>
                                                <td><?php echo $All_schools[$key]["scl_name"]; ?></td>
                                                <td><?php echo $All_schools[$key]["coll_name"]; ?></td>
                                                <!-- <td>< ?php// echo $All_schools[$key]["stf_lname"]; ?></td> -->
                                               
                                                <td class="datatable-ct" >
                                                <input data-target="#mdl-edit-college" data-toggle="modal"  school-id="<?php echo htmlentities($All_schools[$key]["scl_id"]);  ?>" type="button" class="btn-sm btn-primary border-0 class-college " value="edit"/>
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
      
                   
         </div>
                  <?php endif; ?>
                       
                        
                    
        </div>
        </div>
        </div>
  
 


<div class="modal fade bd-example-modal-lg1 add-college" id="admin-add-college" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-md" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Add School</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="add-colle-container">

      <form id="form-add-college">




      <div class="form-group-inner">
          <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label for="Department" class="login2">College</label>
              </div>
              <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <select id="departement" name="Department"   data-placeholder="Choose a deptmnt ..." class="chosen-select" tabindex="-1">
                <option value="">Select</option>
                <?php
                  $college = $organisation->getAllColleges();
                  
                  if(!empty($college)):
                  foreach($college as $key => $value):
                                ?>
                                  
                                  <option id="<?php echo $college[$key]['coll_id'];?>"> <?php echo $college[$key]['coll_name']; ?> </option>

                    <?php  endforeach; endif; ?>							  
            </select>
            </div>
          </div>
      </div>

      <div class="form-group-inner">
      <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label class="login2" for="first_name ">school name</label>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <input id="college_name" name="college_name" type="text" class="form-control" placeholder="college title" />
          </div>
      </div>
  </div>

  <div class="login-btn-inner">
 <div class="row">
     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
         <div class="login-horizental">
             <input id="add-staff" type="button" onclick="Addschool()" name="register"  class="btn btn-sm btn-primary login-submit-cs" value="Add College now" />
         </div>
     </div>
 </div>
 </div>

      </form>

     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 


<!-- edit college -->

<div class="modal fade bd-example-modal-lg1 edit-school" id="mdl-edit-school" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit College</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="edit-colle-container">

     
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
  <script src="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.js"></script>

  <!-- js bootstrap table from jwrly template -->
  <!-- <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
 -->

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
  <!-- <script src="../app-assets/js/customJs.js" type="text/javascript"></script> -->


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