<?php

class Functions{
    public static function checkLoginState($Sessions){
        if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID']))
        {
            session_start();
        }
        if(isset($_COOKIE['id']) && isset($_COOKIE['token']))
        {
            $userid = $_COOKIE['userid'];
            $token = $_COOKIE['token'];
            $serial = $_COOKIE['serial'];

            $session = $Sessions->getSessionByCreditials($id, $token, $serial);
            if(isset($session)){
                if(
                    $session[0]['stf_id'] == $_COOKIE['userid'] &&
                    $session[0]['session_token'] == $_COOKIE['token'] &&
                    $session[0]['session_serial'] == $_COOKIE['serial']
                )
                {
                    if(
                        $session[0]['stf_id'] == $_SESSION['userid'] &&
                        $session[0]['session_token'] == $_SESSION['token'] &&
                        $session[0]['session_serial'] == $_SESSION['serial']
    
                    ){
                        return true;
                    }
    

                }
            }

            
        }
    }

    public static function createString($len)
    {
        $string = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $s = "";
        $r_new = "";
        $r_old = "";

        for($i = 1; $i < $len; $i++)
        {
            while($r_old == $r_new)
            {
                $r_new = rand(0, 60);
            }
            $r_old = $r_new;
            $s = $s.$string[$r_new];
        }
        return $s;

    }

}


?>