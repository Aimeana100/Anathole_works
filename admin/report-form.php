<?php
$Req_id = $_POST['req_id'];
// error_reporting(0);
include('Classes/DBController.php');
// include('../Classes/Staff_class.php');
include('Classes/Requests_class.php');
// include('../Classes/Notification_class.php');

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
      <div  class="form-group  col-lg-8 col-md-7 col-sm-6 col-xs-12">
     <textarea style="width: 100%; border: none;"  id="req-outcomes" name="req-purpose" placeholder="enter text- mission outcomes here"  row="4" title="Mission outcomes is mandatory" > </textarea>
     </div>
      </div>

      <!-- <div class="row pl-4"> -->
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <span><b>Enter destination arrival and departure date respectively</b></span>
      </div>
      <!-- </div> -->
 
      <div class="row pl-4 data-custon-pick data-custom-mg" id="data_5">
              
              <div class="input-daterange input-group" id="datepicker">
                  <input id="arrival-date" type="text" class="" name="start" value="01/01/202" />
                  <span class="input-group-addon ml-0 mr-0">to</span>
                  <input id="departure-date" type="text" class="" name="end" value="01/01/2021" />
              </div>
        </div>



    <div class="row pl-4">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <span><b>Done on</b> </span> <?php echo "      ".date("yy/mm/dd"); ?>
    </div>      
   </div>


      </div>
    </div>


     

  <div class="text-center pt-1 "><button  type="button" onclick="SubmitMissionOutcomes()" class="btn btn-primary">Submit Report</button></div>
  </form>
       
 </section>        
    
            <!-- datapicker JS
		============================================ -->
    <script src="../super-admins/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="../super-admins/js/datapicker/datepicker-active.js"></script>

  <script type="text/javascript">

  // stretch a text area height as too many lise get in

  $('textarea').each(function () {
  this.setAttribute('style', 'height:' +5+ (this.scrollHeight) + 'px;overflow-y:hidden; width:100%');
}).on('input', function () {
  this.style.height = 'auto';
  this.style.height = (this.scrollHeight) + 'px';
});

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
    var arrival_date = new Date($('#datepicker #arrival-date').val());
        arrival_date = arrival_date.getFullYear()+'-'+(arrival_date.getMonth()+1)+'-'+arrival_date.getDate();
    var departure_date = new Date($('#datepicker #departure-date').val());
        departure_date = departure_date.getFullYear()+'-'+(departure_date.getMonth()+1)+'-'+departure_date.getDate();
        // console.log(typeof(mission_out_comes));
        // console.log(typeof(arrival_date));
        // console.log((mission_out_comes.length));
      if(mission_out_comes.length < 5) {

      Lobibox.notify('error', {
      sound: false,
      size: 'large',
      width: 500,
      position: 'top right',
      msg: '<b>Fill the form before submit</b></br> outcomes fields should be meaningful'
  });
      }
      else
      {
    $.post("../scripts/save-staff-mission-report.php",{req_id: req_id,current_date_time: current_date_time, mission_out_comes: mission_out_comes, arrival_date: arrival_date,departure_date: departure_date},
    function(data) {

      ('#mission-report').modal('hide');
      JsonData = JSON.parse(data);
      console.log(JsonData);

      if(JsonData.success)
      {
        // hide the button clicked report to avoid re submut
    

      Lobibox.notify('success', {
      sound: false,
      size: 'large',
      width: 500,
      position: 'top right',
      msg: '<b>Successfully </b></br> Report sent'
      });
      }
      
    });
}
}




  </script>















