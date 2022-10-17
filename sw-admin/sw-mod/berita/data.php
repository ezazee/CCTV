<section class="content-header">
  <h1>Data<small> Berita</small></h1>
  <ol class="breadcrumb">
    <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Data Berita</li>
  </ol>
</section>
<?php
$site_url = 'https://sisters-kominda.eagleye.id/';
?>
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Berita</b></h3>
          <div class="box-tools pull-right">
            <a href="<?= $mod; ?>&op=add" class="btn btn-success btn-flat" <?= ($row_user['is_create'] === '0' ? 'style="visibility:hidden"' : '') ?>><i class="fa fa-plus"></i> Tambah Baru</a>
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="swdatatable" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Judul Berita</th>
                  <th>Gambar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = "SELECT * FROM `news`";
                $result = $connection->query($query);

                if ($result->num_rows > 0) :
                  $no = 0;
                  while ($row = $result->fetch_assoc()) :
                    $no++;
                ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $row['title']; ?></td>
                      <td>
                        <img src="<?= $site_url ?>/sw-content/news/<?= $row['image']; ?>" alt="<?= $row['image']; ?>" class="img-thumbnail" style="height: 100px; width:auto">
                      </td>
                      <td>
                        <div class="btn-group">
                          <a href="./<?= $mod ?>&op=edit&id=<?= epm_encode($row['id']) ?>" class="btn btn-warning btn-xs enable-tooltip" title="Edit" <?= ($row_user['is_update'] === '0' ? 'style="visibility:hidden"' : '') ?>><i class="fa fa-pencil"></i> Edit</a>
                          <buton data-id="<?= epm_encode($row['id']) ?>" <?= ($row_user['is_delete'] === '0' ? 'style="visibility:hidden"' : '') ?> class="btn btn-xs btn-danger delete" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</button>
                        </div>
                      </td>
                    </tr>
                <?php
                  endwhile;
                endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>