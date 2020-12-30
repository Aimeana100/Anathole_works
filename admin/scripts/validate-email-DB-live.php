<?php

include('../Classes/DBController.php');
include('../Classes/Staff_class.php');
// include('../Classes/Requests_class.php');
// include('../Classes/Notification_class.php');
// include('../../mailer.php');

if (isset($_GET['staff_email']) AND $_GET['staff_email'] != "" ){

    $staff_email = $_GET['staff_email'];
    $flag = false;    
    $staff_instance = new Staff();    
    $allStaffs = $staff_instance->getAllRegisteredStaffs();
    foreach ($allStaffs as $key => $value) {
        if ($allStaffs[$key]['stf_email'] == $staff_email) {
          echo json_encode(array("success"=> true, "meassage"=> "exist"));
          exit();

            $flag = true;
            break;
        }
        else
            {
                echo json_encode(array("success"=> false, "meassage"=> "email doesn't exist yet"));
                exit();
            
                
        }
    }
   
   
  
}
else
{
    echo json_encode(array("success"=> false, "meassage"=> "sorry provide email"));
    
}



	?>
