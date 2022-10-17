<?php
require_once '../../sw-library/sw-config.php';
include_once '../../sw-library/sw-function.php';
$email  = $_GET['email'];
$token  = $_GET['token'];

$userToken  = "SELECT * FROM `tr_token` WHERE `email`='$email' AND `token` = '$token'";
$result     = $connection->query($userToken);
if ($result->num_rows > 0) :
  $tokenData    = $result->fetch_assoc();
  $now      = date('Y-m-d H:i:s');
  $expired  = $tokenData['expired_at'];
  if ($expired > $now) :
?>
    <!DOCTYPE html>
    <html>

    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Lupa Password Administrator</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <meta name="description" content="Login">
      <meta name="author" content="pixelcave">
      <meta name="robots" content="noindex, nofollow">

      <!-- Icons -->
      <link rel="shortcut icon" href="../../sw-content/favicon.png">
      <link rel="apple-touch-icon" href="../../sw-content/favicon.png">

      <link rel="stylesheet" href="../sw-assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="../sw-assets/css/AdminLTE.min.css">
      <link rel="stylesheet" href="../sw-assets/css/skin-blue-light.css">
      <link rel="stylesheet" href="../sw-assets/css/font-awesome.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>

    <body class="hold-transition login-page">
      <div class="login-box">
        <div class="login-logo">
          <a href="./"><img src="../../sw-content/<?= $site_logo ?> " oncontextmenu="return false;" height="50"></a>
        </div>
        <!-- /.login-logo -->
        <form action="./action-reset-password" method="POST">
          <?php
          if ($_SESSION['confirmPassword']) {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>Maaf!</strong> Konfirmasi password salah.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>';
          };
          unset($_SESSION["confirmPassword"]);
          ?>

          <input type="hidden" name="email" id="email" value="<?= $email; ?>">
          <input type="hidden" name="token" id="token" value="<?= $token; ?>">
          <div class="login-box-body">
            <p class="login-box-msg">Silahkan masukan password baru :</p>
            <div class="form-group has-feedback">
              <input type="email" id="email" name="email" class="form-control" placeholder="Masukan Email" readonly value="<?= $email; ?>">
              <span class="fa fa-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" id="password" name="password" class="form-control" placeholder="Masukan Password">
              <span class="fa fa-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="Konfirmasi Password">
              <span class="fa fa-user form-control-feedback"></span>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" id="showPassword">
                Show Password
              </label>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
              </div>
              <!-- /.col -->
            </div>
          </div>
        </form>
        <!-- /.login-box-body -->
      </div>
      <!-- /.login-box -->'; ?>


      <footer class="text-muted text-center">
        <small>&copy; 2021 - <?= date('Y') ?> <?= $site_name; ?>
          <em>Version 4.0 Update 2021</em></small>
      </footer>

      <script src="../sw-assets/js/jquery.min.js"></script>
      <script src="../sw-assets/js/bootstrap.min.js"></script>
      <script src="../sw-assets/js/adminlte.js"></script>
      <script src="../sw-assets/js/demo.js"></script>
      <script src="./jquery-login.js"></script>
      <script>
        $(document).ready(function() {
          $('#showPassword').click(function() {
            $(this).is(':checked') ? $('#password').attr('type', 'text') : $('#password').attr('type', 'password');
            $(this).is(':checked') ? $('#confirm-password').attr('type', 'text') : $('#confirm-password').attr('type', 'password');
          });
        });
      </script>
    </body>

    </html>
  <?php else : ?>
    <h4>Token sudah expired</h4>
    <?php
    $deleteToken  = "DELETE FROM `tr_token` WHERE email = '$email'";
    $delete       = $connection->query($deleteToken);
    ?>
  <?php endif; ?>
<?php else : ?>
  <h4>Data Tidak Ada</h4>

<?php endif; ?>