<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>laporan masuk</title>
  <link rel="icon" href="<?= $base_url; ?>sw-mod/laporan-kerja/assets/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="<?= $base_url; ?>sw-mod/laporan-kerja/assets/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.1/css/font-awesome.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
</head>
<?php
ob_start();
session_start();
error_reporting(0);
require_once './sw-library/vendor/autoload.php';
require_once './sw-library/sw-config.php';
include('./sw-library/sw-function.php');
$id = epm_decode($_GET['nomor']);
if ($id) :
  $query  = "SELECT a.*,b.`employees_name` FROM `m_work_report` as a JOIN `employees` as b ON a.`employe_id`=b.`id` WHERE a.`id`='$id'";
  $result = $connection->query($query);
  if ($result->num_rows > 0) :
    $row  = $result->fetch_assoc();
?>

    <body>
      <div class="container-fluid">
        <div class="row" id="tibo">
          <!-- <label class="ml-16">
            <ion-icon name="chevron-back-outline" size="large" id="back-button"></ion-icon>
          </label> -->
          <label class="title">Detail Laporan Kerja </label>
          <div id="form-laporan" class="col-12">
            <form id="form-submit" class="ml-16 mr-16 mb-16">
              <div id="page1">
                <div style="color: #787878;">
                  <p style="text-align: right;"><?= date('d-m-Y H:i', strtotime($row['created_at'])) ?></p>
                  <p style="text-align: left;">Kepada :
                    <br />
                    <?php
                    $workId      = $row['id'];
                    // $queryKepada = "SELECT `tr_report_purpose_to_work_report`.*,`employees`.`employees_name` 
                    //                 from `tr_report_purpose_to_work_report` 
                    //                   INNER JOIN `employees` ON `tr_report_purpose_to_work_report`.`employe_id`=`employees`.`id`
                    //                   WHERE `tr_report_purpose_to_work_report`.`work_report_id` ='$workId'";
                    $queryKepada  = "SELECT * FROM `tr_report_purpose_to_work_report` WHERE `work_report_id` = '$workId'";
                    $resultKepada = $connection->query($queryKepada);
                    $no = 0;
                    while ($dataKepada = $resultKepada->fetch_assoc()) :
                      $no++;
                    ?>
                      <?= $no; ?>. <?= $dataKepada['employe_name']; ?>
                      <br />
                    <?php endwhile; ?>

                  </p>
                  <p style="text-align: left;">Tembusan :
                    <br />
                    <?php
                    $queryTembusan  = "SELECT * FROM `tr_forward_report_to_work_report` WHERE `work_report_id`='$workId'";
                    $resultTembusan = $connection->query($queryTembusan);
                    $noTembusan = 0;
                    while ($dataTembusan = $resultTembusan->fetch_assoc()) :
                      $noTembusan++;
                    ?>
                      <?= $noTembusan; ?>. <?= $dataTembusan['employe_name']; ?>
                      <br />
                    <?php endwhile; ?>
                  </p>
                  <p style="text-align: left;">Dari :
                    <br />MJKK8
                  </p>
                  <p style="text-align: left;">Nilai:<br />1</p>
                  <p style="text-align: left;">Perihal :
                    <br /><?= $row['about']; ?>
                  </p>
                  <p style="text-align: left;">Fakta-fakta :
                    <br /><?= $row['fakta_fakta'] ?>
                  </p>
                  <div>
                    <div>Catatan</div>
                    <ul>
                      <li>
                        UPAYA
                        <p>
                          <?= $row['upaya']; ?>
                        </p>

                      </li>
                      <li>
                        ANALISA
                        <p>
                          <?= $row['analisa']; ?>
                        </p>
                      </li>
                      <li>
                        REKOMENDASI
                        <p>
                          <?= $row['rekomendasi']; ?>
                        </p>
                      </li>
                    </ul>
                    <div>
                      <hr />
                    </div>
                    <div style="text-align: center;">TERLAMPIR</div>
                    <div style="text-align: left;">Foto</div>
                    <div style="text-align: left;">
                      <?php
                      $queryImage = "SELECT * FROM `tr_picture_to_work_report` WHERE `work_report_id` = '$workId'";
                      $resultImage = $connection->query($queryImage);
                      $rowCountImage = mysqli_num_rows($resultImage);
                      $tr = 1;
                      if ($rowCountImage > 2) {
                        $tr = ceil($rowCountImage / 2);
                      }
                      for ($i = 0; $i < $tr; $i++) :
                        echo '<div class="row">';
                        while ($dataImage = $resultImage->fetch_assoc()) :
                      ?>
                          <div class="col-6">
                            <img src="./sw-mod/laporan-kerja/upload/image/<?= $dataImage['picture'] ?>" alt="Lights" width="100%">
                            <!-- <img src="../sw-mod/laporan-kerja/upload/image/<?= $dataImage['picture'] ?>" alt="Lights" width="100%"> -->
                            <br>
                            <p>
                              <span style="text-align: right;">Keterangan Foto Lokasi</span>
                            </p>
                          </div>

                        <?php endwhile; ?>

                      <?php
                        echo '</div>';
                      endfor; ?>
                    </div>

                    <div style="text-align: left;">
                      <hr />
                    </div>
                    <div style="text-align: left;">Camera Foto</div>
                    <div style="text-align: left;">
                      <img src="./sw-mod/laporan-kerja/upload/image/<?= $dataImage['camera'] ?>" alt="Lights" style="width:50%">
                    </div>
                    <div style="text-align: left;">
                      <hr />
                      <p>Link :</p>
                      <a href="<?= $row['link'] ?>" target="__blank">Klik Link</a>

                    </div>
                  </div>
                </div>
              </div>


            </form>
          </div>

        </div>
      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
      <script>
        var btnBack = $("#back-button").on("click", function() {
          window.location.href = 'https://sisterskominda.eagleye.id/laporan-kerja';
        });
      </script>
    <?php else : ?>
      <h1>Data Yang diminta Tidak Ada</h1>
    <?php endif; ?>
  <?php else : ?>
    <h1>Data ID Tidak Ada</h1>
  <?php endif; ?>