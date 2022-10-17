<?php session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])) {
  header('location:../../login/');
  exit;
} else {
  require_once '../../../sw-library/vendor/autoload.php';
  require_once '../../../sw-library/sw-config.php';
  require_once '../../login/login_session.php';
  include('../../../sw-library/sw-function.php');

  $options = array(
    'cluster' => 'ap1',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '7f343d2bf73dbaa74e14',
    'c99a5484fdacf5c83137',
    '1431303',
    $options
  );

  switch (@$_GET['action']) {
    case 'tambah':
      $checkbox   = $_POST['checkbox'];
      $penempatan = $_POST['state'];
      $anggota    = $_POST['anggota'];
      $isipesan   = $_POST['isi-pesan'];
      $linkzoom   = $_POST['link-zoom'];
      $uploadTo       = "../../../sw-content/broadcast/";
      $allowFileType  = ['pdf'];
      $fileName       = $_FILES['file']['name'];
      $tempPath       = $_FILES['file']['tmp_name'];
      $baseName       = time() . "-" . basename($fileName);
      $originalPath   = $uploadTo . $baseName;
      $fileType       = pathinfo($originalPath, PATHINFO_EXTENSION);
      if (!empty($fileType)) {
        if (in_array($fileType, $allowFileType)) {
          if (move_uploaded_file($tempPath, $originalPath)) {
            $insertFileName   = $baseName;
          } else {
            echo "file gagal di upload, coba lagi";
          }
        } else {
          echo $fileType . "Tipe File Salah";
        }
      } else {
        $insertFileName   = "";
      }
      if ($checkbox === null) {
        echo "validation";
      } else {
        $add = "INSERT INTO `m_broadcast` (`pesan`,
              `file`,
              `link_zoom`) values('$isipesan',
              '$insertFileName',
              '$linkzoom')";
        if ($connection->query($add) === false) {
          die($connection->error . __LINE__);
          echo 'error';
        } else {
          $query  = "SELECT * FROM `m_broadcast` ORDER BY `id` DESC LIMIT 1";

          $result = $connection->query($query);
          $row    = $result->fetch_assoc();
          $datapusher['message'] = $row['pesan'];
          if ($checkbox === "1") {
            $queryEmploye       = "SELECT * FROM `employees`";
            $resultQueryEmploye = $connection->query($queryEmploye);
            $broadcstId         =  $row['id'];
            if ($resultQueryEmploye->num_rows > 0) {
              while ($employe = $resultQueryEmploye->fetch_assoc()) {
                $employeid  = $employe['id'];
                $insertTBroadcast = "INSERT INTO `t_broadcast_to_employe` (`broadcast_id`,`employee_id`) values('$broadcstId','$employeid')";
                $queryInsertTBroadcast = $connection->query($insertTBroadcast);
                // var_dump($queryInsertTBroadcast);
                $mail = new PHPMailer(true);

                try {
                  $penerima = [
                    'id'      => epm_encode($id),
                    'email'   => $employe['employees_email'],
                    'name'    => $employe['employees_name']
                  ];
                  $mail->isSMTP();
                  $mail->SMTPDebug    = 0;
                  $mail->Debugoutput  = 'html';
                  $mail->Host         = 'srv159.niagahoster.com';
                  $mail->Port         = 587;
                  $mail->SMTPSecure   = 'tls';
                  $mail->SMTPAuth     = true;
                  $mail->Username     = 'no-reply@bt-pmp.com';
                  $mail->Password     = 'ReactNative1234%';
                  //Recipients
                  $mail->setFrom('no-reply@bt-pmp.com', 'Sister Kominda');
                  $mail->addAddress($penerima['email'], $penerima['name']);     //Add a recipient
                  $mail->addReplyTo('no-reply@bt-pmp.com', 'Sister Kominda');
                  //Attachments
                  //Content
                  $mail->isHTML(true);                                  //Set email format to HTML
                  $mail->Subject = 'Pesan Broadcast';
                  // $mail->Body    = 'Selamat akun mu sudah di acc admin, silahkan klik link <a href="https://sisters-kominda.eagleye.id/email?email=' . $penerima['email'] . '&code=' . $penerima['id'] . '"> Akivasi </a> atau salin link dan pastekan di web browser <a href="https://sisters-kominda.eagleye.id/email?email=' . $penerima['email'] . '&code=' . $penerima['id'] . '"> https://sisters-kominda.eagleye.id/email?email=' . $penerima['email'] . '&code=' . $penerima['id'] . ' </a>';
                  $mail->Body    = '' . $row['pesan'];
                  $mail->send();
                  // echo 'success';
                  // echo 'Message has been sent';
                } catch (Exception $e) {
                  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
              }
              // push notification
              $pusher->trigger('notif-chanel', 'notif-all', $datapusher);
            }
          } elseif ($checkbox === '2') {
            $buildingId         = $penempatan;
            $queryEmploye       = "SELECT * FROM `employees` WHERE `building_id` = '$buildingId'";
            $resultQueryEmploye = $connection->query($queryEmploye);
            $broadcstId         =  $row['id'];
            if ($resultQueryEmploye->num_rows > 0) {
              while ($employe = $resultQueryEmploye->fetch_assoc()) {
                $employeid  = $employe['id'];
                $insertTBroadcast = "INSERT INTO `t_broadcast_to_employe` (`broadcast_id`,`employee_id`) values('$broadcstId','$employeid')";
                $queryInsertTBroadcast = $connection->query($insertTBroadcast);
                $mail = new PHPMailer(true);

                try {
                  $penerima = [
                    'id'      => epm_encode($id),
                    'email'   => $employe['employees_email'],
                    'name'    => $employe['employees_name']
                  ];
                  $mail->isSMTP();
                  $mail->SMTPDebug    = 0;
                  $mail->Debugoutput  = 'html';
                  $mail->Host         = 'srv159.niagahoster.com';
                  $mail->Port         = 587;
                  $mail->SMTPSecure   = 'tls';
                  $mail->SMTPAuth     = true;
                  $mail->Username     = 'no-reply@bt-pmp.com';
                  $mail->Password     = 'ReactNative1234%';
                  //Recipients
                  $mail->setFrom('no-reply@bt-pmp.com', 'Sister Kominda');
                  $mail->addAddress($penerima['email'], $penerima['name']);     //Add a recipient
                  $mail->addReplyTo('no-reply@bt-pmp.com', 'Sister Kominda');
                  //Attachments
                  //Content
                  $mail->isHTML(true);                                  //Set email format to HTML
                  $mail->Subject = 'Pesan Broadcast';
                  // $mail->Body    = 'Selamat akun mu sudah di acc admin, silahkan klik link <a href="https://sisters-kominda.eagleye.id/email?email=' . $penerima['email'] . '&code=' . $penerima['id'] . '"> Akivasi </a> atau salin link dan pastekan di web browser <a href="https://sisters-kominda.eagleye.id/email?email=' . $penerima['email'] . '&code=' . $penerima['id'] . '"> https://sisters-kominda.eagleye.id/email?email=' . $penerima['email'] . '&code=' . $penerima['id'] . ' </a>';
                  $mail->Body    = '' . $row['pesan'];
                  $mail->send();
                  // echo 'success';
                  // echo 'Message has been sent';
                } catch (Exception $e) {
                  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
              }
              // push notification
              $pusher->trigger('notif-chanel', 'notif-building-' . $buildingId, $datapusher);
            }


            if ($explodeCheckbox[0] === 'anggota') {
            }
          } elseif ($checkbox === '3') {
            $anggotaId          = $anggota;
            $queryEmploye       = "SELECT * FROM `employees` WHERE `id` = '$anggotaId'";
            $resultQueryEmploye = $connection->query($queryEmploye);
            $broadcstId         =  $row['id'];
            if ($resultQueryEmploye->num_rows > 0) {
              $employe = $resultQueryEmploye->fetch_assoc();
              $employeid  = $employe['id'];
              $insertTBroadcast = "INSERT INTO `t_broadcast_to_employe` (`broadcast_id`,`employee_id`) values('$broadcstId','$employeid')";
              $queryInsertTBroadcast = $connection->query($insertTBroadcast);
              $mail = new PHPMailer(true);

              try {
                $penerima = [
                  'id'      => epm_encode($id),
                  'email'   => $employe['employees_email'],
                  'name'    => $employe['employees_name']
                ];
                $mail->isSMTP();
                $mail->SMTPDebug    = 0;
                $mail->Debugoutput  = 'html';
                $mail->Host         = 'srv159.niagahoster.com';
                $mail->Port         = 587;
                $mail->SMTPSecure   = 'tls';
                $mail->SMTPAuth     = true;
                $mail->Username     = 'no-reply@bt-pmp.com';
                $mail->Password     = 'ReactNative1234%';
                //Recipients
                $mail->setFrom('no-reply@bt-pmp.com', 'Sister Kominda');
                $mail->addAddress($penerima['email'], $penerima['name']);     //Add a recipient
                $mail->addReplyTo('no-reply@bt-pmp.com', 'Sister Kominda');
                //Attachments
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Pesan Broadcast';
                // $mail->Body    = 'Selamat akun mu sudah di acc admin, silahkan klik link <a href="https://sisters-kominda.eagleye.id/email?email=' . $penerima['email'] . '&code=' . $penerima['id'] . '"> Akivasi </a> atau salin link dan pastekan di web browser <a href="https://sisters-kominda.eagleye.id/email?email=' . $penerima['email'] . '&code=' . $penerima['id'] . '"> https://sisters-kominda.eagleye.id/email?email=' . $penerima['email'] . '&code=' . $penerima['id'] . ' </a>';
                $mail->Body    = '' . $row['pesan'];
                $mail->send();
                // echo 'success';
                // echo 'Message has been sent';
              } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
              }

              // push notification
              $pusher->trigger('notif-chanel', 'notif-id-' . $employeid, $datapusher);
            }
          }
          echo 'success';
        }
      }
      break;
  }
}
