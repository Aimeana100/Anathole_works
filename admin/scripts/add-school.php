<?php 
        include('../Classes/DBController.php');
        include('../Classes/Organisation_class.php');
        
		include('../../mailer.php');
   
        if (isset($_POST['school_name']) && isset($_POST['college_id'])) {
            $organisation= new Organisation();            
			$connection = new DBController();
			 $school_name = $_POST['school_name'];
			 $coll_id = $_POST['college_id'];


			 // Generating Password
			$currdate=date("y-m-d");
	
			// $connt->beginTransaction();
            $connection->startTransaction();
            $querry_success = TRUE;
          
            $save_new_school = $organisation->InsertSchool($school_name, $coll_id);
          if(empty($save_new_school)){
            $querry_success = FALSE;            
          }
          else{
            $new_school = $organisation->getSchoolByScllId($save_new_school);
            if($new_school){
            echo json_encode(array("success"=> true, "message"=> "school added", "school_id"=>$save_new_school, "result"=>$new_school[0]));
              
           }
          }

		
			
        }
        else{
            echo json_encode(array("success"=> false, "message"=> "school not added"));

        }
        
	   
	



?>