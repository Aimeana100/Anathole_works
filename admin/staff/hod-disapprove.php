<?php
session_start();
// error_reporting(0);
include('includes/config.php');
if(((strlen($_SESSION['userlogin'])==0) OR (!isset($_SESSION['stf_id']) ) OR  (strlen($_SESSION['dept_id'])==0))):
header('location:index.php');

else:
$HOD_dept=$_SESSION['stf_id'];
$HOD_id = $_SESSION['dept_id'];


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
  <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/morris.css">
  <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">

   <style>

    #username-profile{
      border-bottom: 3px solid #0044cc;
    }

     #username-profile:after{
    content:'';
    position: absolute;
    left: 0;
    right: 0;
    margin: 0 auto;
    width: 0;
    height: 0;
    border-top: 8px solid #0044cc;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;

     }
     
   </style>
    }

</head>
<body style="color: #000000" class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  <!-- fixed-top-->
   <?php include_once('includes/header.php');?>
   <!-- <p style="background: green; height: 30"></p> -->
  <!-- ////////////////////////////////////////////////////////////////////////////-->
 <?php include_once('includes/hod/hod_leftbar.php');?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <!-- Revenue, Hit Rate & Deals -->
       







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
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 

$sql ="SELECT requests.req_id as req_id, staffs_info.stf_id as stf_id, staffs_info.stf_fname as stf_fname,staffs_info.stf_lname as stf_lname, roles.role_name as role_id, departements.dept_name as dept_name, requests.req_departure as req_departure, requests.req_return as req_return, destination.des_name as destination, user_request.hod_sansation as req_hod_sansation FROM requests INNER JOIN user_request ON user_request.req_id = requests.req_id AND user_request.req_id IS NOT NULL AND user_request.hod_sansation = 1 JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id AND staffs_info.statuses = 1 INNER JOIN departements ON departements.dept_id = staffs_info.dept_id AND departements.dept_id = :departement INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id;";
// $sql = "SELECT tabl.req_id as dd from requests as tabl";
$query = $connt -> prepare($sql);
$query-> bindParam(':departement', $HOD_dept, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0):
foreach($results as $result):
      ?>

                      <tr>
                  <th scope="row"><?php echo htmlentities($cnt);?></th>
                  <td><?php echo htmlentities($result->stf_id);?></td>
                  <td><?php echo htmlentities($result->stf_fname);?></td>
                  <td><?php echo htmlentities($result->stf_lname);?></td>
                  <td><?php echo htmlentities($result->role_id);?></td>
                  <td><?php echo htmlentities($result->dept_name);?></td>
                  <td><?php echo htmlentities($result->req_departure);?></td>
                  <td><?php echo htmlentities($result->req_return);?></td>
<td><?php if($result->req_hod_sansation !=1):
echo htmlentities("Unread");
else:
 echo htmlentities("Read"); 
endif;
?></td>

                  <td><a href="request-details.php?Rid=<?php echo htmlentities($result->req_id);?>&hodId=<?php echo $_SESSION['hod_id']; ?>"><button type="button" class="btn btn-info btn-min-width btn-glow mr-1 mb-1">View Details</button></td>
                      </tr>
                      <?php
                      $cnt++;
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
        </div>
        <!-- Basic Tables end -->

             




        </div>
        </div></div></div>
       
<?php include('includes/footer.php');?>
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
  <script src="app-assets/data/jvector/visitor-data.js" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="app-assets/js/scripts/pages/dashboard-sales.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
</body>
</html>
<?php endif;?>