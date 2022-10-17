<section class="content-header">
  <h1>Data<small> Laporan Kerja</small></h1>
  <ol class="breadcrumb">
    <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Data Laporan Kerja</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Laporan Kerja</b></h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="swdatatable" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Pengirim</th>
                  <th>Link</th>
                  <th>Tanggal Dibuat</th>
                  <th style="width:150px" class="text-right">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // $query = "
                //       SELECT m_work_report.*,employees.employees_name 
                //           FROM m_work_report 
                //           LEFT JOIN employees ON m_work_report.employe_id=employees.id 
                //     ";
                $query = "SELECT * FROM `m_work_report`";
                $result = $connection->query($query);

                if ($result->num_rows > 0) :
                  $no = 0;
                  while ($row = $result->fetch_assoc()) :
                    $no++;
                ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $row['employe_name']; ?></td>
                      <td>
                        <a href="<?= $row['link']; ?>" target="__blank">
                          <?= $row['link']; ?>
                        </a>
                      </td>
                      <td><?= date('d-m-Y H:i:s', strtotime($row['created_at'])); ?></td>
                      <td>
                        <div class="btn-group">
                          <a href="../print-laporan-kerja?action=pdf&id=<?= $row['id']; ?>" class="btn btn-danger btn-xs enable-tooltip" title="Print" target="__blank"><i class="fa fa-file-pdf-o"></i> Print</a>
                          <a href="./<?= $mod ?>&op=detail&id=<?= epm_encode($row['id']) ?>" class="btn btn-warning btn-xs enable-tooltip" title="Detail"><i class="fa fa-eye"></i> Detail</a>
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