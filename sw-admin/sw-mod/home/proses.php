<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
if (empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])) {
    header('location:../../login/');
    exit;
} else {
    require_once '../../../sw-library/sw-config.php';
    require_once '../../login/login_session.php';
    include('../../../sw-library/sw-function.php');

    switch (@$_GET['action']) {
        case 'get-location':
            // $id       = mysqli_real_escape_string($connection, epm_decode($_POST['id']));
            $query = "SELECT code,name,address,latitude_longtitude FROM building";
            $result = $connection->query($query);
            if ($result->num_rows > 0) {
                echo json_encode($result->fetch_all(MYSQLI_ASSOC));
            } else {
                echo json_encode(null);
            }
            break;

        case 'get-employees':
            // $id       = mysqli_real_escape_string($connection, epm_decode($_POST['id']));
            $now = date("Y-m-d");
            $query = "SELECT
                        a.id,
                        a.employees_nip,
                        a.employees_name,
                        if(b.latest_presence>= current_date(), b.latitude_longtitude_in, a.latitude_longtitude ) latitude_longtitude,
                        if(b.latest_presence>= current_date(), true, false ) absen
                        FROM
                        employees a
                        LEFT JOIN (
                            SELECT
                            *, max(presence_date) latest_presence
                            from
                            presence
                            GROUP BY
                            employees_id
                            ORDER BY
                            presence_date DESC
                        ) b on a.id = b.employees_id 
                        ";
            $result = $connection->query($query);
            if ($result->num_rows > 0) {
                echo json_encode($result->fetch_all(MYSQLI_ASSOC));
            } else {
                echo json_encode(null);
            }
            break;
    }
}
