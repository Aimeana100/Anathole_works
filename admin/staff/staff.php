<?php
session_start();
// error_reporting(0);
include('Classes/DBController.php');
include('Classes/Staff_class.php');
include('Classes/Requests_class.php');
include('Classes/Notification_class.php');
include('Classes/Organisation_class.php');
include('Classes/Report_class.php');

  if(((strlen($_SESSION['userlogin'])==0) OR (!isset($_SESSION['stf_id']) ) OR  (strlen($_SESSION['stf_id'])==0))):

  header('location:index.php');

  else:
    // $stf_role = 13;
    $stf_role = $_SESSION['role'];
    // $staf_id = 4;
    $staf_id = $_SESSION['stf_id'];

    $organisation = new Organisation();
  // instantiate request
    $request = new Request();
    $request_instance = $request->getAllRequestsByStaff($staf_id);

   // getting data to pre-fill the form
    $staff = new Staff();
     // instantiate reports
     $report = new Report();

    $staff_details = $staff->getStaffById($staf_id);
    $staff_hod_details = $staff->getStaff_HODbyDept($staff_details[0]['dept_id']);
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
  <link rel="stylesheet" type="text/css" href="super-admins/css/bootstrap.min.css">

  
  <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/morris.css">
  <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">


 <link rel="stylesheet" type="text/css" href="includes/regform-36/css/add-new-staff.css">
 <link rel="stylesheet" type="text/css" href="app-assets/css/new-customized.css">


<script src="app-assets/js/scripts/html2canvas.js" type="text/javascript"></script>
 
<!-- forms -->
    <!-- modals CSS
		============================================ -->
    <!-- <link rel="stylesheet" href="css/modals.css"> -->
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="super-admins/css/form/all-type-forms.css">

    <!-- for select chosen -->
    <link rel="stylesheet" href="super-admins/css/chosen/bootstrap-chosen.css">

    <!-- date picker -->
    <link rel="stylesheet" href="super-admins/css/datapicker/datepicker3.css">

    <!-- notifications CSS
		============================================ -->
    <link rel="stylesheet" href="super-admins/css/notifications/Lobibox.min.css">
    <link rel="stylesheet" href="super-admins/css/notifications/notifications.css">



</head>

<body style="color: #000000" class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">



  <!-- fixed-top-->
   <?php include_once('includes/staff_header.php'); ?>
 <!-- always at left -->
   <?php require_once('includes/hod/hod_leftbar.php');?>



  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
  <div class="content-body">
        <!-- Revenue, Hit Rate & Deals -->


 <div class="">

<div><button onclick="checkip()" >test ip locations</button></div>
   <?php 
    if(isset($_GET['option'])):
      $option = $_GET['option'];
      
      switch ($option) {
        case 'requests':

          if($logged_in_user_role == 7)
          {include_once('scripts/hod-requests-dept-work.php');}

          if($logged_in_user_role == 6)
          {include_once('scripts/dean-school-requests-work.php');}
        break;

        case 'staffs':

          if($logged_in_user_role == 7)
          {include_once('scripts/hod-staffs-dept-work.php');}
          if($logged_in_user_role == 6)
          {include_once('scripts/dean-staffs-school-work.php');}
              break;
        case 'add_staff':
          include('includes/regform-36/add_new_staff_form.php');
          break;

        case 'all_reports':
          include('scripts/all_reports.php');
          break;

          case 'edit_profile':
            include('includes/regform-36/editStaff_form.php');
          break;
                       
            default:
              goto basic_staff_request;
              break;         
          
      }
    
  else:

    ?>

    

 
 
        <?php basic_staff_request: ?>
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
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd row">
                                <div class="main-sparkline13-hd co-6">
                                    <h1>ALL <span class="table-project-n">Request</span></h1>
                                </div>
                                <div class="main-sparkline13-hd col-6 text-right ">
                                    <button class="btn-md m-b-r-0 b-0 add-staff float-right">
                                    <a class="zoomInDown mg-t secondary p-2" href="#" data-toggle="modal" data-target=".bd-example-modal-lg" id="btn-open-request-form" ><i class="fa fa-add"></i> Add request</a>
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
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" class="table mb-0">
                    <thead>
                      <tr>
                      <th data-field="state" data-checkbox="true"></th>
                      <th data-field="state" >#</th>
                        <th data-field="state" >req ID</th>
                        <th data-field="state" >Destination</th>
                        <th data-field="state" >Deperture</th>
                        <th data-field="state" >Return</th>
                        <th data-field="state" >Status</th>
                        <th data-field="state"  class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 


if(!empty($request_instance)):


$cont_rows=1;

foreach($request_instance as $key => $value):

      ?>

      <tr>
      <td></td>
      <th scope="row"><?php echo htmlentities($cont_rows);?></th>
      <td><?php echo htmlentities($request_instance[$key]["req_id"]);?></td>                
      <td><?php echo htmlentities($request_instance[$key]["des_name"]);?></td>
      <td><?php echo htmlentities($request_instance[$key]["req_departure"]);?></td>
      <td><?php echo htmlentities($request_instance[$key]["req_return"]);?></td>
      <td><?php if((isset($request_instance[$key]["principal_sansation"])) AND ($request_instance[$key]["principal_sansation"] != 0 )):
      if($request->Is_mission_reported($request_instance[$key]["req_id"])): echo 'approved | <span class="text-success">reported </span>';
      else:
       ?><a><i class="la la-thumbs-up"></i>|<button data-toggle="modal" data-target="#mission-report" reqId = "<?php echo($request_instance[$key]["req_id"]); ?>" id = "<?php echo($request_instance[$key]["req_id"]); ?>" class="give-report btn btn-sm" >report</button></a>
      <?php endif;?>
      <?php elseif($request_instance[$key]["principal_sansation"] == 2): ?>
      <i class="la la-thumbs-down"></i>|<span>Disapproved</span>
      <?php else: ?>
      <span><b>Waiting</b> Last Approval</span>
      <?php endif; ?>
      </td>

  <td style="padding: 0px" >
    <?php $progr = $request_instance[$key]["progress"];
     ?>
<a style="margin: 0px ;padding: 3px;" reqId="<?php echo htmlentities($request_instance[$key]["req_id"]);?>" tabindex="0" data-toggle="popover"  class="btn btn-secondary track-request" role="button" data-trigger="focus">
Track</a>
  </td>

<td class="datatable-ct" style="padding: 0px">
<input data-target="#Request-view-details" req-id="<?php echo htmlentities($request_instance[$key]["req_id"]) ?>" style="margin: 0px ;padding: 3px;" type="button" class="btn btn-info btn-glow view-request-details" value="View" data-toggle="modal" > 
</td>
   </tr>

    <?php
                $cont_rows++; endforeach; endif;
                      ?>
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
          </div>
        </div>
     <?php endif; ?>
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



<!-- forms validation modal  -->

<div class="modal bg-light" id="validationModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal body -->
        <div id="validate-form-modal" class="modal-body">
        </div>
        
        <!-- Modal footer -->
         <div class="modal-header">
          <button id="btn-hide-validation-error-modal" type="button" class="close" data-dismiss="modal">&times;</button>
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

<div id="wait" style="z-index:100;display:none;width:80px;height:80px;border:none;position:fixed;top:45%;left:45%; background-color: #3f6ff0;"><img class="preLoader" src='ajax-loader.gif' width="80" height="80" /><br>wait..</div>

<!-- End of Report Form -->       
<?php include('includes/footer.php');?>

  <!-- BEGIN VENDOR JS-->
  <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
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

  <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <!-- END MODERN JS-->



  <!-- js bootstrap table from jwrly template -->
    <script src="super-admins/js/data-table/bootstrap-table.js"></script>
    <script src="super-admins/js/data-table/tableExport.js"></script>
    <script src="super-admins/js/data-table/data-table-active.js"></script>
    <script src="super-adminsjs/data-table/bootstrap-table-editable.js"></script>
    <script src="super-admins/js/data-table/bootstrap-editable.js"></script>
    <script src="super-admins/js/data-table/bootstrap-table-resizable.js"></script>
    <script src="super-admins/js/data-table/colResizable-1.5.source.js"></script>
    <script src="super-admins/js/data-table/bootstrap-table-export.js"></script>

            <!-- datapicker JS
		============================================ -->
    <script src="super-admins/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="super-admins/js/datapicker/datepicker-active.js"></script>
    <!-- input-mask JS
		============================================ -->
    <script src="super-admins/js/input-mask/jasny-bootstrap.min.js"></script>
    <!-- chosen JS
		============================================ -->
    <script src="super-admins/js/chosen/chosen.jquery.js"></script>
    <script src="super-admins/js/chosen/chosen-active.js"></script>

    <!-- notifications -->
    <!-- notification JS
		============================================ -->
    <script src="super-admins/js/notifications/Lobibox.js"></script>
    <script src="super-admins/js/notifications/notification-active.js"></script>


 <script>

//  track a staff request
   var mytrack  = $('.track-request');
   mytrack.popover({
   placement: 'left',
   content:  fetchData,
   html: true
   });

   function fetchData(){
      var fetch_data = '';
      var reqId = $(this).attr("reqId"); 
      $.ajax({  
           url:"scripts/track-my-request.php",  
           method:"POST",  
           async:false,
           data:{req_id:reqId},  
           success:function(data){  
                fetch_data = data;  
           }  
      });  
      return fetch_data;  
 } 
// });


// hod view the single staff request

$('.hod-view-staff-request-details').click(function(){  
           var reqId = $(this).attr("req-id");
           var staf_id = <? echo $staf_id; ?>;
           var hod_view_single_req = "hod";
                $.ajax({  
                url:"scripts/staff-request-details.php",  
                method:"post",
                data:{req_id:reqId, staf_id:staf_id, who_views_single_req : hod_view_single_req},
                success:function(data){
                      $('#request_detail').html(data);  
                      // $('#dataModal').modal("show");  
                 }  
           });  
      });


// staff view his/her request

       $('.view-request-details').click(function(){         
           var reqId = $(this).attr("req-id");
           var staf_id = <? echo $staf_id; ?>;
           console.log(reqId);
                $.ajax({  
                url:"scripts/staff-request-details.php",  
                method:"post",  
                data:{req_id:reqId, staf_id:staf_id},
                success:function(data){
                      $('#request_detail').html(data);  
                      // $('#dataModal').modal("show");  
                 }  
           });  
      });


    function SubmitFormRequest() {
    var errors = [];
    var stf_id = <?php echo $staf_id ?>;
    // var supervisor_id  = <? echo  $staff_hod_details[0]['stf_id'] ?>;
    var req_purpose=$('#req_purpose').val();
    var exp_result=$('#exp-result').val();
    var destination=$('#destination').children(":selected").attr("value");
    var transiport =$("input[name='transiportation']:checked").val();
    var req_departure=$('#departure-date').val();
    var req_return = $('#return-date').val();
    var req_distance=$('#distance-of-travel').val();
    var req_mission_duration =$('#mission-duration').val();
    // alert(departure_date);
     
     if (req_purpose.trim().length == 0) {
      errors.push("request purpose can't be empty <br>");
     }

      if (exp_result.trim().length == 0) {
      errors.push("expected result field can't be empty <br>");
     }

      if (destination == "") {
      errors.push("select desstination");
     }

     if (transiport == null) {
      errors.push("tick the transiportation means");
     }

     if (req_departure.trim().length == 0) {
      errors.push("Enter a Deperture date");
     }
      if (req_return.trim().length == 0) {
      errors.push("Enter a return date");
     }

       if (errors.length != 0) {
      errorMessage = "";
      for(var i = 0; i < errors.length; i++){
      errorMessage += '<p class ="text-danger">'+errors[i]+'</p>';
      }

      $('#display-error').html(errorMessage);
     }

     
   else {
    
    $.post("scripts/save-staff-request.php", { stf_id: stf_id, req_purpose: req_purpose, exp_result: exp_result, destination: destination, transiport: transiport, req_departure: req_departure, req_return: req_return, req_distance: req_distance, req_mission_duration: req_mission_duration, supervisor: supervisor_id},
    function(data) {
      alert(data);
      if (data != false) {
        // $('#table-data-rows').prepend(data);
        // $('#staff-form-request')[0].reset();
        // window.alert(data);

      }
    });
  }
  
}
     $('.give-report').click(function(){ 
         var reqId = $(this).attr("reqId");
           $('#request-id').html(reqId);
                $.ajax({  
                url:"scripts/save-mission-outcomes.php",  
                method:"post",
                data:{req_id:reqId},  
                success:function(data){  
                      $('#reporot-form-container').html(data);
                      $("#myModal").on('shown.bs.modal', function(){
                      $(this).find('#inputName').focus();
                    });
                      // $('#dataModal').modal("show");  
                 }  
           });  
      });



// $(document).ready(function(){
//     $("#mission-report").on('shown.bs.modal', function(){
//         $(this).find('#req-outcomes').focus();
//     });
// });


 // a popover form for actions on reqeust

var do_direct_action_on_request = $('.give-sansation');
   do_direct_action_on_request.popover({
   placement: 'left',
   title : '<h4 class="text-center" ><i class="la la-arrow-right"></i><b> React to this request</b></h4>',
   content: fetchDataForm,
   html: true
   });

   $('.give-sansation').on('click', function (e) {
    $('.give-sansation').not(this).popover('hide');
});

   function fetchDataForm(){
    var fetch_data = '';
    var reqId = $(this).attr("req-id");
    var hod_id = <? echo $staf_id; ?>

      $.ajax({
      url:"scripts/hod-direct-action-on-request.php",
      method:"POST",
      async:false,
      data:{req_id:reqId, hod_id:hod_id},
      success:function(data){
      fetch_data = data;
      }
      }); 
      return fetch_data;  
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