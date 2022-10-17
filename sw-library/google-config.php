<?php
//sessoin_start();
include_once '../sw-library/sw-config.php';
// Include Librari Google Client (API)
include_once '../sw-library/google-client/Google_Client.php';
include_once '../sw-library/google-client/contrib/Google_Oauth2Service.php';

$client_id = '993040533530-g9fdhaq9jdml40kjg2gov0k3al1dr4p4.apps.googleusercontent.com'; // Google client ID
$client_secret = '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'; // Google Client Secret
$redirect_url = ''.$site_url.'/oauth/google'; // Callback URL

// Call Google API
$gclient = new Google_Client();
$gclient->setClientId($client_id); // Set dengan Client ID
$gclient->setClientSecret($client_secret); // Set dengan Client Secret
$gclient->setRedirectUri($redirect_url); // Set URL untuk Redirect setelah berhasil login

$google_oauthv2 = new Google_Oauth2Service($gclient);
?>
