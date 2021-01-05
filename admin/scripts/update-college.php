
<?php 
	include('../Classes/DBController.php');
    include('../Classes/Organisation_class.php');
	include('../../mailer.php');

        if (isset($_POST['update']) && isset($_POST['college_id']) ) {

            $connection = new DBController();     	
       
             $college_name=$_POST['college_name'];
             $college_id = $_POST['college_id'];

			 $currdate=date("y-m-d");



			$connection->startTransaction();	    	
				$updated = $staff->UpdateCollege($college_id, $college_name);
                $connection->commitTransaction();
                if($updated){
                    $updated_data = getCollegeByCollId()
                }
				echo json_encode(array("success"=> 1, "message"=> "$last_name.' data updated'"));
			}
			else{
				$connection->rollBackTransaction();


			}

        $connection->closeDB();
       }
       else {
		echo json_encode(array("success"=> 0, "message"=> "staff not updated", "error"=> "invalid request"));
	}
?>