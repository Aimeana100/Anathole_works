<?php 
        include('../Classes/DBController.php');
        include('../Classes/Organisation_class.php');
        
		include('../../mailer.php');
   
        if (isset($_POST['pos_name'])) {
            $organisation= new Organisation();            
			$connection = new DBController();
			 $pos_name = $_POST['pos_name'];


			 // Generating Password
			$currdate=date("y-m-d");
	
			// $connt->beginTransaction();
            $connection->startTransaction();
            $querry_success = TRUE;
          
            $save_new_position = $organisation->InsertPosition($pos_name);
          if(empty($save_new_position)){
            $querry_success = FALSE;            
          }
          else{
            $new_position = $organisation->getPositionByPosId($save_new_position);
            if($new_position){
            echo json_encode(array("success"=> true, "message"=> "Position added", "college_id"=>$save_new_position, "result"=>$new_position[0]));
              
           }
          }

		
			
        }
        else{
            echo json_encode(array("success"=> false, "message"=> "college not added"));

        }
        
	   
	



?>