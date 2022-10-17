<?php
include "excel_reader2.php";
require_once '../../../sw-library/sw-config.php';

$target = basename($_FILES['filepegawai']['name']);
move_uploaded_file($_FILES['filepegawai']['tmp_name'], $target);
// beri permisi agar file xls dapat di baca
chmod($_FILES['filepegawai']['name'], 0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filepegawai']['name'], false);

// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index = 0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i = 2; $i <= $jumlah_baris; $i++) {

  // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
  $employees_code     = $data->val($i, 1);
  $employees_nip   = $data->val($i, 2);
  $employees_email  = $data->val($i, 3);
  $employees_password  = $data->val($i, 4);
  $employees_name  = $data->val($i, 5);
  $position_id  = $data->val($i, 6);
  $shift_id  = $data->val($i, 7);
  $building_id  = $data->val($i, 8);

  if ($employees_code != "" && $employees_nip != "" && $employees_email != "") {
    $add = "INSERT INTO employees (employees_code,
              employees_nip,
              employees_email,
              employees_password,
              employees_name,
              position_id,
              shift_id,
              building_id,
              photo,
              user_status,
              is_active,
              created_login,
              created_cookies) values('$employees_code',
              '$employees_nip',
              '$employees_email',
              '$employees_password',
              '$employees_name',
              '$position_id',
              '$shift_id',
              '$building_id',
              'photo.jpg',
              'online',
              '2',
              '$date $time',
              '-')";
    if ($connection->query($add) === false) {
      die($connection->error . __LINE__);
      echo 'Data tidak berhasil disimpan!';
    } else {
      $berhasil++;
    }
  }
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filepegawai']['name']);

// alihkan halaman ke index.php
header("location:https://sisters-kominda.eagleye.id/sw-admin/karyawan?berhasil=$berhasil");
