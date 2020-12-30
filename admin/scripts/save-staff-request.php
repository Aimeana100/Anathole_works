
<?php include('../Classes/DBController.php');
      include('../Classes/Staff_class.php');
      include('../Classes/Requests_class.php');
      include('../Classes/Notification_class.php');

      
      $stf_id = $_POST['stf_id'];
      $supervisor_id = $_POST['supervisor'];            
      $req_purpose = $_POST['req_purpose'];
      $exp_result = $_POST['exp_result'];
      $destination = $_POST['destination'];
      $transiport = $_POST['transiport'];
      $req_departure = $_POST['req_departure'];
      $req_return = $_POST['req_return'];
      $req_distance = $_POST['req_distance'];
      $req_mission_duration = $_POST['req_mission_duration'];

      $progress = 0;
      $request_status = 1;
      $currdate=date("y-m-d mm:ss");


      if(empty($stf_id) or empty($supervisor_id) or 
      empty($req_purpose) or empty($exp_result) or 
      empty($destination) or empty($transiport) or 
      empty($req_departure) or empty($req_return))

       {
        echo json_encode(array("success"=> 0, "message"=> "data bad format or not fill "));

       }
       else{      

      $table_row = "";    

      $connection = new DBController();    
      
			// instatiate a requests object
      $request = new Request();
      // instatiate a notification object
      $notification = new Notification();
			
  
			// $connt->beginTransaction();
      $connection->startTransaction();
      $querry_success = TRUE;
    
      $save_new_request = $request->insertRequest($req_purpose,$exp_result,$req_departure,$req_return,$req_mission_duration,$progress,$request_status,$transiport,$destination);
    if(empty($save_new_request)){
      $querry_success = FALSE;
      
    }
    else{
      $save_user_request = $request->insertUserRequest($save_new_request,$stf_id,$supervisor_id);
      if(empty($save_user_request)){
        $querry_success = FALSE;
     }
    }   

      $save_notification = true;
      $save_notification = $notification->insertNotification($save_new_request,0, 0, 0);
      if(empty($save_notification)){
        $querry_success = FALSE;
      }
      if($querry_success){
        
        $connection->commitTransaction();
       
      $current_inserted_req_details = $request->getRequestDeatailsByReq_id($save_new_request);
             
      if(!empty($current_inserted_req_details)){

          $table_row='<tr class="bg-success"><th>new</th><td>'. $current_inserted_req_details[0]["req_id"].'</td><td>'.$current_inserted_req_details[0]["des_name"].'</td><td>'.$current_inserted_req_details[0]["req_departure"].'</td><td>'.$current_inserted_req_details[0]["req_return"]. '</td><td><span><b>Waiting</b> Last Approval</span></td> <td style="padding: 0px" ><a style="margin: 0px ;padding: 3px;" reqId="'.$current_inserted_req_details[0]["req_id"].'" tabindex="0" data-toggle="popover"  class="btn btn-secondary track-request" role="button" data-trigger="focus" >
    Track</a></td> <td style="padding: 0px"> <input data-target="#Request-view-details" req-id="'.$current_inserted_req_details[0]["req_id"].'" style="margin: 0px ;padding: 3px;" type="button" class="btn btn-info btn-glow view-request-details" value="View" data-toggle="modal" ></td></tr>';
        }
        // echo $table_row;
      echo json_encode(array("success"=> 1, "message"=> "Request set", "request_id"=>$save_new_request, "result"=>json_encode($current_inserted_req_details[0])));

      }
      else{
        $connection->rollBackTransaction();
        echo json_encode(array("success"=> 0, "message"=> "Request not sent"));

      }      
      
       
    }

?>