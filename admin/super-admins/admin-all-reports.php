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

// check authentication
$organisation = new Organisation();

// instantiate request
$request = new Request();
$request_instance = $request->getAllRequestsByStaff($staf_id);
// getting data to pre-fill the form
$staff = new Staff();
$staff_details = $staff->getStaffById($staf_id);
$staff_hod_details = $staff->getStaff_HODbyDept($staff_details[0]['dept_id']);
$staff_dean_details = $staff->getStaff_DeanbySchool($staff_details[0]['scl_id']);
$staff_principal_details = $staff->getStaff_Principalbycollege($staff_details[0]['coll_id']);
$staff_HR_details = $staff->getStaff_HRbycollege($staff_details[0]['coll_id']);

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
                   <a href="hod-disapprove.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-center">
<?php 
 
?>
 <h2 class="success"><b><?php echo htmlentities(9);?></b></h2>
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
                <a href="hod-approved.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-center">
<?php 

  ?>
 <h2 class="success"> <b> <?php echo htmlentities(3);?> </b></h2>
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
                 <a .php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-center">
<?php 

?>

<h2 class="success"><b><?php echo htmlentities(7);?> </b></h2>
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
                 <a .php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-center">
<?php 

?>

           <h2 class="success"> <b><?php echo htmlentities(7);?></b></h2>
                      <h4><b>Host Places</b></h4>
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


       <div class="content-body">
           <!-- table start -->

       <div class="data-table-area mg-tb-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1>Products <span class="table-project-n">Data</span> Table</h1>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar">
                                        <select class="form-control">
												<option value="">Export Basic</option>
												<option value="all">Export All</option>
												<option value="selected">Export Selected</option>
											</select>
                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="id">ID</th>
                                                <th data-field="name" data-editable="true">Product Title</th>
                                                <th data-field="company" data-editable="true">Stock</th>
                                                <th data-field="price" data-editable="true">Price</th>
												<th data-field="date" data-editable="true">Date</th>
												<th data-field="task" data-editable="true">Status</th>
												<th data-field="email" data-editable="true">Total Sales</th>
                                                <th data-field="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>18</td>
                                                <td>Product Title</td>
                                                <td>In Of Stock</td>
												<td>$5</td>
												<td>Jul 14, 2017</td>
                                                <td>Active</td>
												<td>$700</td>
                                                <td class="datatable-ct"><i class="fa fa-check"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>19</td>
                                                <td>Product Title</td>
                                                <td>In Of Stock</td>
												<td>$5</td>
												<td>Jul 14, 2017</td>
                                                <td>Active</td>
												<td>$700</td>
                                                <td class="datatable-ct"><i class="fa fa-check"></i>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- table end -->

         <!-- bar chart strart -->
            <div class="charts-area mg-tb-15">
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="charts-single-pro responsive-mg-b-30">
                            <div class="alert-title">
                                <h2>Bar Chart</h2>
                                <p>A bar chart provides a way of showing data values. It is sometimes used to show trend data. we create a bar chart for a single dataset and render that in our page.</p>
                            </div>
                            <div id="bar1-chart">
                                <canvas id="myChart"></canvas>
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
        </div>
        <!-- bar chart end -->

        


       <div class="">

            </div>
        </div>
        </div>
        </div>
  





    <!-- request details preview start -->

       <div  style="" id="Request-view-details" class="container-fluid modal modal-adminpro-general fullwidth-popup-InformationproModal fadeIn " role="dialog">
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
     <?php include_once("request-form.php"); ?>  
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- forms validation modal  -->

<div class="modal bg-light" id="validationModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal body -->
        <div id="validate-form-modal" class="modal-body">
        </div>
        
        <!-- Modal footer -->
         <div class="modal-header">
          <button id="btn-hide-validation-error-modal" type="button" class="close" data-dismiss="modal">&times;</button>
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

    

 <script>
     function BuildChart(labels, values, chartTitle) {
         var ctx = document.getElementById("myChart").getContext('2d');
         var myChart = new Chart(ctx, {
             type: 'bar',
             data: {
             labels: labels, // Our labels
      datasets: [{
        label: chartTitle, // Name the series
        data: values, // Our values
        backgroundColor: [ // Specify custom colors
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [ // Add custom color borders
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1 // Specify bar border width
      }]
    },
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behavior of full-width/height 
    }
  });
  return myChart;
}



var table = document.getElementById('table');
var json = []; // First row needs to be headers 
var headers =[];
for (var i = 0; i < table.rows[0].cells.length; i++) {
  headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi, '');
}

// Go through cells 
for (var i = 1; i < table.rows.length; i++) {
  var tableRow = table.rows[i];
  var rowData = {};
  for (var j = 0; j < tableRow.cells.length; j++) {
    rowData[headers[j]] = tableRow.cells[j].innerHTML;
  }

  json.push(rowData);
}

// console.log(json);


// Map JSON values back to label array
var labels = json.map(function (e) {
  return e.status;
});
console.log(labels); // ["2016", "2017", "2018", "2019"]

// Map JSON values back to values array
var values = json.map(function (e) {
  return e.id;
});
console.log(values); // ["10", "25", "55", "120"]

var chart = BuildChart(labels, values, "Id");



var ctx = document.getElementById("barchart1").getContext('2d');
	var barchart1 = new Chart(ctx, {
        type: 'bar',
		data: {
			labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
			datasets: [{
				label: 'Bar Chart',
				data: [12, 19, 3, 5, 2, 3],
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				],
				borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
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
		}
    });
    




    // for line chart
    

	 /*----------------------------------------*/
	/*  1.  Basic Line Chart
	/*----------------------------------------*/
	var ctx = document.getElementById("basiclinechart");
	var basiclinechart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["January", "February", "March", "April", "May", "June", "July"],
			datasets: [{
				label: "My First dataset",
				fill: false,
                backgroundColor: '#303030',
				borderColor: '#303030',
				data: [3, -5, -2, 3, 9, 12, 19]
            }, {
                label: "My Second dataset",
				fill: false,
                backgroundColor: '#03a9f4',
				borderColor: '#03a9f4',
				data: [-12, -3, -4, 6, 3, 7, 10]
				
		}]
		},
		options: {
			responsive: true,
			title:{
				display:true,
				text:'Basic Line Chart'
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
					ticks: {
						autoSkip: false,
						maxRotation: 0
					},
					ticks: {
					  fontColor: "#fff", // this here
					},
					scaleLabel: {
						display: true,
						labelString: 'Month'
					}
				}],
				yAxes: [{
					ticks: {
						autoSkip: false,
						maxRotation: 0
					},
					ticks: {
					  fontColor: "#fff", // this here
					},
					scaleLabel: {
						display: true,
						labelString: 'Value'
					}
				}]
			}
		}
	});
	
	 /*----------------------------------------*/
	/*  2.  Line Chart Multi axis
	/*----------------------------------------*/
	var ctx = document.getElementById("linechartmultiaxis");
	var linechartmultiaxis = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["January", "February", "March", "April", "May", "June", "July"],
			datasets: [{
				label: "My First dataset",
				fill: false,
                backgroundColor: '#303030',
				borderColor: '#303030',
				data: [3, -5, -2, 3, 9, 12, 19],
				yAxisID: "y-axis-1"
            }, {
                label: "My Second dataset",
				fill: false,
                backgroundColor: '#03a9f4',
				borderColor: '#03a9f4',
				data: [-12, -3, -4, 6, 3, 7, -20],
				yAxisID: "y-axis-2"
				
		}]
		},
		options: {
			responsive: true,
			hoverMode: 'index',
			stacked: false,
			title:{
				display: true,
				text:'Line Chart Multi Axis'
			},
			scales: {
				yAxes: [{
					type: "linear",
					display: true,
					position: "left",
					id: "y-axis-1",
				}, {
					type: "linear", 
					display: true,
					position: "right",
					id: "y-axis-2",
					gridLines: {
						drawOnChartArea: false,
					},
				}],
			}
		}
	});


     /*----------------------------------------*/
	/*  3.  Line Chart stepped
	/*----------------------------------------*/
	var ctx = document.getElementById("linechartstepped");
	var linechartstepped = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6'],
			datasets: [{
				label: "steppedLine",
				fill: false,
                backgroundColor: '#303030',
				borderColor: '#303030',
				data: [3, -5, -2, 3, 9, 12, 19]
            }]
		},
		options: {
			responsive: true,
			title: {
				display: true,
				text:'Line Chart stepped',
			},
			scales: {
				xAxes: [{
					ticks: {
						autoSkip: false,
						maxRotation: 0
					},
					ticks: {
					  fontColor: "#fff", // this here
					}
				}],
				yAxes: [{
					ticks: {
						autoSkip: false,
						maxRotation: 0
					},
					ticks: {
					  fontColor: "#fff", // this here
					}
				}]
			}
		}
	});
	
 </script>


</body>
</html>
<!-- <?php// endif;?>  -->