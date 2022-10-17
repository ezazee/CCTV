<?php if (empty($connection)) {
  header('location:./404');
} else {
  ob_start("minify_html");
  echo '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
  <title>' . $website_name . '</title>
  <meta name="theme-color" content="#CC0000">
  <meta name="msapplication-navbutton-color" content="#CC0000">
  <meta name="apple-mobile-web-app-status-bar-style" content="#CC0000">

    <!-- Favicons -->
  <link rel="shortcut icon" href="' . $website_url . '/sw-content/faviconx.png">
  <link rel="apple-touch-icon" href="' . $website_url . '/sw-content/faviconx.png">
  <link rel="apple-touch-icon" sizes="72x72" href="' . $website_url . '/sw-content/faviconx.png">
  <link rel="apple-touch-icon" sizes="114x114" href="' . $website_url . '/sw-content/faviconx.png">
  
  <meta name="robots" content="index, follow">
  <meta name="description" content="' . $meta_description . '">
  <meta name="keywords" content="' . $meta_keyword . '">
  <meta name="author" content="' . $website_name . '">
  <meta http-equiv="Copyright" content="' . $website_name . '">
  <meta name="copyright" content="' . $website_name . '">
  <meta itemprop="image" content="sw-content/meta-tag.jpg">

  <link rel="stylesheet" href="' . $base_url . '/sw-mod/sw-assets/css/style.css">
  <link rel="stylesheet" href="' . $base_url . '/sw-mod/sw-assets/css/sw-custom.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="https://sisters-kominda.eagleye.id/sw-mod/sw-assets/js/html5-qrcode.min.js"></script>
  ';


  if ($mod == 'history') {
    echo '
  <link rel="stylesheet" href="' . $base_url . '/sw-mod/sw-assets/js/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="' . $base_url . '/sw-mod/sw-assets/js/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="' . $base_url . '/sw-mod/sw-assets/js/plugins/magnific-popup/magnific-popup.css">';
  }

  if ($mod == 'cuty') {
    echo '
  <link rel="stylesheet" href="' . $base_url . '/sw-mod/sw-assets/css/bootstrap-datetimepicker.css">';
  }

  echo '
</head>';
  if ($mod == 'absent') {
    echo '<body onload="Absent()">';
  } else {
    echo '<body>';
  }
  echo '
<div class="loading"><div class="spinner-border text-primary" role="status"></div></div>
  <div class="splashscreen" style="display:none;"></div>
  <!-- loader -->
    <div id="loader">
        <img src="' . $base_url . 'sw-mod/sw-assets/img/logo-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->';
  if (isset($_COOKIE['COOKIES_MEMBER'])) {
    echo '
<!-- App Header -->
    <div class="appHeader bg-success text-light">
        <div class="left">

                    <!-- hearder atas -->
        </div>

<div class="left">
          <span class="title"> SISTERS KOMINDA </span>
       
        </div>
    


        <div class="right">
            <div class="headerButton" data-toggle="dropdown" id="dropdownMenuLink" aria-haspopup="true">';
    if ($row_user['photo'] == '') {
      echo '<img src="' . $base_url . 'sw-content/avatar.jpg" alt="image" class="imaged w32">';
    } else {
      echo '
                <img src="timthumb?src=' . $base_url . 'sw-content/karyawan/' . $row_user['photo'] . '&h=40&w=45" alt="image" class="imaged w32">';
    }
    echo '
               

                    <!-- * menu -->
                </div>
            </div>
        </div>
    </div>
    <!-- * App Sidebar -->';
  }
}
