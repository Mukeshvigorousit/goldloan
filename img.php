<?php
require 'vendor/autoload.php';
 
$mpdf = new \Mpdf\Mpdf();

// Full path to the image file
$imagePath = 'C:/xampp/htdocs/goldloan/img/item/item_full/1696968225468411.png';

// HTML content with an image using the full path
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDF with Image</title>
</head>
<body>
    <h1>PDF with Image</h1>
    <p>This is an example of a PDF with an image.</p>
    <img src="' . getcwd() . '\\img\\item\\item_full\\1696968157114306.jpeg" alt="Sample Image" style="width: 200px;">
</body>
</html>
';

$mpdf->WriteHTML($html);

// Output the PDF to the browser
$mpdf->Output();

// Save the PDF to a file
// $mpdf->Output('output.pdf', \Mpdf\Output\Destination::FILE);
