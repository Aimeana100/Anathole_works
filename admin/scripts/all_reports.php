<?php

$request = new Request();
$request_dept_instance = $request->getAllRequestsByDept($HOD_dept);

$staff = new Staff();
$staff_details = $staff->getStaffById($HOD_id);

 // instantiate reports
 $report = new Report();
 $all_dept_reports = $report->getAllReportByDept($HOD_id);

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
                        <th>Return</th>
                        <th>submited on</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 

                    $cnt=1;
                    if(!empty($all_dept_reports)):
                    foreach($all_dept_reports as $key => $value):
                    if($all_dept_reports[$key]["role_id"] != 7):
                    ?>
                      <tr>
                  <th scope="row"><?php echo htmlentities($cnt);?></th>
                  <td><?php echo htmlentities($all_dept_reports[$key]["stf_id"]);?></td>
                  <td><?php echo htmlentities($all_dept_reports[$key]["stf_fname"]);?></td>
                  <td><?php echo htmlentities($all_dept_reports[$key]["stf_lname"]);?></td>
                  <td><?php echo htmlentities($all_dept_reports[$key]["role_id"]);?></td>
                  <td><?php echo htmlentities($all_dept_reports[$key]["report_date"]);?></td>
                  <td><?php echo htmlentities($all_dept_reports[$key]["req_return"]);?></td>
                <td><?php if($all_dept_reports[$key]["req_hod_sansation"] !=1):
                echo htmlentities("Unread");
                else:
                echo htmlentities("Read"); 
                endif;
                ?></td>

                  <td><a href="request-details.php?Rid=<?php echo htmlentities($all_dept_reports[$key]["req_id"]);?>&hodId=<?php echo $_SESSION['hod_id']; ?>"><button type="button" class="btn btn-info btn-min-width btn-glow mr-1 mb-1">View Details</button></td>
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
            endif;?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Basic Tables end -->
        