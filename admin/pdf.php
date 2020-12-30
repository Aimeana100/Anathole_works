<?php 
// pdf.php
require_once 'dompdf/autoloaad.inc.php';
use Dompdf\Dompdf;
class pdf extends Dompdf
{
    public function __construct()
    {
        parent::__construct();
        
    }
}
?>