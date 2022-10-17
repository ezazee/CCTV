<?php
header('Content-Type: application/json; charset=utf-8');

$aksi = $_REQUEST['aksi'];
date_default_timezone_set("Asia/Jakarta");


require_once "../../sw-library/sw-config.php";
$dbhostsql      = DB_HOST;
$dbusersql      = DB_USER;
$dbpasswordsql  = DB_PASSWD;
$dbnamesql      = DB_NAME;

//koneksi
$conn = mysqli_connect($dbhostsql, $dbusersql, $dbpasswordsql, $dbnamesql);
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}

if ($aksi == "get-banner") {
    $query = "SELECT title, image FROM news";
    $result = $conn->query($query);
    $rows    = $result->fetch_all(MYSQLI_ASSOC);

    $res['status'] = 200;
    $res['success'] = true;
    $res['data'] = $rows;
    echo json_encode($res);
}
