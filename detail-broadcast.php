<?php
ob_start();
session_start();
error_reporting(0);
require_once './sw-library/vendor/autoload.php';
require_once './sw-library/sw-config.php';
include('./sw-library/sw-function.php');
$id = epm_decode($_GET['nomor']);
if ($id) :
  $query  = "SELECT * FROM `m_broadcast` WHERE `id`='$id'";
  $result = $connection->query($query);
  if ($result->num_rows > 0) :
    $row  = $result->fetch_assoc();
?>

    <!doctype html>
    <html lang="en">

    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->

      <title>Pesan Broadcast</title>
    </head>

    <body>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card mt-4">
              <div class="card-body">
                <h5 class="card-title">Pengirim : Administrator</h5>
                <p class="card-text"><?= $row['pesan']; ?></p>
                <br>
                <span class="h6">Lampiran</span>
                <?php if ($row['file']) : ?>
                  <a href="<?= $base_url; ?>sw-content/broadcast/<?= $row['file']; ?>" class="btn btn-link" target="_blank">Download File PDF</a>
                <?php endif; ?>
                <?php if ($row['link_zoom']) : ?>
                  <span class="text-primary">
                    <a href="<?= $row['link_zoom']; ?>" class="btn btn-link" target="_blank">Link</a>
                  </span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> -->

      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
    </body>

    </html>
  <?php else : ?>
    <h1>Data Yang diminta Tidak Ada</h1>
  <?php endif; ?>
<?php else : ?>
  <h1>Data ID Tidak Ada</h1>
<?php endif; ?>