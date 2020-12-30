<?php
include('../../Classes/DBController.php');
include('../../Classes/Staff_class.php');
include('../../Classes/Requests_class.php');
include('../../Classes/Notification_class.php');
include('../../../mailer.php');

if (isset($_POST['req_id'])){
$Req_id = $_POST['req_id'];
$principal_id = $_POST['principal_id'];
$sensation =$_POST['principal_sansation'];
$principal_comment = $_POST['principal_comment'];
// date_default_timezone_set('Asia/Kolkata');
$actiondate = date('Y-m-d G:i:s ', strtotime("now"));
$sansation_in_word = $sensation == 1 ? "Approved" : "Disapproved";

if(empty($Req_id) OR $Req_id == "" OR empty($principal_id) OR 
empty($sensation) OR $sensation == null OR empty($principal_comment) OR $principal_comment == "" )
 {
	  echo json_encode( array("success" => 0, "message" => "data sent not valid"));
	  exit();
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
$pmsg ="<strong> Hello ".$requestor_first_name."</strong> <br> your mission request <b>".$Req_id."</b> has been ".$sansation_in_word." by <b> Principal of College</b><br> COMMENT: ".$principal_comment."";

try {
$connection->startTransaction();
if ((true) AND send_email($requestor_email,$pmsg,$requestor_first_name,$subject))
{
$dean_action_on_request = $request->Principal_takeActionOnRequest($principal_id, $principal_comment, $sensation, $actiondate, $Req_id);
$connection->commitTransaction();
	echo json_encode( array("success" => true, "message" => "done ", "sansaton"=> $sensation));
	exit();
}
else{
	$connection->rollBackTransaction();
	echo json_encode( array("success" => false, "message" => "sansansion not well set, something went wrong"));
	exit();
	
}

}
 catch (Exception $e) {
	echo json_encode( array("success" => false, "message" => "sansansion not well set, something went wrong", "error"=>$e->getMessage()));
	exit();

   }

}
}
?>
