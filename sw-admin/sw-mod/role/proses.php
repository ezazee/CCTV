<?php session_start();
if (empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])) {
  header('location:../../login/');
  exit;
} else {
  require_once '../../../sw-library/sw-config.php';
  require_once '../../login/login_session.php';
  include('../../../sw-library/sw-function.php');
  switch (@$_GET['action']) {
    case 'iscreated':
      $id   = $_POST['isCreatedId'];
      $data = $_POST['isCreated'];
      $update = "UPDATE `user_level` SET `is_create`='$data' WHERE `level_id`='$id'";
      if ($connection->query($update) === false) {
        die($connection->error . __LINE__);
        echo 'Data tidak berhasil disimpan!';
      } else {
        echo 'success';
      }
      break;
    case 'isupdated':
      $id   = $_POST['isUpdatedId'];
      $data = $_POST['isUpdated'];
      $update = "UPDATE `user_level` SET `is_update`='$data' WHERE `level_id`='$id'";
      if ($connection->query($update) === false) {
        die($connection->error . __LINE__);
        echo 'Data tidak berhasil disimpan!';
      } else {
        echo 'success';
      }
      break;
    case 'isdeleted':
      $id   = $_POST['isDeletedId'];
      $data = $_POST['isDeleted'];
      $update = "UPDATE `user_level` SET `is_delete`='$data' WHERE `level_id`='$id'";
      if ($connection->query($update) === false) {
        die($connection->error . __LINE__);
        echo 'Data tidak berhasil disimpan!';
      } else {
        echo 'success';
      }
      break;

    case 'isupload':
      $id   = $_POST['isUploadId'];
      $data = $_POST['isUpload'];
      $update = "UPDATE `user_level` SET `is_upload`='$data' WHERE `level_id`='$id'";
      if ($connection->query($update) === false) {
        die($connection->error . __LINE__);
        echo 'Data tidak berhasil disimpan!';
      } else {
        echo 'success';
      }
      break;

    case 'isdownload':
      $id   = $_POST['isDownloadId'];
      $data = $_POST['isDownload'];
      $update = "UPDATE `user_level` SET `is_download`='$data' WHERE `level_id`='$id'";
      if ($connection->query($update) === false) {
        die($connection->error . __LINE__);
        echo 'Data tidak berhasil disimpan!';
      } else {
        echo 'success';
      }
      break;

    case 'created':
      $roleUser = mysqli_real_escape_string($connection, $_POST['role-user']);
      $add = "INSERT INTO `user_level` (`level_name`) values('$roleUser')";
      if ($connection->query($add) === false) {
        die($connection->error . __LINE__);
        echo 'Data tidak berhasil disimpan!';
      } else {
        echo 'success';
        imagejpeg($tmp, $directory, 90);
      }
      break;
  }
}
