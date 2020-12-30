<?php

include('../Classes/DBController.php');
include('../Classes/Staff_class.php');
include('../Classes/Requests_class.php');
include('../Classes/Notification_class.php');
include('../Classes/Sessions_class.php');

$sessions = new Session();
if($Functions->checkLoginState($db->connectDB())) // check login state
{
    echo "welcome ". $_SESSION['username'];

}
else
{
    header("location:login.php");

}

?>