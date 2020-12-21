<?php

$request = new Request();
$request_dept_instance = $request->getAllRequestsByDept($HOD_dept);

$staff = new Staff();
$staff_details = $staff->getStaffById($HOD_id);

?>


 <!-- Revenue, Hit Rate & Deals -->

 <div class="row">
          <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                   <a href="hod-disapprove.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
<?php 

$Pending_requests = array();
foreach($request_dept_instance as $key => $value){
if($request_dept_instance[$key]["hod_sansation"] == 2){
  $Pending_requests = $request_dept_instance;
}
}
 
$Pending_requests_number = count($Pending_requests);

?>
 <h3 class="info"><?php echo htmlentities($Pending_requests_number);?></h3>
                      <h6>Pending Requests</h6>
                    </div>
                    <div>
         <i class="icon-user-follow success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>

     <!-- Last Seven Days Complaints --->
    
          <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <a href="hod-approved.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
<?php

// $approved_requests = array();
$cnt=0;

foreach($request_dept_instance as $key => $value){
if(($request_dept_instance[$key]["hod_sansation"] == 1) AND ($request_dept_instance[$key]["role_id"] != 7)){
  // $approved_requests = $request_dept_instance;
  $cnt++;
}
}
 
// $approved_requests_number = count($approved_requests);


  ?>
 <h3 class="warning"><?php echo $cnt;?></h3>
                      <h6>Approved Requests</h6>
                    </div>
                    <div>
    <i class="icon-user-follow success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%"
                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                </a>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                 <a .php" >
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
  
  <?php

        $completed_requests = array();
        foreach($request_dept_instance as $key => $value){
        if($request_dept_instance[$key]["hod_sansation"] == 3){
          $completed_requests = $request_dept_instance;
        }
        }
        
        $completed_number = count($completed_requests);

 ?>

 <h3 class="success">
  <?php echo htmlentities($completed_number);?></h3>
        <h6>Completed Requests</h6>
          </div>
          <div>
          <i class="icon-user-follow success font-large-2 float-right"></i>
          </div>
          </div>
          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
          <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%"
                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                      
                    </div>
                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>          
          </div>



          
<!-- <button  type="button" class="btn btn-primary" id="btn-open-request-form" data-toggle="modal" data-target=".bd-example-modal-lg" >Add mission Request</button> -->



        <!-- Basic Tables start -->
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
              <div class="card-content collapse show">
                
                <p class="px-1">
                
                <div class="table-responsive">
                  <table class="table mb-0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>req ID</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Position</th>
                        <th>Depertement</th>
                        <th>Deperture</th>
                        <th>Return</th>
                        <th>Status</th>
                        <th colspan="2">Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 

$cnt=1;
if(!empty($request_dept_instance)):
foreach($request_dept_instance as $key => $value):
  if($request_dept_instance[$key]["role_id"] != 7):
  ?>
  <tr>
  <th scope="row"><?php echo htmlentities($cnt);?></th>
  <td><?php echo htmlentities($request_dept_instance[$key]["req_id"]);?></td>
  <td><?php echo htmlentities($request_dept_instance[$key]["stf_fname"]);?></td>
  <td><?php echo htmlentities($request_dept_instance[$key]["stf_lname"]);?></td>
  <td><?php echo htmlentities($request_dept_instance[$key]["role_name"]);?></td>
  <td><?php echo htmlentities($request_dept_instance[$key]["dept_name"]);?></td>
  <td><?php echo htmlentities($request_dept_instance[$key]["req_departure"]);?></td>
  <td><?php echo htmlentities($request_dept_instance[$key]["req_return"]);?></td>
  <td>
  <?php if($request_dept_instance[$key]["hod_sansation"] !=1):
  echo htmlentities("Unread");
else:
  echo htmlentities("Read");
endif;
?></td>
<td style="padding: 0px">
 <!-- <a href="hod-request-details.php?Rid=<?php// echo htmlentities($request_dept_instance[$key]["req_id"]);?>&hodId=<?php echo $HOD_id = $_SESSION['stf_id']; ?>"><button type="button" class="btn btn-info btn-min-width btn-glow mr-1 mb-1">View Details</button></a> -->

 <input data-target="#Request-view-details" req-id="<?php echo htmlentities($request_dept_instance[$key]["req_id"]) ?>" style="margin: 0px ;padding: 3px;" type="button" class="btn btn-info btn-glow hod-view-staff-request-details" value="View" data-toggle="modal" > 
  </td>
    <td style="padding: 0px">
     <a style="margin: 0px ;padding: 3px;" req-id="<?php echo htmlentities($request_dept_instance[$key]["req_id"]); ?>" tabindex="0"  class="btn btn-primary give-sansation" role="button" data-trigger="click">
Take action</a>
</td>
                      </tr>
                      <?php
                      $cnt++;
endif;
endforeach;
else: ?>
<tr>
<td colspan="5" style="color:red; font-size:22px;" align="center">No Record found</td>
</tr>
<?php  
endif;
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



