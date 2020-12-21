<?php 

// require_once "Classes/DBController.php";

class Notification {    
    private $db_handle;


    function Notification(){
        $this->db_handle = new DBController();
    }

    function insertNotification($req_id,$hod_sansation_notification, $dean_sansation_notification, $principal_sansation_notification){
        $query = "INSERT INTO `urstms`.`action_notifications` (req_id,hod_sansation_notification,dean_sansation_notification,principal_sansation_notification) VALUES (?,?,?,?);";
        $paramType = "iiii";
        $paramValue = array(
            $req_id,
            $hod_sansation_notification,
            $dean_sansation_notification,
            $principal_sansation_notification
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }

    function hodActionViewed($hod_sansation_notification, $req_id){
        $query = "UPDATE `urstms`.`action_notifications`  SET hod_sansation_notification = ? WHERE req_id = ?";
        $paramType = "i";
        $paramValue = array(
            $hod_sansation_notification,
            $req_id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);


    }


    function DeanActionViewed($dean_sansation_notification, $req_id){
        $query = "UPDATE `urstms`.`action_notifications`  SET dean_sansation_notification = ? WHERE req_id = ?";
        $paramType = "i";
        $paramValue = array(
            $dean_sansation_notification,
            $req_id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }


    function principalActionViewed($principal_sansation_notification, $req_id){
        $query = "UPDATE `urstms`.`action_notifications`  SET principal_sansation_notification = ? WHERE req_id = ?";
        $paramType = "i";
        $paramValue = array(
            $principal_sansation_notification,
            $req_id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    }

?>