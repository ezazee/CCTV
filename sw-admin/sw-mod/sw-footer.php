<?php if (empty($connection)) {
  header('location:./404');
} else {
  if ($mod === 'aplikasi-pesan') {
  } else {

    $mod = "home";
    $mod = htmlentities(@$_GET['mod']);
    // Get number
    function get_numbers()
    {
      for ($i = 1; $i <= 500; $i++) {
        yield $i;
      }
    }
    $result = get_numbers();
    function convert($size)
    {
      $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
      return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }
    echo '
  <footer class="main-footer">
  <div class="pull-right hidden-xs">Theme LTE / 
    ' . convert(memory_get_usage()) . '
  </div>
   &copy; 2021 - ' . DATE('Y') . ' ' . $site_name . ' 
</footer>
</div>
<!-- wrapper -->
<script src="./sw-assets/js/jquery-2.2.3.min.js"></script>
<script src="./sw-assets/js/jquery-ui.min.js"></script>
<script src="./sw-assets/js/bootstrap-bawaan.min.js"></script>
<script src="./sw-assets/js/jquery.slimscroll.min.js"></script>
<script src="./sw-assets/js/adminlte.js"></script>
<script src="./sw-assets/js/app.js"></script>
<script src="./sw-assets/js/demo.js"></script>
<script src="./sw-assets/js/sweetalert.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="./sw-assets/js/simple-lightbox.min.js"></script>
<script src="./sw-assets/js/validasi/jquery.validate.js"></script>
<script src="./sw-assets/js/validasi/messages_id.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="./sw-assets/js/loading-modal/jquery.loadingModal.min.js"></script>
';
    if ($mod == 'scan-absen') {
      echo '
  <script src="https://sisters-kominda.eagleye.id/sw-mod/sw-assets/js/html5-qrcode.min.js"></script>
  <script src="../sw-mod/sw-assets/js/instascan.min.js"></script>
  <link rel="stylesheet" href="./sw-assets/plugins/leatfet/leaflet.css">
  <script src="./sw-assets/plugins/leatfet/leaflet.js"></script>';
    }

    if ($mod == 'shift') {
      echo '
<script src="./sw-assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="./sw-assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>';
    }

    if ($mod == 'scan-absen' or $mod == 'karyawan' or $mod == 'jabatan' or $mod == 'shift' or $mod == 'lokasi' or $mod == 'user' or $mod == 'absensi' or $mod == 'cuty' or $mod == 'thema-card' or $mod === 'laporan-kerja' or $mod === 'berita' or $mod === 'aplikasi-pesan') {
      echo '
<link rel="stylesheet" href="./sw-assets/plugins/datatables/dataTables.bootstrap.css">
<script src="./sw-assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="' . $base_url . 'sw-mod/sw-assets/js/html5-qrcode.min.js"></script>
<script src="./sw-assets/plugins/datatables/dataTables.bootstrap.min.js"></script>';
    }
    if ($mod == 'absensi' or $mod == 'thema-card') {
      echo '
<script src="../sw-mod/sw-assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>';
    }

    if ($mod == 'berita') {
      echo '
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>';
    }

    if (file_exists('sw-mod/' . $mod . '/scripts.js')) {
      echo '
  <script src="sw-mod/' . $mod . '/scripts.js"></script>';
    }
    echo '
  <script>
  var base_url ="' . $base_url . '"
  </script>
<script src="' . $base_url . 'sw-assets/js/app/context.js"></script>
<script type="module" src="' . $base_url . 'sw-assets/js/app/core.js"></script>


  <script type="text/javascript">
  	$(document).ready(function() {
  		$(".validate").validate();
  	});
    
    $(document).ready(function() {
      $(".validate2").validate();
    });
    $(document).on("click", ".access-failed", function(){ 
      swal({title:"Error!", text: "Anda tidak memiliki hak akses!", icon:"error",timer:2000,});  
    });
  </script>'; ?>
    <!-- </body></html> -->
    </body>

    </html>
<?PHP }
} ?>