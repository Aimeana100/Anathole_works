<?php
session_start();
// error_reporting(0);
include('includes/config.php');
if(((strlen($_SESSION['userlogin'])==0) OR (!isset($_SESSION['stf_id']) ) OR  (strlen($_SESSION['dept_id'])==0))):
header('location:index.php');

else:
$HOD_dept =$_SESSION['dept_id'];
$HOD_id = $_SESSION['stf_id'];

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>Contact Form Admin | Dashboard</title>
 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">

 

  <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">

  <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/morris.css">
  <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/new-customized.css">
<!--   
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> -->

   <style>
   
   </style>

</head>
<body style="color: #000000" class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  <!-- fixed-top-->


   <?php include_once('includes/header.php');?>
 <?php include_once('includes/hod/hod_leftbar.php');?>


  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">

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
$sql = "SELECT requests.req_id FROM requests INNER JOIN user_request ON requests.req_id = user_request.req_id AND user_request.hod_sansation = 2 AND requests.req_status = 1 INNER JOIN staffs_info ON user_request.stf_id = staffs_info.stf_id AND staffs_info.statuses =1 INNER JOIN departements ON staffs_info.dept_id = departements.dept_id AND departements.dept_id = :departement";
$query = $connt -> prepare($sql);
$query-> bindParam(':departement', $HOD_dept, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$Pending_requests=$query->rowCount() 
?>
 <h3 class="info"><?php echo htmlentities($Pending_requests);?></h3>
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

$sql = "SELECT requests.req_id FROM requests INNER JOIN user_request ON requests.req_id = user_request.req_id AND user_request.hod_sansation = 1 AND requests.req_status = 1 INNER JOIN staffs_info ON user_request.stf_id = staffs_info.stf_id AND staffs_info.statuses =1 INNER JOIN departements ON staffs_info.dept_id = departements.dept_id AND departements.dept_id = :departement;";
$query = $connt -> prepare($sql);

  $query-> bindParam(':departement', $HOD_dept, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$approved_requests=$query->rowCount() 
  ?>
 <h3 class="warning"><?php echo htmlentities($approved_requests);?></h3>
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
 $sql = "SELECT requests.req_id FROM requests INNER JOIN user_request ON requests.req_id = user_request.req_id AND requests.progress = 3 AND requests.req_status = 1 INNER JOIN staffs_info ON user_request.stf_id = staffs_info.stf_id AND staffs_info.statuses =1 INNER JOIN departements ON staffs_info.dept_id = departements.dept_id AND departements.dept_id = :departement;";
 $query = $connt -> prepare($sql);

  $query-> bindParam(':departement', $HOD_dept, PDO::PARAM_STR);
 $query->execute();
 $results=$query->fetchAll(PDO::FETCH_OBJ);
 $approved_requests=$query->rowCount()
 ?>

 <h3 class="success">
  <?php echo htmlentities($approved_requests);?></h3>
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



          
<button type="button" class="btn btn-primary" id="btn-open-request-form" data-toggle="modal" data-target=".bd-example-modal-lg" >Add mission Request</button>





<div class="modal-body">


       <form method="POST" id="staff-form-request" name="staff-form-request" >  
        <div class="container-fluid" id="request" >  
 
               <div class="row">
               <div class="col-md-3 col-xs-3 col-3 pl-1  col-3 col-lg-3"> 
                    
                <img src="../images/UR-logo2.jpeg" width="100%" class=" ml-0 mx-auto "> 
              </div>
            <div class="col-md-9 col-xs-9 col-9 col-9 col-lg-9 pr-0 pt-30 mr-0" >
                  <h4 style="margin-top: 5%;color: black;font-family: Crimson Text" class="float-right mr-1 "><b> COLLEGE OF SCIENCE AND TECHNOLOGY</b></h4>
            </div>
            </div>
            <hr style="border: 2px solid #3385ff;border-radius: 1px;" class="hol1">


            <div id="display-error" class="bg-light text-center" style="top: 50%;margin-left: auto; position: relative;z-index: 50;border: 1px solid red"></div>

            
            <div class="row mt-1 " >
                  <div class="col-12 mr-0 mx-auto"><h5 class="text-center text-body" style="font-size : 100%; color: #000000;font-family: Crimson Text" ; ><b>IN-COUNTRY MISSION AUTHORIZATION FORM</b></h5> </div>
            </div>

      <div class="row mx-auto mt-2">
                
        <div class="col-8 mx-auto text-center text-body">
        <span style="color: #000000" ><b>  Mission Serial N<sup>o</sup>  &nbsp</b>  
             ........
          </span> 
            </div>
                
        </div>


     
      <div class="row pl-4">
        <div  class="col-lg-2 col-md-4 col-sm-4 col-xs-6">  <b><span class="blanked" style="color: #000000" >1.</span></b>&nbsp <span style="color: #000000" classs="blanked" >Issued to </span>
        </div>
        <div class="col-lg-10 col-md-7 col-sm-8 col-xs-6"> 
          <b> 
           <?php echo $staff_first_name." ".$staff_last_name."  "; ?> </b>
             <span> signature</span>
           <span> <?php echo "signs" ?></span>
        </div>
        </div>

      <div class="row pl-4">  </div>

      <div class="row pl-4">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
      <b>2. </b> <span>Department: </span>
      </div>
      <div  class="col-lg-9 col-md-7"><b><?php echo $staff_departement." / ".$staff_school ; ?></b>
      </div>
      </div>

      <div class="row pl-4">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
      <b>3. </b> <span>Function: </span>
      </div>
      <div  class="col-lg-9 col-md-7 col-sm-8 col-xs-8 "><b><?php echo $staff_function; ?></b>
      </div>
      </div>

      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>04. </b> <span>Purpose of the Mission </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <textarea style="width: 100%"  id="req_purpose" name="req-purpose" row="2" cols="" title="purpose is mandatory" > </textarea>
      </div>
      </div>

       <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>05. </b> <span>Expected Result </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <textarea style="width: 100%" id="exp-result" name="exp-result" col="5" row="2" cols="" title="expected result is mandatory" > </textarea>
      </div>
      </div>


       <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>06. </b> <span> Destination </span>
      </div>

      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">

      <select class="form-control col-6" id="destination" name="destination" >
      <option value="" disabled="true" > ..select the destination.. </option>

          <?php
          $sql ="SELECT * FROM destination";
        $query = $connt -> prepare($sql);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0):
        foreach($results as $dest_result):
            ?>
        <option value="<?php echo $dest_result->des_id;?>">
         <?php echo $dest_result->des_name; ?> </option>

       <?php endforeach; endif ?>

        </select>
        
      </div>
      </div>


       <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>07. </b> <span>Distance in KM (to and from) </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <span><input class="form-control col-6" id="distance-of-travel" type="number" name="distance-of-travel" placeholder="........"></span>
        
      </div>
      </div>


      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>08. </b> <span>Departue date </span>
      </div>
      <div  class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">

        <input type="text" id="departure-date" name="departure-date" class="date-picker form-control" placeholder="YYYY-MM-DD" required 
pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" 
title="Enter a date in this format YYYY-MM-DD"/>

      </div>
      </div>


      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>09. </b> <span>Return date </span>
      </div>
      <div  class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">

        <input type="text" id="return-date" name="return-date" class="form-control" placeholder="YYYY-MM-DD" required 
pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" 
title="Enter a date in this format YYYY-MM-DD"/>

        
     </div>
      <input type="text"  class="form-control" name="dept_date" id="dept_date">


      </div>


      <div class="row pl-4">
      <div class="col-lg-6 col-md-8 col-sm-8 col-xs-11">
      <b>10. </b> <span> Duration of the mission (Number of days)</span>
      </div>
      <div  class="col-lg-6 col-md-6 col-sm-4 col-xs-8">
        <input class="form-control col-lg-4 col-md-6 "  id="mission-duration" type="number" name="mission-duration" min="1" placeholder="00">
      </div>
      </div>



      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>11. </b> <span>Transiportaton  means </span>
      </div>

      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <div class="col-12">
      <label style="padding: 4px;" class="co-4 " ><input type="radio" value="1" name="transiportation">public </label>
      <label style="padding: 4px;" class="co-4 " ><input type="radio" value="2" name="transiportation">private </label>
      <label style="padding: 4px;" class="co-4 " ><input type="radio" value="3" name="transiportation">provided </label>
      </div>

  
      </div>
      </div>



      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>12. </b> <span>Vehicle Identification </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
      <span>.............</span>
        
      </div>
      </div>


      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>13. </b> <span> Name of Driver </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
      <span>.............</span>
        
      </div>
      </div>




        <div class="row pl-4">
        <div  class="col-lg-4 col-md-4 col-sm-4 col-xs-4">  <b><span class="blanked" style="color: #000000" >14.</span></b>&nbsp <span style="color: #000000" classs="blanked" >Name of Supervisor </span>
        </div>
        <div class="col-lg-8 col-md-7 col-sm-8"> 
          <b> 


          <?php echo $supervisor_first_name." ".$supervisor_last_name."  "; ?> </b>
          <span> signature</span>
           <span> <?php echo "signs" ?></span>

            
        </div>
        </div>

       



        <div class="row pl-4">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <b>15. </b> <span> <b><u> Authorized by VC/DVCs/ Principal or Campus Director of operations </u></b> </span>
      </div>
      <div  class="text-center mt-1 col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <b>
         <?php echo $principal_first_name." ".$principal_last_name." " ; ?> </b>
          <span> signature</span>
           <span> <?php echo "signs" ?></span>
        </div>
        
      </div>
      

        <div class="row pl-4">
        <div  class="col-lg-4 col-md-4 col-sm-4 col-xs-4">  <b><span class="blanked" style="color: #000000" >16.</span></b>&nbsp <span style="color: #000000" classs="blanked" ><u><b>Acknowledged by HR </b></u> </span>
        </div>
        <div class="col-lg-8 col-md-7 col-sm-8"> 
          <b> 
          <?php echo $HR_first_name." ".$HR_last_name."  "; ?> </b>
          <span> signature</span>
           <span> <?php echo "signs" ?></span>
        </div>
        </div>


        <div class="row pl-4">
          <div class="col-lg-6 col-md-4 col-sm-2 col-xs-12"></div>
          <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                  <div class="col-12 pt-1 "><b>Visa for Destination</b></div>
                  <div class="col-12  "><b>Stamp and Signature</b></div>
                  <div class="col-12 pt-1 ">Arrival Date .....</div>
                  <div class="col-12 pt-1 ">Depature date ..... .</div>
            
          </div>
        </div>

  
    </div>


    
  <div class="text-center"><button  type="button" onclick="SubmitFormRequest()" class="btn btn-primary">Submit request</button></div>
 
  </form>
      </div>









    <!-- Basic Tables end -->

      <div  style="" id="Request-view-details" class="container-fluid modal modal-adminpro-general fullwidth-popup-InformationproModal fadeIn " role="dialog">
       <div class="modal-dialog modal-lg " role="document" >
          <div class="modal-content">
        <div style="margin: 0px" class="modal-header">
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

          </div>
        </div>
      </div>
    </div>
       
<?php include('includes/footer.php'); ?>


<!-- request form modal start -->



<div class="modal fade bd-example-modal-lg" id="request-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>REQUEST FORM</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


       <form method="POST" id="staff-form-request" name="staff-form-request" >  
        <div class="container-fluid" id="request" >  
 
               <div class="row">
               <div class="col-md-3 col-xs-3 col-3 pl-1  col-3 col-lg-3"> 
                    
                <img src="../images/UR-logo2.jpeg" width="100%" class=" ml-0 mx-auto "> 
              </div>
            <div class="col-md-9 col-xs-9 col-9 col-9 col-lg-9 pr-0 pt-30 mr-0" >
                  <h4 style="margin-top: 5%;color: black;font-family: Crimson Text" class="float-right mr-1 "><b> COLLEGE OF SCIENCE AND TECHNOLOGY</b></h4>
            </div>
            </div>
            <hr style="border: 2px solid #3385ff;border-radius: 1px;" class="hol1">


            <div id="display-error" class="bg-light text-center" style="top: 50%;margin-left: auto; position: relative;z-index: 50;border: 1px solid red"></div>

            
            <div class="row mt-1 " >
                  <div class="col-12 mr-0 mx-auto"><h5 class="text-center text-body" style="font-size : 100%; color: #000000;font-family: Crimson Text" ; ><b>IN-COUNTRY MISSION AUTHORIZATION FORM</b></h5> </div>
            </div>

      <div class="row mx-auto mt-2">
                
        <div class="col-8 mx-auto text-center text-body">
        <span style="color: #000000" ><b>  Mission Serial N<sup>o</sup>  &nbsp</b>  
             ........
          </span> 
            </div>
                
        </div>


     
      <div class="row pl-4">
        <div  class="col-lg-2 col-md-4 col-sm-4 col-xs-6">  <b><span class="blanked" style="color: #000000" >1.</span></b>&nbsp <span style="color: #000000" classs="blanked" >Issued to </span>
        </div>
        <div class="col-lg-10 col-md-7 col-sm-8 col-xs-6"> 
          <b> 
           <?php echo $staff_first_name." ".$staff_last_name."  "; ?> </b>
             <span> signature</span>
           <span> <?php echo "signs" ?></span>
        </div>
        </div>

      <div class="row pl-4">  </div>

      <div class="row pl-4">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
      <b>2. </b> <span>Department: </span>
      </div>
      <div  class="col-lg-9 col-md-7"><b><?php echo $staff_departement." / ".$staff_school ; ?></b>
      </div>
      </div>

      <div class="row pl-4">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
      <b>3. </b> <span>Function: </span>
      </div>
      <div  class="col-lg-9 col-md-7 col-sm-8 col-xs-8 "><b><?php echo $staff_function; ?></b>
      </div>
      </div>

      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>04. </b> <span>Purpose of the Mission </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <textarea style="width: 100%"  id="req_purpose" name="req-purpose" row="2" cols="" title="purpose is mandatory" > </textarea>
      </div>
      </div>

       <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>05. </b> <span>Expected Result </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <textarea style="width: 100%" id="exp-result" name="exp-result" col="5" row="2" cols="" title="expected result is mandatory" > </textarea>
      </div>
      </div>


       <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>06. </b> <span> Destination </span>
      </div>

      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">

      <select class="form-control col-6" id="destination" name="destination" >
      <option value="" disabled="true" > ..select the destination.. </option>

          <?php
          $sql ="SELECT * FROM destination";
        $query = $connt -> prepare($sql);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0):
        foreach($results as $dest_result):
            ?>
        <option value="<?php echo $dest_result->des_id;?>">
         <?php echo $dest_result->des_name; ?> </option>

       <?php endforeach; endif ?>

        </select>
        
      </div>
      </div>


       <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>07. </b> <span>Distance in KM (to and from) </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <span><input class="form-control col-6" id="distance-of-travel" type="number" name="distance-of-travel" placeholder="........"></span>
        
      </div>
      </div>


      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>08. </b> <span>Departue date </span>
      </div>
      <div  class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">

        <input type="text" id="departure-date" name="departure-date" class="date-picker form-control" placeholder="YYYY-MM-DD" required 
pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" 
title="Enter a date in this format YYYY-MM-DD"/>

      </div>
      </div>


      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>09. </b> <span>Return date </span>
      </div>
      <div  class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">

        <input type="text" id="return-date" name="return-date" class="form-control" placeholder="YYYY-MM-DD" required 
pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" 
title="Enter a date in this format YYYY-MM-DD"/>

        
     </div>
      <input type="text"  class="form-control" name="dept_date" id="dept_date">


      </div>


      <div class="row pl-4">
      <div class="col-lg-6 col-md-8 col-sm-8 col-xs-11">
      <b>10. </b> <span> Duration of the mission (Number of days)</span>
      </div>
      <div  class="col-lg-6 col-md-6 col-sm-4 col-xs-8">
        <input class="form-control col-lg-4 col-md-6 " id="mission-duration" type="number" name="mission-duration" min="1" placeholder="00">
      </div>
      </div>



      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>11. </b> <span>Transiportaton  means </span>
      </div>

      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <div class="col-12">
      <label style="padding: 4px;" class="co-4 " ><input type="radio" value="1" name="transiportation">public </label>
      <label style="padding: 4px;" class="co-4 " ><input type="radio" value="2" name="transiportation">private </label>
      <label style="padding: 4px;" class="co-4 " ><input type="radio" value="3" name="transiportation">provided </label>
      </div>

  
      </div>
      </div>



      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>12. </b> <span>Vehicle Identification </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
      <span>.............</span>
        
      </div>
      </div>


      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>13. </b> <span> Name of Driver </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
      <span>.............</span>
        
      </div>
      </div>




        <div class="row pl-4">
        <div  class="col-lg-4 col-md-4 col-sm-4 col-xs-4">  <b><span class="blanked" style="color: #000000" >14.</span></b>&nbsp <span style="color: #000000" classs="blanked" >Name of Supervisor </span>
        </div>
        <div class="col-lg-8 col-md-7 col-sm-8"> 
          <b> 


          <?php echo $supervisor_first_name." ".$supervisor_last_name."  "; ?> </b>
          <span> signature</span>
           <span> <?php echo "signs" ?></span>

            
        </div>
        </div>

       



        <div class="row pl-4">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <b>15. </b> <span> <b><u> Authorized by VC/DVCs/ Principal or Campus Director of operations </u></b> </span>
      </div>
      <div  class="text-center mt-1 col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <b>
         <?php echo $principal_first_name." ".$principal_last_name." " ; ?> </b>
          <span> signature</span>
           <span> <?php echo "signs" ?></span>
        </div>
        
      </div>
      

        <div class="row pl-4">
        <div  class="col-lg-4 col-md-4 col-sm-4 col-xs-4">  <b><span class="blanked" style="color: #000000" >16.</span></b>&nbsp <span style="color: #000000" classs="blanked" ><u><b>Acknowledged by HR </b></u> </span>
        </div>
        <div class="col-lg-8 col-md-7 col-sm-8"> 
          <b> 
          <?php echo $HR_first_name." ".$HR_last_name."  "; ?> </b>
          <span> signature</span>
           <span> <?php echo "signs" ?></span>
        </div>
        </div>


        <div class="row pl-4">
          <div class="col-lg-6 col-md-4 col-sm-2 col-xs-12"></div>
          <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                  <div class="col-12 pt-1 "><b>Visa for Destination</b></div>
                  <div class="col-12  "><b>Stamp and Signature</b></div>
                  <div class="col-12 pt-1 ">Arrival Date .....</div>
                  <div class="col-12 pt-1 ">Depature date ..... .</div>
            
          </div>
        </div>

  
    </div>


    
  <div class="text-center"><button  type="button" onclick="SubmitFormRequest()" class="btn btn-primary">Submit request</button></div>
 
  </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>






<div class="modal fade bd-example-modal-lg" id="request-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>REQUEST FORM</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



    </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>

  </div>
  </div>
  </div>









  <!-- BEGIN VENDOR JS-->
  <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>

  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->

  <script src="app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"
  type="text/javascript"></script>
   <!-- <script src="app-assets/data/jvector/visitor-data.js" type="text/javascript"></script> -->

  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->

  <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>

  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <!-- <script src="app-assets/js/scripts/pages/dashboard-sales.js" type="text/javascript"></script> -->
  <!-- END PAGE LEVEL JS-->

  <script type="text/javascript">
    
         $('.view-request-details').click(function(){  
           var reqId = $(this).attr("req-id");
           var hod_id = <? echo $HOD_id; ?>;
           $.ajax({  
                url:"scripts/hod-request-details.php",  
                method:"post",  
                data:{req_id:reqId, hod_id:hod_id},
                success:function(data){  
                      $('#request_detail').html(data);  
                      // $('#dataModal').modal("show");  
                 }  
           });  
      });

  </script>


  <script type="text/javascript">

   // $('[data-toggle="popover"]').popover('hide');
    // $('.give-sansation').click(function(){
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
    var hod_id = <? echo $HOD_id; ?>

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
 // });

    function DoActionOnRequest(){
    var hod_id = $('#Req-Hod-Ids').attr("hod_id");
    var req_id = $('#Req-Hod-Ids').attr("req_id");;
    window.console.log(hod_id+"  "+req_id);
    var hod_comment=$('#action_comment').val();
    var hod_sansation=$('#hod_sansation').children(":selected").attr("value");
    $.post("scripts/hod-action-on-request.php",{req_id: req_id,hod_comment: hod_comment, hod_sansation: hod_sansation,hod_id:hod_id},
    function(data) {
   window.alert(data);
    });
}

  
var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#dept_date').datepicker({
          format: 'yyyy-mm-dd',
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            minDate: today,
            maxDate: function () {
                return $('#return_date').val();
            }
        });
        $('#return_date').datepicker({
          format: 'yyyy-mm-dd',
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            minDate: function () {
                return $('#dept_date').val();
            }
        }); 



        unction SubmitFormRequest() {
    var errors = [];
    var stf_id = <? echo $staf_id ?>;
    var supervisor_id  = <? echo  $supervisor_id ?>;
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
      if (data != false) {
        $('#table-data-rows').prepend(data);
        // $('#staff-form-request')[0].reset();
        window.alert(data);

      }
    });
  }
  
}

</script>






</body>
</html>
<?php endif;?>