<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../../sw-library/vendor/autoload.php';
require_once '../../sw-library/sw-config.php';
include_once '../../sw-library/sw-function.php';
$email = $_POST['email'];

$user       = "SELECT * FROM `user` WHERE `email`='$email'";
$resultUser = $connection->query($user);
$userNum    = $resultUser->num_rows;
if ($userNum > 0) {
  $deleteToken  = "DELETE FROM `tr_token` WHERE email = '$email'";
  $delete       = $connection->query($deleteToken);
  $token        = "SELECT * FROM `t_token` WHERE email = '$email'";
  $resultToken  = $connection->query($token);
  if ($resultToken->num_rows <= 0) {
    $date         = date('Y-m-d H:i:s');
    $newdate      = date('Y-m-d H:i:s', strtotime('+2 days', strtotime($date))); //operasi penjumlahan tanggal sebanyak 6 hari  
    $expiredDate  = $newdate;
    $randomString = generateRandomString(30);
    $queryInsert  = "INSERT INTO `tr_token`(`email`,`token`,`level`,`expired_at`)VALUES('$email','$randomString','admin','$expiredDate')";
    if ($connection->query($queryInsert) === false) {
      die($connection->error . __LINE__);
      echo 'Data tidak berhasil disimpan!';
    } else {
      $mail = new PHPMailer(true);
      try {
        $penerima = [
          'email'   => $email,
          'token'   => $randomString
        ];
        $mail->isSMTP();
        $mail->SMTPDebug    = 0;
        $mail->Debugoutput  = 'html';
        $mail->Host         = 'smtp.gmail.com';
        $mail->Port         = 465;
        $mail->SMTPSecure   = 'ssl';
        $mail->SMTPAuth     = true;
        $mail->Username     = 'sisterkominda@gmail.com';
        $mail->Password     = '123Daftar@@';
        //Recipients
        $mail->setFrom('sisterkominda@gmail.com', 'Sister Kominda');
        $mail->addAddress($penerima['email'], '');     //Add a recipient
        $mail->addReplyTo('sisterkominda@gmail.com', 'Sister Kominda');
        //Attachments
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reset Password';
        $mail->Body    = 'Hallo, silahkan klik link <a href="https://sisters-kominda.eagleye.id/sw-admin/login/form-reset-password?email=' . $penerima['email'] . '&token=' . $penerima['token'] . '"> Reset Password </a> atau salin link dan pastekan di web browser <a href="https://sisters-kominda.eagleye.id/sw-admin/login/form-reset-password?email=' . $penerima['email'] . '&token=' . $penerima['token'] . '"> https://sisters-kominda.eagleye.id/sw-admin/login/form-reset-password?email=' . $penerima['email'] . '&token=' . $penerima['token'] . ' </a>';
        $mail->send();
        $_SESSION["success-reset"] = "success-reset";
        header("Location: ./");
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }
  }
} else {
  $_SESSION["user-not-found"] = "user-not-found";
  header("Location: ./");
}

function generateRandomString($length = 10)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
