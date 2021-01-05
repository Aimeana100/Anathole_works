<?php 
// pdf.php
require_once '../dompdf/';
use Dompdf\Dompdf;
class pdf extends Dompdf
{
    public function __construct()
    {
        parent::__construct();
        
    }
}
?>