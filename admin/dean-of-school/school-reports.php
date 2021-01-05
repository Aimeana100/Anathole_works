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


  // if(((strlen($_SESSION['user_username'])==0) OR (!isset($_SESSION['user_id']) ) OR  (strlen($_SESSION['user_id'])==0))):
  if(!$loginFunctions->checkLoginState($session_instance)):
    

  header('location:../index.php');

  else:
    // $_SESSION['userlogin'] = $_SESSION['user_username'];
    $stf_role = $_SESSION['role_id'];
    // $staf_id = 4;
    $staf_id = $_SESSION['user_id'];

    $staff = new Staff();
    $staff_details = $staff->getStaffById($_SESSION['user_id']);
    if($staff_details[0]['role_id'] != 6):
  header('location:../index.php');
  exit();
    else: 
  
    
    // $staf_id = $_SESSION['stf_id'];

    // $HOD_id = $_SESSION['stf_id'];
    $organisation = new Organisation();
  
    $staff = new Staff();
        // instantiate request
    $request = new Request();
   // instantiate reports
    $reports = new Report();

    $staff_details = $staff->getStaffById($staf_id);
    $schl_id = $staff_details[0]['scl_id'];


//   $request_dept_instance = $request->getAllRequestsBySchoolId($schl_id);
  $report_instance = $reports->getAllReportBySchool($schl_id);

   // getting data to pre-fill the form
    $staff = new Staff();

    $staff_details = $staff->getStaffById($staf_id);
    // $staff_hod_details = $staff->getStaff_HODbyDept($staff_details[0]['dept_id']);
    // $staff_dean_details = $staff->getStaff_DeanbySchool($staff_details[0]['scl_id']);
    $staff_principal_details = $staff->getStaff_Principalbycollege($staff_details[0]['coll_id']);
    $staff_HR_details = $staff->getStaff_HRbycollege($staff_details[0]['coll_id']);
    $logged_in_user_role = $staff_details[0]['role_id'];


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
  <!-- bootstrap from jewery -->
  <link rel="stylesheet" type="text/css" href="../super-admins/css/bootstrap.min.css">

  
  <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/morris.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/core/colors/palette-gradient.css">


 <link rel="stylesheet" type="text/css" href="../includes/regform-36/css/add-new-staff.css">
 <link rel="stylesheet" type="text/css" href="../app-assets/css/new-customized.css">

 <!-- boot table -->
 <link rel="stylesheet" type="text/css" href="../super-admins/css/data-table/bootstrap-table.css">
<!-- css -->
<link rel="stylesheet" type="text/css" href="../super-admins/css/style.css">

<link rel="stylesheet" href="../super-admins/css/font-awesome.min.css">


<script src="../app-assets/js/scripts/html2canvas.js" type="text/javascript"></script>
 
<!-- forms -->
    <!-- modals CSS
		============================================ -->
    <!-- <link rel="stylesheet" href="css/modals.css"> -->
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="../super-admins/css/form/all-type-forms.css">

    <!-- for select chosen -->
    <link rel="stylesheet" href="../super-admins/css/chosen/bootstrap-chosen.css">

    <!-- date picker -->
    <link rel="stylesheet" href="../super-admins/css/datapicker/datepicker3.css">

    <!-- notifications CSS
		============================================ -->
    <link rel="stylesheet" href="../super-admins/css/notifications/Lobibox.min.css">
    <link rel="stylesheet" href="../super-admins/css/notifications/notifications.css">

</head>

<body style="color: #000000" class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">



  <!-- fixed-top-->
  <?php include_once('../includes/staff_header.php'); ?>
 <!-- always at left -->
   <?php require_once('components/dean-of-school-side-bar.php');?>


  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
  <div class="content-body">

 <?php if (isset($_GET['option']) AND $_GET['option'] == "change-password"):
  
 include_once('../change-password.php'); 

 else:
  ?>

        <!-- Data Tables of staff request start  -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
             
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                  
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                 
                  </ul>
                </div>
              </div> 

              
          <div class="data-table-area mg-tb-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list container">
                            <div class="sparkline13-hd row">
                                <div class="main-sparkline13-hd co-6">
                                    <h1>ALL <span class="table-project-n">REPORTS</span></h1>
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
                                                <th data-field="count">#</th>
                                                <th data-field="id">req_ID</th>
                                                <th data-field="destination">Destination</th>
                                                <th data-field="mission-outcomes" >Mission Outcomes</th>
                                                <th data-field="report-date" >Report Date</th>
                                                <th data-field="number-of-days" >Number of Days</th>
                                                <th data-field="Status" data-editable="true">Received</th>
                                                <th data-field="action" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty($report_instance)):
                                          $cont_rows=1;
                                          foreach($report_instance as $key => $value):
                                         ?>
                                          <tr>
                                          <td></td>
                                          <td scope="row"><?php echo $cont_rows;?></td>
                                          <td><?php echo $report_instance[$key]["req_id"]; ?></td>
                                          <td><?php echo $report_instance[$key]["des_name"]; ?></td>
                                          <td><?php echo $report_instance[$key]["res_skills_gained"]; ?></td>
                                          <td><?php echo $report_instance[$key]["report_date"]; ?></td>
                                          <td><?php echo $report_instance[$key]["report_date"]; ?></td>
                                          <td><?php echo $report_instance[$key]["statuses"] == 1 ? "Yes" : "No"  ; ?></td>
                                          <td class="datatable-ct">
                                          <!-- <input data-target="#staff-track-request-progress" req-id="<?php echo htmlentities($report_instance[$key]["req_id"]) ?>" style="margin: 0px ;padding: 3px;" type="button" class="btn btn-secondary staff-track-request" value="track" data-toggle="modal" >  -->
                                         <input data-target="#Report-view-details" req-id="<?php echo htmlentities($report_instance[$key]["req_id"]) ?>" reportId = "<?php echo htmlentities($report_instance[$key]["res_id"]) ?>" style="margin: 0px ;padding: 3px;" type="button" class="btn btn-info btn-glow view-report-details" value="View" data-toggle="modal" > 

                                          </td>
                                          
                                            </tr>

                                            <?php $cont_rows++; endforeach; endif;?>

                                         </tbody>
                                    </table>
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
       


        <!-- Basic Tables end -->

          </div>
        </div>
      </div>
    </div>
  


   

<!-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

  <div class="modal-dialog ">
    <div class="modal-content">
  
    </div>
  </div>
</div> -->


    <!-- reportt details preview start -->

       <div  style="" id="Report-view-details" class="container-fluid modal modal-adminpro-general fullwidth-popup-InformationproModal fadeIn " role="dialog">
       <div class="modal-dialog modal-lg " role="document" >
          <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>REPORT DETAILS</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div style="margin: 0px; padding: 0px;" class="modal-body" id="report_detail">

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
  <!-- <script src="app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"
  type="text/javascript"></script> -->

  <!-- <script src="../app-assets/data/jvector/visitor-data.js" type="text/javascript"></script> -->
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->

  <script src="../app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="../app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="../app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <!-- END MODERN JS-->


  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>

  <!-- js bootstrap table from jwrly template -->
    <script src="../super-admins/js/data-table/bootstrap-table.js"></script>
    <script src="../super-admins/js/data-table/tableExport.js"></script>
    <script src="../super-admins/js/data-table/data-table-active.js"></script>
    <!-- <script src="js/data-table/bootstrap-table-editable.js"></script> -->
    <script src="../super-admins/js/data-table/bootstrap-editable.js"></script>
    <script src="../super-admins/js/data-table/bootstrap-table-resizable.js"></script>
    <script src="../super-admins/js/data-table/colResizable-1.5.source.js"></script>
    <script src="../super-admins/js/data-table/bootstrap-table-export.js"></script>

            <!-- datapicker JS
		============================================ -->
    <script src="../super-admins/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="../super-admins/js/datapicker/datepicker-active.js"></script>
    <!-- input-mask JS
		============================================ -->
    <script src="../super-admins/js/input-mask/jasny-bootstrap.min.js"></script>
    <!-- chosen JS
		============================================ -->
    <script src="../super-admins/js/chosen/chosen.jquery.js"></script>
    <script src="../super-admins/js/chosen/chosen-active.js"></script>

    <!-- notifications -->
    <!-- notification JS
		============================================ -->
    <script src="../super-admins/js/notifications/Lobibox.js"></script>
    <script src="../super-admins/js/notifications/notification-active.js"></script>


 <script>
// $('.view-report-details').click(function(){ 
//          var reqId = $(this).attr("reqId");
//                 $.ajax({  
//                 url:"scripts/save-mission-outcomes.php",  
//                 method:"post",
//                 data:{req_id:reqId},  
//                 success:function(data){  
//                       $('#report_detail').html(data);
//                       $("#myModal").on('shown.bs.modal', function(){
//                       $(this).find('#inputName').focus();
//                     });
//                     // $('#dataModal').modal("show");  
//                  }  
//            });  
//       });


      $('#table').on('click', '.view-report-details', function(){
           var reqId = $(this).attr("req-id");
           console.log(reqId);
                $.ajax({  
                url:"../scripts/staff-report-details.php", 
                method:"POST",  
                data:{req_id:reqId},
                success:function(data){
                      $('#report_detail').html(data);  
                      // $('#dataModal').modal("show");  
                 }  
           });  

});


   // take action on request. for direct action in table 

    function Do_direct_ActionOnRequest(){

      // getting ids from hidden input in popover  on direct action
    
    // errors = {"approver_id": "", "request:id": "", "comment": "", "sansation": ""};
    errors_array = [];
    var hod_id = $('#Req-Hod-Ids').attr("hod_id");
    var req_id = $('#Req-Hod-Ids').attr("req_id");
    var hod_comment=$('#action_comment').val();
    var hod_sansation=$('#hod_sansation').children(":selected").attr("value");

    if(hod_comment == null || hod_comment == ""){
      errors_array.push("comment field can't be empty");
    }
    if(hod_sansation == null || hod_sansation == "")
    {
      errors_array.push("choose to approve or not");
    }    
    if(errors_array.length != 0){
      alert(errors_array);
    }
    else{
    $.post("scripts/hod-action-on-request.php",{req_id: req_id,hod_comment: hod_comment, hod_sansation: hod_sansation, hod_id:hod_id},
    function(data) {
   window.alert(data);
    });
    }
    }



// check ip data/ locations ...

function checkip(){

function jsonIp_data(url) {
  return fetch(url).then(res => res.json());
}
let apiKey = '963f4c40c4bb0adad4fde3e00a14ee73ff587e24a5155a3956afa26d'; //secret key
jsonIp_data(`https://api.ipdata.co?api-key=${apiKey}`).then(data => {
  console.log(data);
  // console.log(data.city);
  // console.log(data.country_code);
  // so many more properties
});
}

 </script>


</body>
</html>
<?php endif; endif;?> 