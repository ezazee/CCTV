<?PHP session_start();
if (!empty($_SESSION['SESSION_USER']) && !empty($_SESSION['SESSION_ID'])) {
  header('location:../');
  exit;
} else {
  require_once '../../sw-library/sw-config.php';
}
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
    <form action="./reset-password" method="POST">
      <div class="login-box-body">
        <p class="login-box-msg">Silahkan masukan email :</p>
        <div class="form-group has-feedback">
          <input type="email" id="email" name="email" class="form-control" placeholder="Masukan Email" required>
          <span class="fa fa-user form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
          </div>
          <a href="./" class="btn btn-link">Login</a>
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
</body>

</html>