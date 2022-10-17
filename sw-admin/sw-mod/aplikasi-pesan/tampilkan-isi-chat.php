<?php
$id = @$_GET['id']; //ID PENGIRIM
$penerima = @$_GET['penerima'];
if ($id && $penerima) :
  $id     =  mysqli_real_escape_string($connection, epm_decode($id));
  $query  = "SELECT * FROM `employees` WHERE `id`='$id'";
  $penerima     =  mysqli_real_escape_string($connection, epm_decode($penerima));
  $queryPenerima  = "SELECT * FROM `employees` WHERE `id`='$penerima'";
  $resultPengirim = $connection->query($query);
  $resultPenerima = $connection->query($queryPenerima);
  if ($resultPengirim->num_rows > 0 && $resultPenerima->num_rows > 0) :
    $rowPengirim = $resultPengirim->fetch_assoc();
    $rowPenerima  = $resultPenerima->fetch_assoc();
?>

    <section class="content-header">
      <h1>Riwayat<small> Obrolan User</small></h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="./aplikasi-pesan"><i class="fa fa-dashboard"></i> Data Obrolan User</a></li>
        <li><a href="./aplikasi-pesan&op=detail&id=<?= epm_encode($rowPengirim['id']) ?>"><i class="fa fa-dashboard"></i> Riwayat Obrolan User</a></li>
        <li class="active">Tampil Chat</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Riwayat Obrolan User : <?= $rowPengirim['employees_name']; ?></b></h3>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <td style="width: 10%;">
                      Pengirim
                    </td>
                    <td>
                      : <?= $rowPengirim['employees_name']; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Penerima
                    </td>
                    <td>
                      : <?= $rowPenerima['employees_name'] ?>
                    </td>
                  </tr>
                </table>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Chat Pengirim (<?= $rowPengirim['employees_name']; ?>)</th>
                      <th>Chat Penerima (<?= $rowPenerima['employees_name'] ?>)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $pengirim     = $rowPengirim['id'];
                    $penerima     = $rowPenerima['id'];
                    $queryisiChat  = "SELECT * FROM `chat` WHERE (`chat_pengirim`='$pengirim' AND `chat_penerima`='$penerima') or (`chat_pengirim`='$penerima' AND `chat_penerima`='$pengirim')";

                    $resultIsiChat  = $connection->query($queryisiChat);
                    while ($isiChat  = $resultIsiChat->fetch_assoc()) :
                    ?>
                      <tr>
                        <?php if ($isiChat['chat_pengirim'] === $pengirim) : ?>
                          <td>
                            <?php if ($isiChat['chat_tipe'] === 'file') : ?>
                              <a href="https://chat-sisterskominda.eagleye.id/gambar/file/<?= $isiChat['chat_isi']; ?>" target="__blank"><?= $isiChat['chat_isi']; ?></a>
                            <?php elseif ($isiChatp['chat_tipe' === 'gambar']) : ?>
                              <a href="https://chat-sisterskominda.eagleye.id/gambar/chat/<?= $isiChat['chat_isi']; ?>" target="__blank"><?= $isiChat['chat_isi']; ?></a>
                            <?php else : ?>
                              <?= $isiChat['chat_isi']; ?>
                            <?php endif; ?>

                          </td>
                          <td>
                          </td>
                        <?php else : ?>
                          <td></td>
                          <td>
                            <?php if ($isiChat['chat_tipe'] === 'file') : ?>
                              <a href="https://chat-sisterskominda.mydhrs.com/gambar/file/<?= $isiChat['chat_isi']; ?>" target="__blank"><?= $isiChat['chat_isi']; ?></a>
                            <?php elseif ($isiChatp['chat_tipe' === 'gambar']) : ?>
                              <a href="https://chat-sisterskominda.mydhrs.com/gambar/chat/<?= $isiChat['chat_isi']; ?>" target="__blank"><?= $isiChat['chat_isi']; ?></a>
                            <?php else : ?>
                              <?= $isiChat['chat_isi']; ?>
                            <?php endif; ?>
                          </td>
                        <?php endif; ?>
                      </tr>
                    <?php endwhile; ?>


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