<?php
//GA KEPAKE
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
