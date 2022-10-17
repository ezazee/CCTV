<?php
if ($mod == '') {
  header('location:../404');
  echo 'kosong';
} else {
  include_once 'sw-mod/sw-header.php';
  if (!isset($_COOKIE['COOKIES_MEMBER']) && !isset($_COOKIE['COOKIES_COOKIES'])) {
    setcookie('COOKIES_MEMBER', '', 0, '/');
    setcookie('COOKIES_COOKIES', '', 0, '/');
    // Login tidak ditemukan
    setcookie("COOKIES_MEMBER", "", time() - $expired_cookie);
    setcookie("COOKIES_COOKIES", "", time() - $expired_cookie);
    session_destroy();
    header("location:./");
  } else {

    echo '
  <!-- App Capsule -->
<div id="appCapsule">
  <!-- Wallet Card -->
  <div class="section wallet-card-section pt-1" id="app" data-module="AbsentModule">
    <div class="wallet-card">
      <div class="balance">
        <div class="left">
          <span class="title"> Selamat ' . $salam . '</span>
          <h4>' . ucfirst($row_user['employees_name']) . '</h4>
        </div>
        <div class="right">
          <span class="title">' . tgl_ind($date) . ' </span>
          <h4><span class="clock"></span></h4>
        </div>
      </div>
      <!-- * Balance -->
              
     
      <div class="text-center">
        <p>Lat-Long: <span class="latitude" id="latitude"></span></p>
      </div>


      <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        <li class="nav-item">
          <a
            class="nav-link active"
            id="home-tab"
            data-toggle="tab"
            href="#qrcode"
            role="tab"
            aria-controls="home"
            aria-selected="true"
            >Scan QRCode</a
          >
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            id="profile-tab"
            data-toggle="tab"
            href="#selfie"
            role="tab"
            aria-controls="profile"
            aria-selected="false"
            >Selfie</a
          >
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div
          class="tab-pane fade show active"
          id="qrcode"
          role="tabpanel"
          aria-labelledby="home-tab"
        >
          <h4 class="text-center mt-4">Arahkan Kode QR Ke Kamera!</h4>
          <div class="wallet-footer text-center">
            <div class="webcame text-center">
            <video id="preview"></video>
              <!--<div
                id="reader"
                style="
                  width: 100% !important;
                  text-align: center !important;
                  aspect-ratio: 4/3 !important;
                "
                class="animate p-0 m-0"
              ></div>-->
            </div>
          </div>
                    <div class="text-center">
            <div class="btn-group btn-group-toggle mb-5 text-xl-center">
              <label class="btn btn-success active">
                <input
                  type="radio"
                  name="options"
                  value="1"
                  autocomplete="off"
                  checked
                />
                Front Camera
              </label>
              <label class="btn btn-warning">
                <input
                  type="radio"
                  name="options"
                  value="2"
                  autocomplete="off"
                />
                Back Camera
              </label>
            </div>
          </div>
          <div class="text-center">
            <button class="btn btn-secondary btn-show-camera">
              Tampilkan Kamera
            </button>
          </div>
          <canvas></canvas>
        </div>
        <div
          class="tab-pane fade"
          id="selfie"
          role="tabpanel"
          aria-labelledby="profile-tab"
        >
          <h4 class="text-center mt-4">Arahkan Wajah anda ke Kamera!</h4>
          <div class="wallet-footer text-center mb-2">
            <div class="col-md-12">
              <div class="bg-dark" style="width: 100%; padding-top: 20px; padding-bottom: 20px; border-radius: 10px;">
                <div class="camera_field">
                  <div id="my_camera" style="width: 240px; height: 240px; margin: auto;" >
                </div>
                </div>
                <div id="results" class="d-none" style="width: 240px; height: 240px; margin: auto;"></div>
              </div>
            </div>
            <input type="hidden" name="camera" class="image-tag" />
          </div>
            <div class="col-md-12 d-flex flex-column my-2">
              <button class="btn btn-primary take-picture mb-1">
                <ion-icon name="camera"></ion-icon>
              </button>
              <button class="btn btn-primary retake-picture mb-1 d-none">
                Ambil Ulang
              </button>
              <button class="btn btn-secondary" id="absen-selfie" disabled>
                Kirim Foto
              </button>
            </div>
                      <center><button class="btn btn-success" type="button" onClick="window.location.reload();">Refresh Your Location</button><center>
              
          </div>
        </div>
      </div>
      <audio id="my_audio" class="d-none">
        <source
          src="sw-mod/sw-assets/js/webcameqrcode/audio/beep.mp3"
          type="audio/mpeg"
        />
      </audio>
    </div>
  </div>
  <!-- Card -->
  
</div>
<!-- * App Capsule -->
';
  }
  include_once 'sw-mod/sw-footer.php';
}
