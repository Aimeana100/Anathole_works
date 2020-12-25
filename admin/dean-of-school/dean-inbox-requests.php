<?php
session_start();
// error_reporting(0);
include('../Classes/DBController.php');
include('../Classes/Staff_class.php');
include('../Classes/Requests_class.php');
include('../Classes/Notification_class.php');
include('../Classes/Organisation_class.php');
include('../Classes/Report_class.php');
  if(((strlen($_SESSION['userlogin'])==0) OR (!isset($_SESSION['stf_id']) ) OR  (strlen($_SESSION['stf_id'])==0))):

  header('location:../index.php');

  else:
    // $stf_role = 6;
    // $stf_role = $_SESSION['role'];
    $staf_id = 8;
    // $staf_id = $_SESSION['stf_id'];

    // $HOD_id = $_SESSION['stf_id'];
    $organisation = new Organisation();
    $staff = new Staff();
    $staff_details = $staff->getStaffById($staf_id);

    $schl_id=$staff_details[0]['scl_id'];
    $HOD_id = $_SESSION['stf_id'];

    $request = new Request();
    $request_instance = $request->getAllRequestsByStaff($staf_id);
;   // getting data to pre-fill the form
    $staff = new Staff();
     // instantiate reports
     $report = new Report();

    $staff_details = $staff->getStaffById($staf_id);
    // $staff_hod_details = $staff->getStaff_HODbyDept($staff_details[0]['dept_id']);
    $staff_dean_details = $staff->getStaff_DeanbySchool($staff_details[0]['scl_id']);
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

/* hide bootstrap data table buttons and fields */
/* .dataTables_filter, .dataTables_info { display: none; } */
.bs-bars.pull-left, .pull-right.search, .fixed-table-pagination>div {
  display:block;
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
  <!-- <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/morris.css"> -->
  <link rel="stylesheet" type="text/css" href="../app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/core/colors/palette-gradient.css">


 <link rel="stylesheet" type="text/css" href="../includes/regform-36/css/add-new-staff.css">
 <link rel="stylesheet" type="text/css" href="../app-assets/css/new-customized.css">


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


     <!-- from jewery temperate -->
 <!-- boot table -->
 <link rel="stylesheet" type="text/css" href="../super-admins/css/data-table/bootstrap-table.css">
<!-- css -->
<link rel="stylesheet" type="text/css" href="../super-admins/css/style.css">

<link rel="stylesheet" href="../super-admins/css/font-awesome.min.css">



    <!-- notifications CSS
		============================================ -->
    <link rel="stylesheet" href="../super-admins/css/notifications/Lobibox.min.css">
    <link rel="stylesheet" href="../super-admins/css/notifications/notifications.css">


    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css"/> -->
 
 <!-- progress tracker -->
 <link rel="stylesheet" href="../super-admins/css/progree-tracker/styles/site.css">
  <link rel="stylesheet" href="../super-admins/css/progree-tracker/styles/progress-tracker.css">
  <link rel="stylesheet" href="  https://use.fontawesome.com/releases/v5.7.2/css/all.css
">
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

 
        <?php basic_staff_request: ?>
        <!-- Data Tables of staff request start -->
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
                                    <h1>MY <span class="table-project-n">REQUEST</span> Records</h1>
                                </div>
                                <div class="main-sparkline13-hd col-6 float-right text-right ">

                                    <button class="btn-md m-b-r-0 b-0 add-staff float-right">
                                    <a class="zoomInDown mg-t secondary p-2 btn-sm" href="#" data-toggle="modal" data-target="#staff-request-form" id="btn-open-request-form" ><i class="fa fa-plus"></i> Add request</a>
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
                                                <th data-field="count">#</th>
                                                <th data-field="id">req_ID</th>
                                                <th data-field="destination" data-editable="true">Destination</th>
                                                <th data-field="departure" data-editable="true">Deperture</th>
                                                <th data-field="return" data-editable="true">Return</th>
                                                <th data-field="Status" data-editable="true">Status</th>
                                                <th data-field="action" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty($request_instance)):
                                          $cont_rows=1;
                                          foreach($request_instance as $key => $value):

                                         ?>
                                          <tr>
                                          <td></td>
                                          <td scope="row"><?php echo $cont_rows;?></td>
                                          <td><?php echo $request_instance[$key]["req_id"]; ?></td>
                                          <td><?php echo $request_instance[$key]["des_name"]; ?></td>
                                          <td><?php echo $request_instance[$key]["req_departure"]; ?></td>
                                          <td><?php echo $request_instance[$key]["req_return"]; ?></td>
                                          <td>
                                          <input req-id="<?php echo htmlentities($request_instance[$key]["req_id"]);  ?>" type="button" class="btn-sm border-0 my-request-status <?php echo $request_instance[$key]['req_status'] == 1 ? 'btn-success': 'btn-warning'; ?>" value="<?php echo $request_instance[$key]['req_status'] == 1 ? 'ON': 'OFF'; ?>" />
                                          <?php ; ?>
                                          </td>
                                          <td class="datatable-ct">
                                          <div class="acition-btn">
                                         <input data-target="#staff-track-request-progress" req-id="<?php echo htmlentities($request_instance[$key]["req_id"]) ?>" style="margin: 0px ;padding: 3px;" type="button" class="btn btn-secondary staff-track-request" value="track" data-toggle="modal" > 
                                         <input data-target="#Request-view-details" req-id="<?php echo htmlentities($request_instance[$key]["req_id"]) ?>" style="margin: 0px ;padding: 3px;" type="button" class="btn btn-info btn-glow view-request-details" value="View" data-toggle="modal" > 
                                         <input data-target="#mission-report" req-id="<?php echo htmlentities($request_instance[$key]["req_id"]) ?>" style="margin: 0px ;padding: 3px;" type="button" class="btn btn-blue give-mission-report" value="report" data-toggle="modal" > 
 
                                            </div>
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


<!-- track a request -->

<div  style="" id="staff-track-request-progress" class="container-fluid modal modal-adminpro-general fullwidth-popup-InformationproModal fadeIn " role="dialog">
       <div class="modal-dialog modal-dialog-centered modal-sm" >
          <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Track my request</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body" id="request-progress">

       </div>
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
             <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
            </div>
          </div>
      </div>


<!-- request form modal start -->

<div class="modal fade bd-example-modal-lg" id="staff-request-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
     <?php include_once("../request-form.php"); ?>  
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
<script src="../super-admins/js/progress-tracker/scripts/site.js"></script>


  <!-- BEGIN VENDOR JS-->
  <script src="../app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>

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
    <!-- <script src="../js/data-table/bootstrap-table-editable.js"></script> -->
    <script src="../super-admins/js/data-table/bootstrap-editable.js"></script>
    <script src="../super-admins/js/data-table/bootstrap-table-resizable.js"></script>
    <script src="../super-admins/js/data-table/colResizable-1.5.source.js"></script>
    <script src="../super-admins/js/data-table/bootstrap-table-export.js"></script>
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

    <!-- progress tracker -->
    <!-- <script src="../super-admins/js/progress-tracker/scripts/site.js"></script> -->
     

 <script>

// $('#table').DataTable({sDom: 'lrtip'});
// staff view his/her request

$('#table').on('click', '.staff-track-request', function(){
           var reqId = $(this).attr("req-id");
                $.ajax({  
                url:"../scripts/track-my-request.php", 
                method:"post",  
                data:{req_id:reqId},
                success:function(data){
                  let data_formulated = JSON.parse(data);

                  console.log(data_formulated.all_about_request.hod_sansation);
                      // $('#request-progress').html(data);  
var track_progress = '<div class="fullwidth"><div class="container  separator">'+
'<ul class="progress-tracker progress-tracker--vertical">'+
'<li class="progress-step';
if(data_formulated.hod_reacted){
  track_progress += ' is-complete"><div class="progress-marker"  data-text="1"></div><div class="progress-text"><h4 class="progress-title">L1: Depertement</h4>';
  
  if(data_formulated.all_about_request.hod_sansation == 1){
    track_progress += '<h5 class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>Approved</h5> by <h6>'+data_formulated.about_hod_reacted.fname+' '+data_formulated.about_hod_reacted.lname+ '</h6>  </div></li>';
  }
  else{
    track_progress += '<h5 class="text-danger">Disapproved</h5></div></li>';
  }
}
else{
  track_progress += '"><div class="progress-marker"  data-text="1"></div><div class="progress-text"><h4 class="progress-title">L1: Depertement</h4>';
  
  if(data_formulated.all_about_request.hod_sansation == 0){
    track_progress += '<h5 class="text-info"> Sansation Waiting... </h5></div></li>';
  }

}

track_progress +='<li class="progress-step';
if(data_formulated.dean_reacted){
  track_progress +=' is-complete "><div class="progress-marker"  data-text="2"></div><div class="progress-text"><h4 class="progress-title">L2: School</h4>';
  if(data_formulated.all_about_request.dean_sansation == 1){
    track_progress += '<h5 class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>Approved </h5> by <h6>'+data_formulated.about_dean_reacted.fname+' '+data_formulated.about_dean_reacted.lname+ '</h6>  </div></li>';
  }
  else{
    track_progress += '<h5 class="text-danger">Disapproved</h5></div></li>';
  }
}
else{
  track_progress += '"><div class="progress-marker"  data-text="2"></div><div class="progress-text"><h4 class="progress-title">L2: School</h4>';
  
  if(data_formulated.all_about_request.dean_sansation == 0){
    track_progress += '<h5 class="text-info"> Sansation Waiting... </h5></div></li>';
  }

}
track_progress +='<li class="progress-step';

if(data_formulated.principal_reacted){
  track_progress +=' is-complete "><div class="progress-marker"  data-text="2"></div><div class="progress-text"><h4 class="progress-title">L2: College</h4>';
  if(data_formulated.all_about_request.principal_sansation == 1){
    track_progress += '<h5 class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>Approved</h5> by <h6>'+data_formulated.about_principal_reacted.fname+' '+data_formulated.about_principal_reacted.lname+ '</h6>  </div></li>';
  }
  else{
    track_progress += '<h5 class="text-danger">Disapproved</h5></div></li>';
  }
}
else{
  track_progress += '"><div class="progress-marker"  data-text="2"></div><div class="progress-text"><h4 class="progress-title">L1: College</h4>';
  
  if(data_formulated.all_about_request.principal_sansation == 0){
    track_progress += '<h5 class="text-info"> Sansation Waiting... </h5></div></li>';
  }

}

track_progress +='</ul></div>';

        $('#request-progress').html(track_progress);  

                }
           });  

});

$('#table').on('click', '.view-request-details', function(){
           var reqId = $(this).attr("req-id");
           var staf_id = <?php echo $staf_id; ?>;        
           console.log(staf_id);
                  
                $.ajax({  
                url:"../scripts/staff-request-details.php", 
                method:"post",  
                data:{req_id:reqId, staf_id:staf_id},
                success:function(data){
                      $('#request_detail').html(data);  
                      // $('#dataModal').modal("show");  
                 }  
           });  

});

     
$('#table').on('click', '.give-mission-report', function(){
           var reqId = $(this).attr("req-id");
           let ThisButton = $(this);
                $.ajax({  
                url:"../report-form.php",  
                method:"POST",
                data:{req_id:reqId},  
                success:function(data){ 
                      $('#reporot-form-container').html(data);
                      ThisButton.addClass('disabled')
                      $("#myModal").on('shown.bs.modal', function(){
                      $('document').find('#inputName').focus();
                    });
                      // $('#dataModal').modal("show");  
                 }  
           }); 

});

 
$('#table tbody').on( 'click', 'td input.my-request-status', function () {
  if(confirm('you are about to change status')){
  var thisButton = $(this);
  // var this_table_data = $(this).closest()
  // var name = $(this).closest('td');
  // console.log(name);
  var current_status = $(this).attr("value");
  var reqId = $(this).attr("req-id");
  var newstatus = "";
  $.ajax({  
                url:"../scripts/change-request-status.php", 
                method:"post",  
                data:{req_id:reqId},
                success:function(data){
                  data =  JSON.parse(data);
                  let newStatus = data.status;
                  thisButton.removeClass(newStatus == 1 ? 'btn-warning' : 'btn-success');
                  thisButton.addClass(newStatus == 1 ? 'btn-success' : 'btn-warning');
                  thisButton.val(newStatus == 1 ? "ON" : "OFF");
            }  
           });
          }
} );

    function SubmitFormRequest() {
    var errors = [];
    var stf_id = <?php echo $staf_id ?>;
    var supervisor_id  = <?php echo isset($staff_hod_details[0]['stf_id']) ? $staff_hod_details[0]['stf_id'] : isset($staff_dean_details[0]['stf_id']) ? $staff_dean_details[0]['stf_id'] : $staff_principal_details[0]['stf_id'] ?>;
    var req_purpose = $('#req_purpose').val();
    var exp_result = $('#exp-result').val();
    var destination = $('#destination').children(":selected").attr("value");
    var transiport = $("input[name='transiportation']:checked").val();
    var req_departure = new Date($('#destination-departure-date').val());
    req_departure = req_departure.getFullYear()+'-'+(req_departure.getMonth()+1)+'-'+req_departure.getDate();
    var req_return = new Date($('#destination-return-date').val());
    req_return = req_return.getFullYear()+'-'+(req_return.getMonth()+1)+'-'+req_return.getDate();
    var req_distance=$('#distance-of-travel').val();
    var req_mission_duration =$('#mission-duration').val();
     
     if (req_purpose.length == 0) {

      errors.push("request purpose can't be empty <br>");
     }

      if (exp_result.length == 0) {
      errors.push("expected result field can't be empty <br>");
     }

      if (destination == "") {
      errors.push("select desstination");
     }

     if (transiport == null) {
      errors.push("tick the transiportation means");
     }

     if (req_departure.length == 0) {
      errors.push("Enter a Deperture date");
     }
      if (req_return.length == 0) {
      errors.push("Enter a return date");
     }

       if (errors.length != 0) {
      errorMessage = "";
      for(var i = 0; i < errors.length; i++){
      errorMessage += '<p class ="">'+errors[i]+'</p>';
      }

      Lobibox.notify('warning', {
      sound: false,
      size: 'large',
      width: 500,
      position: 'top right',
      msg: errorMessage
  });
  
     }

   else {
    
    $.post("../scripts/save-staff-request.php", { stf_id: stf_id, req_purpose: req_purpose, exp_result: exp_result, destination: destination, transiport: transiport, req_departure: req_departure, req_return: req_return, req_distance: req_distance, req_mission_duration: req_mission_duration, supervisor: supervisor_id},
    function(data) {
      
      var all_callback = JSON.parse(data)
      var DBcallback = JSON.parse(all_callback.result);
        // console.log(all_callback);
        // console.log(DBcallback);

      let first_columns = ['<input data-index="0" name="btSelectItem" type="checkbox">','<span class"text-success">New</span>'];
      let tableColumns = [DBcallback.req_id, DBcallback.des_name, DBcallback.req_departure, DBcallback.req_return]
      let last_column_status = ['<input req-id="'+ DBcallback.req_id +'" type="button" class="btn-sm border-0 btn-success" value="ON" />'];
      let last_column_track = ['<input data-target="#staff-track-request-progress" req-id="'+ DBcallback.req_id +'" style="margin: 0px ;padding: 3px;" type="button" class="btn btn-secondary staff-track-request" value="track" data-toggle="modal" > '];
      let last_column_view = ['<input data-target="#Request-view-details" req-id="'+ DBcallback.req_id +'" style="margin: 0px ;padding: 3px;" type="button" class="btn btn-info btn-glow view-request-details" value="View" data-toggle="modal" > '];

      var table_row_full = first_columns.concat(tableColumns, last_column_status, last_column_track + last_column_view);
        var t = $('#table').DataTable()
          m = t.row.add(table_row_full).order( [ 2, 'desc' ]).draw();

      Lobibox.notify('success',{
      sound: false,
      width: 400,
      position: 'top right',
      msg: '<b>Request sent, with request ID:  '+ DBcallback.req_id +'</b>'
  });


      if (data != false) {
        $('#table-data-rows').prepend(data);
        // $('#staff-form-request')[0].reset();
        // window.alert(data);
      }
    });
  }  
}

// $(document).ready(function(){
//     $(".give-mission-report").on('shown.bs.modal', function(){
//         $(this).find('#req-outcomes').focus();
//     });
// });


 // a popover form for actions on reqeust
var do_direct_action_on_request = $('.give-sansation');
   var retrieved = fetchDataForm();
   do_direct_action_on_request.popover({
   placement: 'left',
   title : '<h4 class="text-center" ><i class="la la-arrow-right"></i><b> React to this request</b></h4>',
   content: retrieved,
   html: true
   });

   $('.give-sansation').on('click', function (e) {
    $('.give-sansation').not(this).popover('hide');
});

  async function fetchDataForm(){
    let fetch_data = '';
    var reqId = $(this).attr("req-id");
    var hod_id = <?php echo $staf_id; ?>

    try {
      fetch_data = await $.ajax({
          url:"../scripts/hod-direct-action-on-request.php",
          method:"POST",
          async:false,
          data:{req_id:reqId, hod_id:hod_id},
          success:function(data){
          fetch_data = data;
          }
          }); 
      return fetch_data; 
      
    } catch (error) {
      alert(error);
      console.error(error);
      
    }

 
 } 




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
<?php endif;?> 