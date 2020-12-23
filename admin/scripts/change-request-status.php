<?php

include('../Classes/DBController.php');
// include('../Classes/Staff_class.php');
include('../Classes/Requests_class.php');
// include('../Classes/Notification_class.php');
// include('../../mailer.php');

if (isset($_POST['req_id']) AND $_POST['req_id'] != "" ){

$Req_id = $_POST['req_id'];


$request = new Request();

$single_request_instance = $request->getRequestDeatailsByReq_id($Req_id);

    $request_status = $single_request_instance[0]['req_status'];
    $update_status = $request_status == 1 ? 0 : 1;
    $change_req_status = $request->changeRequestStatus($Req_id,$update_status);
    $updated_status = $request->getRequestDeatailsByReq_id($Req_id);
    // if($change_req_status){
        echo json_encode(array("success"=> "1", "status"=>$updated_status[0]['req_status']));
    // }
}



	?>
