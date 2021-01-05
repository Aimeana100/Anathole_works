<?php 
        include('../Classes/DBController.php');
        include('../Classes/Organisation_class.php');
        
		include('../../mailer.php');   
        if (isset($_POST['dept_name']) && isset($_POST['scl_id'])) {
            $organisation= new Organisation();            
			$connection = new DBController();
			 $dept_name = $_POST['dept_name'];
			 $scl_id = $_POST['scl_id'];

			// $connt->beginTransaction();
            $connection->startTransaction();
            $querry_success = TRUE;
          
            $save_new_dept = $organisation->InsertDepartement($dept_name, $scl_id);
          if(empty($save_new_dept)){
            $querry_success = FALSE;            
          }
          else{
            $new_dept = $organisation->getDeptByDeptId($save_new_dept);
            if($new_dept){
            echo json_encode(array("success"=> true, "message"=> "dept added", "dept_id"=>$save_new_dept, "result"=>$new_dept[0]));
              
           }
          }

		
			
        }
        else{
            echo json_encode(array("success"=> false, "message"=> "school not added"));

        }
        
	   
	



?>