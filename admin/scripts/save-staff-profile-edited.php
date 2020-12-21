
<?php 
	include('../Classes/DBController.php');
	include('../Classes/Staff_class.php');
	include('../Classes/Requests_class.php');
	include('../Classes/Notification_class.php');
	include('../../mailer.php');

        if (isset($_POST['update'])) {
			$staff = new Staff();
			$connection = new DBController();
      	
       
             $staff_id=$_POST['Emp_id'];
             $last_name=$_POST['first_name'];
			 $username=$_POST['username'];
			 $first_name=$_POST['last_name'];
			 $gender=$_POST['gender'];
			 $depertment=$_POST['Department'];
			 $position=$_POST['Position'];
			 $staff_email=$_POST['email'];
			 $telphone=$_POST['telphone'];

			$subject = "URSTMS Staff profile update";
			$pmsg ="<strong>".$first_name."</strong>  you updated your profile at URSTMS <br>your <b>username</b> is ".$username;
			$currdate=date("y-m-d");



	    try{
			$connection->startTransaction();
	    	if( send_email($staff_email,$pmsg,$first_name,$subject)){

				$updated = $staff->updateStaff($first_name, $last_name, $telphone, $staff_email, $username, $staff_id);
				$connection->commitTransaction();
				echo json_encode(array("success"=> 1, "message"=> "$last_name.' data updated'"));
			}
			else{
				$connection->rollBackTransaction();


			}

			} catch(PDOException $e){
				echo json_encode(array("success"=> 0, "message"=> "staff not updated", "error"=> "$e->getMessage()"));
				$connection->rollBackTransaction();			
        } 
        $connection->closeDB();
       }
       else {
		echo json_encode(array("success"=> 0, "message"=> "staff not updated", "error"=> "invalid request"));
	}
?>