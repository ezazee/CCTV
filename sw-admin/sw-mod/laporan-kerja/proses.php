<?php session_start();
if (empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])) {
  header('location:../../login/');
  exit;
} else {
  require_once '../../../sw-library/sw-config.php';
  require_once '../../login/login_session.php';
  include('../../../sw-library/sw-function.php');
  switch (@$_GET['action']) {
    case 'delete':
      $id       = mysqli_real_escape_string($connection, epm_decode($_POST['id']));
      $deleted  = "DELETE FROM `m_work_report` WHERE id='$id'";
      if ($connection->query($deleted) === true) {
        $deleteForward  = mysqli_query($connection, "DELETE FROM `tr_forward_report_to_work_report` WHERE `work_report_id` = '$id'");
        $deletePenerima  = mysqli_query($connection, "DELETE FROM `tr_report_purpose_to_work_report` WHERE `work_report_id` = '$id'");
        $cari = "SELECT * FROM `tr_picture_to_work_report` WHERE `work_report_id`='$id'";
        $resultPict = $connection->query($cari);
        while ($row = $resultPict->fetch_assoc()) {
          $picture  = '../../../../sw-mod/laporan-kerja/upload/image/' . $row['picture'] . '';
          unlink($picture);
        }
        $deletePenerima  = mysqli_query($connection, "DELETE FROM `tr_picture_to_work_report` WHERE `work_report_id` = '$id'");
        echo 'success';
      } else {
        //tidak berhasil
        echo 'Data tidak berhasil dihapus.!';
        die($connection->error . __LINE__);
      }
      break;
  }
}
