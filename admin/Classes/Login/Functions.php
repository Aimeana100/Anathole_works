<?php

class Functions{
    private $functions;
    public function Functions()
    {

    }
    public function checkLoginState($Sessions){
       
        if(isset($_COOKIE['user_id']) AND isset($_COOKIE['token']))
        {
            $user_id = $_COOKIE['user_id'];
            $token = $_COOKIE['token'];
            $serial = $_COOKIE['serial'];
            // $Admin_category = $_COOKIE['AdministrationID'];
        
            $session = $Sessions->getSessionByCreditials($user_id, $token, $serial);
            // $staffs = $Staffs->
            if(
                isset($session) && 
                isset($_COOKIE['user_id']) && 
                isset($_COOKIE['token']) &&
                isset($_COOKIE['serial']) &&
                isset($_SESSION['user_id']) &&
                isset($_SESSION['token']) &&
                isset($_SESSION['serial']) && 
                isset($_SESSION['role_id']) &&
                strlen($_SESSION['role_id']) != 0 
                
                // &&
                // isset($_SESSION['AdministrationID']) &&
                // strlen($_SESSION['AdministrationID']) != 0

                )
                {
                if(
                    $session[0]['stf_id'] == $_COOKIE['user_id'] &&
                    $session[0]['session_tokens'] == $_COOKIE['token'] &&
                    $session[0]['session_serial'] == $_COOKIE['serial']
                )
                {
                    if(
                        $session[0]['stf_id'] == $_SESSION['user_id'] &&
                        $session[0]['session_tokens'] == $_SESSION['token'] &&
                        $session[0]['session_serial'] == $_SESSION['serial']
                        
                    )
                    {
                        return true;
                    }
    

                }
            }

            
        }
    }

    public function createRecord($Sessions, $user_username, $user_userId,$userRole_id)
    {
        $Sessions->deleteSessions($user_userId);
        $token = $this->createString(32);
        $serial = $this->createString(32);

        $this->createCookies( $user_userId, $user_username, $token, $serial);
        $this->createSessions($userRole_id, $user_userId, $user_username, $token, $serial);

        $sessId = $Sessions->insertSessions($user_userId, $token, $serial,date("Y-m-d"));

    }

    public function createCookies($user_userId, $user_username, $token, $serial)
    {
        setcookie('user_id', $user_userId, time()+(86400)*30, "/");
        setcookie('user_username', $user_username, time()+(86400)*30, "/");
        setcookie('token', $token, time()+(86400)*30, "/");
        setcookie('serial', $serial, time()+(86400)*30, "/");
    }

    public function createSessions($role_id,$user_userId, $user_username, $token, $serial)
    { 
        $_SESSION['role_id'] = $role_id;
        $_SESSION['user_id'] = $user_userId;
        $_SESSION['user_username'] = $user_username;
        $_SESSION['token'] = $token;
        $_SESSION['serial'] = $serial;
    

    }

    public function deleteCokies()
    {
        setcookie('user_id', '', time()-1, "/");
        setcookie('user_username', '', time()-1, "/");
        setcookie('token', '', time()-1, "/");
        setcookie('serial', '', time()-1, "/");
        session_destroy(); // destroy session

    }

    public function createString($len)
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

    
    public function DirectUserPage($role, $direct_page_id)
    {
        $_SESSION['AdministrationID'] = $direct_page_id;
        switch ($role) {
          
          case '7':
            // $_SESSION['dept_id'] = $direct_page_id;
            // echo $fetchedUserData[0]['dept_id'];exit();
            // $_SESSION['role'] = $user_role;
            header('Location: head-of-departement/index.php');
          break;

          case '6':
            // $_SESSION['dean_id'] = $fetchedUserData[0]['stf_id'];
            // $_SESSION['scl_id'] = $direct_page_id;
            header('Location: dean-of-school/index.php');
          break;
        //   case '3':
        //     // $_SESSION['coll_id'] = $direct_page_id;     
        //     header('Location: principal-of-college/college-all-requests.php');
        //   break;

          case '3':
            // $_SESSION['coll_id'] = $direct_page_id;     
            header('Location: super-admins/admin-all-requests.php');
          break;

          case '4':
            // $_SESSION['coll_id'] = $direct_page_id;        
            header('Location: human-resource/index.php');
          break;


          default:
        //   $_SESSION['stfId'] = $fetchedUserData[0]['stf_id'];
        //   $_SESSION['role'] = $user_role;
          header('Location: staff/');
          break;
          }
                }

}


?>