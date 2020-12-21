<?php
session_start();
// error_reporting(0);
include('includes/config.php');
if(((strlen($_SESSION['userlogin'])==0) OR (!isset($_SESSION['stfId']) ) OR  (strlen($_SESSION['stfId'])==0))):
header('location:index.php');


else:
$stf_role=$_SESSION['role'];
$staf_id = $_SESSION['stfId'];


$sql_staff ="SELECT * FROM staffs_info INNER JOIN departements ON departements.dept_id = staffs_info.dept_id AND staffs_info.stf_id = :staff_id INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON colleges.coll_id = schools.scl_id;";
// $sql = "SELECT tabl.req_id as dd from requests as tabl";
$query = $connt -> prepare($sql_staff);
$query-> bindParam(':staff_id', $staf_id, PDO::PARAM_STR);
$query->execute();
$staffresults=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0){
foreach($staffresults as $staffresult){
 $staff_id = $staffresult->stf_id;
 $staff_first_name = $staffresult->stf_fname;
 $staff_last_name = $staffresult->stf_lname;
 $staff_departement = $staffresult->dept_name;
 $staff_departement_id = $staffresult->dept_id;
 $staff_function = $staffresult->role_name;
 $staff_position_id = $staffresult->role_id;
 $staff_school= $staffresult->scl_name;
 $college_id = $staffresult->coll_id;
 $staff_gender = $staffresult->gender;
 $staff_username = $staffresult->username;
 $staff_email = $staffresult->stf_email;
 $staff_telphone = $staffresult->stf_tel_no;


}
}



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
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <title>URSTMS | MY Profile
  </title>

  <style>
 *{
    font-family: Crimson Text;
  }
  .row.pl-4{
    margin-bottom: 10px;
    margin-top: 10px;
  }
  #success-message, #danger-message {
    display: none; 
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
  <link rel="stylesheet" type="text/css" href="app-assets/css/new-customized.css">

<link rel="stylesheet" type="text/css" href="../css/style.css">

<link rel="stylesheet" type="text/css" href="app-assets/css/customstyle/request-details.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 -->

<!-- add a new staff css -->

 <link rel="stylesheet" type="text/css" href="includes/regform-36/css/add-new-staff.css">

</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">


<!-- fixed-top-->
<?php include_once('includes/staff_header.php');?>
<?php include_once('includes/staff/staff_sidebar.php');?>

  <div class="app-content content">
    <div style="padding-top: 10px;" class="content-wrapper">

      <div style="background: #0d0d0d" class="content-header row ">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 style="font-family: Anton;" class=" content-header-title mb-0 d-inline-block text-white">Add New Staff </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php"></a>
                </li>
                </li>
                <li class="breadcrumb-item active">MY Profile</li>
              </ol>
            </div>
          </div>
        </div>
    
      </div>

    <div id="success-message" class="text-center" id="message"> <span class="alert alert-success"  role="alert" ></span></div>
      
      <div style="background: white; border: 1px solid black; padding-bottom: 0px; padding-top: 0px" class="content-body container-fluid">

        <section  style="color: black; margin-top: 0px" class="card">

          <?php include('includes/regform-36/staff_profile_form.php'); ?>




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