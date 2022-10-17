<?php
$id = @$_GET['id']; //ID PENGIRIM
if ($id) :
  $id     =  mysqli_real_escape_string($connection, epm_decode($id));
  $query  = "SELECT * FROM `employees` WHERE `id`='$id'";
  $result = $connection->query($query);
  if ($result->num_rows > 0) :
    $row  = $result->fetch_assoc();
?>
    <section class="content-header">
      <h1>Riwayat<small> Obrolan User</small></h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="./aplikasi-pesan"><i class="fa fa-dashboard"></i> Data Obrolan User</a></li>
        <li class="active">Riwayat Obrolan User</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Riwayat Obrolan User : <?= $row['employees_name']; ?></b></h3>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table id="swdatatable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>User Penerima</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $queryChat  = "SELECT a.*, `b`.`id`,b.`employees_name` FROM 
                      `chat` as `a` LEFT JOIN `employees` as `b` ON `a`.`chat_penerima`=`b`.`id` WHERE `a`.`chat_pengirim`='$id' GROUP BY `a`.`chat_penerima`
                    ";
                    $resultPenerima = $connection->query($queryChat);
                    $nomor = 0;
                    while ($dataPenerima = $resultPenerima->fetch_assoc()) :
                      $nomor++;
                    ?>
                      <tr>
                        <td><?= $nomor; ?></td>
                        <td><?= $dataPenerima['employees_name']; ?></td>
                        <td>
                          <a href="./<?= $mod ?>&op=tampilchat&id=<?= epm_encode($id) ?>&penerima=<?= epm_encode($dataPenerima['id']) ?>" class="btn btn-warning btn-xs enable-tooltip" title="Detail"><i class="fa fa-eye"></i> Lihat Obrolan</a>
                        </td>
                      </tr>
                    <?php
                    endwhile;
                    ?>
                  </tbody>
                </table>
              </div>
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
<?php endif; ?>