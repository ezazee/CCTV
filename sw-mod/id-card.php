<?php
if ($mod == '') {
  header('location:../404');
  echo 'kosong';
} else {
  include_once 'sw-mod/sw-header.php';
  require_once './sw-library/qr_code/qrlib.php';
  if (!isset($_COOKIE['COOKIES_MEMBER'])) {
    setcookie('COOKIES_MEMBER', '', 0, '/');
    setcookie('COOKIES_COOKIES', '', 0, '/');
    // Login tidak ditemukan
    setcookie("COOKIES_MEMBER", "", time() - $expired_cookie);
    setcookie("COOKIES_COOKIES", "", time() - $expired_cookie);
    session_destroy();
    header("location:./");
  } else {

    $codeContents = $row_user['employees_code'] . '|' . date('h:idMY') . '|' . $row_user['latitude_longtitude'];


    $query_theme  = "SELECT photo FROM business_card WHERE active='1' LIMIT 1";
    $result_theme = $connection->query($query_theme);
    $row_theme    = $result_theme->fetch_assoc();

    $query = "SELECT position_name FROM position WHERE position_id='$row_user[position_id]'";
    $result = $connection->query($query);
    $row =  $result->fetch_assoc();
    echo '
  <!-- App Capsule -->
    <div id="appCapsule">
        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1 mb-4">
            <div class="wallet-card">
                <div class="text-center">
                    <!-- * ID Card -->
                    <div class="id-card">';
    if ($result_theme->num_rows > 0) {
      echo '
                      <div class="body-id-card text-center" id="divToPrint" style="background:url(./sw-content/id-card/' . $row_theme['photo'] . ') no-repeat center; background-size:150%;">';
    } else {
      echo '
                      <div class="body-id-card text-center" id="divToPrint" style="background:url(./sw-mod/sw-assets/img/bg-id-card.jpg) no-repeat center;background-size:100%;">';
    }
    echo '
                        <div class="logo">
                          <!--<img src="' . $base_url . 'sw-content/' . $site_logo . '" alt="logo">-->
                        </div>
                
                <div>
         <p style="text-align:center;font-size:13px
">BADAN INTELEJEN NEGARA</p>
                </div>
                            <div class="avatar">';
    if ($row_user['photo'] == '') {
      echo '<img src="' . $base_url . 'sw-content/avatar.jpg" alt="image" class="imaged w100">';
    } else {
      echo '<img src="timthumb?src=' . $base_url . 'sw-content/karyawan/' . $row_user['photo'] . '&h=100&w=105" alt="' . $row_user['employees_name'] . '" class="imaged w80">';
    }
    echo '
                            </div>
                            <h3>' . $row_user['employees_name'] . '</h3>
                            <p>' . $row['position_name'] . '</p>
                            <ul>  
                             <li><span>NRP</span>: ' . $row_user['employees_nip'] . '</li>
                             <li><span>Email</span>: ' . $row_user['employees_email'] . '</li>

                            </ul>
                            <div class="barcode">
                                <img class="img-responsive text-center" src="./sw-library/qrcodegenerate.php?text=' . $codeContents . '" alt="QR CODE">
                            </div>
        
                        </div>
                    </div>'; ?>


    </div>
    </div>
    </div>
    <!-- Wallet Card -->
    </div>
    <!-- * App Capsule -->
<?php
  }
  include_once 'sw-mod/sw-footer.php';
} ?>