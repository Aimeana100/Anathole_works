<?php 
        include('../Classes/DBController.php');
        include('../Classes/Organisation_class.php');
        
		include('../../mailer.php');
   
        if (isset($_POST['pos_name'])) {
            $organisation= new Organisation();            
			$connection = new DBController();
			 $pos_id = $_POST['pos_id'];

			 // Generating Password
			$currdate=date("y-m-d");
	
			// $connt->beginTransaction();
            $connection->startTransaction();
            $querry_success = TRUE;
          
            $delete_position = $organisation->EditPosition($pos_id);
          if(empty($delete_position)){
            $querry_success = FALSE;            
          }
          else{
            $new_position = $organisation->getPositionByPosId($delete_position);
            if($new_position){
            echo json_encode(array("success"=> true, "message"=> "Position added", "college_id"=>$delete_position, "result"=>$new_position[0]));
              
           }
          }

		
			
        }
        else{
            echo json_encode(array("success"=> false, "message"=> "college not added"));

        }
        
	   
	



?>