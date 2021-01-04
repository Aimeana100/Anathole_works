<?php

include('../Classes/DBController.php');
include('../Classes/Staff_class.php');
include('../Classes/Requests_class.php');
include('../Classes/Notification_class.php');
include('../../mailer.php');
echo json_encode( array("success" => false, "message" => "sansansion not well set, something went wrong"));
exit();

if (isset($_POST['req_id'])){

$Req_id = $_POST['req_id'];
$HOD_id = $_POST['hod_id'];
$sensation =$_POST['hod_sansation'];
$hod_comment = $_POST['hod_comment'];
// date_default_timezone_set('Asia/Kolkata');
$actiondate = date('Y-m-d G:i:s ', strtotime("now"));
$sansation_in_word = $sensation == 1 ? "Approved" : "Disapproved";

if(empty($Req_id) OR $Req_id == "" OR empty($HOD_id) OR 
empty($sensation) OR $sensation == null OR empty($hod_comment) OR $hod_comment == "" )
 {
	  echo json_encode( array("success" => 0, "message" => "data sent not valid"));
 }

 else{


$request = new Request();
$connection = new DBController();

$single_request_instance = $request->getRequestDeatailsByReq_id($Req_id);
if(isset($single_request_instance))
{

	$requestor_first_name = $single_request_instance[0]['stf_fname'];
	$requestor_last_name = $single_request_instance[0]['stf_lname'];
	$requestor_email = $single_request_instance[0]['stf_email'];

}

$subject = "URSTMS sansation on misson Request";
$pmsg ="<strong> Hello ".$requestor_first_name."</strong> <br> your mission request <b>".$Req_id."</b> has been ".$sansation_in_word." by <b>Head of Depertement</b><br> COMMENT: ".$hod_comment."";

try {
$connection->startTransaction();echo "successiful";
$request->HOD_takeActionOnRequest($HOD_id, $hod_comment, $sensation, $actiondate, $Req_id);

if ((true) AND send_email($requestor_email,$pmsg,$requestor_first_name,$subject))
{
// echo "Request ".$Req_id." ".$sansation_in_word." successfully";
$connection->commitTransaction();
echo json_encode( array("success" => true, "message" => "done"));

}
else{
	$connection->rollBackTransaction();
	echo json_encode( array("success" => false, "message" => "sansansion not well set, something went wrong"));
	
}

}
 catch (Exception $e) {
	echo json_encode(array("success" => false, "message" => "sansansion not well set, something went wrong", "error"=>$e->getMessage()));

   }

}
}


	?>
