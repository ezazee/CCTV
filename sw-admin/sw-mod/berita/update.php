<?php
$id   = $_GET['id'];
if ($id) :
  $id     =  mysqli_real_escape_string($connection, epm_decode($id));
  $query  = "SELECT * FROM `news` WHERE `id`='$id'";
  $result = $connection->query($query);
  if ($result->num_rows > 0) :
    $row  = $result->fetch_assoc();
?>
    <section class="content-header">
      <h1>Ubah Data<small> Berita</small></h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Ubah Data Berita</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Ubah Data Berita</b></h3>
              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body">
              <form method="POST" action="sw-mod/berita/proses.php?action=update" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= $_GET['id']; ?>">
                <input type="hidden" name="oldImage" id="id" value="<?= $row['image']; ?>">
                <div class="form-group">
                  <label for="title">Judul Berita</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Judul Berita" required value="<?= $row['title']; ?>">
                </div>
                <div class="form-group">
                  <label for="image">Image</label>
                  <input type="file" id="image" name="image">
                  <p class="help-block">Khusus Ekstensi jpeg,jpg,png</p>
                </div>
                <div class="form-group">
                  <textarea id="content" name="content" rows="10" cols="50" placeholder="Masukan Konten" required><?= $row['content']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a class="btn btn-danger" href="./<?= $mod; ?>"><i class="fa fa-remove"></i> Batal</a>
              </form>
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
<?php
else :
?>
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
<?php
endif;
?>