 <?php  
 
 if(isset($_POST["req_id"]))  
 {    
  include('../Classes/DBController.php');
  // include('Classes/Staff_class.php');
  include('../Classes/Requests_class.php');
  // include('Classes/Notification_class.php');

 

      $Req_id = $_POST["req_id"];
      $Canprint= false;
      $output = '';  

      $request = new Request();

      $request_details = $request->getRequestDeatailsByReq_id($Req_id);

      $which_hod_acted_on_request = $request->getWhoDidActionONRequest("HOD", $Req_id);
      $which_dean_acted_on_request = $request->getWhoDidActionONRequest("Dean", $Req_id);
      $which_principal_acted_on_request = $request->getWhoDidActionONRequest("principal", $Req_id);
       
    
        if(isset($request_details))
      {
        $hod_id = $request_details[0]["hod_id"];
        $hod_sansation = $request_details[0]["hod_sansation"] ;
        $dean_id = $request_details[0]["Dean_id"];
        $dean_sansation = $request_details[0]["dean_sansation"];

        $principal_id = $request_details[0]["principal_id"];
        $principal_sansation = $request_details[0]["principal_sansation"];


        $output = "";
        $output = '<table><tr style="border-bottom: 1px solid #000; color: #000000" ><th colspan="2"> Request Tracking</th></tr>
      <tr style=" color:#000000; border-bottom: 1px solid #000 ;border-left: 1px solid #000;" ><td colspan="2">Request id: '.$request_details[0]["req_id"].'</td> </tr>
      <tr style="border-bottom: 1px solid #000 ;border-left: 1px solid #000;color:#000000;"><td> Submitted on: </td><td>'.$request_details[0]["req_action_date"].'</td> </tr>';

        if ((isset($hod_sansation)) AND ($hod_sansation == 1 ) )
        {

       $message = "Approved by";
     
        
        if(isset($which_hod_acted_on_request))

       {


          $output .= '<tr style="border-bottom: 1px solid #000 ;border-left: 1px solid #000;" > <td rowspan="2">'.$message.'</td><td>'.$which_hod_acted_on_request[0]["stf_fname"]." ".$which_hod_acted_on_request[0]["stf_lname"].'</td></tr> <tr  style="border-bottom: 1px solid #000;" ><td> on '.$which_hod_acted_on_request[0]["hod_action_date"].'</td> </tr>';

        }
      
    }

  elseif ((isset($hod_sansation)) AND ($hod_sansation == 2 ) ) {
    # code...

      $message = "Disapprooved By";
      if(isset($which_hod_acted_on_request))
      {


          $output .= '<tr style="border-bottom: 1px solid #000 ;border-left: 1px solid #000;" > <td  rowspan="2" >'.$message.'</td><td>'.$which_hod_acted_on_request[0]["stf_fname"]." ".$which_hod_acted_on_request[0]["stf_lname"].'</td></tr> <tr style="border-bottom: 1px solid #000;" > <td> on '.$which_hod_acted_on_request[0]["hod_action_date"].'</td> </tr>';

        
      }
  }

  else{
    $message = "waiting for HOD sansation";
    $output .=' <tr style="border-bottom: 1px solid #000; border-left: 1px solid #000;" ><td colspan="2"  class="text-info" >'.$message.'</td></tr>';
  }




    


    if ((isset($dean_sansation)) AND ($dean_sansation == 1 ) ){

      $message = "Approved by";
      if(isset($which_dean_acted_on_request)){


          $output .= '<tr style="border-bottom: 1px solid #000; border-left: 1px solid #000;" > <td  rowspan="2">'.$message.'</td> <td>'.$which_dean_acted_on_request[0]["stf_fname"]." ".$which_dean_acted_on_request[0]["stf_lname"].'</td></tr><tr  style="border-bottom: 1px solid #000;"> <td> on '.$which_dean_acted_on_request[0]["dean_action_date"].'</td> </tr>';

        }
      
    }

  elseif ((isset($dean_sansation))AND ($dean_sansation == 2 ) ){
    # code...

      $message = "Disapproved by";

      if(isset($which_dean_acted_on_request)){


      $output .= '<tr style="border-bottom: 1px solid #000 ;border-left: 1px solid #000;" > <td rowspan="2">'.$message.'</td><td>'.$which_dean_acted_on_request[0]["stf_fname"]." ".$which_dean_acted_on_request[0]["stf_lname"].'on </td> </tr> <tr style=" border-bottom: 1px solid #000;" ><td>'.$which_dean_acted_on_request[0]["dean_action_date"].'</td></tr>';

        }
  
  }

  else{
    $message = "waiting for Dean sansation ";
    $output .=' <tr style="border-bottom: 1px solid #000 ;border-left: 1px solid #000;"><td  colspan="2"  class="text-info" >'.$message.'</td></tr>';
  }





if ((isset($principal_sansation)) AND ($principal_sansation == 1 ) ){
      $Canprint = true;
      $message = "Approved by";
      
      if(isset($which_principal_acted_on_request)){


          $output .= '<tr style="border-bottom: 1px solid #000 ;border-left: 1px solid #000;" > <td rowspan="2"  >'.$message.'</td><td>'.$which_principal_acted_on_request[0]["stf_fname"]." ".$which_principal_acted_on_request[0]["stf_lname"].' </td> </tr><tr style="border-bottom: 1px solid #000" ><td>'.$which_principal_acted_on_request[0]["principal_action_date"].'</td> </tr>';

        }
      
    }




  elseif ((isset($principal_sansation))AND ($principal_sansation == 2 ) ) {
      $message = "Disapproved by";
      if(isset($which_principal_acted_on_request)){


          $output .= '<tr style="border-bottom: 1px solid #000 ;border-left: 1px solid #000;" > <td  rowspan="2" >'.$message.'</td><td>'.$principal_result->stf_fname." ".$principal_result->stf_lname.'</td></tr> <tr style="border-bottom: 1px solid #000" ><td>on '.$principal_result->principal_action_date.'</td> </tr>';

      }
  }

  else{
    $message = "waiting for Principal sansation ";
    $output .=' <tr style="border-bottom: 1px solid #000 ;border-left: 1px solid #000;"> <td colspan="2"  class="text-info" >'.$message.'</td></tr>';
  }



if ($Canprint) {
  $output .='<a href="staff-request-details.php?Rid="'.$Req_id.'></a>';
}

 

  $output .='</table>';


 }

      echo $output;  
 }  
// }


 ?> 
