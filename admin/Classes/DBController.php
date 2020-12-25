<?php
// namespace DBController\DBController;
class DBController {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "urstms";
    private $conn;

    // private $host = "sql9.freemysqlhosting.net";
    // private $user = "sql9381078";
    // private $password = "6LSwAhSFbV";
    // private $database = "sql9381078";
    // private $conn;


    // private $host = "sql9.freemysqlhosting.net";
    // private $user = "epiz_27536849";
    // private $password = "mIpx46lqqGG0";
    // private $database = "epiz_27536849_XXX";
    // private $conn;
    
    function __construct(){
        $this->conn = $this->connectDB();
    }  
    
    function connectDB() {
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        return $conn;
    }
    
    function runBaseQuery($query) {
        $result = $this->conn->query($query); 
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        
        
        return $resultset;
        }
    }
    
    
    
    function runQuery($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        $result = $sql->get_result();
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        
        if(!empty($resultset)) {
            return $resultset;
        }
    }
    
    function bindQueryParams($sql, $param_type, $param_value_array) {
        $param_value_reference[] = & $param_type;
        for($i=0; $i<count($param_value_array); $i++) {
            $param_value_reference[] = & $param_value_array[$i];
        }
        call_user_func_array(array(
            $sql,
            'bind_param'
        ), $param_value_reference);
    }
    
    function insert($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        $insertId = $sql->insert_id;
        if($insertId)
        {return $insertId;}
        else
        {
            return  mysqli_error($this->conn);

        }
        
    }
    
    function update($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        return ($sql->execute());
    }
    
    // db manipulation ( transaction)
    function startTransaction(){
       return mysqli_begin_transaction($this->conn, MYSQLI_TRANS_START_READ_WRITE);
        mysqli_autocommit($this->conn, FALSE);
    }

    function commitTransaction(){
    return mysqli_commit($this->conn);
    // return 1;
    }

    function rollBackTransaction(){
        mysqli_rollback($this->conn);
        return -1;
    }

    function closeDB(){
        mysqli_close($this->connectDB());
    }
    

}
?>