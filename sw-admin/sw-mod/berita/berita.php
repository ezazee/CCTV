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

      case 'add':
        include_once "create.php";
        break; //CASE DETAIL

      case 'edit':
        include_once 'update.php';
        break;
    endswitch;
    ?>
  </div>
  <!--Content Wrapper End-->

<?php } ?>