<?php

class Staff{    
    private $db_handle;
    private $userData = array();
    
    function Staff(){
        $this->db_handle = new DBController();
    }

    //  start of functions called in login and Auntentications

    function Check_user_registred($username){
        $sql_query = "SELECT * FROM staffs_info WHERE username = ? OR stf_email = ?";
        $paramType = "ss";
        $paramValue = array($username,$username);
        $result = $this->db_handle->runQuery($sql_query, $paramType, $paramValue);
        $this->userData = $result;
    }
// check registred user by usename and password
    function AuntaticateUser($username, $password){
        $sql_query = "SELECT * FROM staffs_info INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON schools.coll_id = colleges.coll_id INNER JOIN  roles ON roles.role_id = staffs_info.role_id WHERE username = ? OR stf_email = ? AND password = ?;";
        $paramType = "sss";
        $paramValue = array($username,$username,$password);
        $result = $this->db_handle->runQuery($sql_query, $paramType, $paramValue);
        $this->userData = $result;
    }



    function getUserData($username){
        $this->Check_user_registred($username);
        return $this->userData;
    }
    // get user data from known username and password
    function getUserDataByCreditials($username, $password){
        $this->AuntaticateUser($username, $password);
        return $this->userData;
    }

    // verfy if username and password match the database 
    // return true if matchs
    function VerfyPassword($username,$password)
    {
        $UserFetchedData = $this->getUserDataByCreditials($username,$password);
        return ((password_verify($password, $UserFetchedData[0]['password'])) AND ($UserFetchedData[0]['username'] == $username OR $UserFetchedData[0]['stf_email'] == $username )) ? true : false ;
    
        }

        function resetPassword($uname,$pass)
        {
            $query = "UPDATE staffs_info SET  `staffs_info`.`password` = ? WHERE `staffs_info`.`stf_email` = ? ";
            $paramType = "ss";
            $paramValue = array(
                $pass,
                $uname

            );
            
            $updated = $this->db_handle->update($query, $paramType, $paramValue);
            return $updated;

        }
    // end of functions called in user login functions


    

    function addStaff($stf_id, $stf_fname, $stf_lname, $gender, $stf_tel_no, $stf_email, $stf_date_joined, $username, $password, $dept_id, $role_id, $is_admin) {
        $query = "INSERT INTO `urstms`.`staffs_info`(`stf_id`, `stf_fname`, `stf_lname`, `gender`, `stf_tel_no`, `stf_email`, `stf_date_joined`,`username`, `password`, `dept_id`, `role_id`, `is_admin`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
        $paramType = "issssssssiii";
        $paramValue = array(
            $stf_id,
            $stf_fname,
            $stf_lname,
            $gender,
            $stf_tel_no,
            $stf_email,
            $stf_date_joined,
            $username, 
            $password,
            $dept_id,
            $role_id,
            $is_admin
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }

    // update a staffs information
    
    function updateStaff($first_name, $last_name, $telphone, $staff_email, $username, $staff_id){
        $query = "UPDATE staffs_info  SET  stf_fname = ?, stf_lname = ?, stf_tel_no = ?, stf_email = ?, username = ? WHERE stf_id = ?;";
        $paramType = "sssssi";
        $paramValue = array(
            $first_name, 
            $last_name, 
            $telphone, 
            $staff_email, 
            $username,
            $staff_id
        );
        
        $updated = $this->db_handle->update($query, $paramType, $paramValue);
        return $updated;
    }


    // update staffs password

    function Update_staff_Password($password, $staff_id) {
        $query = "UPDATE `staffs_info` SET `staffs_info`.`password` = ? WHERE `staffs_info`.`stf_id` = ?";
        $paramType = "si";
        $paramValue = array(
            $password,
            $staff_id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
        
    }

    
    function deleteStaff($student_id) {
        $query = "DELETE FROM tbl_student WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $student_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

        
    function getStaffById($staff_id){
        $query = "SELECT * FROM staffs_info INNER JOIN departements ON departements.dept_id = staffs_info.dept_id AND staffs_info.stf_id = ? INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON colleges.coll_id = schools.coll_id";
        $paramType = "i";
        $paramValue = array(
            $staff_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getStaff_HODbyDept($dept_id) {
        $query_HOD = "SELECT * FROM staffs_info INNER JOIN departements ON departements.dept_id = staffs_info.dept_id AND departements.dept_id = ? INNER JOIN roles ON staffs_info.role_id = roles.role_id AND roles.role_id = 7 INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON colleges.coll_id = schools.coll_id;";
        $paramType = "i";
        $paramValue = array(
            $dept_id
        );
        
        $result = $this->db_handle->runQuery($query_HOD, $paramType, $paramValue);
        return $result;
    }

    function getStaff_DeanbySchool($school_id) {
        $query_dean = "SELECT * FROM staffs_info INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN roles ON staffs_info.role_id = roles.role_id AND roles.role_id = 7 INNER JOIN schools ON schools.scl_id = departements.scl_id AND departements.scl_id = ? INNER JOIN colleges ON colleges.coll_id = schools.coll_id;";
        $paramType = "i";
        $paramValue = array(
            $school_id
        );
        
        $result = $this->db_handle->runQuery($query_dean, $paramType, $paramValue);
        return $result;
    }


    function getStaff_Principalbycollege($college_id) {
        $query_principle = "SELECT * FROM staffs_info INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN roles ON staffs_info.role_id = roles.role_id AND roles.role_id = 3 INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON colleges.coll_id = schools.coll_id AND colleges.coll_id = ?;";
$paramType = "i";
        $paramValue = array(
            $college_id
        );        
        $result = $this->db_handle->runQuery($query_principle, $paramType, $paramValue);
        return $result;
    }



    function getStaff_HRbycollege($college_id) {
        $query_HR = "SELECT * FROM staffs_info INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN roles ON staffs_info.role_id = roles.role_id AND roles.role_id = 4 INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON colleges.coll_id = schools.scl_id AND colleges.coll_id = ?;";
        $paramType = "i";
        $paramValue = array(
            $college_id
        );        
        $result = $this->db_handle->runQuery($query_HR, $paramType, $paramValue);
        return $result;
    }


            
    function getAllStaff_in_dept($dept_id){
        $query = "SELECT staffs_info.* ,departements.*, roles.*, schools.*, colleges.*, COUNT(user_request.stf_id) as nb_of_request_per_staff FROM staffs_info INNER JOIN departements ON departements.dept_id = staffs_info.dept_id AND departements.dept_id = ? INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON colleges.coll_id = schools.coll_id INNER JOIN user_request ON user_request.stf_id = staffs_info.stf_id GROUP BY user_request.stf_id;";
        $paramType = "i";
        $paramValue = array(
            $dept_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getAllStaff_in_school($school_id){
        $query = "SELECT staffs_info.* ,departements.*, roles.*, schools.*, colleges.*, COUNT(user_request.stf_id) as nb_of_request_per_staff FROM staffs_info INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN schools ON schools.scl_id = departements.scl_id AND schools.scl_id = ? INNER JOIN colleges ON colleges.coll_id = schools.coll_id INNER JOIN user_request ON user_request.stf_id = staffs_info.stf_id GROUP BY user_request.stf_id;";
        $paramType = "i";
        $paramValue = array(
            $school_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }


    function getAllStaff_in_college($coll_id){
        $query = "SELECT staffs_info.* ,departements.*, roles.*, schools.*, colleges.* FROM staffs_info INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON colleges.coll_id = schools.coll_id AND colleges.coll_id = ?;";
        $paramType = "i";
        $paramValue = array(
            $coll_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getAllStaff_in_college_who_has_requested($coll_id){
        $query = "SELECT staffs_info.* ,departements.*, roles.*, schools.*, colleges.*, COUNT(user_request.stf_id) as nb_of_request_per_staff FROM staffs_info INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN roles ON staffs_info.role_id = roles.role_id INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON colleges.coll_id = schools.coll_id AND colleges.coll_id = ? INNER JOIN user_request ON user_request.stf_id = staffs_info.stf_id GROUP BY user_request.stf_id;";
        $paramType = "i";
        $paramValue = array(
            $coll_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function changeStaffStatus($staff_id,$new_status){
        $query = "UPDATE `urstms`.`staffs_info`  SET statuses = ? WHERE stf_id = ?";
        $paramType = "ii";
        $paramValue = array(
            $new_status,
            $staff_id        
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }

}
?>