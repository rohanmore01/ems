<?php

$decodedDoc = base64_decode($_POST['encoded_document']);
$file = $_POST['document_name'];
file_put_contents($file, $decodedDoc);

if (file_exists($file)) 
{
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);

    if (file_exists($file)) 
    {
		unlink($file);	
	}
    exit;
}

?>