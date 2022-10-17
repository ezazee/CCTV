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
  <h1>Data<small> Karyawan</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Data Karyawan</li>
    </ol>
</section>';
      echo '
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Karyawan</b></h3>
          <div class="box-tools pull-right">    
          <a href="' . $mod . '&op=upload" class="btn btn-primary btn-flat btn-upload-excel" ' . ($row_user['is_upload'] === '0' ? 'style="visibility:hidden"' : '') . '><i class="fa fa-upload"></i> Upload Data</a>
          <a href="#" class="btn btn-warning btn-flat btn-download-excel" ' . ($row_user['is_download'] === '0' ? 'style="visibility:hidden"' : '') . '><i class="fa fa-download"></i> Unduh Data</a>
          <a href="' . $mod . '&op=add" class="btn btn-success btn-flat" ' . ($row_user['is_create'] === '0' ? 'style="visibility:hidden"' : '') . '><i class="fa fa-plus"></i> Tambah Baru</a>
          </div>
        </div>
    <div class="box-body">
      <div class="table-responsive">
          <table id="swdatatable" class="table table-bordered">
            <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Jabatan</th>
              <th>Status</th>
              <th>Shift</th>
              <th>Lokasi</th>
              <th style="width:150px" class="text-right">Aksi</th>
            </tr>
            </thead>
            <tbody>';
      $query = "SELECT employees.*,position.position_name,shift.shift_name,building.name  FROM employees,position,shift,building WHERE employees.position_id=position.position_id AND employees.shift_id=shift.shift_id AND employees.building_id=building.building_id  order by employees.id DESC";
      $result = $connection->query($query);
      if ($result->num_rows > 0) {
        $no = 0;
        while ($row = $result->fetch_assoc()) {
          $no++;
          if ($row['is_active'] === '0') {
            $isActive = '<span class="label label-danger badge-pill">Tidak Aktif </span> <a href="#" class="btn btn-link activation" title="Aktivasi Sekarang" data-id="' . epm_encode($row['id']) . '"><i class="fa fa-check-circle-o" aria-hidden="true"></i></a> ';
          }
          if ($row['is_active'] === '1') {
            $isActive = 'Aktivasi User';
          }
          if ($row['is_active'] === '2') {
            $isActive = '<span class="label label-primary badge-pill"> User Aktif </span>';
          }
          echo '
              <tr>
                <td class="text-center">' . $no . '</td>
                <td>' . $row['employees_nip'] . '</td>
                <td>' . $row['employees_name'] . '</td>
                <td>' . $row['employees_email'] . '</td>
                <td>' . $row['position_name'] . '</td>
                <td>' . $isActive . '</td>
                <td>' . $row['shift_name'] . '</td>
                <td>' . $row['name'] . '</td>
                <td class="text-right">
                  <div class="btn-group">
                    <button type="button" class="btn btn-info btn-xs btn-qrcode" data-id="' . epm_encode($row['id']) . '" title="Qr-Code"><i class="fa fa-qrcode" aria-hidden="true"></i></button>
                    <a href="./' . $mod . '&op=edit&id=' . epm_encode($row['id']) . '" class="btn btn-warning btn-xs enable-tooltip" title="Edit" ' . ($row_user['is_update'] === '0' ? 'style="visibility:hidden"' : '') . '><i class="fa fa-pencil-square-o"></i> Ubah</a>
                    <buton data-id="' . epm_encode($row['id']) . '" class="btn btn-xs btn-danger delete" title="Hapus" ' . ($row_user['is_delete'] === '0' ? 'style="visibility:hidden"' : '') . '><i class="fa fa-trash-o"></i> Hapus</button>         
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
</section>';


      echo '
<!-- QR CODE -->
<div id="modal-qrcode" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">QR Code</h4>
            </div>

            <div class="modal-body">
                <div class="loaddata"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->';
      break;
    case 'add':
      echo '
<section class="content-header">
  <h1>Tambah Data<small> Karyawan</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li><a href="./karyawan"> Data Karyawan</a></li>
      <li class="active">Tambah Karyawan</li>
    </ol>
</section>';
      echo '
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Tambah Data Karyawan</b></h3>
        </div>

        <div class="box-body">
            <form class="form-horizontal validate add-karyawan" enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">NIP</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="employees_nip" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="employees_name" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="employees_email" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-6">
                    <input type="password" class="form-control" name="employees_password" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Jabatan</label>
                  <div class="col-sm-6">
                   <select class="form-control" name="position_id" required="">
                      <option value="">- Pilih -</option>';
      $query = "SELECT * from position order by position_name ASC";
      $result = $connection->query($query);
      while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['position_id'] . '">' . $row['position_name'] . '</option>';
      }
      echo '
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Shift</label>
                  <div class="col-sm-6">
                   <select class="form-control" name="shift_id" required="">
                      <option value="">- Pilih -</option>';
      $query = "SELECT shift_id,shift_name from shift order by shift_name ASC";
      $result = $connection->query($query);
      while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['shift_id'] . '">' . $row['shift_name'] . '</option>';
      }
      echo '
                  </select>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 control-label">Penempatan</label>
                  <div class="col-sm-6">
                   <select class="form-control" name="building_id" id="building" required="">
                      <option value="">- Pilih -</option>';
      $query = "SELECT building_id,name,address from building order by name ASC";
      $result = $connection->query($query);
      while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['building_id'] . '">' . $row['name'] . '</option>';
      }
      echo '
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Foto</label>
                  <div class="col-sm-6">
                    <img width="80" class="preview" src="./sw-assets/img/avatar.jpg"><br><br>
                    <input type="file" id="imgInp" class="btn btn-default" id="file" name="photo" required="" accept="image/jpeg, image/jpg, image/gif" capture>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-sm-2"></div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                <a class="btn btn-danger" href="./' . $mod . '"><i class="fa fa-remove"></i> Batal</a>
              </div>
              <!-- /.box-footer -->
            </form>
        
      </div>
    </div>
  </div> 
</section>';
      break;

    case 'edit':
      echo '
<section class="content-header">
  <h1>Edit Data<small> Karyawan</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li><a href="./karyawan"> Data Karyawan</a></li>
      <li class="active">Edit Karyawan</li>
    </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Profil</a></li>
            <li><a href="#tab_2" data-toggle="tab">Ubah Password</a></li>
          </ul>
        </div>

      <div class="box-body">';
      if (!empty($_GET['id'])) {
        $id     =  mysqli_real_escape_string($connection, epm_decode($_GET['id']));
        $query  = "SELECT * from employees WHERE id='$id'";
        $result = $connection->query($query);
        if ($result->num_rows > 0) {
          $row  = $result->fetch_assoc();
          echo '
      <div class="nav-tabs-custom">
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">

            <form class="form-horizontal validate update-karyawan" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">NIP</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="employees_nip" value="' . $row['employees_nip'] . '" required>
                    <input type="hidden"  name="id" value="' . $row['id'] . '" readonly required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="employees_name" value="' . $row['employees_name'] . '" required>
                  </div>
                </div>

                
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jabatan</label>
                  <div class="col-sm-6">
                   <select class="form-control" name="position_id" required="">
                      <option value="">- Pilih -</option>';
          $query = "SELECT * from position order by position_name ASC";
          $result = $connection->query($query);
          while ($rowa = $result->fetch_assoc()) {
            if ($rowa['position_id'] == $row['position_id']) {
              echo '<option value="' . $rowa['position_id'] . '" selected>' . $rowa['position_name'] . '</option>';
            } else {
              echo '<option value="' . $rowa['position_id'] . '">' . $rowa['position_name'] . '</option>';
            }
          }
          echo '
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Shift</label>
                  <div class="col-sm-6">
                   <select class="form-control" name="shift_id" required="">
                      <option value="">- Pilih -</option>';
          $query = "SELECT shift_id,shift_name from shift order by shift_name ASC";
          $result = $connection->query($query);
          while ($rowa = $result->fetch_assoc()) {
            if ($rowa['shift_id'] == $row['shift_id']) {
              echo '<option value="' . $rowa['shift_id'] . '" selected>' . $rowa['shift_name'] . '</option>';
            } else {
              echo '<option value="' . $rowa['shift_id'] . '">' . $rowa['shift_name'] . '</option>';
            }
          }
          echo '
                  </select>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 control-label">Penempatan</label>
                  <div class="col-sm-6">
                   <select class="form-control" name="building_id" id="building" required="">
                      <option value="">- Pilih -</option>';
          $query = "SELECT building_id,name,address from building order by name ASC";
          $result = $connection->query($query);
          while ($rowa = $result->fetch_assoc()) {
            if ($rowa['building_id'] == $row['building_id']) {
              echo '<option value="' . $rowa['building_id'] . '" selected>' . $rowa['address'] . '</option>';
            } else {
              echo '<option value="' . $rowa['building_id'] . '">' . $rowa['address'] . '</option>';
            }
          }
          echo '
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Foto</label>
                  <div class="col-sm-6">
                    <div class="upload-media">';
          if ($row['photo'] == '') {
            echo '<img width="80" class="preview" width="80" src="./sw-assets/img/avatar.jpg">';
          } else {
            echo '<img width="80" class="preview" width="80" src="../sw-content/karyawan/' . $row['photo'] . '">';
          }
          echo '
                    </div>
                    <input type="file" id="imgInp" class="btn btn-default" id="file" name="photo" accept="image/jpeg, image/jpg, image/gif" capture>
                    <small>Kosongan jika tidak ingin mengubah</small>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-sm-2"></div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                <a class="btn btn-danger" href="./' . $mod . '"><i class="fa fa-remove"></i> Batal</a>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_2">
            <form class="form-horizontal validate update-password">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="employees_email" value="' . $row['employees_email'] . '" readonly required>
                    <input type="hidden"  name="id" value="' . $row['id'] . '" readonly required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-6">
                    <input type="password" class="form-control" id="password" name="employees_password" required>
                  </div>
                </div>

              </div>
              
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-sm-2"></div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                <a class="btn btn-danger" href="./' . $mod . '"><i class="fa fa-remove"></i> Batal</a>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->';
        } else {
          echo '<section class="content">
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
          </section>';
        }
      }
      echo '
      </div>
    </div>
  </div> 
</section>';
      break;
    case 'upload':
      echo '
      <section class="content-header">
          <h1>Upload Data<small> Karyawan</small></h1>
          <ol class="breadcrumb">
            <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="./karyawan"> Data Karyawan</a></li>
            <li class="active">Tambah Karyawan</li>
          </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title"><b>Upload Data Karyawan</b></h3>
              </div>
                <div class="box-body">
                  <h4 class="text-danger">Untuk melakukan upload data karyawan silahkan unduh beberapa keperluan data-data yang berhubungan dengan data karyawan tersebut</h4>
                  <ul>
                    <li><a href="sw-mod/karyawan/proses.php?action=download-data-jabatan">Unduh Data Jabatan</a></li>
                    <li><a href="sw-mod/karyawan/proses.php?action=download-data-jam-kerja">Unduh Data Jam Kerja</a></li>
                    <li><a href="sw-mod/karyawan/proses.php?action=download-data-lokasi">Unduh Data Lokasi</a></li>
                  </ul>
                  <form method="post" enctype="multipart/form-data" action="sw-mod/karyawan/upload_data.php">
                    <div class="form-group">
                      <label for="upload">Upload File</label>
                      <input name="filepegawai" type="file" required="required" id="upload">
                      <a class="btn btn-link" href="sw-mod/karyawan/excel/format_import_excel.xls">Unduh Format Excel disini.</a>
                    </div>
                    <input name="upload" type="submit" value="Import" class="btn btn-primary">
                    <a class="btn btn-danger" href="./' . $mod . '"><i class="fa fa-remove"></i> Batal</a>
                  </form>
                </div>
               
              </div>
            </div>
          </div>
        </div>
      </section>
      
      ';
      break;
  } ?>

  </div>
<?php } ?>