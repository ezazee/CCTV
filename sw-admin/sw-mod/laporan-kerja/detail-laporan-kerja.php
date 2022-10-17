<?php
$id   = $_GET['id'];
if ($id) :
  $id     =  mysqli_real_escape_string($connection, epm_decode($id));
  // $query = "SELECT `m_work_report`.*,`employees`.`employees_name`
  //         FROM `m_work_report` 
  //         INNER JOIN `employees` ON `m_work_report`.`employe_id`=`employees`.`id`
  //         WHERE `m_work_report`.`id` = '$id'";
  $query  = "SELECT * FROM `m_work_report` WHERE `id`='$id'";
  $result = $connection->query($query);
  if ($result->num_rows > 0) :
    $row  = $result->fetch_assoc();
?>

    <section class="content-header">
      <h1>Data<small> Laporan Kerja</small></h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="./laporan-kerja">Data Laporan Kerja</a></li>
        <li class="active">Detail</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Detail Laporan Kerja</b></h3>
            </div>
            <div class="box-body">
              <?php include_once('view-detail-laporan-kerja.php') ?>
              <!-- <table style="border-collapse: collapse; width: 100%;" border="0">
                <tbody>
                  <tr>
                    <td style="width: 80%;">&nbsp;</td>
                    <td style="width: 20%;"><?= date('d-m-Y H:i', strtotime($row['created_at'])) ?></td>
                  </tr>
                </tbody>
              </table>
              <div style="padding-left: 15px; padding-right:15px">
                <p>&nbsp;</p>
                <p>
                  Kepada
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

                <p>
                  Tembusan
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

                <p>
                  Dari
                  <br />
                  <?= $row['employe_name']; ?>
                </p>

                <p>
                  Nilai
                  <br />
                  A<?= $row['point']; ?>
                </p>

                <p>
                  Perihal<br />
                <p class="text-justify">
                  <?=
                  $row['about'];
                  ?>
                </p>
                <p>
                <p>
                  Fakta - Fakta
                  <br />
                <p class="text-justify">
                  <?= $row['fakta_fakta'] ?>
                </p>

                </p>
                Catatan
                <br />

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
                    <p><?= $row['rekomendasi']; ?></p>
                  </li>
                </ul>
                </p>
              </div>

              <div class="font-weight-bold">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="mt-4">
                      <span style="padding-left: 15px;">Lampiran</span>
                      <br>
                      <ul>
                        <li>
                          <span>
                            GAMBAR
                          </span>
                          <p>
                          <div class="row">
                            <?php
                            $queryImage = "SELECT * FROM `tr_picture_to_work_report` WHERE `work_report_id` = '$workId'";
                            $resultImage = $connection->query($queryImage);
                            while ($dataImage = $resultImage->fetch_assoc()) :
                            ?>
                              <div class="col-md-4">
                                <div class="thumbnail">
                                  <a href="../../../../sw-mod/laporan-kerja/upload/image/<?= $dataImage['picture'] ?>">
                                    <img src="../../../../sw-mod/laporan-kerja/upload/image/<?= $dataImage['picture'] ?>" alt="Lights" style="width:100%">
                                    <div class="caption">
                                      <p><?= $dataImage['description']; ?></p>
                                    </div>
                                  </a>
                                </div>
                              </div>
                            <?php endwhile; ?>

                          </div>
                          </p>
                        </li>

                        <li>
                          <span>
                            GAMBAR KAMERA (FOTO)
                          </span>
                          <p>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="thumbnail">
                                <a href="../../../../sw-mod/laporan-kerja/upload/camera/<?= $row['camera'] ?>">
                                  <img src="../../../../sw-mod/laporan-kerja/upload/camera/<?= $row['camera'] ?>" alt="Lights" style="width:100%">
                              </div>
                              </a>
                            </div>
                          </div>
                          </p>
                        </li>

                        <li>
                          <span>3. Link</span>
                          <p>
                            <a href="<?= $row['link'] ?>" target="__blank"><?= $row['link'] ?></a>
                          </p>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
          </div>

        </div>
      </div>
    </section>
  <?php else : ?>
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>
        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Data yang diminta tidak ada.</h3>
          <p>
            Saat ini data yang Anda cari tidak ditemukan<br>
            <a class="btn btn-primary" href="./">return to dashboard</a>
          </p>
        </div>
      </div>
    </section>
  <?php endif; ?>

<?php else : ?>
  <section class="content">
    <div class="error-page">
      <h2 class="headline text-yellow"> 404</h2>
      <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
        <p>
          Saat ini data yang Anda cari tidak ditemukan<br>
          <a class="btn btn-primary" href="./">return to dashboard</a>
        </p>
      </div>
    </div>
  </section>
<?php

endif; //Jika Id tidak ada 
?>