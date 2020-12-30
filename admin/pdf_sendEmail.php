<?php 
if(isset($_POST['sendEmail']))
{
    $filename = md5(rand()) .'pdf';
    $html_code = '.css';
    $html_code .= fetch_customer_data($conenct);
    $pdf = new pfd();
    $pdf->load_html($html_code);
    $pdf->render();
    $file = $pdf->output();
    file_put_contents($filename, $file);
    
    require 'class/class.phpmailer.php';
    $mail = new PHPMailer;
    $mail-IsSMTP();
    
}
?>