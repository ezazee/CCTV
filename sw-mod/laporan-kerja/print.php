<?php
ob_start();
session_start();
error_reporting(0);
require_once '../../sw-library/sw-config.php';
require_once '../../sw-library/sw-function.php';
include_once '../../sw-library/vendor/autoload.php';

// if (!isset($_COOKIE['COOKIES_MEMBER']) or !isset($_COOKIE['COOKIES_COOKIES'])) {
//   //Kondisi tidak login
// } else {
require_once '../../sw-mod/out/sw-cookies.php';
$mpdf = new \Mpdf\Mpdf();
include_once "print-pdf.php";
$html = ob_get_clean();

include_once "print-lampiran.php";
$lampiran = ob_get_clean();
$mpdf->WriteHTML($html, 2);
$mpdf->AddPage();
$mpdf->WriteHTML($lampiran, 2);
$mpdf->Output();
// }
