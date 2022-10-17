<?php
if(empty($connection)){
  header('location:../../');
} else {
  include_once 'sw-mod/sw-panel.php'; 
echo'
  <div class="content-wrapper">';
    switch(@$_GET['op']){ 
    default:
echo'
<section class="content-header">
  <h1>Scan<small> Absensi</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Scan Absensi</li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Arahkan Kode QR Ke Kamera!</h3>
        </div>
          <div class="box-body text-center">
            <span id="latitude" class="latitude" style="display:none"></span>
            <div class="webcame">
              <video id="preview"></video>
              <audio id="my_audio" class="d-none">
                <source src="../sw-mod/sw-assets/js/webcameqrcode/audio/beep.mp3" type="audio/mpeg">
              </audio>
            </div>
          </div>
      </div>

      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Histori absensi hari ini ('.tgl_ind($date).')</b></h3>
        </div>
          <div class="box-body">
            <div class="loaddata"></div>
          </div>
      </div>


    </div>
  </div>
</section>';
break;
}?>

</div>
<?php }?>