<?php session_start();
error_reporting(0);
if (empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])) {
  header('location:../../login/');
  exit;
} else {
  require_once '../../../sw-library/sw-config.php';
  require_once '../../login/login_session.php';
  include('../../../sw-library/sw-function.php');

  switch (@$_GET['action']) {
      /* -------  LOAD DATA ABSENSI----------*/
    case 'absensi':
      $error = array();

      if (empty($_GET['id'])) {
        $error[] = 'ID tidak boleh kosong';
      } else {
        $id = mysqli_real_escape_string($connection, $_GET['id']);
      }

      if (isset($_POST['month']) or isset($_POST['year'])) {
        $bulan   = date($_POST['month']);
      } else {
        $bulan  = date("m");
      }

      $hari       = date("d");
      //$bulan      = date ("m");
      $tahun      = date("Y");
      $jumlahhari = date("t", mktime(0, 0, 0, $bulan, $hari, $tahun));
      $s          = date("w", mktime(0, 0, 0, $bulan, 1, $tahun));
      $sum        = 0;
      if (empty($error)) {
        echo '
<div class="table-responsive">
<table class="table table-bordered table-hover" id="swdatatable">
        <thead>
            <tr>
                <th class="align-middle" width="20">No</th>
                <th class="align-middle">Tanggal</th>
                <th class="align-middle text-center">Jam Masuk</th>
                <th class="align-middle text-center">Scan Masuk</th>
                <th class="align-middle text-center">Terlambat</th>
                <th class="align-middle text-center">Jam Pulang</td>
                <th class="align-middle text-center">Scan Pulang</th>
                <th class="align-middle text-center">Pulang Cepat</th>
                <th class="align-middle text-center">Selfie Masuk</th>
                <th class="align-middle text-center">Selfie Pulang</th>
                <th class="align-middle text-center">Tipe Absent</th>
                <th class="align-middle">Status</th>
                <th class="align-middle text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>';

        for ($d = 1; $d <= $jumlahhari; $d++) {
          $warna      = '';
          $background = '';
          $status_hadir     = 'Tidak Hadir';
          if (date("l", mktime(0, 0, 0, $bulan, $d, $tahun)) == "Sunday") {
            $warna = '#ffffff';
            $background = '#FF0000';
            $status_hadir = 'Libur Akhir Pekan';
            $sum++;
          }
          $date_month_year = '' . $year . '-' . $bulan . '-' . $d . '';

          if (isset($_POST['month']) or isset($_POST['year'])) {
            $month = $_POST['month'];
            $year  = $_POST['year'];
            $filter = "employees_id='$id' AND presence_date='$date_month_year' AND MONTH(presence_date)='$month' AND year(presence_date)='$year' AND employees_id='$id'";
          } else {
            $filter = "employees_id='$id' AND presence_date='$date_month_year' AND MONTH(presence_date) ='$month' AND employees_id='$id'";
          }

          $query = "SELECT employees.id,shift.shift_id,shift.time_in,shift.time_out FROM employees,shift WHERE employees.shift_id=shift.shift_id AND employees.id='$id'";
          $result = $connection->query($query);
          $row    = $result->fetch_assoc();


          $query_shift = "SELECT time_in,time_out FROM shift WHERE shift_id='$row[shift_id]'";
          $result_shift = $connection->query($query_shift);
          $row_shift = $result_shift->fetch_assoc();
          $shift_time_in = $row_shift['time_in'];
          $shift_time_out = $row_shift['time_out'];
          $newtimestamp = strtotime('' . $shift_time_in . ' + 05 minute');
          $newtimestamp = date('H:i:s', $newtimestamp);

          $query_absen = "SELECT is_selfie,img_in,img_out,presence_id,presence_date,time_in,time_out,present_id, latitude_longtitude_in,latitude_longtitude_out,information,TIMEDIFF(TIME(time_in),'$shift_time_in') AS selisih,if (time_in>'$shift_time_in','Telat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status, TIMEDIFF(TIME(time_out),'$shift_time_out') AS selisih_out FROM presence WHERE $filter ORDER BY presence_id DESC";
          $result_absen = $connection->query($query_absen);
          $row_absen = $result_absen->fetch_assoc();
          // Status Kehadiran
          $querya = "SELECT present_id,present_name FROM present_status WHERE present_id='$row_absen[present_id]'";
          $resulta = $connection->query($querya);
          $rowa =  $resulta->fetch_assoc();
          // Status Kehadiran
          if ($row_absen['time_in'] == NULL) {
            if (date("l", mktime(0, 0, 0, $bulan, $d, $tahun)) == "Sunday") {
              $status_hadir = 'Libur Akhir Pekan';
            } else {
              $status_hadir = '<span class="label label-danger">Tidak Hadir</span>';
            }
            $time_in = $row_absen['time_in'];
          } else {
            $status_hadir = '<a href="javascript:void(0);" data-id="' . $row_absen['presence_id'] . '" data-present-id="' . $row_absen['present_id'] . '" class="label label-warning btn-modal-status">' . $rowa['present_name'] . '</a>';
            $time_in = $row_absen['time_in'];
          }

          // Status Absensi Jam Masuk
          if ($row_absen['status'] == 'Telat') {
            $status_time_in = '<label class="label label-danger">Terlambat</label>';
          } elseif ($row_absen['status'] == 'Tepat Waktu') {
            $status_time_in = '<label class="label label-info">' . $row_absen['status'] . '</label>';
          } else {
            $status_time_in = '<label class="label label-danger">' . $row_absen['status'] . '</label>';
          }

          if ($row_absen['time_out'] > $shift_time_out) {
            $selisih_out = '';
          } else {
            $selisih_out = $row_absen['selisih_out'];
          }
          list($latitude,  $longitude) = explode(',', $row_absen['latitude_longtitude_in']);
          list($latitude_out,  $longitude_out) = explode(',', $row_absen['latitude_longtitude_out']);
          echo '
        <tr style="background:' . $background . ';color:' . $warna . '">
          <td class="text-center">' . $d . '</td>
          <td>' . format_hari_tanggal($date_month_year) . '</td>
          <td class="text-center">' . $row['time_in'] . '</td>
          <td class="text-center"><span class="text-primary">' . $row_absen['time_in'] . '</span> ' . $status_time_in . '</td>
          <td class="text-center">' . $row_absen['selisih'] . '</td>
          <td class="text-center">' . $row['time_out'] . '</td>
          <td class="text-center"><span class="text-primary">' . $row_absen['time_out'] . '</span></td>
          <td class="text-center">' . $selisih_out . '</td>
          <td>' . $status_hadir . '<br>' . $row_absen['information'] . '</td>
          <td class="text-center">' . ($row_absen['img_in'] != '' ? '<a class="action-img-in" data-img="' . $row_absen['img_in'] . '" href="#"><img height="30px" src="' . $row_absen['img_in'] . '"></img></a>' : '') . '</td>
          <td class="text-center">' . ($row_absen['img_out'] != '' ? '<a class="action-img-out" data-img="' . $row_absen['img_out'] . '" href="#"><img height="30px" src="' . $row_absen['img_out'] . '"></img></a>' : '') . '</td>
          <td>' . ($row_absen['is_selfie'] == 1 ? '<span class="label label-info">selfie</span>' : ($row_absen['presence_date'] ? '<span class="label label-info">QRcode</span>' : '')) . '</td>
          <td class="text-right">';
          if (!$latitude == NULL) {
            echo '
              <button type="button" class="btn btn-primary btn-xs btn-modal enable-tooltip" title="Lokasi" data-latitude="' . $latitude . '" data-longitude="' . $longitude . '"><i class="fa fa-map-marker"></i> Klik PETA</button>';
          }
          if (!$longitude_out == NULL) {
            echo '
              <button type="button" class="btn btn-danger btn-xs btn-modal enable-tooltip" title="Lokasi" data-latitude="' . $latitude_out . '" data-longitude="' . $longitude_out . '"><i class="fa fa-map-marker"></i> Pulang</button>';
          }
          echo '
          </td>
        </tr>';
        }
        echo '
        </tbody>
      </table>
  </div>';
        if (isset($_POST['month']) or isset($_POST['year'])) {
          $month = $_POST['month'];
          $year  = $_POST['year'];
          $filter = "employees_id='$id' AND MONTH(presence_date)='$month' AND year(presence_date)='$year' AND employees_id='$id'";
        } else {
          $filter = "employees_id='$id' AND MONTH(presence_date) ='$month' and employees_id='$id'";
        }

        $query_hadir = "SELECT presence_id FROM presence WHERE $filter AND present_id='1' ORDER BY presence_id DESC";
        $hadir = $connection->query($query_hadir);

        $query_sakit = "SELECT presence_id FROM presence WHERE $filter AND present_id='2' ORDER BY presence_id";
        $sakit = $connection->query($query_sakit);

        $query_izin = "SELECT presence_id FROM presence WHERE $filter AND present_id='3' ORDER BY presence_id";
        $izin = $connection->query($query_izin);


        $query_telat = "SELECT presence_id FROM presence WHERE $filter AND time_in>'$shift_time_in'";
        $telat = $connection->query($query_telat);

        $query_alpha = "SELECT presence_id FROM presence WHERE $filter AND employees_id='$row[id]'";
        $alpha = $connection->query($query_alpha);
        $alpha = $jumlahhari - $alpha->num_rows - $sum;

        echo '<hr>
      <div class="row">
        <div class="col-md-2">
          <p>Alpha : <span class="label label-danger">' . $alpha . '</span></p>
        </div>


        <div class="col-md-2">
          <p>Hadir : <span class="label label-success">' . $hadir->num_rows . '</span></p>
        </div>

        <div class="col-md-2">
          <p>Terlambat : <span class="label label-danger">' . $telat->num_rows . '</span></p>
        </div>

        <div class="col-md-2">
          <p>Sakit : <span class="label label-warning">' . $sakit->num_rows . '</span></p>
        </div>

        <div class="col-md-2">
          <p>Izin : <span class="label label-info">' . $izin->num_rows . '</span></p>
        </div>

      </div>';
        echo '
<script>
  $("#swdatatable").dataTable({
      "iDisplayLength":35,
      "aLengthMenu": [[35, 40, 50, -1], [35, 40, 50, "All"]]
  });
 $(".image-link").magnificPopup({type:"image"});
</script>'; ?>
        <script type="text/javascript">
          $(function() {
            $('[data-toggle="tooltip"]').tooltip()
          })
        </script>
<?php
      } else {
        echo 'Data tidak ditemukan';
      }

      break;
    case 'update':
      $error = array();
      if (empty($_POST['id'])) {
        $error[] = 'ID tidak boleh kosong';
      } else {
        $id = mysqli_real_escape_string($connection, $_POST['id']);
      }

      if (empty($_POST['status'])) {
        $error[] = 'tidak boleh kosong';
      } else {
        $status = mysqli_real_escape_string($connection, $_POST['status']);
      }

      if (empty($error)) {
        $update = "UPDATE presence SET present_id='$status' WHERE presence_id='$id'";
        if ($connection->query($update) === false) {
          die($connection->error . __LINE__);
          echo 'Data tidak berhasil disimpan!';
        } else {
          echo 'success';
        }
      } else {
        echo 'Bidang inputan tidak boleh ada yang kosong..!';
      }
      break;
  }
}
