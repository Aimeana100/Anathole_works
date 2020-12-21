<?php
// error_reporting(0);
include('../Classes/DBController.php');
// include('../Classes/Staff_class.php');
include('../Classes/Report_class.php');
// include('../Classes/Notification_class.php');

$Req_id = $_POST['req_id'];


// $request = new Request();
// $request_details = $request->getRequestDeatailsByReq_id($Req_id);

$report = new Report();
$request_details = $report->getReportByReq_id($Req_id)[0];

if(isset($request_details)){
 
 $staff_first_name = $request_details["stf_fname"];
 $staff_last_name = $request_details["stf_lname"];
 $staff_departement = $request_details["dept_name"];
 $staff_function = $request_details["role_name"];
//  $staff_school= $request_details["scl_name"];
//  $college_id = $request_details["coll_id"];
 $req_purpose = $request_details["req_purpose"];
 $req_result = $request_details["req_expected_result"];
 $req_destination = $request_details["des_name"];
 $req_departure = $request_details["req_departure"];
 $req_return = $request_details["req_return"];
 $req_transiport = $request_details["trans_id"];
 $missiion_duration = $request_details["mission_n_days"];
 $principal_sansation = $request_details["principal_sansation"];

 $mission_date = $request_details["dest_arrival"];
 $report_submission_date = $request_details["report_date"];
 $mission_outcomes = $request_details["res_skills_gained"];
 }




?>

      
      <div style="background: white;padding-top: 2px; color: black;" class="content-body container-fluid">



        <section  style="color: black" class="card">
        


       <form method="POST" id="staff-form-report" name="staff-form-report" >  
        <div class="container-fluid" id="report">  


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
     
           <?php echo $staff_first_name." ".$staff_last_name; ?>
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
        <?php echo $mission_date." at ".$req_destination;  ?>
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
      <div  class="form-group  col-lg-8 col-md-7 col-sm-6 col-xs-12">
     <textarea style="width: 100%; border: none;"  id="req-outcomes" name="req-purpose" ><?php echo $mission_outcomes?> </textarea>
     </div>
      </div>

      <!-- <div class="row pl-4"> -->
      <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <span><b>Enter destination arrival and departure date respectively</b></span>
      </div> -->
      <!-- </div> -->
 
      <!-- <div class="row pl-4 data-custon-pick data-custom-mg" id="data_5">
              
              <div class="input-daterange input-group" id="datepicker">
                  <input id="arrival-date" type="text" class="" name="start" value="05/14/2014" />
                  <span class="input-group-addon ml-0 mr-0">to</span>
                  <input id="departure-date" type="text" class="" name="end" value="05/22/2014" />
              </div>
          </div> -->



    <div class="row pl-4">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <span><b>Done on</b> </span> <?php echo "      ".$report_submission_date ; ?>
    </div>      
   </div>


      </div>
    </div>


     

  <!-- <div class="text-center pt-1 "><button  type="button" onclick="SubmitMissionOutcomes()" class="btn btn-primary">Submit Report</button></div> -->
  </form>
       
 </section>        
    
            <!-- datapicker JS
		============================================ -->
    <script src="../super-admins/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="../super-admins/js/datapicker/datepicker-active.js"></script>

  <script type="text/javascript">

    </script>



