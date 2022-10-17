<section class="content-header">
  <h1>Tambah Data<small> Berita</small></h1>
  <ol class="breadcrumb">
    <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Tambah Data Berita</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Tambah Data Berita</b></h3>
          <div class="box-tools pull-right">
          </div>
        </div>
        <div class="box-body">
          <form method="POST" action="sw-mod/berita/proses.php?action=add" enctype="multipart/form-data">
            <div class="form-group">
              <label for="title">Judul Berita</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Judul Berita" required>
            </div>
            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" id="image" name="image" required>
              <p class="help-block">Khusus Ekstensi jpeg,jpg,png</p>
            </div>
            <div class="form-group">
              <textarea id="content" name="content" rows="10" cols="50" placeholder="Masukan Konten" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-danger" href="./<?= $mod; ?>"><i class="fa fa-remove"></i> Batal</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>