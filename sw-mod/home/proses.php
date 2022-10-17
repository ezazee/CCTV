<?php
header('Content-Type: application/json; charset=utf-8');

$aksi = $_REQUEST['aksi'];
date_default_timezone_set("Asia/Jakarta");

session_start();
include_once '../../sw-library/sw-config.php';
include_once '../../sw-library/sw-function.php';
ob_start("minify_html");
$dbhostsql      = DB_HOST;
$dbusersql      = DB_USER;
$dbpasswordsql  = DB_PASSWD;
$dbnamesql      = DB_NAME;
$connection     = mysqli_connect($dbhostsql, $dbusersql, $dbpasswordsql, $dbnamesql) or die(mysqli_error($connection));


if (!isset($_COOKIE['COOKIES_MEMBER']) && !isset($_COOKIE['COOKIES_COOKIES'])) {
    $res['status'] = 401;
    echo json_encode($res);
} else {
    $COOKIES_COOKIES = '';
    $COOKIES_MEMBER = '';
    if (!empty($_COOKIE['COOKIES_COOKIES'])) {
        $COOKIES_COOKIES   =  $_COOKIE['COOKIES_COOKIES'];
    }
    if (!empty($_COOKIE['COOKIES_MEMBER'])) {
        $COOKIES_MEMBER     =  epm_decode($_COOKIE['COOKIES_MEMBER']);
    }
    require_once '../../sw-mod/out/sw-cookies.php';
    $query_absent   = "SELECT employees_id,time_in,time_out FROM presence WHERE employees_id='$row_user[id]' AND presence_date='$date'";
    $result_absent  = $connection->query($query_absent);
    $row_absent     = $result_absent->fetch_assoc();

    if ($aksi == "get-banner") {
        $query = "SELECT id,image FROM news";
        $result = $connection->query($query);
        $rows    = $result->fetch_all(MYSQLI_ASSOC);

        $res['status'] = 200;
        $res['success'] = true;
        $res['data'] = $rows;
        echo json_encode($res);
    }

    if ($aksi == "get-absent") {
        $res['status'] = 200;
        $res['success'] = true;
        $res['is_absent'] = ($row_absent) ? true : false;
        echo json_encode($res);
    }

    if ($aksi == "get-news") {
        $id = $_GET['id'];
        $query = "SELECT * FROM news WHERE id=$id";
        $result = $connection->query($query);
        $news    = $result->fetch_assoc();

        $res['status'] = 200;
        $res['success'] = true;
        $res['data'] = $news;
        echo json_encode($res);
    }

    if ($aksi == "get-last-report") {
        $query = "SELECT
                a.created_at, b.employe_name kepada, b.work_report_id
                FROM m_work_report a 
                LEFT JOIN tr_report_purpose_to_work_report b 
                ON a.id = b.work_report_id
                WHERE 
                a.employe_id = '$row_user[id]'
                ORDER BY a.id DESC 
                LIMIT 1
    ";
        $result = $connection->query($query);
        $report    = $result->fetch_assoc();

        $res['status'] = 200;
        $res['success'] = true;
        $res['data'] = $report;
        echo json_encode($res);
    }

    if ($aksi == "get-profile") {

        $res['status'] = 200;
        $res['success'] = true;
        $res['data'] = [
            'employees_name' => $row_user['employees_name'],
            'photo' => $row_user['photo'],
            'id' => $row_user['id'],
            'building_id' => $row_user['building_id']
        ];
        echo json_encode($res);
    }

    if ($aksi == "set-user-latitude-longtitude") {
        $latlong = $_POST['latlong'];
        $update = "UPDATE `employees` SET latitude_longtitude = '$latlong' WHERE id = '$row_user[id]'";
        if ($connection->query($update) === false) {
            die($connection->error . __LINE__);
            $res['success'] = false;
            $res['message'] = 'Update lokasi terbaru gagal, silahkan nanti coba kembali!';
        } else {
            $res['success'] = true;
            $res['message'] = 'Update lokasi terbaru suksess!';
        }

        $res['status'] = 200;
        $res['success'] = true;
        echo json_encode($res);
    }
}
