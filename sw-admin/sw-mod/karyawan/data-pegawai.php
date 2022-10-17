<!DOCTYPE html>
<html>

<head>
  <title>Export Data Ke Excel Dengan PHP - www.malasngoding.com</title>
</head>

<body>
  <style type="text/css">
    body {
      font-family: sans-serif;
    }

    table {
      margin: 20px auto;
      border-collapse: collapse;
    }

    table th,
    table td {
      border: 1px solid #3c3c3c;
      padding: 3px 8px;

    }

    a {
      background: blue;
      color: #fff;
      padding: 8px 10px;
      text-decoration: none;
      border-radius: 2px;
    }
  </style>

  <?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Data Pegawai.xls");
  ?>

  <center>
    <h1>Export Data Ke Excel Dengan PHP <br /> www.malasngoding.com</h1>
  </center>

  <table border="1">
    <tr>
      <th>No</th>
      <th>Nama Pegawai</th>
      <th>Alamat</th>
      <th>No.Telp</th>
    </tr>
    <tr>
      <td>1</td>
      <td>Sulaiman</td>
      <td>Jakarta</td>
      <td>0829121223</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Diki Alfarabi Hadi</td>
      <td>Jakarta</td>
      <td>08291212211</td>
    </tr>
    <tr>
      <td>3</td>
      <td>Zakaria</td>
      <td>Medan</td>
      <td>0829121223</td>
    </tr>
    <tr>
      <td>4</td>
      <td>Alvinur</td>
      <td>Jakarta</td>
      <td>02133324344</td>
    </tr>
    <tr>
      <td>5</td>
      <td>Muhammad Rizani</td>
      <td>Jakarta</td>
      <td>08231111223</td>
    </tr>
    <tr>
      <td>6</td>
      <td>Rizaldi Waloni</td>
      <td>Jakarta</td>
      <td>027373733</td>
    </tr>
    <tr>
      <td>7</td>
      <td>Ferdian</td>
      <td>Jakarta</td>
      <td>0829121223</td>
    </tr>
    <tr>
      <td>8</td>
      <td>Fatimah</td>
      <td>Jakarta</td>
      <td>23432423423</td>
    </tr>
    <tr>
      <td>9</td>
      <td>Aminah</td>
      <td>Jakarta</td>
      <td>0829234233</td>
    </tr>
    <tr>
      <td>10</td>
      <td>Jafarudin</td>
      <td>Jakarta</td>
      <td>0829239323</td>
    </tr>
  </table>
</body>

</html>