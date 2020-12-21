<?php
// request progress 1: not yet seen, 2: approved or not approve 3: in excution 4:excutted, 5:reported completed. 

class Request {    
    private $db_handle;
    
    function Request(){
        $this->db_handle = new DBController();
    }

    // insert_req and user_ request can be merged / call insertUserRequest

    function insertRequest($req_purpose,$exp_result,$req_departure,$req_return,$req_mission_duration,$progress,$request_status, $transiport, $destination){
        $query = "INSERT INTO `urstms`.`requests` (req_purpose,req_expected_result,req_departure,req_return,mission_n_days,progress,req_status,trans_id,dest_id) VALUES (?,?,?,?,?,?,?,?,?);";
        $paramType = "ssssiiiii";
        $paramValue = array(
            $req_purpose,
            $exp_result,
            $req_departure,
            $req_return,
            $req_mission_duration,
            $progress,
            $request_status,
            $transiport,
            $destination

        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;

    }

    function insertUserRequest($lastid,$stf_id,$supervisor_id){
        $query = "INSERT INTO `urstms`.`user_request` (req_id,stf_id,supervisor_id) VALUES (?,?,?)";
        $paramType = "iii";
        $paramValue = array(
            $lastid,
            $stf_id,
            $supervisor_id
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    // get all requests

    function getAllrequestData(){
        $query = "SELECT * FROM user_request INNER JOIN requests ON user_request.req_id = requests.req_id INNER JOIN action_notifications ON user_request.req_id = action_notifications.req_id INNER JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON schools.coll_id = colleges.coll_id INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id ORDER BY requests.req_id DESC;";
        $All_requests = $this->db_handle->runBaseQuery($query);
        return $All_requests;
    
    }
    //request details by request id

    function getRequestDeatailsByReq_id($req_id){

    $query = "SELECT * FROM user_request INNER JOIN requests ON user_request.req_id = requests.req_id AND requests.req_id = ? INNER JOIN action_notifications ON user_request.req_id = action_notifications.req_id INNER JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON schools.coll_id = colleges.coll_id INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id ORDER BY requests.req_id DESC;";
    $paramType = "i";
    $paramValue = array(
        $req_id
    );
    
    $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
    return $result;

    }

    
// get all requests on a single staff
    
function getAllRequestsByStaff($staff_id)
{
    $query = "SELECT * FROM user_request INNER JOIN requests ON user_request.req_id = requests.req_id INNER JOIN action_notifications ON user_request.req_id = action_notifications.req_id INNER JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id AND staffs_info.stf_id = ? INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id ORDER BY requests.req_id DESC;";
    $paramType = "i";
    $paramValue = array(
        $staff_id
    );    
    $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
    return $result;
}

// get all request by dept ID

function getAllRequestsByDept($dept_id)
{
    $query = "SELECT * FROM user_request INNER JOIN requests ON user_request.req_id = requests.req_id INNER JOIN action_notifications ON user_request.req_id = action_notifications.req_id INNER JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id INNER JOIN departements ON departements.dept_id = staffs_info.dept_id AND  departements.dept_id = ? INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id ORDER BY requests.req_id DESC;";
    $paramType = "i";
    $paramValue = array(
        $dept_id
    );
    
    $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
    return $result;
}

function getAllRequestsBySchool($school_id)
{
    $query = "SELECT * FROM user_request INNER JOIN requests ON user_request.req_id = requests.req_id INNER JOIN action_notifications ON user_request.req_id = action_notifications.req_id INNER JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN schools ON schools.scl_id = departements.scl_id AND schools.scl_id = ? INNER JOIN colleges ON colleges.coll_id = schools.coll_id INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id ORDER BY requests.req_id DESC;";
    $paramType = "i";
    $paramValue = array(
        $school_id
    );
    
    $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
    return $result;
}

function getAllRequestsByCollege($college_id)
{
    $query = "SELECT * FROM user_request INNER JOIN requests ON user_request.req_id = requests.req_id AND requests.req_status = 1 INNER JOIN action_notifications ON user_request.req_id = action_notifications.req_id INNER JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON colleges.coll_id = schools.coll_id AND colleges.coll_id = ? INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id ORDER BY requests.req_id DESC;";
    $paramType = "i";
    $paramValue = array(
        $college_id
    );
    
    $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
    return $result;
}



// get who did action on a staaff's request
function getWhoDidActionONRequest($which_position_user_is, $req_id){
    $column_to_check ="";
    if($which_position_user_is == "HOD"){
        $column_to_check = "user_request.hod_id";
                
    }
    if($which_position_user_is == "Dean"){
        $column_to_check = "user_request.Dean_id";
                
    }

    if($which_position_user_is == "principal"){
        $column_to_check = "user_request.principal_id";
                
    }


    $query = "SELECT * FROM user_request INNER JOIN staffs_info ON staffs_info.stf_id =" .$column_to_check." AND user_request.req_id = ?;";
    $paramType = "i";
    $paramValue = array(
        $req_id
    );
    
    $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
    return $result;


}


function getAllDestination(){
    $query = "SELECT * FROM destination;";
    $All_recognized_destination = $this->db_handle->runBaseQuery($query);
    return $All_recognized_destination;
}

// request get to be approved 
// by HOD


function HOD_takeActionOnRequest($hod_id, $hod_comment, $hod_sansation, $hod_action_date, $req_id)
{
    $query = "UPDATE `urstms`.`user_request` SET hod_id = ?, hod_comment = ?, hod_sansation = ?, hod_action_date = ? WHERE req_id = ?";
    $paramType = "isisi";
    $paramValue = array(
        $hod_id,
        $hod_comment,
        $hod_sansation,
        $hod_action_date,
        $req_id
    );
    
    $this->db_handle->update($query, $paramType, $paramValue);        
}

function Dean_takeActionOnRequest($dean_id, $dean_comment, $dean_sansation, $dean_action_date, $req_id)
{
    $query = "UPDATE `urstms`.`user_request`  SET Dean_id = ?, dean_comment = ?, dean_sansation = ?,  dean_action_date = ? WHERE req_id = ?";
    $paramType = "isisi";
    $paramValue = array(
        $Dean_id,
        $dean_comment,
        $dean_sansation,
        $dean_action_date,
        $req_id
    );
    
    $this->db_handle->update($query, $paramType, $paramValue);      
}


function Principal_takeActionOnRequest($principal_id, $principal_comment, $principal_sansation, $principal_action_date, $req_id)
{
    $query = "UPDATE `urstms`.`user_request`  SET principal_id = ?, principal_sansation = ?, principal_comment = ?, principal_action_date = ? WHERE req_id = ?";
    $paramType = "isisi";
    $paramValue = array(
        $principal_id,
        $principal_comment,
        $principal_sansation,
        $principal_action_date,
        $req_id
    );
    
    $this->db_handle->update($query, $paramType, $paramValue);      
}

}


?>