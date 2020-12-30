<?php
//  include('Classes/DBController.php');
//  include('Classes/Staff_class.php');
//  include('Classes/Login/Sessions_class.php');
 include('Classes/Login/Functions.php');
 $loginFunctions = new Functions();
 $loginFunctions->deleteCokies();
header("location:./index.php"); 
?>

