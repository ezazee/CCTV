<?php
error_reporting(0);
require_once '../sw-library/sw-config.php';
require_once '../sw-library/sw-function.php';

$email = $_GET['email'];
$id    = epm_decode($_GET['code']);

$update = "UPDATE employees SET is_active='2' WHERE id='$id'";
if ($connection->query($update) === false) {
  die($connection->error . __LINE__);
  echo 'Data tidak berhasil disimpan!';
} else {
  $_SESSION["success-activation"] = "success-activation";
  header("Location: https://sisters-kominda.eagleye.id/");
}
