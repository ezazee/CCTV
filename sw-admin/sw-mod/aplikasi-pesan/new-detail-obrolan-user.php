<!DOCTYPE html>
<html>

<head>
  <title>Chat</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
  <style>
    body,
    html {
      height: 100%;
      margin: 0;
      background: #7F7FD5;
      background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
      background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
    }

    .chat {
      margin-top: auto;
      margin-bottom: auto;
    }

    .card {
      height: 500px;
      border-radius: 15px !important;
      background-color: rgba(0, 0, 0, 0.4) !important;
    }

    .contacts_body {
      padding: 0.75rem 0 !important;
      overflow-y: auto;
      white-space: nowrap;
    }

    .msg_card_body {
      overflow-y: auto;
    }

    .card-header {
      border-radius: 15px 15px 0 0 !important;
      border-bottom: 0 !important;
    }

    .card-footer {
      border-radius: 0 0 15px 15px !important;
      border-top: 0 !important;
    }

    .container {
      align-content: center;
    }

    .search {
      border-radius: 15px 0 0 15px !important;
      background-color: rgba(0, 0, 0, 0.3) !important;
      border: 0 !important;
      color: white !important;
    }

    .search:focus {
      box-shadow: none !important;
      outline: 0px !important;
    }

    .type_msg {
      background-color: rgba(0, 0, 0, 0.3) !important;
      border: 0 !important;
      color: white !important;
      height: 60px !important;
      overflow-y: auto;
    }

    .type_msg:focus {
      box-shadow: none !important;
      outline: 0px !important;
    }

    .attach_btn {
      border-radius: 15px 0 0 15px !important;
      background-color: rgba(0, 0, 0, 0.3) !important;
      border: 0 !important;
      color: white !important;
      cursor: pointer;
    }

    .send_btn {
      border-radius: 0 15px 15px 0 !important;
      background-color: rgba(0, 0, 0, 0.3) !important;
      border: 0 !important;
      color: white !important;
      cursor: pointer;
    }

    .search_btn {
      border-radius: 0 15px 15px 0 !important;
      background-color: rgba(0, 0, 0, 0.3) !important;
      border: 0 !important;
      color: white !important;
      cursor: pointer;
    }

    .contacts {
      list-style: none;
      padding: 0;
    }

    .contacts li {
      width: 100% !important;
      padding: 5px 10px;
      margin-bottom: 15px !important;
    }

    .active {
      background-color: rgba(0, 0, 0, 0.3);
    }

    .user_img {
      height: 70px;
      width: 70px;
      border: 1.5px solid #f5f6fa;

    }

    .user_img_msg {
      height: 40px;
      width: 40px;
      border: 1.5px solid #f5f6fa;

    }

    .img_cont {
      position: relative;
      height: 70px;
      width: 70px;
    }

    .img_cont_msg {
      height: 40px;
      width: 40px;
    }

    .online_icon {
      position: absolute;
      height: 15px;
      width: 15px;
      background-color: #4cd137;
      border-radius: 50%;
      bottom: 0.2em;
      right: 0.4em;
      border: 1.5px solid white;
    }

    .offline {
      background-color: #c23616 !important;
    }

    .user_info {
      margin-top: auto;
      margin-bottom: auto;
      margin-left: 15px;
    }

    .user_info span {
      font-size: 20px;
      color: white;
    }

    .user_info p {
      font-size: 10px;
      color: rgba(255, 255, 255, 0.6);
    }

    .video_cam {
      margin-left: 50px;
      margin-top: 5px;
    }

    .video_cam span {
      color: white;
      font-size: 20px;
      cursor: pointer;
      margin-right: 20px;
    }

    .msg_cotainer {
      margin-top: auto;
      margin-bottom: auto;
      margin-left: 10px;
      border-radius: 25px;
      background-color: #82ccdd;
      padding: 10px;
      position: relative;
    }

    .msg_cotainer_send {
      margin-top: auto;
      margin-bottom: auto;
      margin-right: 10px;
      border-radius: 25px;
      background-color: #78e08f;
      padding: 10px;
      position: relative;
    }

    .msg_time {
      position: absolute;
      left: 0;
      bottom: -15px;
      color: rgba(255, 255, 255, 0.5);
      font-size: 10px;
    }

    .msg_time_send {
      position: absolute;
      right: 0;
      bottom: -15px;
      color: rgba(255, 255, 255, 0.5);
      font-size: 10px;
    }

    .msg_head {
      position: relative;
    }

    #action_menu_btn {
      position: absolute;
      right: 10px;
      top: 10px;
      color: white;
      cursor: pointer;
      font-size: 20px;
    }

    .action_menu {
      z-index: 1;
      position: absolute;
      padding: 15px 0;
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      border-radius: 15px;
      top: 30px;
      right: 15px;
      display: none;
    }

    .action_menu ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .action_menu ul li {
      width: 100%;
      padding: 10px 15px;
      margin-bottom: 5px;
    }

    .action_menu ul li i {
      padding-right: 10px;

    }

    .action_menu ul li:hover {
      cursor: pointer;
      background-color: rgba(0, 0, 0, 0.2);
    }

    @media(max-width: 576px) {
      .contacts_card {
        margin-bottom: 15px !important;
      }
    }
  </style>
</head>
<!--Coded With Love By Mutiullah Samim-->
<?php
$id = @$_GET['id']; //ID PENGIRIM
if ($id) :
  $id     =  mysqli_real_escape_string($connection, epm_decode($id));
  $query  = "SELECT * FROM `employees` WHERE `id`='$id'";
  $result = $connection->query($query);
  if ($result->num_rows > 0) :
    $row  = $result->fetch_assoc();
?>

    <body>
      <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">
          <div class="col-md-6 col-xl-6 chat">
            <a href="./aplikasi-pesan" class="btn btn-danger" style="margin-left: 10px;margin-bottom:10px"> Kembali </a>
            <div class="card mb-sm-3 mb-md-0 contacts_card">
              <div class="card-header">
                <span style="color: white;">Tampilkan Chat Dengan</span>
              </div>
              <div class="card-body contacts_body">
                <ui class="contacts">
                  <?php
                  $queryChat  = "SELECT a.*, `b`.`id`,b.`employees_name` FROM 
                    `chat` as `a` RIGHT JOIN `employees` as `b` ON `a`.`chat_penerima`=`b`.`id` WHERE `a`.`chat_pengirim`='$id' GROUP BY `a`.`chat_penerima`
                  ";
                  $resultPenerima = $connection->query($queryChat);
                  $nomor = 0;
                  while ($dataPenerima = $resultPenerima->fetch_assoc()) :
                    $nomor++;
                  ?>
                    <li class="d-flex justify-content-between align-items-center">
                      <div class="d-flex bd-highlight">
                        <div class="img_cont">
                          <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
                          <!-- <span class="online_icon"></span> -->
                        </div>
                        <div class="user_info">
                          <span><?= $dataPenerima['employees_name']; ?></span>
                        </div>
                      </div>
                      <div>
                        <a href="./<?= $mod ?>&op=tampilchat&id=<?= epm_encode($id) ?>&penerima=<?= epm_encode($dataPenerima['id']) ?>" class="btn btn-warning" style="color:white;">Pilih</a>
                      </div>
                    </li>
                  <?php
                  endwhile;
                  ?>
                </ui>
              </div>
              <div class="card-footer"></div>
            </div>
          </div>
        </div>
      </div>
    <?php else : ?>
      <section class="content">
        <div class="error-page">
          <h2 class="headline text-yellow"> 404</h2>
          <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Data yang diminta tidak ada.</h3>
            <p>
              Saat ini data yang Anda cari tidak ditemukan<br>
              <a class="btn btn-primary" href="./">return to dashboard</a>
            </p>
          </div>
        </div>
      </section>
    <?php endif; ?>
  <?php else : ?>
    <section class="content">
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
    </section>
  <?php endif; ?>




    </body>

    <script>
      $(document).ready(function() {
        $('#action_menu_btn').click(function() {
          $('.action_menu').toggle();
        });
      });
    </script>

</html>