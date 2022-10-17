<?php
session_start();
if (!isset($_COOKIE['COOKIES_MEMBER']) && !isset($_COOKIE['COOKIES_COOKIES'])) {
  header("Location:./login");
} else {
  require_once './sw-library/vendor/autoload.php';
  require_once './sw-library/sw-config.php';
  include('./sw-library/sw-function.php');
  $employeId          = epm_decode($_COOKIE['COOKIES_MEMBER']);
  $queryEmploye       = "SELECT * FROM `employees` WHERE `id` = '$employeId'";
  $resultQueryEmploye = $connection->query($queryEmploye);
  $employe            = $resultQueryEmploye->fetch_assoc();


?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://kit.fontawesome.com/6165a5b20e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./sw-mod/sw-assets/css/style.css" />
    <link rel="stylesheet" href="./sw-mod/sw-assets/css/sw-custom.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="./sw-mod/sw-assets/js/sw-script.js"></script>

    <style>
      /* style guide */
      :root {
        --custom-primary: #57d163;
        --custom-secondary: #373737;
        --custom-dark: #1d1d1d;
        --custom-white: #cccccc;
      }

      .bg-dark {
        background-color: var(--custom-dark) !important;
      }

      .navbar-brand .h1 {
        color: var(--custom-primary);
      }

      .nav-item a {
        font-size: 0.7rem;
        padding: 0 !important;
      }

      .nav-item.show .nav-link,
      .nav-link.active {
        border-bottom: 0.25rem solid var(--custom-primary);
        border-bottom-color: var(--custom-primary);
      }

      .nav-link img {
        height: 45px;
      }

      .nav-link .img-laporan-saya {
        content: url('./sw-mod/sw-assets/img/btn/Btn_LaporanSaya_off.png');
      }

      .nav-link.active .img-laporan-saya {
        content: url('./sw-mod/sw-assets/img/btn/Btn_LaporanSaya_On.png');
      }

      .nav-link .img-laporan-masuk {
        content: url('./sw-mod/sw-assets/img/btn/Btn_LaporanMasuk_Off.png');
      }

      .nav-link.active .img-laporan-masuk {
        content: url('./sw-mod/sw-assets/img/btn/Btn_LaporanMasuk_On.png');
      }

      .nav-link .img-broadcast {
        content: url('./sw-mod/sw-assets/img/btn/Btn_Broadcast_Off.png');
      }

      .nav-link.active .img-broadcast {
        content: url('./sw-mod/sw-assets/img/btn/Btn_Broadcast_On.png');
      }

      .btn-outline-primary {
        border-color: var(--custom-primary) !important;
        color: var(--custom-primary) !important;
      }

      .input-group-search span:first-child {
        position: absolute;
        margin-left: 0.5rem;
        height: 30px;
        color: rgba(0, 0, 0, 0.54);
        left: 0;
        bottom: 0;
        z-index: 99;
      }

      .input-group-search>input {
        padding-left: 32px;
      }

      .empty-box {
        height: 300px;
        background: transparent url('./sw-mod/sw-assets/img/Etc/Empty Box.png') no-repeat center;
        background-size: contain;
      }

      .card-laporan-masuk {
        border-radius: 0.5rem;
        padding-top: 1rem;
        padding-left: 0.5rem;
        padding-right: 1rem;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
        border-left: 6px solid var(--custom-primary);
        background: var(--custom-dark);
      }

      .card-laporan-masuk .card-body {
        padding: 0px !important;
      }

      .card-laporan-masuk .card-body h1,
      .card-laporan-masuk .card-body h6,
      .card-laporan-masuk .card-body .card-title {
        color: var(--custom-primary);
      }

      .card-laporan-masuk .card-body .card-text {
        color: var(--custom-white);
        font-size: 12px;
        font-weight: 300;
        line-height: 1rem;
      }

      .card-laporan-masuk .card-body h1 {
        font-size: 46px !important;
        font-weight: 500;
      }
    </style>
    <title>Lembar Kerja</title>
  </head>

  <body>
    <!-- Image and text -->
    <nav class="navbar navbar-dark bg-dark">
      <div class="col navbar-brand m-0 p-0">
        <a href="home.html">
          <img src="./sw-mod/sw-assets/img/Btn_Back.png" width="30" height="30" class="d-inline-block align-top" alt="" />
        </a>
        <span class="navbar-brand py-1 mb-0 ml-2 h1">Lembar Kerja</span>
      </div>
    </nav>

    <ul class="nav justify-content-between bg-dark pt-2 flex-nowrap" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#laporansaya" role="tab" aria-controls="home" aria-selected="true">
          <img class="img-laporan-saya" />
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#laporanmasuk" role="tab" aria-controls="profile" aria-selected="false">
          <img class="img-laporan-masuk" />
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#broadcast" role="tab" aria-controls="contact" aria-selected="false">
          <img class="img-broadcast" />
        </a>
      </li>
    </ul>

    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="laporansaya" role="tabpanel" aria-labelledby="laporansaya-tab">
        <div class="container px-2 py-3">
          <!-- <div class="col-12 mb-2">
            <div class="input-group input-group-search">
              <span>
                <i class="fa fa-search" aria-hidden="true"></i>
              </span>
              <input class="form-control py-2" type="search" value="search" placeholder="pencarian" id="example-search-input" />
              <span class="input-group-append">
                <button class="btn btn-outline-primary bg-white" type="button">
                  <i class="fa fa-calendar"></i>
                </button>
              </span>
            </div>
          </div> -->
          <div class="col mb-2">
            <!-- kalo ada data laporan disini -->
            <?php
            $queryLaporanKu = "SELECT * FROM `m_work_report` WHERE employe_id='$employeId'";

            $resultLaporanKu = $connection->query($queryLaporanKu);
            if ($resultLaporanKu->num_rows > 0) :
              $no = 0;
              while ($rowLaporanKu = $resultLaporanKu->fetch_assoc()) :
            ?>
                <div class="row">
                  <div class="card card-laporan-masuk col">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-3 text-center">
                          <h1 class="mb-0"><?= date('d', strtotime($rowLaporanKu['created_at'])); ?></h1>
                          <h6 class="card-subtitle"><?= date('M Y', strtotime($rowLaporanKu['created_at'])); ?></h6>
                        </div>
                        <div class="col-9">
                          <p class="card-title mb-1">Perihal : <?= $rowLaporanKu['about']; ?></p>
                          <p class="card-text mb-0">
                            <?= date('H:i:s', strtotime($rowLaporanKu['created_at'])); ?>
                          </p>
                          <a href="<?= $base_url; ?>detail-laporan-kerja?nomor=<?= $rowLaporanKu['id']; ?>" class="float-right">
                            <img src="./sw-mod/sw-assets/img/btn/Buka File.png" height="30px" />
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              endwhile;
              ?>
              <!-- kalau belum ada laporan disini -->
            <?php else : ?>
              <div class="col empty-box my-4 d-none"></div>
            <?php endif; ?>

          </div>
          <div class="col-12 fixed-bottom">
            <a href="./laporan-kerja" class="float-right">
              <img src="./sw-mod/sw-assets/img/btn/Btn_Laporan.png" height="45px" />
            </a>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="laporanmasuk" role="tabpanel" aria-labelledby="laporanmasuk-tab">
        <div class="container px-2 py-3">
          <!-- <div class="col-12 mb-2">
            <div class="input-group input-group-search">
              <span>
                <i class="fa fa-search" aria-hidden="true"></i>
              </span>
              <input class="form-control py-2" type="search" value="search" placeholder="pencarian" id="example-search-input" />
              <span class="input-group-append">
                <button class="btn btn-outline-primary bg-white" type="button">
                  <i class="fa fa-calendar"></i>
                </button>
              </span>
            </div>
          </div> -->
          <div class="col mb-2">
            <!-- kalo ada data laporan disini -->
            <?php
            $employeIdName = $employe['employees_name'];
            $queryKepada = "SELECT
            a.*,
            b.`employe_name` as `pengirim`,
            b.`about`,
            b.`created_at`
          From
            `tr_report_purpose_to_work_report` as `a`,
            `m_work_report` as `b`
          WHERE
            `a`.`work_report_id` = b.`id` AND a.`employe_name` = '$employeIdName' ORDER BY `b`.`id` DESC";
            $resultWorkReportPurpose = $connection->query($queryKepada);

            if ($resultWorkReportPurpose->num_rows > 0) :
              $no = 0;
              while ($rowPurpose = $resultWorkReportPurpose->fetch_assoc()) :
            ?>
                <div class="row">
                  <div class="card card-laporan-masuk col">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-3 text-center">
                          <h1 class="mb-0"><?= date('d', strtotime($rowPurpose['created_at'])); ?></h1>
                          <h6 class="card-subtitle"><?= date('M Y', strtotime($rowPurpose['created_at'])); ?></h6>
                        </div>
                        <div class="col-9">
                          <p class="card-title mb-1">File No <?= $rowPurpose['work_report_id']; ?></p>
                          <p class="card-text mb-0">
                            Pengirim : <?= $rowPurpose['pengirim']; ?>
                            <br />
                            <?= date('H:i:s', strtotime($rowPurpose['created_at'])); ?>
                          </p>
                          <a href="./detail-laporan-masuk.php?nomor=<?= epm_encode($rowPurpose['work_report_id']); ?>" class="float-right">
                            <img src="./sw-mod/sw-assets/img/btn/Buka File.png" height="30px" />
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              endwhile;
              ?>
              <!-- kalau belum ada laporan disini -->
            <?php else : ?>
              <div class="col empty-box my-4 d-none"></div>
            <?php endif; ?>

            <!-- TEMBUSAN -->
            <?php
            $employeIdName = $employe['employees_name'];
            $queryTembusan = "SELECT
            a.*,
            b.`employe_name` as `pengirim`,
            b.`about`,
            b.`created_at`
          From
            `tr_forward_report_to_work_report` as `a`,
            `m_work_report` as `b`
          WHERE
            `a`.`work_report_id` = b.`id` AND a.`employe_name` = '$employeIdName' ORDER BY `b`.`id` DESC";
            $resultForwardReport = $connection->query($queryTembusan);
            $no = 0;
            while ($rowTembusan = $resultForwardReport->fetch_assoc()) :
            ?>
              <div class="row">
                <div class="card card-laporan-masuk col">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-3 text-center">
                        <h1 class="mb-0"><?= date('d', strtotime($rowTembusan['created_at'])); ?></h1>
                        <h6 class="card-subtitle"><?= date('M Y', strtotime($rowTembusan['created_at'])); ?></h6>
                      </div>
                      <div class="col-9">
                        <p class="card-title mb-1">File No <?= $rowTembusan['work_report_id']; ?></p>
                        <p class="card-text mb-0">
                          Pengirim : <?= $rowTembusan['pengirim']; ?>
                          <br />
                          <?= date('H:i:s', strtotime($rowTembusan['created_at'])); ?>
                        </p>
                        <a href="./detail-laporan-masuk.php?nomor=<?= epm_encode($rowTembusan['work_report_id']); ?>" class="float-right">
                          <img src="./sw-mod/sw-assets/img/btn/Buka File.png" height="30px" />
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            endwhile;
            ?>
            <!-- kalau belum ada laporan disini -->

          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="broadcast" role="tabpanel" aria-labelledby="broadcast-tab">
        <div class="container px-2 py-3">
          <!-- <div class="col-12 mb-2">
            <div class="input-group input-group-search">
              <span>
                <i class="fa fa-search" aria-hidden="true"></i>
              </span>
              <input class="form-control py-2" type="search" value="search" placeholder="pencarian" id="example-search-input" />
              <span class="input-group-append">
                <button class="btn btn-outline-primary bg-white" type="button">
                  <i class="fa fa-calendar"></i>
                </button>
              </span>
            </div>
          </div> -->
          <div class="col mb-2">
            <?php
            $query = "SELECT a.*,b.`employee_id` FROM `m_broadcast` `a`, `t_broadcast_to_employe` `b` WHERE `a`.`id`=`b`.`broadcast_id` AND `b`.`employee_id`='$employeId'";
            $result = $connection->query($query);
            if ($result->num_rows > 0) :
              $no = 0;
              while ($row = $result->fetch_assoc()) :
            ?>
                <!-- kalo ada data laporan disini -->
                <div class="row">
                  <div class="card card-laporan-masuk col">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-3 text-center">
                          <h1 class="mb-0"><?= date('d', strtotime($row['craeted_at'])); ?></h1>
                          <h6 class="card-subtitle"><?= date('M Y', strtotime($row['craeted_at'])); ?></h6>
                          <span class=""><?= date('H:i', strtotime($row['craeted_at'])); ?></span>
                        </div>
                        <div class="col-9">
                          <p class="card-title mb-1">
                            Pengirim : Administrator

                          </p>
                          <p class="card-text mb-0">
                            <?= $row['pesan']; ?>
                          </p>

                          <a href="./detail-broadcast.php?nomor=<?= epm_encode($row['id']); ?>" class="float-right">
                            <img src="./sw-mod/sw-assets/img/btn/Buka File.png" height="30px" />
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- kalau belum ada laporan disini -->
              <?php
              endwhile;
              ?>
            <?php else : ?>
              <div class="col empty-box my-4 d-none"></div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener('contextmenu', (event) =>
        event.preventDefault()
      );
      document.onkeydown = function(e) {
        if (e.keyCode == 123) {
          return false;
        }
      };
    </script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
  </body>

  </html>

<?php
}
?>