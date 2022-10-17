<?php if (empty($connection)) {
  header('location:./404');
} else {

  if (isset($_COOKIE['COOKIES_MEMBER'])) {
    echo '
<div class="appBottomMenu">
        <a href="' . $base_url . 'home.html" class="item">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>

        <!--<a href="absent" class="item">
            <div class="col">
                <ion-icon name="qr-scanner"></ion-icon>
                <strong>Absen</strong>
            </div>
        </a>-->

        <a href="' . $base_url . 'cuty" class="item">
            <div class="col">
               <ion-icon name="calendar-outline"></ion-icon>
                <strong>Cuti</strong>
            </div>
        </a>

        <a href="' . $base_url . 'history" class="item">
            <div class="col">
                 <ion-icon name="document-text-outline"></ion-icon>
                <strong>History</strong>
            </div>
        </a>

        <a href="' . $base_url . 'id-card" class="item">
            <div class="col">
                 <ion-icon name="id-card-outline"></ion-icon>
                <strong>ID Card</strong>
            </div>
        </a>
        
        <a href="' . $base_url . 'profile" class="item">
            <div class="col">
                <ion-icon name="person-outline"></ion-icon>
                <strong>Profil</strong>
            </div>
        </a>
</div>
<!-- * App Bottom Menu -->';
  }
  ob_end_flush();
  echo '
<footer class="text-muted text-center" style="display:none">
   <p>© 2021 - ' . $year . ' ' . $site_name . ' - Design By:  <a class="credits" href="https://s-widodo.com" id="credits" title="CMS Sw-widodo.com">CMS S-widodo.com</a> - All Rights Reserved</p>
</footer>
<!-- ///////////// Js Files ////////////////////  -->
<!-- Jquery -->
<script src="' . $base_url . 'sw-mod/sw-assets/js/lib/jquery-3.4.1.min.js"></script>
<!-- Bootstrap-->
<script src="' . $base_url . 'sw-mod/sw-assets/js/lib/popper.min.js"></script>
<script src="' . $base_url . 'sw-mod/sw-assets/js/lib/bootstrap.min.js"></script>
<!-- Ionicons -->
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<script src="https://kit.fontawesome.com/0ccb04165b.js" crossorigin="anonymous"></script>
<!-- Base Js File -->
<script src="' . $base_url . 'sw-mod/sw-assets/js/base.js"></script>
<script src="' . $base_url . 'sw-mod/sw-assets/js/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>';
  if ($mod == 'absent') {
    echo '<script src="' . $base_url . 'sw-mod/sw-assets/js/html5-qrcode.min.js"></script>
      <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<!--<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>-->';
  }
  if ($mod == 'id-card') {
    echo '
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>';
    ob_end_flush(); ?>
    <script type="text/javascript">
      /* ---------- Save Id Card ----------*/
      var element = $("#divToPrint"); // global variable
      var getCanvas; // global variable
      html2canvas(element, {
        onrendered: function(canvas) {
          $("#previewImage").append(canvas);
          getCanvas = canvas;
        }
      });

      $(".btn-Convert-Html2Image").on('click', function() {
        var imgageData = getCanvas.toDataURL("image/png");
        // Now browser starts downloading it instead of just showing it
        var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
        $(".btn-Convert-Html2Image").attr("download", "ID-CARD.jpg").attr("href", newData);
      });
    </script>
<?PHP }
  if ($mod == 'history' or $mod == 'cuty') {
    echo '
<script src="' . $base_url . 'sw-mod/sw-assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="' . $base_url . 'sw-mod/sw-assets/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="' . $base_url . 'sw-mod/sw-assets/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="' . $base_url . 'sw-mod/sw-assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
<script>
    $(".datepicker").datepicker({
        format: "dd-mm-yyyy",
        "autoclose": true
    });
</script>
<script src="' . $base_url . 'sw-mod/sw-assets/js/plugins/jquery-1.11.3.min.js"></script>
<script src="' . $base_url . 'sw-mod/sw-assets/js/plugins/moment-with-locales.js"></script>
<script src="' . $base_url . 'sw-mod/sw-assets/js/plugins/bootstrap-datetimepicker.js"></script>
<script src="' . $base_url . 'sw-mod/sw-assets/js/cuty.js"></script>

';
  }
  echo '
<script src="' . $base_url . '/sw-mod/sw-assets/js/sw-script.js"></script>
<script>
  document.addEventListener("contextmenu", event => event.preventDefault());
  document.onkeydown = function (e) {
      if(e.keyCode == 123) {
          return false;
      }
  };
  var base_url ="' . $base_url . '"
</script>
<script src="' . $base_url . '/sw-mod/sw-assets/js/app/context.js"></script>
<script type="module" src="' . $base_url . '/sw-mod/sw-assets/js/app/core.js"></script>
  <!-- </body></html> -->
  </body>
</html>';
} ?>