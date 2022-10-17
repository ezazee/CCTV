<?php
ob_start();
session_start();
error_reporting(0);
require_once '../../sw-library/sw-config.php';
require_once '../../sw-library/sw-function.php';
include_once '../../sw-library/vendor/autoload.php';
$id   = $_GET['id'];
if ($id) :
  //$id     =  mysqli_real_escape_string($connection, epm_decode($id));
  $query  = "SELECT * FROM `m_work_report` WHERE `id`='$id'";
  $result = $connection->query($query);
  if ($result->num_rows > 0) :
    $row  = $result->fetch_assoc();

?>
    <table style="border-collapse: collapse; width: 100%;" border="0">
      <tbody>
        <tr>
          <td style="width: 80%;">&nbsp;</td>
          <td style="width: 20%;"><?= date('d-m-Y H:i', strtotime($row['created_at'])) ?></td>
        </tr>
      </tbody>
    </table>
    <div style="padding-left: 15px; padding-right:15px">
      <p>&nbsp;</p>
      <p>
        Kepada
        <br />
        <?php
        $workId      = $row['id'];
        // $queryKepada = "SELECT `tr_report_purpose_to_work_report`.*,`employees`.`employees_name` 
        //                 from `tr_report_purpose_to_work_report` 
        //                   INNER JOIN `employees` ON `tr_report_purpose_to_work_report`.`employe_id`=`employees`.`id`
        //                   WHERE `tr_report_purpose_to_work_report`.`work_report_id` ='$workId'";
        $queryKepada  = "SELECT * FROM `tr_report_purpose_to_work_report` WHERE `work_report_id` = '$workId'";
        $resultKepada = $connection->query($queryKepada);
        $no = 0;
        while ($dataKepada = $resultKepada->fetch_assoc()) :
          $no++;
        ?>
          <?= $no; ?>. <?= $dataKepada['employe_name']; ?>
          <br />
        <?php endwhile; ?>

      </p>

      <p>
        Tembusan
        <br />
        <?php
        $queryTembusan  = "SELECT * FROM `tr_forward_report_to_work_report` WHERE `work_report_id`='$workId'";
        $resultTembusan = $connection->query($queryTembusan);
        $noTembusan = 0;
        while ($dataTembusan = $resultTembusan->fetch_assoc()) :
          $noTembusan++;
        ?>
          <?= $noTembusan; ?>. <?= $dataTembusan['employe_name']; ?>
          <br />
        <?php endwhile; ?>

      </p>

      <p>
        Dari
        <br />
        <?= $row['employe_name']; ?>

      </p>

      <p>
        Nilai
        <br />
        A<?= $row['point']; ?>
      </p>

      <p>
        Perihal<br />
      <p style="text-align:justify">
        <?= $row['about'] ?>

      </p>
      <p>
      <p>
        Fakta - Fakta
        <br />
      <p style="text-align:justify">
        <?= $row['fakta_fakta'] ?>
      </p>

      </p>
      Catatan
      <br />

      <ul>
        <li>
          UPAYA
          <p>
            <?= $row['upaya']; ?>
          </p>

        </li>
        <li>
          ANALISA
          <p>
            <?= $row['analisa']; ?>
          </p>
        </li>
        <li>
          REKOMENDASI
          <p>
            <?= $row['rekomendasi']; ?>
          </p>
        </li>
      </ul>
      </p>
    </div>
  <?php else : ?>
    <h1>Data Yang diminta Tidak Adaaa</h1>
  <?php endif; ?>
<?php else : ?>
  <h1>Data ID Tidak Ada</h1>
<?php endif; ?>