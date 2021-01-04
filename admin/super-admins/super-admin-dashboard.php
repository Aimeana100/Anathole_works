<?php
session_start();
// error_reporting(0);
include('../Classes/DBController.php');
include('../Classes/Staff_class.php');
include('../Classes/Requests_class.php');
include('../Classes/Notification_class.php');
include('../Classes/Organisation_class.php');
include('../Classes/Report_class.php');

$stf_role = 3;
// $_SESSION['role'];
$staf_id = 2;
// $_SESSION['stf_id'];

$college_id = 1;

// check authentication
$organisation = new Organisation();

// instantiate request
$request = new Request();
// $request_instance = $request->getAllRequestsByStaff($staf_id);
// getting data to pre-fill the form
$staff = new Staff();
$reports = new Report();

$staff_details = $staff->getStaffById($staf_id);
$staff_hod_details = $staff->getStaff_HODbyDept($staff_details[0]['dept_id']);
$staff_dean_details = $staff->getStaff_DeanbySchool($staff_details[0]['scl_id']);
$staff_principal_details = $staff->getStaff_Principalbycollege($staff_details[0]['coll_id']);
$staff_HR_details = $staff->getStaff_HRbycollege($staff_details[0]['coll_id']);

$All_college_requests = $request->getAllRequestsByCollege($college_id);
$All_college_staffs = $staff->getAllStaff_in_college($college_id);
$All_college_reports = $reports->getAllReportByCollegeId($college_id);
$All_host_Place = $request->getAllDestination();


//  echo json_encode(array("staff_id" =>$staff_details[0]["stf_id"], "depertement" => $staff_details[0]["dept_id"], "college_id" => $staff_details[0]['coll_id'])  );
$_SESSION['userlogin'] = isset($staff_details[0]['username']) ? $staff_details[0]['username'] : $staff_details[0]['stf_email'];
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
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet"> -->

  <!-- from jewerly -->
  <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">

  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <!-- <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/morris.css"> -->
  <link rel="stylesheet" type="text/css" href="../app-assets/fonts/simple-line-icons/style.css">



  <!-- <link rel="stylesheet" type="text/css" href="../includes/regform-36/css/add-new-staff.css"> -->
 <link rel="stylesheet" type="text/css" href="../app-assets/css/new-customized.css"> 


<script src="app-assets/js/scripts/html2canvas.js" type="text/javascript"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script> -->

 <!-- from jewery temperate -->
 <!-- boot table -->
 <link rel="stylesheet" type="text/css" href="css/data-table/bootstrap-table.css">
<!-- css -->
<link rel="stylesheet" type="text/css" href="css/style.css">

<link rel="stylesheet" href="css/font-awesome.min.css">


  <!-- forms -->
    <!-- modals CSS
		============================================ -->
    <!-- <link rel="stylesheet" href="css/modals.css"> -->
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">

    <!-- for select chosen -->
    <link rel="stylesheet" href="css/chosen/bootstrap-chosen.css">

    <!-- date picker -->
    <link rel="stylesheet" href="css/datapicker/datepicker3.css">

    <!-- notifications CSS
		============================================ -->
    <link rel="stylesheet" href="css/notifications/Lobibox.min.css">
    <link rel="stylesheet" href="css/notifications/notifications.css">

</head>

<body style="color: #000000" class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">



  <!-- fixed-top-->
   <?php include_once('principal-componets/principal_header.php'); ?>
 <!-- always at left -->
   <?php require_once('principal-componets/principal-left-bar.php');?>



  <div class="app-content content">
    <div sty class="content-wrapper">

    
    <div class="content-body">

        <!-- Revenue, Hit Rate & Deals -->
        <!-- all requests -->
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-sm-3  ">
            <div class="card pull-up">
              <div class="card-content">
                   <a href="admin-all-requests.php">
                <div class="card-body">
                  <div class="media d-flex">
                   <div class="media-body text-center">
                  <?php 

                    $college_requests = [];
                    $All_college_requests_number = 0;
                    if ($All_college_requests != null) {
                    foreach ($All_college_requests as $key => $value) {
                            $college_requests[] = $All_college_requests;                        
                    }
                    $All_college_requests_number =  count($college_requests);
                    
                    }
                  
                  ?>
                  <h2 class="success"><b><?php echo htmlentities($All_college_requests_number);?></b></h2>
                      <h4><b>All Requests</b></h4>
                    </div>
                    <div>
                 <i class="icon-book-open info font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-secondary" role="progressbar" style="width: 100%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="90"></div>
                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>

     <!-- Last Seven Days Complaints --->
    
          <div class="col-xl-3 col-lg-3 col-sm-3  ">
            <div class="card pull-up">
              <div class="card-content">
                <a href="admin-all-reports.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-center">
                  <?php 
                   $college_reports = [];
                   $All_college_reports_number = 0;
                   if ($All_college_reports != null) {
                   foreach ($All_college_reports as $key => $value) {
                           $college_requests[] = $All_college_reports;                        
                   }
                   $All_college_reports_number =  count($college_reports);
                   
                   }
                 
                         
            ?>
            <h2 class="success"> <b> <?php echo htmlentities($All_college_reports_number);?> </b></h2>
                                <h4><b>All Reports</b></h4>
                              </div>
                              <div>
              <i class="icon-notebook info font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar sm-gradient-x-secondary" role="progressbar" style="width: 100%"
                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                </a>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-3 col-sm-3  ">
            <div class="card pull-up">
              <div class="card-content">
                 <a href="admin-all-staffs.php">
                <div class="card-body">
                  <div class="media d-flex">
                              <div class="media-body text-center">
          <?php 
           
           $All_college_staffs_number = 0;
           if ($All_college_staffs != null) {
           foreach ($All_college_staffs as $key => $value) {
            $All_college_staffs_number ++;                        
           }
           }
          ?>

<h2 class="success"><b><?php echo htmlentities($All_college_staffs_number);?> </b></h2>
                      <h4><b>All Staffs</b></h4>
                    </div>
                    <div>
                      <i class="icon-user-follow info font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-secondary" role="progressbar" style="width: 100%"
                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>



          <div class="col-xl-3 col-lg-3 col-sm-3  ">
            <div class="card pull-up">
              <div class="card-content">
                 <a href="admin-all-host-places.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-center">
                    <?php 

                      $All_college_staffs_number = 0;
                      if ($All_host_Place != null) {
                      
                      $All_host_number =  count($All_host_Place);
                      
                      }
                      

                      ?>

           <h2 class="success"> <b><?php echo htmlentities($All_host_number);?></b></h2>
                      <h4><b>Destination Places</b></h4>
                    </div>
                    <div>
                      <i class="icon-direction info font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-secondary" role="progressbar" style="width: 100%"
                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>
                    
          </div>

          <!-- <a data-toogle="modal" data-target="#request-form" hre="#" > test</a> -->
       <div class="content-body">
          

         <!-- bar chart strart -->
            <!-- <div class="charts-area mg-tb-15">
            <div class="container-fluid">
                <div class="row">
                    
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="charts-single-pro mg-tb-30">
                            <div class="alert-title">
                                <h2>Line Chart Stepped</h2>
                                <p>A bar chart provides a way of showing data values. It is sometimes used to show trend data. we create a bar chart for a single dataset and render that in our page.</p>
                            </div>
                            <div id="stepped-chart">
                                <canvas id="linechartstepped"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="charts-single-pro">
                            <div class="alert-title">
                                <h2>Bar Chart vertical</h2>
                                <p>A bar chart provides a way of showing data values represented as vertical bars. It is sometimes used to show trend data, and the comparison of multiple data sets</p>
                            </div>
                            <div id="line2-chart">
                                <canvas id="barchart1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                   
            </div>
        </div> -->
        <!-- bar chart end -->

            

        </div>
        </div>
        </div>
  





    <!-- request details preview start -->
       <div  style="" id="edit-profile" class="container-fluid modal modal-adminpro-general fullwidth-popup-InformationproModal fadeIn " role="dialog">
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


<!-- <a data-toogle="modal" data-target="#request-form"> test</a>
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
     <?php// include_once("request-form.php"); ?>  
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div> -->



<!-- Report form modal start -->

<div class="modal fade bd-example-modal-lg1 add-report" id="mission-report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b> FILL A REPORT FORM</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="reporot-form-container">

     
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
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="../app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
  <script src="../app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
  <script src="../app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
  <script src="../app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
  <script src="../app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"
  type="text/javascript"></script>

  <!-- BEGIN MODERN JS-->

  <script src="../app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="../app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="../app-assets/js/scripts/customizer.js" type="text/javascript"></script>

  <!-- END MODERN JS-->

  <!-- js bootstrap table from jwrly template -->
  <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <!-- <script src="js/data-table/bootstrap-table-editable.js"></script> -->
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>

            <!-- datapicker JS
		============================================ -->
    <script src="js/datapicker/bootstrap-datepicker.js"></script>
    <script src="js/datapicker/datepicker-active.js"></script>
    <!-- input-mask JS
		============================================ -->
    <script src="js/input-mask/jasny-bootstrap.min.js"></script>
    <!-- chosen JS
		============================================ -->
    <script src="js/chosen/chosen.jquery.js"></script>
    <script src="js/chosen/chosen-active.js"></script>

    <!-- notifications -->
    <!-- notification JS
		============================================ -->
    <script src="js/notifications/Lobibox.js"></script>
    <script src="js/notifications/notification-active.js"></script>


    <!-- custom -->
  <script src="../app-assets/js/customJs.js" type="text/javascript"></script>

 <script>
  // function UpdateStaffInfo() {
  //   var dept = $.trim($("#departement").children(":selected").attr("id"));
  //   var staff_id = $("#Emp_id").val();
  //   var staff_username = $("#staff_username").val();
  //   var staff_fname=$("#first_name").val();
  //   var staff_lname=$("#last_name").val();
  //   var staff_gender=$("#gender").children(":selected").attr("value");
  //   var staff_position=$("#position").children(":selected").attr("id");
  //   var staff_tel=$("#telphone").val();
  //   var staff_email = $("#email").val();
  //   var position_id =$('#position').val();
  //   // alert(dept+staff_id+staff_fname+staff_lname+staff_gender+staff_position+staff_tel+staff_email+position_id);
    
  //   $.post("scripts/save-staff-profile-edited.php", { Emp_id: staff_id, first_name: staff_fname,  last_name: staff_lname, email: staff_email, telphone: staff_tel, gender: staff_gender, Position: staff_position, Department: dept, username: staff_username,update: true},
  //   function(data) {
  //       alert(data);
//          	$("#success-message").css("display","block")
//          	$("#success-message span").html(data);
//          	$("#myform")[0].reset();
//          	$(window).scrollTop(0)
//          	$("html, body").animate({
    //     scrollTop: $("#success-message").offset().top
    // }, 1000);
    // });
//      function BuildChart(labels, values, chartTitle) {
//          var ctx = document.getElementById("myChart").getContext('2d');
//          var myChart = new Chart(ctx, {
//              type: 'bar',
//              data: {
//              labels: labels, // Our labels
//       datasets: [{
//         label: chartTitle, // Name the series
//         data: values, // Our values
//         backgroundColor: [ // Specify custom colors
//           'rgba(255, 99, 132, 0.2)',
//           'rgba(54, 162, 235, 0.2)',
//           'rgba(255, 206, 86, 0.2)',
//           'rgba(75, 192, 192, 0.2)',
//           'rgba(153, 102, 255, 0.2)',
//           'rgba(255, 159, 64, 0.2)'
//         ],
//         borderColor: [ // Add custom color borders
//           'rgba(255,99,132,1)',
//           'rgba(54, 162, 235, 1)',
//           'rgba(255, 206, 86, 1)',
//           'rgba(75, 192, 192, 1)',
//           'rgba(153, 102, 255, 1)',
//           'rgba(255, 159, 64, 1)'
//         ],
//         borderWidth: 1 // Specify bar border width
//       }]
//     },
//     options: {
//       responsive: true, // Instruct chart js to respond nicely.
//       maintainAspectRatio: false, // Add to prevent default behavior of full-width/height 
//     }
//   });
//   return myChart;
// }



// var table = document.getElementById('table');
// var json = []; // First row needs to be headers 
// var headers =[];
// for (var i = 0; i < table.rows[0].cells.length; i++) {
//   headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi, '');
// }

// // Go through cells 
// for (var i = 1; i < table.rows.length; i++) {
//   var tableRow = table.rows[i];
//   var rowData = {};
//   for (var j = 0; j < tableRow.cells.length; j++) {
//     rowData[headers[j]] = tableRow.cells[j].innerHTML;
//   }

//   json.push(rowData);
// }

// // console.log(json);


// // Map JSON values back to label array
// var labels = json.map(function (e) {
//   return e.status;
// });
// console.log(labels); // ["2016", "2017", "2018", "2019"]

// // Map JSON values back to values array
// var values = json.map(function (e) {
//   return e.id;
// });
// console.log(values); // ["10", "25", "55", "120"]

// var chart = BuildChart(labels, values, "Id");



// var ctx = document.getElementById("barchart1").getContext('2d');
// 	var barchart1 = new Chart(ctx, {
//         type: 'bar',
// 		data: {
// 			labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
// 			datasets: [{
// 				label: 'Bar Chart',
// 				data: [12, 19, 3, 5, 2, 3],
// 				backgroundColor: [
// 					'rgba(255, 99, 132, 0.2)',
// 					'rgba(54, 162, 235, 0.2)',
// 					'rgba(255, 206, 86, 0.2)',
// 					'rgba(75, 192, 192, 0.2)',
// 					'rgba(153, 102, 255, 0.2)',
// 					'rgba(255, 159, 64, 0.2)'
// 				],
// 				borderColor: [
// 					'rgba(255,99,132,1)',
// 					'rgba(54, 162, 235, 1)',
// 					'rgba(255, 206, 86, 1)',
// 					'rgba(75, 192, 192, 1)',
// 					'rgba(153, 102, 255, 1)',
// 					'rgba(255, 159, 64, 1)'
// 				],
// 				borderWidth: 1
// 			}]
// 		},
// 		options: {
			// scales: {
			// 	xAxes: [{
			// 		ticks: {
			// 			autoSkip: false,
			// 			maxRotation: 0
			// 		},
			// 		ticks: {
			// 		  fontColor: "#fff", // this here
			// 		}
			// 	}],
			// 	yAxes: [{
			// 		ticks: {
			// 			autoSkip: false,
			// 			maxRotation: 0
			// 		},
			// 		ticks: {
			// 		  fontColor: "#fff", // this here
			// 		}
			// 	}]
			// }
		// }
    // });
    




  

     /*----------------------------------------*/
	/*  3.  Line Chart stepped
	/*----------------------------------------*/
	// var ctx = document.getElementById("linechartstepped");
	// var linechartstepped = new Chart(ctx, {
	// 	type: 'line',
	// 	data: {
	// 		labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6'],
	// 		datasets: [{
	// 			label: "steppedLine",
	// 			fill: false,
  //               backgroundColor: '#303030',
	// 			borderColor: '#303030',
	// 			data: [3, -5, -2, 3, 9, 12, 19]
  //           }]
	// 	},
	// 	options: {
	// 		responsive: true,
	// 		title: {
	// 			display: true,
	// 			text:'Line Chart stepped',
	// 		},
	// 		scales: {
	// 			xAxes: [{
	// 				ticks: {
	// 					autoSkip: false,
	// 					maxRotation: 0
	// 				},
	// 				ticks: {
	// 				  fontColor: "#fff", // this here
	// 				}
	// 			}],
	// 			yAxes: [{
	// 				ticks: {
	// 					autoSkip: false,
	// 					maxRotation: 0
	// 				},
	// 				ticks: {
	// 				  fontColor: "#fff", // this here
	// 				}
	// 			}]
	// 		}
	// 	}
	// });
  
  
  $(document).ready(function() {
    $('#table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
 </script>


</body>
</html>
<!-- <?php// endif;?>  -->