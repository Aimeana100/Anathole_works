<?php 
		include('../Classes/DBController.php');
		include('../Classes/Staff_class.php');
		include('../Classes/Requests_class.php');
		include('../Classes/Notification_class.php');
		include('../../mailer.php');
   
        if (isset($_POST['insert_staff'])) {
			$staff = new Staff();
			$connection = new DBController();

             $emp_id = $_POST['Emp_id'];
			 $last_name = $_POST['first_name'];
			 $first_name = $_POST['last_name'];
			 $gender = $_POST['gender'];
			 $depertment = $_POST['Department'];
			 $position = $_POST['Position'];
			 $email = $_POST['email'];
			 $telphone = $_POST['telphone'];

			 // Generating Password
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$password = substr( str_shuffle( $chars ), 0, 8 );
			$password_hashed = password_hash($password, PASSWORD_DEFAULT);

			$subject = "URSTMS Welcomed you";
			$pmsg ="<strong>".$first_name."</strong> Your creditials to USTMS are: <br> USERNAME: ".$email." <br>PASSWORD: "."<b>".$password."</b><br> use tehm to <a href='http://localhost/PR/urstms/ContactForm/pro_urstms/admin/index.php?username=".$email."'>login</a> to URSMS and we advised you to change them within your account";
			$currdate=date("y-m-d");
	  try{
			$connection->startTransaction();
			$send_email = send_email($email,$pmsg,$first_name,$subject);																
			if($send_email){
				$save_staff = $staff->addStaff($emp_id,$first_name,$last_name,$gender,$telphone, $email,$currdate,$email, $password_hashed, $depertment,$position,0);
				$inserted_staff = $staff->getStaffById($save_staff);
				echo json_encode(array("success" => true, "new_user_info" => $inserted_staff[0]));
				// echo $last_name." ".$first_name."  registered successfully ".$password ;
			   $connection->commitTransaction();
		
			}
			else{
				$connection->rollBackTransaction();
				echo json_encode(array("success"=> false, "error"=>"user not recorded"));
				// echo "error, not recorded";
			}

			}
			 catch(Exception $e){
				// die("ERROR:". $e->getMessage());
				$connection->rollBackTransaction();
			
        }
        
	   
	}



?>