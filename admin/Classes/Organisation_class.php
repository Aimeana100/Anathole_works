<?php

class Organisation {    
    private $db_handle;
    // private $userData = array();
    
    function Organisation(){
        $this->db_handle = new DBController();
    }

    function InsertDepartement($departement_name, $school_id){
        $query = "INSERT INTO `urstms`.`departements` (dept_id,dept_name, scl_id) VALUES (?,?,?);";
        $paramType = "si";
        $paramValue = array(
            $departement_id,
            $departement_name,
            $school_id,
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;

    }

    function InsertSchool($scholl_name, $college_id){
        $query = "INSERT INTO `urstms`.`schools` (scl_name,coll_id) VALUES (?,?)";
        $paramType = "si";
        $paramValue = array(
            $scholl_name,
            $college_id,
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }

    function InsertCollege($scholl_name){
        $query = "INSERT INTO `urstms`.`colleges` (coll_name) VALUES (?)";
        $paramType = "s";
        $paramValue = array(
            $scholl_name
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }

    
    // //request details by request id


    function getAllDepartments(){
            $query = "SELECT * FROM departements;";
            $All_departments = $this->db_handle->runBaseQuery($query);
            return $All_departments;
        }

        function getAllSchools(){
            $query = "SELECT * FROM schools;";
            $all_schools = $this->db_handle->runBaseQuery($query);
            return $all_schools;
        }

        function getAllColleges(){
            $query = "SELECT * FROM colleges;";
            $all_colleges = $this->db_handle->runBaseQuery($query);
            return $all_colleges;
        }

        function getAllPositions(){
            $query = "SELECT * FROM roles;";
            $all_roles = $this->db_handle->runBaseQuery($query);
            return $all_roles;
        }

    
// get all requests on a single staff
    
// function getAllRequestsByStaff($staff_id)
// {
//     $query = "SELECT * FROM user_request INNER JOIN requests ON user_request.req_id = requests.req_id INNER JOIN action_notifications ON user_request.req_id = action_notifications.req_id INNER JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id AND staffs_info.stf_id = ? INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id ORDER BY requests.req_id DESC;";
//     $paramType = "i";
//     $paramValue = array(
//         $staff_id
//     );
    
//     $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
//     return $result;
// }

// // get all request by dept ID

// function getAllRequestsByDept($dept_id)
// {
//     $query = "SELECT * FROM user_request INNER JOIN requests ON user_request.req_id = requests.req_id INNER JOIN action_notifications ON user_request.req_id = action_notifications.req_id INNER JOIN staffs_info ON staffs_info.stf_id = user_request.stf_id INNER JOIN departements ON departements.dept_id = staffs_info.dept_id AND  departements.dept_id = ? INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN destination ON requests.dest_id = destination.des_id INNER JOIN transiport ON transiport.trans_id = requests.trans_id ORDER BY requests.req_id DESC;";
//     $paramType = "i";
//     $paramValue = array(
//         $dept_id
//     );
    
//     $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
//     return $result;
// }



// // get who did action on a staaff's request
// function getWhoDidActionONRequest($which_position_user_is, $req_id){
//     $column_to_check ="";
//     if($which_position_user_is == "HOD"){
//         $column_to_check = "user_request.hod_id";
                
//     }
//     if($which_position_user_is == "Dean"){
//         $column_to_check = "user_request.Dean_id";
                
//     }

//     if($which_position_user_is == "principal"){
//         $column_to_check = "user_request.principal_id";
                
//     }


//     $query = "SELECT * FROM user_request INNER JOIN staffs_info ON staffs_info.stf_id =" .$column_to_check." AND user_request.req_id = ?;";
//     $paramType = "i";
//     $paramValue = array(
//         $req_id
//     );
    
//     $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
//     return $result;


// }


// function getAllReporsts(){
//     $query = "SELECT * FROM travel_result;";
//     $All_mission_reports = $this->db_handle->runBaseQuery($query);
//     return $All_mission_reports;
// }

// function Is_mission_reported($Allrequsts_set){
//     $mission_array_objected = array();
//     $mission_reports_array = $this->getAllReporsts();

//     foreach ($mission_reports_array as $key => $value);{
//         $mission_array_objected = $mission_reports_array[$key];
//     }
//     return (in_array($Allrequsts_set, array_column($mission_array_objected, "req_id"),true)) ? true : false;


// }

function getAllDestination(){
    $query = "SELECT * FROM destination;";
    $All_recognized_destination = $this->db_handle->runBaseQuery($query);
    return $All_recognized_destination;
}

// // request get to be approved 
// // by HOD


// function HOD_takeActionOnRequest($hod_id, $hod_comment, $hod_sansation, $hod_action_date, $req_id)
// {
//     $query = "UPDATE `urstms`.`user_request` SET hod_id = ?, hod_comment = ?, hod_sansation = ?, hod_action_date = ? WHERE req_id = ?";
//     $paramType = "isisi";
//     $paramValue = array(
//         $hod_id,
//         $hod_comment,
//         $hod_sansation,
//         $hod_action_date,
//         $req_id
//     );
    
//     $this->db_handle->update($query, $paramType, $paramValue);        
// }

// function Dean_takeActionOnRequest($dean_id, $dean_comment, $dean_sansation, $dean_action_date, $req_id)
// {
//     $query = "UPDATE `urstms`.`user_request`  SET Dean_id = ?, dean_comment = ?, dean_sansation = ?,  dean_action_date = ? WHERE req_id = ?";
//     $paramType = "isisi";
//     $paramValue = array(
//         $Dean_id,
//         $dean_comment,
//         $dean_sansation,
//         $dean_action_date,
//         $req_id
//     );
    
//     $this->db_handle->update($query, $paramType, $paramValue);      
// }


// function Principal_takeActionOnRequest($principal_id, $principal_comment, $principal_sansation, $principal_action_date, $req_id)
// {
//     $query = "UPDATE `urstms`.`user_request`  SET principal_id = ?, principal_sansation = ?, principal_comment = ?, principal_action_date = ? WHERE req_id = ?";
//     $paramType = "isisi";
//     $paramValue = array(
//         $principal_id,
//         $principal_comment,
//         $principal_sansation,
//         $principal_action_date,
//         $req_id
//     );
    
//     $this->db_handle->update($query, $paramType, $paramValue);      
// }

}


?>