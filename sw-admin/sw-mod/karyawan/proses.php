<?php session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//error_reporting(0);
if (empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])) {
  header('location:../../login/');
  exit;
} else {
  require_once '../../../sw-library/vendor/autoload.php';
  require_once '../../../sw-library/sw-config.php';
  require_once '../../login/login_session.php';
  include('../../../sw-library/sw-function.php');
  require_once '../../../sw-library/qr_code/qrlib.php';
  $max_size = 2000000; //2MB
  $salt = '$%DEf0&TTd#%dSuTyr47542"_-^@#&*!=QxR094{a911}+';

  switch (@$_GET['action']) {
    case 'add':
      $error = array();

      if (empty($_POST['employees_nip'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $employees_nip = mysqli_real_escape_string($connection, $_POST['employees_nip']);
        $employees_code = '' . $year . '/' . $employees_nip . '/' . $date . '';
      }

      if (empty($_POST['employees_email'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $employees_email = mysqli_real_escape_string($connection, $_POST['employees_email']);
      }


      if (empty($_POST['employees_password'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $employees_password = mysqli_real_escape_string($connection, hash('sha256', $salt . $_POST['employees_password']));
      }

      if (empty($_POST['employees_name'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $employees_name = mysqli_real_escape_string($connection, $_POST['employees_name']);
      }


      if (empty($_POST['position_id'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $position_id = mysqli_real_escape_string($connection, $_POST['position_id']);
      }

      if (empty($_POST['shift_id'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $shift_id = mysqli_real_escape_string($connection, $_POST['shift_id']);
      }

      if (empty($_POST['building_id'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $building_id = mysqli_real_escape_string($connection, $_POST['building_id']);
      }


      if (empty($_FILES['photo'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $photo = $_FILES["photo"]["name"];
        $lokasi_file = $_FILES['photo']['tmp_name'];
        $ukuran_file = $_FILES['photo']['size'];
      }
      $extension = getExtension($photo);
      $extension = strtolower($extension);
      $photo = strip_tags(md5($photo));
      $photo = "" . $date . "" . $photo . "." . $extension . "";

      if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "gif")) {
        echo 'Gambar/Foto yang di unggah tidak sesuai dengan format, Berkas harus berformat JPG,JPEG,GIF..!';
      } else {
        if ($extension == "jpg" || $extension == "jpeg") {
          $src = imagecreatefromjpeg($lokasi_file);
        } else if ($extension == "png") {
          $src = imagecreatefrompng($lokasi_file);
        } else {
          $src = imagecreatefromgif($lokasi_file);
        }
        list($width, $height) = getimagesize($lokasi_file);

        $width_size = 400;
        $k = $width / $width_size;
        // menentukan width yang baru
        $newwidth = $width / $k;
        // menentukan height yang baru
        $newheight = $height / $k;
        $tmp = imagecreatetruecolor($newwidth, $newheight);
        //imagefill ( $thumb_p, 0, 0, $bg );
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        if (empty($error)) {
          if ($ukuran_file <= $max_size) {
            $directory = '../../../sw-content/karyawan/' . $photo . '';

            $query = "SELECT employees_nip FROM employees WHERE employees_nip='$employees_nip'";
            $result = $connection->query($query);
            if (!$result->num_rows > 0) {
              $add = "INSERT INTO employees (employees_code,
              employees_nip,
              employees_email,
              employees_password,
              employees_name,
              position_id,
              shift_id,
              building_id,
              photo,
              created_login,
              created_cookies) values('$employees_code',
              '$employees_nip',
              '$employees_email',
              '$employees_password',
              '$employees_name',
              '$position_id',
              '$shift_id',
              '$building_id',
              '$photo',
              '$date $time',
              '-')";
              if ($connection->query($add) === false) {
                die($connection->error . __LINE__);
                echo 'Data tidak berhasil disimpan!';
              } else {
                echo 'success';
                imagejpeg($tmp, $directory, 90);
              }
            } else {
              echo 'Sepertinya NIP Anda sudah terdaftar sebelumnya..!';
            }
          } else {
            echo 'Gambar yang di unggah terlalu besar Maksimal Size 2MB..!';
          }
        } else {
          echo 'Bidang inputan masih ada yang kosong..!';
        }
      }
      break;

      /* ------------------------------ Update---------------------------------*/
    case 'update':
      $error = array();
      if (empty($_POST['id'])) {
        $error[] = 'ID tidak boleh kosong';
      } else {
        $id = mysqli_real_escape_string($connection, $_POST['id']);
      }

      if (empty($_POST['employees_nip'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $employees_nip = mysqli_real_escape_string($connection, $_POST['employees_nip']);
        $employees_code = '' . $year . '/' . $employees_nip . '/' . $date . '';
      }

      if (empty($_POST['employees_name'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $employees_name = mysqli_real_escape_string($connection, $_POST['employees_name']);
      }


      if (empty($_POST['position_id'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $position_id = mysqli_real_escape_string($connection, $_POST['position_id']);
      }

      if (empty($_POST['shift_id'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $shift_id = mysqli_real_escape_string($connection, $_POST['shift_id']);
      }

      if (empty($_POST['building_id'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $building_id = mysqli_real_escape_string($connection, $_POST['building_id']);
      }


      $photo = $_FILES["photo"]["name"];
      $lokasi_file = $_FILES['photo']['tmp_name'];
      $ukuran_file = $_FILES['photo']['size'];
      if ($photo == '') {
        if (empty($error)) {
          $update = "UPDATE employees SET employees_nip='$employees_nip',
            employees_name='$employees_name',
            position_id='$position_id',
            shift_id='$shift_id',
            building_id='$building_id' WHERE id='$id'";
          if ($connection->query($update) === false) {
            die($connection->error . __LINE__);
            echo 'Data tidak berhasil disimpan!';
          } else {
            echo 'success';
          }
        } else {
          echo 'Bidang inputan tidak boleh ada yang kosong..!';
        }
      } else {
        $query = mysqli_query($connection, "SELECT photo from employees where id='$id'");
        $data   = mysqli_fetch_assoc($query);
        $images_delete = strip_tags($data['photo']);
        $tmpfile = "../../../sw-content/karyawan/" . $images_delete;
        if (file_exists("../../../sw-content/karyawan/$images_delete")) {
          unlink($tmpfile);
        }

        $extension = getExtension($photo);
        $extension = strtolower($extension);
        $photo = strip_tags(md5($photo));
        $photo = "" . $date . "" . $photo . "." . $extension . "";

        if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "gif")) {
          echo 'Gambar/Foto yang di unggah tidak sesuai dengan format, Berkas harus berformat JPG,JPEG,GIF..!';
        } else {
          if ($extension == "jpg" || $extension == "jpeg") {
            $src = imagecreatefromjpeg($lokasi_file);
          } else if ($extension == "png") {
            $src = imagecreatefrompng($lokasi_file);
          } else {
            $src = imagecreatefromgif($lokasi_file);
          }
          list($width, $height) = getimagesize($lokasi_file);

          $width_size   = 400;
          $k            = $width / $width_size;
          $newwidth     = $width / $k;
          $newheight    = $height / $k;
          $tmp          = imagecreatetruecolor($newwidth, $newheight);
          imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

          if (empty($error)) {
            if ($ukuran_file <= $max_size) {
              $directory = '../../../sw-content/karyawan/' . $photo . '';

              $update = "UPDATE employees SET employees_nip='$employees_nip',
            employees_name='$employees_name',
            position_id='$position_id',
            shift_id='$shift_id',
            building_id='$building_id',
            photo='$photo' WHERE id='$id'";
              if ($connection->query($update) === false) {
                die($connection->error . __LINE__);
                echo 'Data tidak berhasil disimpan!';
              } else {
                echo 'success';
                imagejpeg($tmp, $directory, 90);
              }
            } else {
              echo 'Gambar yang di unggah terlalu besar Maksimal Size 2MB..!';
            }
          }
        }
      }

      break;

      /* --------------- Update Password ------------*/
    case 'update-password':
      $error = array();
      if (empty($_POST['id'])) {
        $error[] = 'ID tidak boleh kosong';
      } else {
        $id = mysqli_real_escape_string($connection, $_POST['id']);
      }

      if (empty($_POST['employees_email'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $employees_email = mysqli_real_escape_string($connection, $_POST['employees_email']);
      }

      if (empty($_POST['employees_password'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $employees_password = mysqli_real_escape_string($connection, $_POST['employees_password']);
        $password_baru = mysqli_real_escape_string($connection, hash('sha256', $salt . $employees_password));
      }

      if (empty($error)) {

        $pesan = '<html><body>';
        $pesan .= 'Saat ini [' . $employees_email . '] Sedang mengganti Password baru<br>';
        $pesan .= '<b>Password Baru Anda : ' . $employees_password . '</b><br><br><br>Harap simpan baik-baik akun Anda.<br><br>';
        $pesan .= 'Hormat Kami,<br>' . $site_name . '<br>Email otomatis, Mohon tidak membalas email ini"';
        $pesan .= "</body></html>";
        $to     = $employees_email;
        $subject = 'Ubah Katasandi Baru';
        $headers = "From: " . $site_name . " <" . $site_email_domain . ">\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $update = "UPDATE employees SET employees_password='$password_baru' WHERE id='$id'";
        if ($connection->query($update) === false) {
          die($connection->error . __LINE__);
          echo 'Data tidak berhasil disimpan!';
        } else {
          echo 'success';
          mail($to, $subject, $pesan, $headers);
        }
      } else {
        echo 'Bidang inputan tidak boleh ada yang kosong..!';
      }
      break;


      /* --------------- Delete ------------*/
    case 'delete':
      $id       = mysqli_real_escape_string($connection, epm_decode($_POST['id']));
      $cari = mysqli_query($connection, "SELECT employees_code,photo from employees WHERE id='$id'");
      $data = mysqli_fetch_assoc($cari);
      $images_delete = strip_tags($data['photo']);
      $qrcode = '../../../sw-content/employees-code-qr/' . seo_title($data['employees_code']) . '.jpg';
      $directory = '../../../sw-content/karyawan/' . $images_delete . '';

      $deleted  = "DELETE FROM employees WHERE id='$id'";
      if ($connection->query($deleted) === true) {
        echo 'success';
        if (file_exists("../../../sw-content/karyawan/$images_delete")) {
          unlink($directory);
          unlink($qrcode);
        }
      } else {
        //tidak berhasil
        echo 'Data tidak berhasil dihapus.!';
        die($connection->error . __LINE__);
      }
      break;

      /* -------------- QR CODE --------------------*/
    case 'qrcode':
      $forecolor = 'red';
      $backcolor = 'black';
      $id       = mysqli_real_escape_string($connection, epm_decode($_GET['id']));
      $query = "SELECT employees_code,employees_nip,employees_name FROM employees WHERE id='$id'";
      $result = $connection->query($query);
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $codeContents = $row['employees_code'];
        $tempdir = '../../../sw-content/employees-code-qr/';
        #parameter inputan
        $isi_teks = $codeContents;
        $namafile = '' . seo_title($row['employees_code']) . '.jpg';
        if (file_exists('../../../sw-content/employees-code-qr/' . $namafile . '')) {
          $namafile = '' . seo_title($row['employees_code']) . '.jpg';
        } else {
          $quality = 'L'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
          $ukuran = 5; //batasan 1 paling kecil, 10 paling besar
          $padding = 1;
          QRCode::png($isi_teks, $tempdir . $namafile, $quality, $ukuran, $padding);
        }

        echo '
          <table class="table table-hover table-bordered">
            <tbody>
              <tr>
                <td>NIP</td>
                <td>' . strip_tags($row['employees_nip']) . '</td>
              </tr>
              <tr>
                <td>Nama</td>
                <td>' . strip_tags($row['employees_name']) . '</td>
              </tr>
              <tr>
                <td>QR Code</td>
                <td>
                  <img class="img-responsive text-center" src="../sw-content/employees-code-qr/' . $namafile . '" alt="QR CODE">
                </td>
              </tr>
            </tbody>
          </table>';
      } else {
        echo 'Data tidak ditemukan';
      }
      break;
    case 'activation':
      $id       = mysqli_real_escape_string($connection, epm_decode($_POST['id']));
      $update = "UPDATE employees SET is_active='2' WHERE id='$id'";
      if ($connection->query($update) === false) {
        die($connection->error . __LINE__);
        echo 'Data tidak berhasil diupdate!';
      } else {
        $cari = mysqli_query($connection, "SELECT employees_email,employees_name from employees WHERE id='$id'");
        $data = mysqli_fetch_assoc($cari);
        $mail = new PHPMailer(true);

        try {
          $penerima = [
            'id'      => epm_encode($id),
            'email'   => $data['employees_email'],
            'name'    => $data['employees_name']
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
          $mail->Subject = 'Pendaftaran Akun';
          // $mail->Body    = 'Selamat akun mu sudah di acc admin, silahkan klik link <a href="https://sisters-kominda.eagleye.id/email?email=' . $penerima['email'] . '&code=' . $penerima['id'] . '"> Akivasi </a> atau salin link dan pastekan di web browser <a href="https://sisters-kominda.eagleye.id/email?email=' . $penerima['email'] . '&code=' . $penerima['id'] . '"> https://sisters-kominda.eagleye.id/email?email=' . $penerima['email'] . '&code=' . $penerima['id'] . ' </a>';
          $mail->Body    = 'Selamat akun mu sudah di acc admin, silahkan login kembali ke aplikasi';
          $mail->send();
          echo 'success';
          // echo 'Message has been sent';
        } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
      }
      break;
    case 'download':
      echo '
      <!DOCTYPE html>
        <html>

        <head>
          <title>Data Pegawai</title>
        </head>

        <body>
          <style type="text/css">
            body {
              font-family: sans-serif;
            }

            table {
              margin: 20px auto;
              border-collapse: collapse;
            }

            table th,
            table td {
              border: 1px solid #3c3c3c;
              padding: 3px 8px;

            }

            a {
              background: blue;
              color: #fff;
              padding: 8px 10px;
              text-decoration: none;
              border-radius: 2px;
            }
          </style>

          ';
      header("Content-type: application/vnd-ms-excel");
      header("Content-Disposition: attachment; filename=Data Pegawai.xls");
      echo '

          <center>
            <h1>Data Pegawai</h1>
          </center>

          <table border="1">
          <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jabatan</th>
            <th>Status</th>
            <th>Shift</th>
            <th>Lokasi</th>
          </tr>
        ';
      $query = "SELECT employees.*,position.position_name,shift.shift_name,building.name  FROM employees,position,shift,building WHERE employees.position_id=position.position_id AND employees.shift_id=shift.shift_id AND employees.building_id=building.building_id  order by employees.id ASC";
      $result = $connection->query($query);
      if ($result->num_rows > 0) {
        $no = 0;
        while ($row = $result->fetch_assoc()) {
          $no++;
          if ($row['is_active'] === '0') {
            $isActive = 'Belum di Aktivasi';
          }
          if ($row['is_active'] === '1') {
            $isActive = 'Aktivasi User';
          }
          if ($row['is_active'] === '2') {
            $isActive = 'User Aktif';
          }
          echo '
                  <tr>
                  <td>' . $no . '</td>
                  <td>' . $row['employees_nip'] . '</td>
                  <td>' . $row['employees_name'] . '</td>
                  <td>' . $row['employees_email'] . '</td>
                  <td>' . $row['position_name'] . '</td>
                  <td>' . $isActive . '</td>
                  <td>' . $row['shift_name'] . '</td>
                  <td>' . $row['name'] . '</td>
                  </tr>
                  ';
        }
      }
      echo '
          </table>
        </body>

        </html>
      ';
      break;

    case 'download-data-jabatan':
      echo '
      <!DOCTYPE html>
        <html>

        <head>
          <title>Data Jabatan</title>
        </head>

        <body>
          <style type="text/css">
            body {
              font-family: sans-serif;
            }

            table {
              margin: 20px auto;
              border-collapse: collapse;
            }

            table th,
            table td {
              border: 1px solid #3c3c3c;
              padding: 3px 8px;

            }

            a {
              background: blue;
              color: #fff;
              padding: 8px 10px;
              text-decoration: none;
              border-radius: 2px;
            }
          </style>

          ';
      header("Content-type: application/vnd-ms-excel");
      header("Content-Disposition: attachment; filename=Data Jabatan.xls");
      echo '
          <table border="1">
          <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama Jabatan</th>
          
          </tr>
        ';
      $query = "SELECT position_id,position_name FROM position order by position_id ASC";
      $result = $connection->query($query);
      if ($result->num_rows > 0) {
        $no = 0;
        while ($row = $result->fetch_assoc()) {
          $no++;

          echo '
                  <tr>
                  <td>' . $no . '</td>
                  <td>' . $row['position_id'] . '</td>
                  <td>' . $row['position_name'] . '</td>
                  </tr>
                  ';
        }
      }
      echo '
          </table>
        </body>

        </html>
      ';
      break;
    case 'download-data-jam-kerja':
      echo '
      <!DOCTYPE html>
        <html>

        <head>
          <title>Data Jam Kerja</title>
        </head>

        <body>
          <style type="text/css">
            body {
              font-family: sans-serif;
            }

            table {
              margin: 20px auto;
              border-collapse: collapse;
            }

            table th,
            table td {
              border: 1px solid #3c3c3c;
              padding: 3px 8px;

            }

            a {
              background: blue;
              color: #fff;
              padding: 8px 10px;
              text-decoration: none;
              border-radius: 2px;
            }
          </style>

          ';
      header("Content-type: application/vnd-ms-excel");
      header("Content-Disposition: attachment; filename=Data Jam Kerja.xls");
      echo '
          <table border="1">
          <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama Jam Kerja</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
          </tr>
        ';
      $query = "SELECT shift_id,shift_name,time_in,time_out FROM shift order by shift_id ASC";
      $result = $connection->query($query);
      if ($result->num_rows > 0) {
        $no = 0;
        while ($row = $result->fetch_assoc()) {
          $no++;

          echo '
                  <tr>
                  <td>' . $no . '</td>
                  <td>' . $row['shift_id'] . '</td>
                  <td>' . $row['shift_name'] . '</td>
                  <td>' . $row['time_in'] . '</td>
                  <td>' . $row['time_out'] . '</td>
                  </tr>
                  ';
        }
      }
      echo '
          </table>
        </body>

        </html>
      ';
      break;
    case 'download-data-lokasi':
      echo '
      <!DOCTYPE html>
        <html>

        <head>
          <title>Data Lokasi</title>
        </head>

        <body>
          <style type="text/css">
            body {
              font-family: sans-serif;
            }

            table {
              margin: 20px auto;
              border-collapse: collapse;
            }

            table th,
            table td {
              border: 1px solid #3c3c3c;
              padding: 3px 8px;

            }

            a {
              background: blue;
              color: #fff;
              padding: 8px 10px;
              text-decoration: none;
              border-radius: 2px;
            }
          </style>

          ';
      header("Content-type: application/vnd-ms-excel");
      header("Content-Disposition: attachment; filename=Data Lokasi.xls");
      echo '
          <table border="1">
          <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama Lokasi</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
          </tr>
        ';
      $query = "SELECT building_id,code,name,address FROM building order by building_id  ASC";
      $result = $connection->query($query);
      if ($result->num_rows > 0) {
        $no = 0;
        while ($row = $result->fetch_assoc()) {
          $no++;

          echo '
                  <tr>
                  <td>' . $no . '</td>
                  <td>' . $row['building_id'] . '</td>
                  <td>' . $row['code'] . '</td>
                  <td>' . $row['name'] . '</td>
                  <td>' . $row['address'] . '</td>
                  </tr>
                  ';
        }
      }
      echo '
          </table>
        </body>

        </html>
      ';
      break;
  }
}
