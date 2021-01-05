<?php

class Organisation {    
    private $db_handle;
    
    function Organisation(){
        $this->db_handle = new DBController();
    }

    function InsertDepartement($departement_name, $school_id){
        $query = "INSERT INTO `urstms`.`departements` (dept_name, scl_id) VALUES (?,?);";
        $paramType = "si";
        $paramValue = array(
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
            $query = "SELECT * FROM departements INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON colleges.coll_id = schools.coll_id;";
            $All_departments = $this->db_handle->runBaseQuery($query);
            return $All_departments;
        }

        function getAllSchools(){
            $query = "SELECT * FROM schools INNER JOIN colleges ON schools.coll_id = colleges.coll_id;";
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
            return $all_roles;        }

            
    

        // get dept by school id    
        function getDeptByDeptId($dept_id)
        {
            $query = "SELECT * FROM departements INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON schools.coll_id = colleges.coll_id AND  = departements.dept_id = ?";
            $paramType = "i";
            $paramValue = array(
                $dept_id
            );
            
            $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
            return $result;
        }

        // get school by school id    
        function getSchoolByScllId($scl_id)
        {
            $query = "SELECT * FROM schools INNER JOIN colleges ON schools.coll_id = colleges.coll_id  WHERE  scl_id = ?";
            $paramType = "i";
            $paramValue = array(
                $scl_id
            );
            
            $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
            return $result;
        }

            // get colleg by colllege id    
            function getCollegeByCollId($coll_id)
            {
                $query = "SELECT * FROM colleges WHERE  coll_id = ?";
                $paramType = "i";
                $paramValue = array(
                    $coll_id
                );
                
                $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
                return $result;
            }

            function UpdateCollege($coll_id, $coll_name)
            {
                $query = "UPDATE `urstms`.`colleges` SET coll_name = ? WHERE coll_id = ?";
                $paramType = "isisi";
                $paramValue = array(
                    $coll_name,
                    $coll_id
                );
                $this->db_handle->update($query, $paramType, $paramValue);        
        }
                

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