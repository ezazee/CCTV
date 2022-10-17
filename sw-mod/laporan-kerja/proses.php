<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../../sw-library/vendor/autoload.php';

$aksi = $_REQUEST['aksi'];
date_default_timezone_set("Asia/Jakarta");


require_once "../../sw-library/sw-config.php";
$dbhostsql      = DB_HOST;
$dbusersql      = DB_USER;
$dbpasswordsql  = DB_PASSWD;
$dbnamesql      = DB_NAME;

//koneksi
$conn = mysqli_connect($dbhostsql, $dbusersql, $dbpasswordsql, $dbnamesql);
if (mysqli_connect_errno()) {
  echo "Koneksi database gagal : " . mysqli_connect_error();
}

function convertBlob($image)
{
  $removeType  = explode(";", $image);
  $removeBase  = explode(",", $removeType[1]);
  $finalData   = $removeBase[1];
  $decode      = base64_decode($finalData);
  return $decode;
}


if ($aksi == "tambah-laporan") {
  if (isset($_POST)) {
    #convert camera file
    if (!empty($_POST['camera'])) {
      $camerFile = convertBlob($_POST['camera']);
      $cameraFileName = $_POST['login'] . "-cam-" . time() . '.png';
    } else {
      $cameraFileName = "";
    }

    #table master
    $rep = [
      'create_by' => $_POST['employe_id'],
      'employe_name' => $_POST['employe_name'],
      'point' => $_POST['point'],
      'about' => $_POST['about'],
      'fakta' => $_POST['fakta'],
      'camera' => $cameraFileName,
      'link' => $_POST['link'],
      'analisa' => $_POST['analisa'],
      'upaya' => $_POST['upaya'],
      'rekomendasi' => $_POST['rekomendasi'],
    ];

    #insert report
    $query = "INSERT INTO `m_work_report` SET
            `employe_id` = '$rep[create_by]', 
            `employe_name`= '$rep[employe_name]', 
            `point`= '$rep[point]', 
            `about`= '$rep[about]', 
            `fakta_fakta`= '$rep[fakta]', 
            `camera`= '$rep[camera]', 
            `link`= '$rep[link]', 
            `analisa`= '$rep[analisa]', 
            `upaya`= '$rep[upaya]', 
            `rekomendasi`= '$rep[rekomendasi]'
        ";
    $insertReport = $conn->query($query);
    $reportId = $conn->insert_id;
    if ($reportId > 0) {
      //upload camerta file
      if (!empty($_POST['camera'])) {
        file_put_contents('upload/camera/' . $cameraFileName, $camerFile);
      }

      #insert kepada
      $to = $_POST['kepada'];
      $toCount = count($to);
      for ($i = 0; $i < $toCount; $i++) {
        $query2 = "INSERT INTO `tr_report_purpose_to_work_report` SET
                    `work_report_id` = '$reportId', 
                    `employe_id`= '$rep[create_by]',
                    `employe_name`= '$to[$i]'
                ";
        $reportTo = $conn->query($query2);
      }

      #insert tembusan
      $tembusan = $_POST['tembusan'];
      $tembusanCount = count($tembusan);
      for ($i = 0; $i < $tembusanCount; $i++) {
        $query4 = "INSERT INTO `tr_forward_report_to_work_report` SET
                    `work_report_id` = '$reportId', 
                    `employe_name`= '$tembusan[$i]'
                ";
        $reportTembusan = $conn->query($query4);
      }

      #insert image file
      $ket = $_POST['keterangan'];
      $namaFile = $_FILES['image']['name'];
      $namaTmp = $_FILES['image']['tmp_name'];
      $imageCount = count($namaFile);
      for ($i = 0; $i < $imageCount; $i++) {
        $query3 = "INSERT INTO `tr_picture_to_work_report` SET
                    `work_report_id` = '$reportId', 
                    `picture`= '$namaFile[$i]',
                    `description` = '$ket[$i]'
                ";
        $pic = $conn->query($query3);
        move_uploaded_file($namaTmp[$i], 'upload/image/' . $namaFile[$i]);
      }

      $res['status'] = 201;
      $res['success'] = true;
      $res['msg'] = "berhasil menambahkan laporan";
    } else {
      $res['status'] = 400;
      $res['success'] = false;
      $res['msg'] = "gagal menambahkan laporan";
    }
  } //close post
  else {
    $res['status'] = 400;
    $res['success'] = false;
    $res['msg'] = "gagal menambah laporan, method harus post";
  }

  if ($res['status'] === 201) {
    // var_dump($reportId);
    // die;
    $queryWorkReport  = "SELECT * FROM `m_work_report` WHERE `id`='$reportId'";
    $resultWorkReport = $conn->query($queryWorkReport);
    $rowWorkReport    = $resultWorkReport->fetch_assoc();
    $isiBody          = '<!DOCTYPE html>
                          <html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">  
                          <head>
                            <title></title>
                            <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                            <meta content="width=device-width, initial-scale=1.0" name="viewport" />
                            <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
                            <style>
                              * {
                                box-sizing: border-box;
                              }
                          
                              body {
                                margin: 0;
                                padding: 0;
                              }
                          
                              a[x-apple-data-detectors] {
                                color: inherit !important;
                                text-decoration: inherit !important;
                              }
                          
                              #MessageViewBody a {
                                color: inherit;
                                text-decoration: none;
                              }
                          
                              p {
                                line-height: inherit
                              }
                          
                              @media (max-width:920px) {
                                .icons-inner {
                                  text-align: center;
                                }
                          
                                .icons-inner td {
                                  margin: 0 auto;
                                }
                          
                                .row-content {
                                  width: 100% !important;
                                }
                          
                                .image_block img.big {
                                  width: auto !important;
                                }
                          
                                .column .border {
                                  display: none;
                                }
                          
                                .stack .column {
                                  width: 100%;
                                  display: block;
                                }
                              }
                            </style>
                          </head><body style="background-color: #FFFFFF; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
                          <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;" width="100%">
                            <tbody>
                              <tr>
                                <td>
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="0" cellspacing="0" class="html_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td>
                                                        <div align="center" style="font-family:Arial, Helvetica Neue, Helvetica, sans-serif;text-align:center;">
                                                          <table border="0" style="border-collapse: collapse; width: 100%;text-align:left; font-size:12px">
                                                            <tbody?>
                                                              <tr>
                                                                <td style="">Nomor</td>
                                                                <td style="">:' . $rowWorkReport["id"] . '</td>  
                                                                <td style="text-align:right">' . $row['created_at'] . '</td>
                                                              </tr>
                                                              <tr>
                                                                <td style="">Perihal</td>
                                                                <td style="">: ' . $rowWorkReport['about'] . '</td>
                                                                <td style=""></td>
                                                              </tr>
                                                              <tr>
                                                                <td style="">Dari</td>
                                                                <td style="">: ' . $rowWorkReport['employe_name'] . '</td>
                                                                <td style=""></td>
                                                              </tr>
                                                              <tr>
                                                                <td style="">Nilai</td>
                                                                <td style="">: ' . $rowWorkReport['point'] . '</td>
                                                                <td style=""> </td>
                                                              </tr>
                                                            </tbody>
                                                          </table>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>                   
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="10" cellspacing="0" class="divider_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td>
                                                        <div align="center">
                                                          <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                            <tr>
                                                              <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #BBBBBB;"><span> </span></td>
                                                            </tr>
                                                          </table>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="10" cellspacing="0" class="paragraph_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td>
                                                        <div style="color:#000000;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;">
                                                          <p style="margin: 0;"><strong>Fakta - Fakta </strong></p>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="10" cellspacing="0" class="paragraph_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td>
                                                        <div style="color:#000000;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;">
                                                          <p style="margin: 0;">' . $rowWorkReport['fakta_fakta'] . '</p>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="10" cellspacing="0" class="paragraph_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td>
                                                        <div style="color:#000000;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;">
                                                          <p style="margin: 0;"><strong>Catatan</strong></p>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-6" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="10" cellspacing="0" class="list_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td>
                                                        <ul style="margin: 0; padding: 0; list-style-type: revert; list-style-position: inside; color: #000000; font-size: 12px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-weight: 400; line-height: 120%; text-align: left; direction: ltr; letter-spacing: 0px;">
                                                          <li>Upaya</li>
                                                        </ul>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-7" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="10" cellspacing="0" class="paragraph_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td>
                                                        <div style="color:#000000;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;">
                                                          <p style="margin: 0;">' . $rowWorkReport['upaya'] . '</p>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-8" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="10" cellspacing="0" class="list_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td>
                                                        <ul style="margin: 0; padding: 0; list-style-type: revert; list-style-position: inside; color: #000000; font-size: 12px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-weight: 400; line-height: 120%; text-align: left; direction: ltr; letter-spacing: 0px;">
                                                          <li>Analisa</li>
                                                        </ul>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-9" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="10" cellspacing="0" class="paragraph_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td>
                                                        <div style="color:#000000;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;">
                                                          <p style="margin: 0;">' . $rowWorkReport['analisa'] . '</p>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-10" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="10" cellspacing="0" class="list_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td>
                                                        <ul style="margin: 0; padding: 0; list-style-type: revert; list-style-position: inside; color: #000000; font-size: 12px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-weight: 400; line-height: 120%; text-align: left; direction: ltr; letter-spacing: 0px;">
                                                          <li>Rekomendasi</li>
                                                        </ul>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-11" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="10" cellspacing="0" class="paragraph_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td>
                                                        <div style="color:#000000;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;">
                                                          <p style="margin: 0;">' . $rowWorkReport['rekomendasi'] . '</p>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-12" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="10" cellspacing="0" class="paragraph_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td>
                                                        <div style="color:#000000;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;">
                                                          <p style="margin: 0;"><strong>Lampiran</strong></p>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                 
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-17" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="10" cellspacing="0" class="list_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td>
                                                        <ul style="margin: 0; padding: 0; list-style-type: revert; list-style-position: inside; color: #000000; font-size: 12px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-weight: 400; line-height: 120%; text-align: left; direction: ltr; letter-spacing: 0px;">
                                                          <li>Link</li>
                                                        </ul>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-18" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="10" cellspacing="0" class="paragraph_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td>
                                                        <div style="color:#000000;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;">
                                                          <a href="' . $rowWorkReport['link'] . '" target="__blank">' . $rowWorkReport['link'] . '</a>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-19" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 900px;" width="900">
                                            <tbody>
                                              <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                  <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                      <td style="vertical-align: middle; color: #9d9d9d; font-family: inherit; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;">
                                                        <table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                          <tr>
                                                            <td style="vertical-align: middle; text-align: center;">
                                                              <!--[if vml]><table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endif]-->
                                                              <!--[if !vml]><!-->

                                                            </td>
                                                          </tr>
                                                        </table>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          </body>
                          </html>
                            ';



    $kepada = "SELECT employe_name FROM `tr_report_purpose_to_work_report` WHERE `work_report_id` = " . $reportId . "";
    $sqlKepada = $conn->query($kepada);

    $results = [];
    while ($kepada = $sqlKepada->fetch_array(MYSQLI_ASSOC)) {
      $employeKepada  = "SELECT * FROM `employees` WHERE `employees_name` = '" . $kepada['employe_name'] . "'";
      $resultKepada   = $conn->query($employeKepada);
      $rowKepada  = $resultKepada->fetch_assoc();
      $mail = new PHPMailer(true);


      try {
        $mail->isSMTP();
        $mail->SMTPDebug    = 0;
        $mail->Debugoutput  = 'html';
        $mail->Host         = 'srv159.niagahoster.com';
        $mail->Port         = 587;
        $mail->SMTPSecure   = 'tls';
        $mail->SMTPAuth     = true;
        $mail->Username     = 'no-reply@bt-pmp.com';
        $mail->Password     = 'ReactNative1234%';
        //Recipients
        $mail->setFrom('no-reply@bt-pmp.com', 'Sister Kominda');
        $mail->addAddress($rowKepada['employees_email'], $rowKepada['employees_name']);     //Add a recipient
        $mail->addReplyTo('no-reply@bt-pmp.com', 'Sister Kominda');
        //Attachments
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Laporan Masuk';
        $mail->Body    = $isiBody;
        $mail->send();
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }

    $queryTembusan = "SELECT employe_name FROM `tr_forward_report_to_work_report` WHERE `work_report_id` = " . $reportId . "";
    $sqlTembusan = $conn->query($queryTembusan);
    while ($rowTembusan = $sqlTembusan->fetch_array(MYSQLI_ASSOC)) {
      $employeTembusan  = "SELECT * FROM `employees` WHERE `employees_name` = '" . $rowTembusan['employe_name'] . "'";
      $resultKepada   = $conn->query($employeTembusan);
      $hasilTembusan  = $resultKepada->fetch_assoc();
      $mail = new PHPMailer(true);


      try {
        $mail->isSMTP();
        $mail->SMTPDebug    = 0;
        $mail->Debugoutput  = 'html';
        $mail->Host         = 'srv159.niagahoster.com';
        $mail->Port         = 587;
        $mail->SMTPSecure   = 'tls';
        $mail->SMTPAuth     = true;
        $mail->Username     = 'no-reply@bt-pmp.com';
        $mail->Password     = 'ReactNative1234%';
        //Recipients
        $mail->setFrom('no-reply@bt-pmp.com', 'Sister Kominda');
        $mail->addAddress($hasilTembusan['employees_email'], $hasilTembusan['employees_name']);     //Add a recipient
        $mail->addReplyTo('no-reply@bt-pmp.com', 'Sister Kominda');
        //Attachments
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Tembusan Laporan Masuk';
        $mail->Body    = $isiBody;
        $mail->send();
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }
    $res['status'] = 201;
    $res['success'] = true;
    $res['msg'] = "berhasil menambahkan laporan dan mengirimkan email";
  } else {
    $res['status'] = 400;
    $res['success'] = false;
    $res['msg'] = "gagal kirim email";
    //Tidak Kirim Email
  }

  echo json_encode($res);
} //close tambah laporan

else if ($aksi == "search-laporan") {
  $search = $_POST['search'];
  $login  = $_POST['login'];
  $query = "SELECT 
                (SELECT GROUP_CONCAT(b.employe_name)) `kepada`,
                a.*
                FROM m_work_report a 
                LEFT JOIN tr_report_purpose_to_work_report b 
                ON a.id = b.work_report_id
                WHERE 
                a.employe_id = '$login' AND
                b.employe_name LIKE '%$search%'
                GROUP BY a.id
                ORDER BY a.id DESC
    ";
  $sql = $conn->query($query);
  $row = $sql->num_rows;
  $dataReport = [];
  while ($data = $sql->fetch_array(MYSQLI_ASSOC)) {
    $dataReport[] = $data;
  }


  if ($row > 0) {

    $res['status'] = 200;
    $res['success'] = true;
    $res['msg']  = "get laporan";
    $res['data'] = $dataReport;
  } else {
    $res['status'] = 200;
    $res['success'] = true;
    $res['msg']  = "get laporan";
    $res['data'] = [];
  }
  echo json_encode($res);
} //close search laporan

else if ($aksi === 'get-employe') {
  $term = $_GET['term'];
  if ($term) {
    $employe = "SELECT * FROM employees WHERE employees_name LIKE '$term%'";
    $sql = $conn->query($employe);
    $row = $sql->num_rows;
    $results = [];
    while ($data = $sql->fetch_array(MYSQLI_ASSOC)) {
      $results[] = array(
        'label' => $data['employees_name'],
        'id'    => $data['id']
      );
    }
    echo json_encode($results);
  }
}
