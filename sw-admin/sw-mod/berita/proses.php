<?php session_start();

if (empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])) {
  header('location:../../login/');
  exit;
} else {
  require_once '../../../sw-library/vendor/autoload.php';
  require_once '../../../sw-library/sw-config.php';
  require_once '../../login/login_session.php';
  include('../../../sw-library/sw-function.php');
  $max_size = 2000000; //2MB
  switch (@$_GET['action']) {
    case 'add':
      if (!empty($_FILES['image'])) {
        $photo = $_FILES["image"]["name"];
        $lokasi_file = $_FILES['image']['tmp_name'];
        $ukuran_file = $_FILES['image']['size'];
        $extension = getExtension($photo);
        $extension = strtolower($extension);
        $photo = strip_tags(md5($photo));
        $photo = "" . $date . "" . $photo . "." . $extension . "";
      }
      if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png")) {
        echo 'Gambar/Foto yang di unggah tidak sesuai dengan format, Berkas harus berformat JPG,JPEG,PNG..!';
        die;
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
      }
      if ($ukuran_file <= $max_size) {
        $directory = '../../../sw-content/news/' . $photo . '';
        $title     = $_POST['title'];
        $content     = $_POST['content'];
        $add = "INSERT INTO news (title,
        image,
        content) values('$title',
        '$photo',
        '$content')";
        if ($connection->query($add) === false) {
          die($connection->error . __LINE__);
        } else {
          imagejpeg($tmp, $directory, 90);
          header('Location:https://sisters-kominda.eagleye.id/sw-admin/berita');
        }
      } else {
        echo 'Gambar yang di unggah terlalu besar Maksimal Size 2MB..!';
        die;
      }
      break;
    case 'update':
      if (!empty($_FILES['image']) && $_FILES['image']['name'] !== "") {
        $photo = $_FILES["image"]["name"];
        $lokasi_file = $_FILES['image']['tmp_name'];
        $ukuran_file = $_FILES['image']['size'];
        $extension = getExtension($photo);
        $extension = strtolower($extension);
        $photo = strip_tags(md5($photo));
        $photo = "" . $date . "" . $photo . "." . $extension . "";
        if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png")) {
          echo 'Gambar/Foto yang di unggah tidak sesuai dengan format, Berkas harus berformat JPG,JPEG,PNG..!';
          die;
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
        }
        if ($ukuran_file <= $max_size) {
          $directory = '../../../sw-content/news/' . $photo . '';
          $title     = $_POST['title'];
          $content   = $_POST['content'];
          $id        =  mysqli_real_escape_string($connection, epm_decode($_POST['id']));
          $update = "UPDATE news SET title = '$title', image='$photo', content='$content' WHERE id = '$id'";
          if ($connection->query($update) === false) {
            die($connection->error . __LINE__);
          } else {
            imagejpeg($tmp, $directory, 90);
            header('Location:https://sisters-kominda.eagleye.id/sw-admin/berita');
          }
        } else {
          echo 'Gambar yang di unggah terlalu besar Maksimal Size 2MB..!';
          die;
        }
      } else {
        $photo     = $_POST['oldImage'];
        $title     = $_POST['title'];
        $content   = $_POST['content'];
        $id        =  mysqli_real_escape_string($connection, epm_decode($_POST['id']));
        $update = "UPDATE news SET title = '$title', image='$photo', content='$content' WHERE id = '$id'";
        if ($connection->query($update) === false) {
          die($connection->error . __LINE__);
        } else {
          header('Location:https://sisters-kominda.eagleye.id/sw-admin/berita');
        }
      }
      break;
    case 'delete':
      $id       = mysqli_real_escape_string($connection, epm_decode($_POST['id']));
      $deleted  = "DELETE FROM `news` WHERE id='$id'";
      if ($connection->query($deleted) === true) {
        echo 'success';
      } else {
        //tidak berhasil
        echo 'Data tidak berhasil dihapus.!';
        die($connection->error . __LINE__);
      }
      break;
  }
}
