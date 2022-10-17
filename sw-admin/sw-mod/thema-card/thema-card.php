<?php
if (empty($connection)) {
  header('location:../../');
} else {
  include_once 'sw-mod/sw-panel.php';
  echo '
  <div class="content-wrapper">';
  switch (@$_GET['op']) {
    default:
      echo '
<section class="content-header">
  <h1>Data<small> Tema ID Card</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Data Jabatan</li>
    </ol>
</section>';
      echo '
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Jabatan</b></h3>
          <div class="box-tools pull-right">';
      if ($level_user == 1) {
        echo '
            <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modalAdd" ' . ($row_user['is_create'] === '0' ? 'style="visibility:hidden"' : '') . '><i class="fa fa-plus"></i> Tambah Baru</button>';
      } else {
        echo '
            <button type="button" class="btn btn-success btn-flat access-failed" ' . ($row_user['is_create'] === '0' ? 'style="visibility:hidden"' : '') . '><i class="fa fa-plus"></i> Tambah Baru</button>';
      }
      echo '
          </div>
        </div>
          <div class="box-body">
          <div class="table-responsive">
          <table id="swdatatable" class="table table-bordered">
            <thead>
            <tr>
              <th style="width:20px" class="text-center">No</th>
              <th width="50">Foto</th>
              <th>Nama</th>
              <th class="text-center">Status</th>
              <th style="width:100px">Aksi</th>
            </tr>
            </thead>
            <tbody>';
      $query = "SELECT * FROM business_card order by id DESC";
      $result = $connection->query($query);
      if ($result->num_rows > 0) {
        $no = 0;
        while ($row = $result->fetch_assoc()) {
          $no++;

          if ($row['active'] == 1) {
            $active = '<button type="button" id="set' . $row['id'] . '" data-id="' . $row['id'] . '" class="btn light btn-primary btn-xs setactive" data-active="' . $row['active'] . '"><i class="fa fa-eye"></i> Aktif</button>';
          } else {
            $active = '<button type="button" id="set' . $row['id'] . '" data-id="' . $row['id'] . '" class="btn light btn-danger btn-xs setactive" data-active="' . $row['active'] . '""><i class="fa fa-eye-slash"></i> Tidak Aktif</button>';
          }
          echo '
              <tr>
                <td class="text-center">' . $no . '</td>
                <td class="text-center">';
          if ($row['photo'] == NULL) {
            echo '<img src="../timthumb?src=' . $site_url . '/sw-content/avatar.jpg&h=50&w=50">';
          } else {
            echo '<a class="image-link" href="' . $site_url . '/sw-content/id-card/' . $row['photo'] . '">
                    <img src="../timthumb?src=' . $site_url . '/sw-content/id-card/' . $row['photo'] . '&h=50&w=50"></a>';
          }
          echo '</td>
                <td>' . $row['name'] . '</td>
                <td class="text-center">' . $active . '</td>
                <td>
                  <div class="btn-group">';
          if ($level_user == 1) {
            echo '
                    <button ' . ($row_user['is_update'] === '0' ? 'style="visibility:hidden"' : '') . ' class="btn btn-warning btn-xs  btn-edit" title="Edit" data-id="' . epm_encode($row['id']) . '" data-name="' . strip_tags($row['name']) . '" data-image="' . $row['photo'] . '"><i class="fa fa-pencil-square-o"></i> Ubah</button>
                    <buton ' . ($row_user['is_delete'] === '0' ? 'style="visibility:hidden"' : '') . ' data-id="' . epm_encode($row['id']) . '" class="btn btn-xs btn-danger delete" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</button>';
          } else {
            echo '
                    <button ' . ($row_user['is_update'] === '0' ? 'style="visibility:hidden"' : '') . ' type="button" class="btn btn-warning btn-xs access-failed enable-tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i> Ubah</button>
                    <buton  ' . ($row_user['is_delete'] === '0' ? 'style="visibility:hidden"' : '') . ' type="button" class="btn btn-xs btn-danger access-failed" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</button>';
          }
          echo '
                  </div>
                </td>
              </tr>';
        }
      }
      echo '
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> 
</section>

<!-- Add -->
<div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Baru</h4>
      </div>
      <form id="validate" class="form add-theme" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="name" id="nama" required>
        </div>

        <div class="form-group">
          <label>Upload Thema ID Card</label>
          <div class="upload-media">
            <img width="80" class="preview" src="./sw-assets/img/avatar.jpg">
            <input type="file" id="imgInp" class="upload-hidden" id="file" name="photo" required="" accept="image/jpeg, image/jpg, image/gif" capture>
          </div>
           <div class="alert text-warning">
             Ungga Tema Id card dengan Ukuran 400 x 600px
           </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Simpan</button>
        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Batal</button>
      </div>
    </form>
    </div>
  </div>
</div>


<!-- Edit -->
<div class="modal fade" id="modal-update" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Data</h4>
      </div>
      <form id="validate" class="form update" enctype="multipart/form-data">
      <input type="hidden" name="id" id="id" readonly required>
      <div class="modal-body">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="form-group">
          <label>Upload Thema ID Card</label>
          <div class="upload-media">
            <img width="80" class="preview" src="./sw-assets/img/avatar.jpg">
            <input type="file" id="imgInp2" class="upload-hidden" id="file" name="photo" accept="image/jpeg, image/jpg, image/gif" capture>
          </div>
          <div class="alert text-warning">
             Ungga Tema Id card dengan Ukuran 400 x 600px
           </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Simpan</button>
        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Batal</button>
      </div>
    </form>
    </div>
  </div>
</div>';
      break;
  } ?>

  </div>
<?php } ?>