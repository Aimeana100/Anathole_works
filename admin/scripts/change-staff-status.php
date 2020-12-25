<?php

include('../Classes/DBController.php');
include('../Classes/Staff_class.php');
// include('../Classes/Requests_class.php');
// include('../Classes/Notification_class.php');
// include('../../mailer.php');

if (isset($_POST['staff_id']) AND $_POST['staff_id'] != "" ){

$staff_id = $_POST['staff_id'];

$staff_instance = new Staff();

$single_staff_instance = $staff_instance->getStaffById($staff_id);

    $staff_status = $single_staff_instance[0]['statuses'];
    $update_status = $staff_status == 1 ? 0 : 1;
    $change_staff_status = $staff_instance->changeStaffStatus($staff_id,$update_status);
    $updated_status = $staff_instance->getStaffById($staff_id);
    // if($change_req_status){
        echo json_encode(array("success"=> "1", "status"=>$updated_status[0]['statuses']));
    // }
}



	?>
