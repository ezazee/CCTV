<?php error_reporting(0);
if (empty($connection)) {
  header('location:../../');
} else {
  include_once 'sw-mod/sw-panel.php';
?>
  <div class="content-wrapper">
    <?php
    switch (@$_GET['op']):
      default:
        include_once "data.php"; //Data Laporan Kerja
        break;

      case 'tambah':
        include_once "tambah.php";
        break; //CASE DETAIL

      case 'print':
        // include_once 'print.php';
        // include_once "../laporan-harian/print.php";
        break;
    endswitch;
    ?>
  </div>
  <!--Content Wrapper End-->

<?php } ?>