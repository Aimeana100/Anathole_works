<?php
$image = $_POST["image"];
$image = explode(";", $image)[1];
$image = explode(",", $image)[1];
$image = base64_decode($image);
$image = str_replace(" ","+", $image);
file_put_contents("uploads_requests_images/filename2.jpeg", $image);
echo "done";
?>