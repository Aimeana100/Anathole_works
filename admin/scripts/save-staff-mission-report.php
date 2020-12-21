
<?php 		
    include('../Classes/DBController.php');
    include('../Classes/Staff_class.php');
    include('../Classes/Requests_class.php');
    include('../Classes/Notification_class.php');
    include('../Classes/Report_class.php');
    include('../../mailer.php');

    $connection = new DBController();
    $report = new Report();

      $req_id =$_POST['req_id'];
      $current_date_time = $_POST['current_date_time'];            
      $mission_out_comes =$_POST['mission_out_comes'];
      $arrival_date = $_POST['arrival_date'];
      $departure_date = $_POST['departure_date'];

      function checkEmpty($varialse_name){
        return !empty($varialse_name) and ($varialse_name != "");
      }

      if(checkEmpty($req_id) and
       checkEmpty($current_date_time) and
       checkEmpty($mission_out_comes) and
        checkEmpty($arrival_date) and
         checkEmpty($departure_date))
         {         

      try{
	    $connection->startTransaction();
      $report_last_id = $report->InsertReport($mission_out_comes, $current_date_time, $req_id, $arrival_date, $departure_date);    
      
      if($report_last_id){  
      $connection->commitTransaction();
      echo json_encode(array("success"=>"1", "message"=>"you reported successfully", "insertedID"=>"$report_last_id"));
      }
      else{
        $connection->rollBackTransaction();
        echo json_encode(array("success"=>"0", "message"=>"report unsuccessfull"));

      }
    }

       catch(Exception $e){
        echo json_encode(array("success"=>"0", "message"=>"report unsuccessfull", "error"=>$e->getMessage()));
    }

}else
{
  echo json_encode(array("success"=>"0", "message"=>"data you passed is not valid"));

}
$connection->closeDB();

?>