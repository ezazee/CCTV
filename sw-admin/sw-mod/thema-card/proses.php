<?php
session_start();
if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
    header('location:../../login/');
 exit;}
else {
require_once'../../../sw-library/sw-config.php';
require_once'../../login/login_session.php';
include('../../../sw-library/sw-function.php');
$max_size = 2000000; //2MB
switch (@$_GET['action']){
case 'add':
  $error = array();
  if (empty($_POST['name'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $name=mysqli_real_escape_string($connection,$_POST['name']);
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
    $photo ="".$date."".$photo.".".$extension."";

    if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "gif")) { 
        echo'Gambar/Foto yang di unggah tidak sesuai dengan format, Berkas harus berformat JPG,JPEG,GIF..!';
    }

    else{
    if($extension=="jpg" || $extension=="jpeg" ){
    $src = imagecreatefromjpeg($lokasi_file);}
    else if($extension=="png"){$src = imagecreatefrompng($lokasi_file);}
    else {$src = imagecreatefromgif($lokasi_file);}
    list($width,$height)=getimagesize($lokasi_file);

    $width_size = 400;
    $k = $width / $width_size;
    // menentukan width yang baru
    $newwidth = $width / $k;
    // menentukan height yang baru
    $newheight = $height / $k;
    $tmp=imagecreatetruecolor($newwidth,$newheight);
    //imagefill ( $thumb_p, 0, 0, $bg );
    imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

    if (empty($error)) {
    if ($ukuran_file <= $max_size) {
    $directory='../../../sw-content/id-card/'.$photo.''; 
    $add ="INSERT INTO business_card (name,photo,active) values('$name','$photo','N')"; 
    if($connection->query($add) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
         imagejpeg($tmp,$directory,90);
    }}
     else{
        echo'Gambar yang di unggah terlalu besar Maksimal Size 2MB..!';
    }}
    else{           
        echo'Bidang inputan tidak boleh ada yang kosong..!';
    }}


/* --------------------------------
    Update
---------------------------------*/
break;
case 'update':
 $error = array();
   if (empty($_POST['id'])) {
      $error[] = 'ID tidak boleh kosong';
    } else {
      $id = mysqli_real_escape_string($connection, epm_decode($_POST['id']));
  }

  if (empty($_POST['name'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $name=mysqli_real_escape_string($connection,$_POST['name']);
  }

  $photo = $_FILES["photo"]["name"];
  $lokasi_file = $_FILES['photo']['tmp_name'];  
  $ukuran_file = $_FILES['photo']['size'];
  if($photo ==''){
      if (empty($error)) { 
        $update="UPDATE business_card SET name='$name' WHERE id='$id'"; 
        if($connection->query($update) === false) { 
            die($connection->error.__LINE__); 
            echo'Data tidak berhasil disimpan!';
        } else{
            echo'success';
        }}
        else{           
            echo'Bidang inputan tidak boleh ada yang kosong..!';
    }
  }else{
    $query= mysqli_query($connection,"SELECT photo from business_card where id='$id'");
    $data   = mysqli_fetch_assoc($query);
    $images_delete = strip_tags($data['photo']);
    $tmpfile = "../../../sw-content/id-card/".$images_delete;
   if(file_exists("../../../sw-content/id-card/$images_delete")){
      unlink ($tmpfile);
    }

    $extension = getExtension($photo);
    $extension = strtolower($extension);
    $photo = strip_tags(md5($photo));
    $photo ="".$date."".$photo.".".$extension."";

    if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "gif")) { 
        echo'Gambar/Foto yang di unggah tidak sesuai dengan format, Berkas harus berformat JPG,JPEG,GIF..!';
    }

    else{
    if($extension=="jpg" || $extension=="jpeg" ){
      $src = imagecreatefromjpeg($lokasi_file);}
      else if($extension=="png"){$src = imagecreatefrompng($lokasi_file);}
      else {$src = imagecreatefromgif($lokasi_file);}
      list($width,$height)=getimagesize($lokasi_file);

      $width_size   = 400;
      $k            = $width / $width_size;
      $newwidth     = $width / $k;
      $newheight    = $height / $k;
      $tmp          = imagecreatetruecolor($newwidth,$newheight);
      imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
      if ($ukuran_file <= $max_size) {
      $directory='../../../sw-content/id-card/'.$photo.'';
      $update="UPDATE business_card SET name='$name', photo='$photo' WHERE id='$id'";  
      if($connection->query($update) === false) { 
          die($connection->error.__LINE__); 
          echo'Data tidak berhasil disimpan!';
      } else{
          echo'success';
          imagejpeg($tmp,$directory,90);
      }}
      else{
          echo'Gambar yang di unggah terlalu besar Maksimal Size 2MB..!';
      }
   }
  }

break;
/* --------------- Delete ------------*/
case 'delete':
  $id       = mysqli_real_escape_string($connection,epm_decode($_POST['id']));
  $query ="SELECT position.position_id,employees.position_id FROM position,employees WHERE position.position_id=employees.position_id AND employees.position_id='$id'";
  $result = $connection->query($query);
  if(!$result->num_rows > 0){
    $deleted  = "DELETE FROM position WHERE position_id='$id'";
      if($connection->query($deleted) === true) {
          echo'success';
        } else { 
          //tidak berhasil
          echo'Data tidak berhasil dihapus.!';
          die($connection->error.__LINE__);
    }
  }else{
      echo'Jabatan digunakan, Data tidak dapat dihapus.!';
  }


/* ------------  Set Active -------------- */
break;
case 'setactive':
  $id = htmlentities($_POST['id']);
  $active = htmlentities($_POST['active']);
  $update="UPDATE business_card SET active='$active' WHERE id='$id'";
    if($connection->query($update) === false) { 
     echo 'error';
     die($connection->error.__LINE__); 
    }
    else{ echo 'sukses..';
  }
break;

}

}
