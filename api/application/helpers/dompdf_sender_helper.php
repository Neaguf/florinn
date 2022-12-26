<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once 'dompdf/lib/html5lib/Parser.php';
require_once 'dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once 'dompdf/lib/php-svg-lib/src/autoload.php';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();


use Dompdf\Dompdf;


function pdf_create($html, $filename='', $orientare , $stream=true, $forceDownload=true)
{
    $dompdf = new DOMPDF();
	$dompdf->set_paper('A4', $orientare);

    $dompdf->load_html($html);

    $dompdf->render();


	if( $forceDownload )
	{
		header("Content-Type:application/pdf");
		header("Content-Disposition: inline; filename=\"$filename\"");
		header("Cache-control: private");
	}

    if ($stream)
    {
	    $dompdf->stream( $filename . ".pdf", array( "Attachment" => 0 ) );
    }
    else
    {
	    return $dompdf->output();
    }
} 
?>