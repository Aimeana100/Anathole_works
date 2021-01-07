<?php
if(!isset($_GET['view'])){
  session_start();
$Req_id = $_POST['req_id'];
include('../Classes/DBController.php');
include('../Classes/Staff_class.php');
include('../Classes/Requests_class.php');
include('../Classes/Notification_class.php');

}
// error_reporting(0);
// $staf_id = $_POST['staf_id'];
if(isset($_GET['view']))
{
$Req_id = $_GET['view'];

include('../pdf.php');

if(isset($_POST['download']))
{
  $doc = new DomDocument;
  
  echo "done";

}
}




$staff = new Staff();
$request = new Request();

$request_details = $request->getRequestDeatailsByReq_id($Req_id);

$statt_details = $staff->getStaffById($request_details[0]['stf_id']);
$staff_hod_details = $staff->getStaff_HODbyDept($statt_details[0]['dept_id']);
$staff_dean_details = $staff->getStaff_DeanbySchool($statt_details[0]['scl_id']);
$staff_principal_details = $staff->getStaff_Principalbycollege($statt_details[0]['coll_id']);
$staff_HR_details = $staff->getStaff_HRbycollege($statt_details[0]['coll_id']);


// $sql_update_notification = "UPDATE action_notifications SET hod_sansation_notification = 1, dean_sansation_notification = 1, principal_sansation_notification = 1  WHERE action_notifications.req_id= :req_id";
// $query_update = $connt->prepare($sql_update_notification);
// $query_update->bindParam(':req_id',$Req_id,PDO::PARAM_STR);
// $query_update->execute();

?>

  <div class="">
    <div class="content-wrapper">


   <div id="testh2c" style="background: white;padding-top: 2px; color: black; border: 1px solid black" class="content-body container-fluid">


        <section class="card">




        <form class="" method="POST" id="staff-form-request" name="staff-form-request" >  
        <div style="color: black" class="container-fluid" id="request" >  
 
         <div class="row">
          <div class="col-md-3 col-xs-3 col-3 pl-1  col-3 col-lg-3"> 
                    
          <img src="../../images/UR-logo2.jpeg" width="100%" class=" ml-0 mx-auto "> 
            </div>
            <div class="col-md-9 col-xs-9 col-9 col-9 col-lg-9 pr-0 pt-30 mr-0" >
                  <h4 style="margin-top: 5%;color: black;font-family: Crimson Text" class="float-right mr-1 "><b> COLLEGE OF SCIENCE AND TECHNOLOGY</b></h4>
            </div>
            </div>
            <hr style="border: 2px solid #3385ff;border-radius: 1px;" class="hol1">
            
            <div class="row mt-1 " >
                  <div class="col-12 mr-0 mx-auto"><h5 class="text-center text-body" style="font-size : 100%; color: #000000;font-family: Crimson Text" ; ><b>IN-COUNTRY MISSION AUTHORIZATION FORM</b></h5> </div>
            </div>






      <div class="row mx-auto mt-2">
                
        <div req_identification_number="<?php echo $Req_id; ?>" class="col-8 mx-auto text-center text-body mission-serial-number">
        <span style="color: #000000" ><b>  Mission Serial N<sup>o</sup>  &nbsp</b>  
             <?php echo $Req_id; ?>
          </span> 
            </div>
                
        </div>


     
      <div class="row-flex-container">
        <div  class="colomn-flex-left"> 
           <b>1.</b> Issued to
        </div>
        <div class="colomn-flex-middle"> 
          <b> 
           <?php echo $statt_details[0]["stf_fname"]." ".$statt_details[0]["stf_lname"]."  "; ?> 
          </b>
        </div>
        <div class="colomn-flex-right" >
             <label> signature</label>
           <span> <?php echo "signs" ?></span>
        </div>
        </div>

      <div class="row-flex-container"> 
      <div  class="colomn-flex-left">     
      <b>2. </b> Department:
      </div>
      <div  class="colomn-flex-middle">
        <b><?php echo $statt_details[0]["dept_name"]." / ".$statt_details[0]["scl_name"] ;  ?></b>
      </div>
      </div>

      <div class="row-flex-container"> 
      <div  class="colomn-flex-left">     
      <b>3. </b> Function: 
      </div>
      <div  class="colomn-flex-middle">
        <b><?php echo $statt_details[0]["role_name"]; ?></b>
      </div>
      </div>

      <div class="row-flex-container has-long-label"> 
      <div  class="colomn-flex-left">     
      <b>4. </b> Purpose of the Mission:
      </div>
      <div  class="colomn-flex-middle">
        <?php echo $request_details[0]["req_purpose"];  ?>
      </div>
      </div>

      <div class="row-flex-container has-long-label"> 
      <div  class="colomn-flex-left">     
      <b>05. </b> Expected Result:
      </div>
      <div  class="colomn-flex-middle">
        <?php echo $request_details[0]["req_expected_result"];  ?>
      </div>
      </div>

      <div class="row-flex-container"> 
      <div  class="colomn-flex-left">     
      <b>06. </b> Destination 
      </div>
      <div  class="colomn-flex-middle">
        <?php echo $request_details[0]["des_name"]; ?>
      </div>
      </div>

      <div class="row-flex-container has-long-label"> 
      <div  class="colomn-flex-left">     
      <b>07. </b> Distance in KM (to and from):
      </div>
      <div  class="colomn-flex-middle">
        <?php echo $request_details[0]["req_purpose"];  ?>
      </div>
      </div>



      <div class="row-flex-container"> 
      <div  class="colomn-flex-left">     
      <b>08. </b> Departue date 
      </div>
      <div  class="colomn-flex-middle">
        <?php echo $request_details[0]["req_departure"]; ?>
      </div>
      </div>


      <div class="row-flex-container"> 
      <div  class="colomn-flex-left">     
      <b>09. </b> Return date 
      </div>
      <div  class="colomn-flex-middle">
        <?php echo $request_details[0]["req_return"]; ?>
      </div>
      </div>

      <div class="row-flex-container has-long-label"> 
      <div  class="colomn-flex-left">     
      <b>10. </b> Duration of the mission (Number of days):
      </div>
      <div  class="colomn-flex-middle">
        <b><?php echo $request_details[0]["mission_n_days"];  ?></b>
      </div>
      </div>


      <div class="row-flex-container has-long-label"> 
      <div  class="colomn-flex-left">     
      <b>11. </b> Transiportaton  means:
      </div>
      <div  class="colomn-flex-middle">
      <label style="padding: 4px;" class="co-4 " ><input type="radio" <?php echo $request_details[0]["trans_id"] == 1 ? "checked": "";?> value="1" name="transiport">public </label>
      <label style="padding: 4px;" class="co-4 " ><input type="radio" <?php echo $request_details[0]["trans_id"] == 2 ? "checked": "";?> value="2" name="transiport">private </label>
      <label style="padding: 4px;" class="co-4 " ><input type="radio" <?php echo $request_details[0]["trans_id"] == 3 ? "checked": "";?> value="3" name="transiport">provided </label>      </div>
      </div>

      
      <div class="row-flex-container has-long-label"> 
      <div  class="colomn-flex-left">     
      <b>12. </b> Vehicle Identification
      </div>
      <div  class="colomn-flex-middle">
      <span>.............</span>
      </div>
      </div>

      <div class="row-flex-container has-long-label"> 
      <div  class="colomn-flex-left">     
      <b>13. </b> Name of Driver
      </div>
      <div  class="colomn-flex-middle">
      <span>.............</span>
      </div>
      </div>



      <div class="row-flex-container">
        <div  class="colomn-flex-left"> 
           <b>14.</b> Name of Supervisor 
        </div>
        <div class="colomn-flex-middle"> 
          <b> 
           <?php
           if(isset($staff_hod_details))
           {
            echo $staff_hod_details[0]["stf_fname"] ." ".$staff_hod_details[0]["stf_lname"]." ";
           }
             
            ?> 
          </b>
        </div>
        <div class="colomn-flex-right" >
             <label> signature</label>
           <span> <?php echo "signs" ?></span>
        </div>
        </div> 
        
        
     <div  class="flex-place-center">     
      <b>15. </b>
       <span>
          <b><u> Authorized by VC/DVCs/ Principal or Campus Director of operations </u>
         </b> 
      </span>
      </div>

      <div class="row-flex-container">
        <div  class="colomn-flex-left "> 
           
        </div>
        <div class="colomn-flex-middle"> 
          <b> 
           <?php
           if(isset($staff_hod_details))
           {
            echo $staff_hod_details[0]["stf_fname"] ." ".$staff_hod_details[0]["stf_lname"]." "; 
           } ?> 
          </b>
        </div>
        <div class="colomn-flex-right" >
             <label> signature</label>
           <span> <?php echo "signs" ?></span>
        </div>
        </div> 

      

      <div class="row-flex-container">
        <div  class="colomn-flex-left"> 
           <b>14.</b> <u><b>Acknowledged by HR </b></u>  
        </div>
        <div class="colomn-flex-middle"> 
          <b> 
          <?php
          if(isset($staff_HR_details))
            {
              echo $staff_HR_details[0]["stf_fname"]."Acknowledged by HR ".$staff_HR_details[0]["stf_lname"]."  ";
            }  ?> 
          </b>
        </div>
        <div class="colomn-flex-right" >
             <label> signature</label>
           <span> <?php echo "signs" ?></span>
        </div>
        </div> 


        <div class="row-flex-container">
          <div class="column-flex-container " style="width: auto;">
                  <div class="c-flex-item"><b>Visa for Destination</b></div>
                  <div class="c-flex-item"><b>Stamp and Signature</b></div>
                  <div class="c-flex-item">Arrival Date .....</div>
                  <div class="c-flex-item">Depature date ..... .</div>
            
          </div>
        </div>

  
    </div>


  </form>

  

  <?php
  
  ?>
 <div id="hold-viwer-action" class="text-center">

  </div>

  <!-- 
  <form method="POST" action="">
  <input class="downloadPdf btn btn-sm" type="submit" value="download PDF" name ="download" />
  </form> -->

  <button onclick="PrintElem()" class="download btn btn-sm" >downLoad</button>

   </section>        
    
      </div>

    </div>
    </div>
 
  <!-- BEGIN VENDOR JS-->
  <!-- <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script> -->


  <script type="text/javascript">
   $('button.download').click(function(){
   var html_code = $('#staff-form-request').html();
   $.ajax(
    {
      url: '../pdf_sendEmail.php',
      method:"POST",
      data: {req_id: 1, html_code: html_code, generate: true},
      success:function(response)
      {
        console.log(response);

      }
    });

  //  window.alert(htmle);


   });

  // $('document').on('click', 'button.download', function(){
  // window.alert('');
  // });

  function getThisIP(){
    let ip = "";
  jQuery.ajax({jsonp: 'jsonp',
  dataType: 'jsonp',
  url: 'http://myexternalip.com/json',
  success: function(myip) {alert(myip); ip = myip;}
});

return ip;
  }


// converting html to image (screenshoot) 

function doCapture() {
  window.scrollTo(0,0)
   html2canvas(document.getElementById("testh2c")).then(function (canvas) {
     console.log(canvas.toDataURL("image/jpeg", 0.9));

     var ajax = new XMLHttpRequest();
     ajax.open("POST", "save-caputure.php", true);
     ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     ajax.send("image=" +canvas.toDataURL("image/jpeg", 0.9));

     ajax.onreadystatechange = function(){
       if((this.readyState == 4) && (this.status == 200)){
         console.log(this.responseText);
       }
     }
     
   })
   
 }

// hod give sansation on request details


$(document).ready(function(){
      var form_hod_sansation = '<div class="modal-body">\
      <form name="remark" method="post"><div style="text-align: center;"><select id="hod_sansation" name="hod_sansation" style="color:black; display:inline-block; max-width: 200px;" class="form-control" name="status" required>\
       <option value="">Choose your option</option> <option value="1">Approved</option> <option value="2">Not Approved</option> </select> </div>\
         <p> <textarea id="action_comment" class="form-control" name="action_comment" rows="5" required> </textarea> </p>\
        <div> <button onclick="DoActionOnRequest()" type="button" class="btn btn-blue btn-sm m-b-xs DoActionOnRequest" name="submitAction" value="Send sansation">Send sansation</button> </div></form></div>';

    $('.view-give-sansation').popover({
    placement: 'top',
    title : '<h4 class="text-center" ><i class="la la-arrow-right"></i> React to this request</h4>',
    content: form_hod_sansation,
    delay: { "show": 100, "hide": 100 },
      html: true
    });
});

   // take action on request.  in request details

// function DoActionOnRequest(){
// var hod_id = < ?php echo $staf_id;?>;
// var req_id = $('.mission-serial-number').attr("req_identification_number");
// console.log(req_id);
// window.alert(hod_id+ ' '+ req_id);

// window.console.log(hod_id+"  "+req_id);
// var hod_comment=$('#action_comment').val();
// var hod_sansation=$('#hod_sansation').children(":selected").attr("value");
// $.post("scripts/hod-action-on-request.php",{req_id: req_id,hod_comment: hod_comment, hod_sansation: hod_sansation,hod_id:hod_id},
// function(data) {
// window.alert(data);
// });
// }


    function PrintElem()
{
    var mywindow = window.open('', 'PRINT', 'height=auto,width=100%');

    mywindow.document.write('<html><head><title>URSTMS-'+<?php echo $Req_id; ?> +'</title>');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="../app-assets/css/vendors.css">');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap-extended.css">');

    mywindow.document.write('<link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.min.css">');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="../app-assets/css/new-customized.css">');

    mywindow.document.write('<style>*{font-size:20px} div.row-flex-container{display: flex;margin: 12px 0px;flex-direction: row;font-size: 100%;} .colomn-flex-left{flex: 0 0 165px;} .colomn-flex-right{place-items: start;display: flex;flex: 1;flex-wrap: nowrap;justify-content: space-around;} .colomn-flex-middle{display: flex; min-width: 30%; place-items: start; flex-wrap: nowrap;} div.row-flex-container.has-long-label .colomn-flex-left{flex: 0 1 270px;} .colomn-flex-right label{margin: 0em 1px;} .column-flex-container{display: flex; flex: auto; flex-direction: column; place-items: right;}</style>');
     

    mywindow.document.write('</head><body >');
    // mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById("staff-form-request").innerHTML);
    mywindow.document.write('</body></html>');
    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); //necessary for IE >= 10*/

    mywindow.print();
    // mywindow.close();

    return true;
}
  </script>


<!-- </body>
</html> -->















