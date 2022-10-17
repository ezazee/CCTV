<?php

ob_start();
session_start();
error_reporting(0);
require_once '../../sw-library/sw-config.php';
require_once '../../sw-library/sw-function.php';
include_once '../../sw-library/vendor/autoload.php';
$id   = $_GET['id'];
//$id     =  mysqli_real_escape_string($connection, epm_decode($id));
$query  = "SELECT * FROM `m_work_report` WHERE `id`='$id'";
$result = $connection->query($query);
$row    = $result->fetch_assoc();
?>

<p>Lampiran-lampiran</p>
<ul>
  <li>
    <span>Gambar-gambar</span>
  </li>
  <?php
  $queryImage = "SELECT * FROM `tr_picture_to_work_report` WHERE `work_report_id` = '$workId'";
  $resultImage = $connection->query($queryImage);
  while ($dataImage = $resultImage->fetch_assoc()) :
  ?>
    <p>
      <img src="../../../../sw-mod/laporan-kerja/upload/image/<?= $dataImage['picture'] ?>" alt="Lights" style="width:100%">
    </p>
  <?php endwhile; ?>
  <li style="margin-top: 50px;">
    <span>
      Foto
    </span>
    <p>
      <img src="../../../../sw-mod/laporan-kerja/upload/camera/<?= $row['camera'] ?>" alt="Lights" style="width:100%">
    </p>
  </li>
  <li>
    <span>Link</span>
    <p>
      <a href="<?= $row['link'] ?>" target="__blank"><?= $row['link'] ?></a>
    </p>
  </li>
</ul>