

<?php
session_start();
// error_reporting(0);
include('../Classes/DBController.php');
// include('../Classes/Staff_class.php');
include('../Classes/Requests_class.php');
// include('../Classes/Notification_class.php');

$stf_id = $_SESSION['stfId'];
$Req_id = $_POST['req_id'];


$request = new Request();

$request_details = $request->getRequestDeatailsByReq_id($Req_id);

if(isset($request_details)){
 
 $staff_first_name = $request_details[0]["stf_fname"];
 $staff_last_name = $request_details[0]["stf_lname"];
 $staff_departement = $request_details[0]["dept_name"];
 $staff_function = $request_details[0]["role_name"];
 $staff_school= $request_details[0]["scl_name"];
 $college_id = $request_details[0]["coll_id"];
 $req_purpose = $request_details[0]["req_purpose"];
 $req_result = $request_details[0]["req_expected_result"];
 $req_destination = $request_details[0]["des_name"];
 $req_departure = $request_details[0]["req_departure"];
 $req_return = $request_details[0]["req_return"];
 $req_transiport = $request_details[0]["trans_id"];
 $missiion_duration = $request_details[0]["mission_n_days"];
 $principal_sansation = $request_details[0]["principal_sansation"];
 $request_submission_date = $request_details[0]["req_action_date"];




}





?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <style>
 *{
    
  }
  .row.pl-4{
   /* font-family: Crimson Text;*/
    font-size: 14px;
    margin-bottom: 15px;
    margin-top: 10px;
  }
  </style>


 <!--  <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico"> -->
 <!--  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet"> -->

  <!-- BEGIN VENDOR CSS-->

 <!--  <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">

  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/pages/invoice.css">

<link rel="stylesheet" type="text/css" href="../css/style.css">


<link rel="stylesheet" type="text/css" href="app-assets/css/customstyle/request-details.css"> -->
 

</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<?php // include('includes/header.php');?>
<?php // include_once('includes/hod/hod_leftbar.php');?>

 <!--  <div class="">
    <div class="content-wrapper">

      <div class="content-header row bg-primary">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Request details</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Request details</li>
              </ol>
            </div>
          </div>
        </div>
    
      </div> -->

      
      <div style="background: white;padding-top: 2px; color: black;" class="content-body container-fluid">



        <section  style="color: black" class="card">
        


       <form method="POST" id="staff-form-request" name="staff-form-report" >  
        <div class="container-fluid" id="report" >  
 <!-- 
               <div class="row">
               <div class="col-md-3 col-xs-3 col-3 pl-1  col-3 col-lg-3">
                   
                <img src="../images/UR-logo2.jpeg" width="100%" class=" ml-0 mx-auto ">
              </div>
            <div class="col-md-9 col-xs-9 col-9 col-9 col-lg-9 pr-0 pt-30 mr-0" >
                  <h4 style="margin-top: 5%;color: black;font-family: Crimson Text" class="float-right mr-1 "><b> COLLEGE OF SCIENCE AND TECHNOLOGY</b></h4>
            </div>
            </div>
            <hr style="border: 2px solid #3385ff;border-radius: 1px;" class="hol1">
           
            <div class="row mt-1 " >
                  <div class="col-12 mr-0 mx-auto"><h5 class="text-center text-body" style="font-size : 100%; color: #000000;font-family: Crimson Text" ; ><b>IN-COUNTRY MISSION AUTHORIZATION FORM</b></h5> </div>
            </div>
 -->





      <div class="row mx-auto mt-2">
               
        <div class="col-8 mx-auto text-center text-body">
        <span style="color: #000000" ><b>MISSION REPORT :</b><span id="request-id"><?php echo $Req_id; ?> </span></span>
            </div>
               
        </div>

     <div class="border border-secondary">
     
      <div class="row pl-4" >
        <div  class="col-lg-3 col-md-4 col-sm-4 col-xs-4">  <b><span class="blanked" style="color: #000000" ></span></b>&nbsp <span style="color: #000000" classs="blanked" ><b>DONE BY:  </b></span>
        </div>
        <div class="col-lg-9 col-md-7">
     
           <?php echo $staff_first_name." ".$staff_last_name."  "; ?>
             <span> signature</span>
           <span> <?php echo "signs" ?></span>
        </div>
        </div>

      <div class="row pl-4">  </div>

      <div class="row pl-4">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
      <b> </b> <span><b>SUBMITTED TO: </b> </span>
      </div>
      <div  class="col-lg-9 col-md-7">UR SPIU
      </div>
      </div>

      <div class="row pl-4">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
      <b></b> <span><b>Cc: </b> </span>
      </div>
      <div  class="col-lg-9 col-md-7 col-sm-8 col-xs-8 "><b>Principal CST</b>
      </div>
      </div>
      <hr>

      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b> </b> <span><b>DESTINATION:  </b> </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <?php echo $req_destination; ?>
      </div>
      </div>

       <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b> </b> <span><b>Date</b> </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <?php echo $request_submission_date." at ".$req_destination;  ?>
      </div>
      </div>
       <hr>


        <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b></b> <span><b>PURPOSE OF THE MISSION:  </b></span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <?php echo $req_purpose; ?>
      </div>
      </div>
      <hr>


      <div class="row pl-4">
      <div class="col-lg-5 col-md-6 col-sm-8 col-xs-12">
      <b></b> <span><b>MISSION OUTCOMES:  </b></span>
      </div><br>
      <div  class="form-group ml-lg-5 ml-md-4 ml-sm-2 ml-xm-0 col-lg-10 col-md-10 col-sm-10 col-xs-12">
     <textarea style="width: 100%;"  id="req-outcomes" name="req-purpose" placeholder="enter text- mission outcomes here"  row="4" title="Mission outcomes is mandatory" > </textarea>
     </div>
      </div>



      <div class="row pl-4">
      <div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <span><b>Enter destination arrival and departure date respectively</b></span>
      </div>
      </div>

       <div class="row pl-4">
      <div class="text-center col-lg-6 col-md-6 col-sm-6 col-xs-6">

     <input type="text" id="arrival-date" name="return-date" class="form-control" placeholder="YYYY-MM-DD" required 
      pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" 
      title="Enter arrival date in this format YYYY-MM-DD"/>
      </div>
      <div class="text-center col-lg-6 col-md-6 col-sm-6 col-xs-6">
   <input type="text" id="dep-date" name="return-date" class="form-control" placeholder="YYYY-MM-DD" required 
pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" 
title="Enter departure date in this format YYYY-MM-DD"/>
      </div>
      </div>


    <div class="row pl-4">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <span><b>Done on</b> </span> <?php echo "      ".date("Y-m-d"); ?>
    </div>      
   </div>


      </div>
    </div>


     

  <div class="text-center pt-1 "><button  type="button" onclick="SubmitMissionOutcomes()" class="btn btn-primary">Submit Report</button></div>
  </form>
       
 </section>        
    
      </div>
    </div>
    </div>
   
  
<!-- <?php// include('../includes/footer.php');?> -->
  <!-- BEGIN VENDOR JS-->
  <!-- <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script> -->
 <!--  <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>
 -->

  <script type="text/javascript">

  // stretch a text area height as too many lise get in

//   $('textarea').each(function () {
//   this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;'+2);
// }).on('input', function () {
//   this.style.height = 'auto';
//   this.style.height = (this.scrollHeight) + 'px';
// });

  // get current date and time

    function getDateTime(){
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;
    return dateTime;
    }

   // submitt a request form
  
    function SubmitMissionOutcomes(){   

    var req_id = <?php echo $Req_id; ?>;
    var current_date_time = getDateTime();
    var mission_out_comes = $('#req-outcomes').val();
    var arrival_date = $.trim($('#arrival-date').val());
    var departure_date = $.trim($('#dep-date').val());
    alert(departure_date);
    $.post("scripts/save-staff-mission-report.php",{req_id: req_id,current_date_time: current_date_time, mission_out_comes: mission_out_comes, arrival_date: arrival_date,departure_date: departure_date},
    function(data) {
   window.alert(data);
    });
}




  </script>


</body>
</html>


















