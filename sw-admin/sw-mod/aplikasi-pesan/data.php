<section class="content-header">
  <h1>Data<small> Obrolan User</small></h1>
  <ol class="breadcrumb">
    <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Data Obrolan User</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Obrolan User</b></h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="swdatatable" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>User</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query  = "SELECT * FROM `employees`";
                $result = $connection->query($query);
                if ($result->num_rows > 0) :
                  $no = 0;
                  while ($row = $result->fetch_assoc()) :
                    $no++;
                ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $row['employees_name']; ?></td>
                      <td>
                        <div class="btn-group">
                          <a href="./<?= $mod ?>&op=detail&id=<?= epm_encode($row['id']) ?>" class="btn btn-warning btn-xs enable-tooltip" title="Detail"><i class="fa fa-eye"></i> Lihat Obrolan</a>
                        </div>
                      </td>
                    </tr>
                <?php
                  endwhile;
                endif;
                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>