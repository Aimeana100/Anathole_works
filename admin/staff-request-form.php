<?php
session_start();
// error_reporting(0);
include('includes/config.php');
// if sesion blank or unauthorized access this will redirect to admin login page
if(strlen($_SESSION['userlogin'])==0):
header('location:index.php');
// if session is valid
else:

$HOD_id=$_SESSION['hod_id']; 

// for updating read status of contact form
if(isset($_GET['Rid']))
{

$Req_id=$_GET['Rid'];
$isread=1;
$sql=" update  tblcontactdata set Is_Read=:isread where id=:cfid";
$query = $dbh->prepare($sql);
$query->bindParam(':cfid',$Req_id,PDO::PARAM_STR);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->execute();

}

// Admin remark Insertion

if(isset($_POST['submit']))
{

$Req_id=$_GET['Rid'];
$sensation =$_POST['send-action'];
$hod_comment = $_POST['action_comment'];
date_default_timezone_set('Asia/Kolkata');
$actiondate=date('Y-m-d G:i:s ', strtotime("now"));

$sql="UPDATE user_request set hod_id = :HOD_id, hod_comment = :hod_comment, hod_sansation = :hod_sansation, hod_action_date= :actiondate where req_id=:req_id;";
$query = $dbh->prepare($sql);
$query->bindParam(':HOD_id',$HOD_id,PDO::PARAM_STR);
$query->bindParam(':hod_sansation',$sensation ,PDO::PARAM_STR);
$query->bindParam(':hod_comment',$hod_comment,PDO::PARAM_STR);
$query->bindParam(':req_id',$Req_id,PDO::PARAM_STR);
$query->bindParam(':actiondate',$actiondate,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
  $msg="Leave updated Successfully";
} else {
    $error="Something went wrong please try again.";
}
}

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <title>Staff request details
  </title>

  <style>
 *{
    font-family: Crimson Text;
  }
  .row.pl-4{
    margin-bottom: 10px;
    margin-top: 10px;
  }
  </style>


  <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">

  <!-- BEGIN VENDOR CSS-->

  <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/pages/invoice.css">

<!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->


<link rel="stylesheet" type="text/css" href="app-assets/css/customstyle/request-details.css">


</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<?php include('includes/header.php');?>
<?php include('includes/leftbar.php');?>
  <div class="app-content content">
    <div class="content-wrapper">

      <div class="content-header row bg-primary">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Request details</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                </li>
                </li>
                <li class="breadcrumb-item active">Request details</li>
              </ol>
            </div>
          </div>
        </div>
    
      </div>
      
      <div style="background: white; border: 1px solid black" class="content-body container-fluid">

        <section  style="color: black" class="card">



        
  <div class="request" id="request" >
    
    <div id="request-content" style="padding: 10px" >
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

  <?php 

$sql ="SELECT staffs_info.stf_id as stf_id, staffs_info.stf_fname as stf_fname,staffs_info.stf_lname as stf_lname, roles.role_name as role_name, departements.dept_name as dept_name, requests.req_id as req_id, requests.req_purpose as req_purpose, requests.req_expected_result as exp_result, requests.req_departure as req_departure, requests.req_return as req_return, requests.req_action_date as action_date, destination.des_name as destination, transiport.trans_type as transiportation, user_request.hod_id as req_hod_sid, user_request.hod_sansation as req_hod_sansation, colleges.coll_id as coll_id FROM requests INNER JOIN user_request ON user_request.req_id = requests.req_id AND user_request.req_id IS NOT NULL INNER JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON colleges.coll_id = schools.scl_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id;";
// $sql = "SELECT tabl.req_id as dd from requests as tabl";
$query = $connt -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
// if($query->rowCount() > 0):
foreach($results as $result):

      ?>


            <div class="row mx-auto mt-2">
                
                <div class="col-8 mx-auto text-center text-body">
                <span style="color: #000000" ><b>  Mission Serial N<sup>o</sup>  &nbsp</b>   <?php echo $result->stf_id; ?>  </span> 
                </div>
                
              </div>


              <div class="row pl-4">
              <div  class="col-lg-4 col-md-4 col-sm-4 col-xs-4">  <b><span class="blanked" style="color: #000000" >1.</span></b>&nbsp <span style="color: #000000" classs="blanked" >Issued to </span>
              </div>
              <div class="col-lg-7 col-md-7"> <b> <?php echo $result->stf_fname." ".$result->stf_lname; ?></b>  <span> signature</span> <span> <?php echo "signs" ?> </span></div>
              </div>

              <div class="row pl-4">
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"> <span  class="blanked"> <b>2.</b></b> &nbsp <span class="blanked" >Department: </span>
              </div>
              <div  class="col-lg-7 col-md-7"><b><?php echo $result->dept_name; ?></b></div>
              </div>

              <div class="row pl-4">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><span style="color: #000000" class="blanked"><b>3.</b></span> &nbsp <span style="color: #000000" class="blanked"> Function: </span> 
              </div>
              <div class="col-lg-7 col-md-7 col-sm-7"><?php echo $result->role_name; ?></div>
             </div>

              <div class="row pl-4">
                    
                   <div  class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><span style="color: #000000"> <b>04.</b></span> <span style="color: #000000" > Purpose of the Mission :</span> 
                  </div>
                  <div class="col-lg-7 col-md-7  col-sm-7"><?php echo $result->req_purpose; ?></div>
               </div>

              <div class="row pl-4">
                  <div class="col-lg-4 col-md-4  col-sm-4 col-xs-4"><span style="color: #000000"><b> 05. </b><span style="color: #000000" > Expected results: </span>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7"><?php echo $result->exp_result; ?></div>
              </div>

                  <div class="row pl-4">
             <div class="col-lg-4 col-md-4  col-sm-4 col-xs-4"><span style="color:#000000"><b>06.</b></span > <span style="color: #000000"> Destination: </span> 
                </div>
                <div  class="col-lg-7 col-md-7 col-sm-7"><?php echo $result->destination; ?></div>
              </div>
            <div style="color: #000000" class="row pl-4">
                <div  class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>07.</b> <span> Departure date: </span> 
                  </div>
                <div  class="col-lg-7 col-md-7 col-sm-7"><?php echo $result->req_departure; ?></div>
              </div>

              <div  style="color: #000000" class="row pl-4">
                   <div  class="col-lg-4 col-md-4  col-sm-4 col-xs-4"><b>09.</b> <span>Returning date: </span> 
               </div>
               <div class="col-lg-7 col-md-7 col-sm-7"><?php echo $result->req_return; ?></div>
                 
              </div>

               <div style="color: #000000" class="row pl-4">
                   <div  class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>11. </b> <span>Transportation Means: </span >
                     </div>
                     <div  class="col-lg-7 col-md-7 col-sm-7"><?php echo $result->transiportation; ?></div>
                     <?php ?>
              </div>

              <div style="margin-bottom: 0px; color: #000000" class="row pl-4">
                   <div  class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
                     <b>14. </b> <span>Name of supervisor </span > 
                </div>

               <?php
              $supervisor_id = $result->req_hod_sid;
              $sql_superv="SELECT staffs_info.stf_fname as stf_fname, staffs_info.stf_lname as stf_lname FROM user_request INNER JOIN staffs_info ON staffs_info.stf_id = user_request.hod_id INNER JOIN requests ON requests.req_id = user_request.req_id AND requests.req_id = $Req_id;";
              $query_superv = $connt -> prepare($sql_superv);
              $query_superv->execute();
              $results_superv=$query_superv->fetchAll(PDO::FETCH_OBJ);
              if($query_superv->rowCount() > 0):
                foreach($results_superv as $supervisor):
              ?>
               

              <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                <?php echo $supervisor->stf_fname. " ".$supervisor->stf_lname; endforeach; endif; ?>
                <span><?php echo "signature"."  ";?></span> <span ><?php ?></span> 
                </div>
                </div>
                <div style="margin: 0px 0px 0px 6px" class="col-lg-5 col-md-5 col-sm-5 col-xs-12 row pl-4" ></div>
                


                <!-- <div id="signature"> <img id="img_siganture" src="img/logo/urlogo2.png"> </div> -->
              
              <div style="color: #000000" class="row pl-4">
                <div class="col">Done at  KIGALI on       
                  <strong><?php echo $result->action_date;  ?></strong>
              </div>   
              </div>

              <div id="hod_approver" class="row" >
                
                <div class="col-lg-5 col-md-5 col-sm-6"></div>
                <div class="col-lg-5 col-md-5 col-sm-6"></div>
                

              </div>


              <div style="color: #000000" class="row pl-4">
                  <div class="col-lg-12"><b><u> Authorized by VC/DVCs/ Principal or Campus Director of operations</u></b></div>
                </div>
              <?php
              // $principal_id = $result->req_principal_sid;
              $sql_principal="SELECT staffs_info.stf_fname as stf_fname, staffs_info.stf_lname as stf_lname FROM user_request INNER JOIN staffs_info ON staffs_info.stf_id = user_request.hod_id INNER JOIN requests ON requests.req_id = user_request.req_id AND requests.req_id = $Req_id;";
              $query_principal = $connt -> prepare($sql_principal);
              $query_superv->execute();
              $results_principal=$query_principal->fetchAll(PDO::FETCH_OBJ);
              if($query_principal->rowCount() > 0):
                foreach($results_principal as $principal):
              ?>
              

   
          <div class="row pl-4">
                <div class="col-8 mx-auto text-center">
                <span style="color: #000000" >

                <b>....<?php echo $results_principal->st_fname." ".$results_principal->st_lname. " ... Signature ..."." signs"; ?>;</b> </span> 
                <?php endforeach; endif; ?>
                </div>
                </div>

              <div class="row pl-4">        
              <div class=" col-lg-12 col-md-12 " >
                <b><u>Acknowledged by HR Office </u></b>....
               


              <?php 
            // $principal_id = $result->req_principal_sid;
            $is_active= 1;
            $HR_role_code = 4;
            $sql_HR="SELECT staffs_info.stf_fname as stf_fname, staffs_info.stf_lname as stf_lname FROM staffs_info INNER JOIN departements ON departements.dept_id = staffs_info.dept_id AND staffs_info.statuses = $is_active INNER JOIN roles ON roles.role_id = staffs_info.role_id AND roles.role_id = $HR_role_code INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON colleges.coll_id = schools.coll_id AND colleges.coll_id = $result->coll_id;";
            $query_HR = $connt -> prepare($sql_HR);
            $query_HR->execute();
            $results_HR=$query_HR->fetchAll(PDO::FETCH_OBJ);
            if($query_HR->rowCount() > 0):
              foreach($results_HR as $HR):
            ?>



              <?php $HR->stf_fname. " ".$HR->stf_fname; endforeach; endif;?><span> Signature  ...... </span>

            </div>
              </div>

              <div class="row pl-4">
                <div class="col-6"></div>
                <div class="col-6">
                  <div class="col-12"><b>Visa for Destination</b></div>
                  <div class="col-12"><b>Stamp and Signature</b></div>
                  <div class="col-12">Arrival Date .....</div>
                  <div class="col-12">Depature date</div>
                </div>
              </div>

          <!-- take action -->

              <div id="request-footer">
              <div class="row">
        
                <div class="col-md-8 col-sm-12 text-center">
                 <button type="button" class="btn btn-lg bg-blue text-white" data-toggle="modal"
                          data-target="#take-action">
                            Take Action on Request
                          </button>
    <div class="modal fade text-left" id="take-action" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12"
                          aria-hidden="true">

                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-primary white">
                                  <h3 class="modal-title white" id="myModalLabel12"><i class="la la-file"></i> Add admin remark here</h3>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div  class="modal-body">
                                  <h4 class="text-center" ><i class="la la-arrow-right"></i> Choose an Action</h4>
                                  <form name="remark" method="post">

                                  <div style="text-align: center;">

                                  <select style="color:black; display:inline-block; max-width: 200px;" class="form-control" name="status" required="">
                                <option value="">Choose your option</option>
                                <option value="1">Approved</option>
                                <option value="2">Not Approved</option>
                                  </select>
                                  </div>
                                </p>
                                    
                                  <p>
                              <textarea class="form-control" name="action_comment" rows="6" required>
                                
                              </textarea>
                                  </p>
                              
                                  <hr>
                            
                                </div>
                                <div class="modal-footer">

                                <input type="submit" class="waves-effect waves-light btn blue m-b-xs" name="update" value="Submit">

                                <button type="submit" name="submit" class="btn btn-outline-warning">Save changes</button> 
                              
                              </form>
                                </div>
                              </div>
                            </div>
                          </div>

                </div>
              </div>
            </div>

              


              
              <?php // $date=new DateTime(); echo $date->format('Y-m-d');  ?>

              <hr class=" mt-0" >
              </div>
  </div>

              <?php endforeach ?>

              </section>
    
            </div>
        
        


      </div>
    </div>
  
<?php include('includes/footer.php');?>
  <!-- BEGIN VENDOR JS-->
  <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>

</body>
</html>
<?php endif;?>