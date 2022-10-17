<?php
require_once '../../sw-library/sw-config.php';
include_once '../../sw-library/sw-function.php';
$salt       = '$%DSuTyr47542@#&*!=QxR094{a911}+';
$email            = $_POST['email'];
$token            = $_POST['token'];
$password         = $_POST['password'];
$confirmPassword  = $_POST['confirm-password'];
if ($password !== $confirmPassword) {
  $_SESSION["confirmPassword"] = "confirmPassword";
  header("Location: ./form-reset-password?email=" . $email . "&token=" . $token);
} else {
  $password = mysqli_real_escape_string($connection, hash('sha256', $salt . $_POST['password']));
  $update = "UPDATE user SET `password`='$password' WHERE `email`='$email'";
  if ($connection->query($update) === false) {
    die($connection->error . __LINE__);
    echo 'Data tidak berhasil disimpan!';
  } else {
    $deleteToken  = "DELETE FROM `tr_token` WHERE email = '$email'";
    $delete       = $connection->query($deleteToken);
    $_SESSION["success-reset-password"] = "success-reset-password";
    header("Location: ./");
  }
}
