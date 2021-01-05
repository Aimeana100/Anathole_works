<?php 
        include('../Classes/DBController.php');
        include('../Classes/Organisation_class.php');
        
		include('../../mailer.php');
   
        if (isset($_POST['college_name'])) {
            $organisation= new Organisation();            
			$connection = new DBController();
			 $college_name = $_POST['college_name'];


			 // Generating Password
			$currdate=date("y-m-d");
	
			// $connt->beginTransaction();
            $connection->startTransaction();
            $querry_success = TRUE;
          
            $save_new_college = $organisation->InsertCollege($college_name);
          if(empty($save_new_college)){
            $querry_success = FALSE;            
          }
          else{
            $new_college = $organisation->getCollegeByCollId($save_new_college);
            if($new_college){
            echo json_encode(array("success"=> true, "message"=> "college added", "college_id"=>$save_new_college, "result"=>$new_college[0]));
              
           }
          }

		
			
        }
        else{
            echo json_encode(array("success"=> false, "message"=> "college not added"));

        }
        
	   
	



?>