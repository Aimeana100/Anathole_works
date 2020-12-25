<?php
class Report {    
    private $db_handle;
    private $userData = array();
    
    function Report(){
        $this->db_handle = new DBController();
    }

//  universal
    function InsertReport($mission_out_comes, $current_date_time, $req_id, $arrival_date, $departure_date){
        $query = "INSERT INTO `urstms`.`travel_result` (res_skills_gained,report_date,req_id,dest_arrival,dest_departure) VALUES (?,?,?,?,?);";    
        $paramType = "ssiss";
        $paramValue = array(
            $mission_out_comes, 
            $current_date_time, 
            $req_id,
            $arrival_date, 
            $departure_date
        );

        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;

        }




function getAllReporsts(){
    $query = "SELECT * FROM travel_result INNER JOIN requests ON requests.req_id = travel_result.req_id INNER JOIN user_request ON user_request.req_id = requests.req_id INNER JOIN action_notifications ON user_request.req_id = action_notifications.req_id INNER JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id;";
    $All_mission_reports = $this->db_handle->runBaseQuery($query);
    return $All_mission_reports;
}

function Is_mission_reported($Allrequsts_set){
    $mission_array_objected = array();
    $mission_reports_array = $this->getAllReporsts();

    foreach ($mission_reports_array as $key => $value);{
        $mission_array_objected = $mission_reports_array[$key];
    }
    return (in_array($Allrequsts_set, array_column($mission_array_objected, "req_id"),true)) ? true : false;

}

// depertament

// get all reports by pepartement ID
function getAllReportByDept($dept_id)
{
    $query = "SELECT * FROM travel_result INNER JOIN requests ON requests.req_id = travel_result.req_id INNER JOIN user_request ON user_request.req_id = requests.req_id INNER JOIN action_notifications ON user_request.req_id = action_notifications.req_id INNER JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id INNER JOIN departements ON departements.dept_id = staffs_info.dept_id AND  departements.dept_id = ? INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id ORDER BY requests.req_id DESC;";
    $paramType = "i";
    $paramValue = array(
        $dept_id
    );
    
    $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
    return $result;
}


// get all reports by scholl ID
function getAllReportBySchool($school_id)
{
    $query = "SELECT * FROM travel_result INNER JOIN requests ON requests.req_id = travel_result.req_id INNER JOIN user_request ON user_request.req_id = requests.req_id INNER JOIN action_notifications ON user_request.req_id = action_notifications.req_id INNER JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN schools ON departements.scl_id = schools.scl_id AND schools.scl_id = ?  INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id ORDER BY requests.req_id DESC;";
    $paramType = "i";
    $paramValue = array(
        $school_id
    );
    
    $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
    return $result;
}

function getAllReportByStfId($stf_id)
{
    $query = "SELECT * FROM travel_result INNER JOIN requests ON requests.req_id = travel_result.req_id INNER JOIN user_request ON user_request.req_id = requests.req_id INNER JOIN action_notifications ON user_request.req_id = action_notifications.req_id INNER JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id AND staffs_info.stf_id = ? INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id ORDER BY requests.req_id DESC;";
    $paramType = "i";
    $paramValue = array(
        $stf_id
    );
    
    $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
    return $result;
}

function getReportByReq_id($req_id){
    $query = "SELECT * FROM travel_result INNER JOIN requests ON requests.req_id = travel_result.req_id INNER JOIN user_request ON user_request.req_id = requests.req_id AND requests.req_id = ?  INNER JOIN action_notifications ON user_request.req_id = action_notifications.req_id INNER JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id;";
    $paramType = "i";
    $paramValue = array(
        $req_id
    );
    
    $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
    return $result;
}

}


?>

