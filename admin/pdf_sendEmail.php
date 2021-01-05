<?php 
include('pdf.php');
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

if(isset($_POST['generate'])){
    $css = '../download.css';

    $filename = md5($_POST['req_id']) .'pdf';
    $html_code =$css . $_POST['html_code'];
    $pdf = new pdf();
    $pdf->load_html($html_code);
    // (Optional) Setup the paper size and orientation 
   $pdf->setPaper('A4', 'landscape'); 
    $pdf->render();
    $pdf->stream($filename, array("Attachment" => 0));
    echo $pdf->output();

}
?>