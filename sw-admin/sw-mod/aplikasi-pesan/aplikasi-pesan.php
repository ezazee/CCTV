<?php error_reporting(0);
if (empty($connection)) {
  header('location:../../');
} else {
  // include_once 'sw-mod/sw-panel.php';
?>
  <!-- <div class="content-wrapper"> -->
  <?php
  switch (@$_GET['op']):
    default:
      // include_once "data.php"; //Data Laporan Kerja
      include_once "new-app.php";
      break;
      //USER CHAT dengan siapa saja
    case 'detail':
      // include_once "detail-obrolan-user.php";
      include_once "new-detail-obrolan-user.php";
      break;

    case 'tampilchat':
      // include_once "tampilkan-isi-chat.php";
      include_once "new-tampil-isi-chat.php";
      break;
  endswitch;
  ?>
  <!-- </div> -->
  <!--Content Wrapper End-->

<?php } ?>