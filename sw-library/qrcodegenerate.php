<?php

require_once './qr_code/qrlib.php';

if (isset($_GET['text'])) {
    $isi_teks = $_GET['text'];
    QRCode::png($isi_teks);
}
