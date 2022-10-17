<section class="content-header">
  <h1>Tambah Data<small> Role Akses</small></h1>
  <ol class="breadcrumb">
    <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Tambah Data Role Akses</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Tambah Data Role Akses</b></h3>
          <div class="box-tools pull-right">
            <a href="<?= $mod;  ?>" class="btn btn-danger btn-flat"> Kembali</a>
          </div>
        </div>
        <div class="box-body">
          <form action="sw-mod/role/proses.php?action=created" method="POST" class="add-user-role">
            <div class="form-group">
              <label for="role-user">User Role</label>
              <input type="text" class="form-control" id="role-user" name="role-user" placeholder="Masukan Nama User Role Akses">
            </div>
            <button type="submit" class="btn btn-primary btn-flat">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>