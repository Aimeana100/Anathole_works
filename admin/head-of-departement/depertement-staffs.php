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


if(((strlen($_SESSION['user_username'])==0) OR (!isset($_SESSION['user_id']) ) OR  (strlen($_SESSION['user_id'])==0))):
  // if(!$loginFunctions->checkLoginState($session_instance)):
    

  header('location:../index.php');

  else:
    // $_SESSION['userlogin'] = $_SESSION['user_username'];
    $stf_role = $_SESSION['role_id'];
    // $staf_id = 4;x
    $staf_id = $_SESSION['user_id'];

    $staff = new Staff();
    $staff_details = $staff->getStaffById($_SESSION['user_id']);
  //   if($staff_details[0]['dept_id'] != 7):
  // header('location:../index.php');
  // exit();
  //   else: 
        
    // $stf_role = 7;
    // $stf_role = $_SESSION['role'];
    // $staf_id = 4;
    // $staf_id = $_SESSION['stf_id'];

    $HOD_id = $_SESSION['stf_id'];
    $organisation = new Organisation();
  
    $staff = new Staff();
    $staff_details = $staff->getStaffById($HOD_id);

    $HOD_dept=$staff_details[0]['dept_id'];

    // instantiate request
  $request = new Request();
  $request_dept_instance = $request->getAllRequestsByDept($HOD_dept);
  $staffs_in_dept = $staff->getAllStaff_in_dept($HOD_dept);

  
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
  <!-- <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css"> -->
  <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/morris.css">
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
   <?php require_once('components/hod-side-bar.php');?>



  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
  <div class="content-body">
  <?php if (isset($_GET['option']) AND $_GET['option'] == "change-password"):  
 include_once('../change-password.php');
 

 else:
  ?>
 <div class="">
  
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
                                    <h1>ALL <span class="table-project-n">Departements Staffs</span></h1>
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
                        <!-- <th data-field="counts" >#</th> -->
                        <th data-field="staff_id" >Staff ID</th>
                        <th data-field="firstName" >First name</th>
                        <th data-field="lastName" >Last name</th>
                        <th data-field="position" >Position</th>
                        <th data-field="number_of_request">No requests</th>
                        <!-- <th data-field="status" >Status</th> -->
                        <th data-field="action"  class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php 


                $cnt=1;
                if(!empty($staffs_in_dept)):
                foreach($staffs_in_dept as $key => $value):
                   ?>

                <tr>
                <td></td>
                <!-- <td><?php// echo htmlentities($cont_rows);?></td> -->
                <td><?php echo htmlentities($staffs_in_dept[$key]["stf_id"]);?></td>                
                <td><?php echo htmlentities($staffs_in_dept[$key]["stf_fname"]);?></td>
                <td><?php echo htmlentities($staffs_in_dept[$key]["stf_lname"]);?></td>
                <td><?php echo htmlentities($staffs_in_dept[$key]["role_name"]);?></td>
                <td><?php echo htmlentities($staffs_in_dept[$key]["nb_of_request_per_staff"]);?></td>
                <td class="datatable-ct" >
                <input staff-id="<?php echo htmlentities($staffs_in_dept[$key]["stf_id"]);  ?>" type="button" class="btn-sm border-0 current-staff-status <?php echo $staffs_in_dept[$key]['statuses'] == 1 ? 'btn-success': 'btn-warning'; ?>" value="<?php echo $staffs_in_dept[$key]['statuses'] == 1 ? 'Active': 'Disactive'; ?>" />


          </td>
            </tr>

                <?php endforeach; endif;
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


    <!-- request details preview start -->

       <div  style="z-index:9999" id="Request-view-details" class="container-fluid modal modal-adminpro-general fullwidth-popup-InformationproModal fadeIn " role="dialog">
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
     <?php include_once("../request-form.php"); ?>  
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


  

<!-- act on request by hod-> form modal start -->

<div  style="z-index:9999" class="modal bd-example-modal-lg1 do-action-on-request" id="action-on-request" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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


  <script src="../app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="../app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="../app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <!-- END MODERN JS-->



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



$('#table').on('click', '.do-action-button', function(){
           var reqId = $(this).attr("req-id");
           var staf_id = <?php echo $staf_id; ?>;        
           console.log(staf_id +" " +reqId);
                  
                $.ajax({  
                url:"../scripts/track-my-request.php", 
                method:"POST",  
                data:{req_id:reqId},
                success:function(data){
                   let data_formulated = JSON.parse(data);
                  // console.log(data_formulated.all_about_request.hod_sansation);

                  if(!data_formulated.hod_reacted){
                  let form_hod_sansation = '<form name="remark" method="post"><div style="text-align: center;"><select id="hod_sansation" name="hod_sansation" style="color:black; display:inline-block; max-width: 200px;" class="form-control" name="status" required> <option value="">Choose your option</option> <option value="1">Approved</option> <option value="2">Not Approved</option> </select></div> <input type="hidden" id="Req-Hod-Ids" class="Req-Hod-Ids" name="Req-Hod-Ids" req_id="'+reqId+'" hod_id="'+staf_id+' "> <textarea  placeholder="leave the comment here" id="action_comment" class="form-control m-t-2" name="action_comment" rows="5" required></textarea> <div class="text-center"> <button onclick="Do_direct_ActionOnRequest()" type="button" class="btn pt-0 mt-1 btn-blue m-b-xs Do_direct_ActionOnRequest" name="submitAction" value="Send sansation">Send sansation</button> </div></form>';
                  $('#action-on-request-form').html(form_hod_sansation);  
                  
                  }
                  else  
                  {
                    let message = '<h4 class="bg-success" > This Request '+data_formulated.all_about_request.hod_sansation == 1 || data_formulated.all_about_request.hod_sansation == true? " Approved " : " Disapproved" +'</h4>'
                  $('#action-on-request-form').html(message);  

                  }
                    
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

      Lobibox.notify('warning',{
      sound: false,
      width: 400,
      position: 'top right',
      msg: errors_array
  });
      alert(errors_array);
    }
    else{
    $.post("action-on-request/hod-action-on-request.php",{req_id: req_id,hod_comment: hod_comment, hod_sansation: hod_sansation, hod_id:hod_id},
    function(data) {
      console.log(data);
      let actionFedback = JSON.parse(data);
      console.log(actionFedback);
    });
    }
    }


    function SubmitFormRequest() {
    var errors = [];
    var stf_id = <?php echo $staf_id ?>;
    var supervisor_id  = <?php echo  $staff_dean_details[0]['stf_id'] ?>;
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

var do_direct_action_on_request = $('#table .give-sansation');
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





//  track a staff request
var mytrack  = $('.track-request');
   mytrack.popover({
   placement: 'left',
   content:  'fetchData',
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