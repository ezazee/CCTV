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
        include_once "create.php"; //Data Laporan Kerja
        break;
    endswitch;
    ?>
  </div>
  <!--Content Wrapper End-->

<?php } ?>