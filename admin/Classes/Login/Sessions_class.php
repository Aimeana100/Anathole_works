<?php
// request progress 1: not yet seen, 2: approved or not approve 3: in excution 4:excutted, 5:reported completed. 

class Sessions {    
    private $db_handle;
    
    function Sessions(){
        $this->db_handle = new DBController();
    }

    // insert_req and user_ request can be merged / call insertUserRequest

    function insertSessions($user_id, $sess_token, $sess_serial, $sess_date){

        $query = "INSERT INTO `sessions`(`stf_id`,`session_tokens`, `session_serial`, `session_date`) VALUES (?,?,?,?)";
        $paramType = "isss";
        $paramValue = array(
            $user_id,
            $sess_token,
            $sess_serial,
            $sess_date
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;

    }


    function getSessions(){
        $query = "SELECT * FROM sessions";
        $sessions = $this->db_handle->runBaseQuery($query);
        return $sessions;
    
    }

    function getSessionByCreditials($sess_user, $sess_token, $sess_serial){

    $query = "SELECT * FROM sessions WHERE stf_id = ? AND session_tokens = ? AND session_serial = ?;";
    $paramType = "iss";
    $paramValue = array(
        $sess_user,
        $sess_token,
        $sess_serial
    );
    
    $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
    return $result;

    }

    function selectUserByusernamePassword($username, $password){
        $sql_query = "SELECT * FROM staffs_info INNER JOIN departements ON departements.dept_id = staffs_info.dept_id INNER JOIN schools ON schools.scl_id = departements.scl_id INNER JOIN colleges ON schools.coll_id = colleges.coll_id INNER JOIN  roles ON roles.role_id = staffs_info.role_id WHERE username = ? OR stf_email = ? AND password = ?;";
        $paramType = "sss";
        $paramValue = array($username,$username,$password);
        $result = $this->db_handle->runQuery($sql_query, $paramType, $paramValue);
        return $result;
    }

    function deleteSessions($session_id){
        $query = "DELETE FROM sessions WHERE stf_id = ?";
        $paramType = "i";
        $paramValue = array(
            $session_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    } 


    


}


?>