<section class="content-header">
  <h1>Data<small> Role Akses</small></h1>
  <ol class="breadcrumb">
    <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Data Role Akses</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Role Akses</b></h3>
          <div class="box-tools pull-right">
            <a <?= ($row_user['is_create'] === '0' ? 'style="visibility:hidden"' : '') ?> href="<?= $mod . '&op=tambah';  ?>" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Tambah Baru</a>
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="swdatatable" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Role</th>
                  <th style="text-align: center;">Create</th>
                  <th style="text-align: center;">Update</th>
                  <th style="text-align: center;">Delete</th>
                  <th style="text-align: center;">Upload</th>
                  <th style="text-align: center;">Download</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // $query = "
                //       SELECT m_work_report.*,employees.employees_name 
                //           FROM m_work_report 
                //           LEFT JOIN employees ON m_work_report.employe_id=employees.id 
                //     ";
                $query = "SELECT * FROM `user_level`";
                $result = $connection->query($query);

                if ($result->num_rows > 0) :
                  $no = 0;
                  while ($row = $result->fetch_assoc()) :
                    $no++;
                ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $row['level_name']; ?></td>
                      <td style="text-align: center;">
                        <?php if ($row['level_id'] === '1') : ?>
                          <input type="checkbox" value="1" checked disabled>
                        <?php else : ?>
                          <input type="checkbox" data-id="<?= $row['level_id']; ?>" class="role-created" <?= $row['is_create'] === '1' ? 'checked="checked"' : ''; ?>>
                        <?php endif; ?>
                      </td>
                      <td style="text-align: center;">
                        <?php if ($row['level_id'] === '1') : ?>
                          <input type="checkbox" value="1" checked disabled>
                        <?php else : ?>
                          <input type="checkbox" data-id="<?= $row['level_id']; ?>" class="role-updated" <?= $row['is_update'] === '1' ? 'checked="checked"' : ''; ?>>
                        <?php endif; ?>
                      </td>
                      <td style="text-align: center;">
                        <?php if ($row['level_id'] === '1') : ?>
                          <input type="checkbox" value="1" checked disabled>
                        <?php else : ?>
                          <input type="checkbox" data-id="<?= $row['level_id']; ?>" class="role-deleted" <?= $row['is_delete'] === '1' ? 'checked="checked"' : ''; ?>>
                        <?php endif; ?>
                      </td>
                      <td style="text-align: center;">
                        <?php if ($row['level_id'] === '1') : ?>
                          <input type="checkbox" value="1" checked disabled>
                        <?php else : ?>
                          <input type="checkbox" data-id="<?= $row['level_id']; ?>" class="role-upload" <?= $row['is_upload'] === '1' ? 'checked="checked"' : ''; ?>>
                        <?php endif; ?>
                      </td>
                      <td style="text-align: center;">
                        <?php if ($row['level_id'] === '1') : ?>
                          <input type="checkbox" value="1" checked disabled>
                        <?php else : ?>
                          <input type="checkbox" data-id="<?= $row['level_id']; ?>" class="role-download" <?= $row['is_download'] === '1' ? 'checked="checked"' : ''; ?>>
                        <?php endif; ?>
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