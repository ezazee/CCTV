$(document).ready(function () {
  function loading() {
    $('.loading').show();
    $('.loading').delay(1500).fadeOut(500);
  }

  /* ------------------------------------------------
    // SCAN ABSENSI
---------------------------------------------------*/
  var result_location;
  $(document).ready(function getLocation() {
    result_location = document.getElementById('latitude');
    //
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    } else {
      swal({
        title: 'Oops!',
        text: 'Maaf, browser Anda tidak mendukung geolokasi HTML5.',
        icon: 'error',
        timer: 3000,
      });
    }
  });

  // Define callback function for successful attempt
  function successCallback(position) {
    result_location.innerHTML =
      '' + position.coords.latitude + ',' + position.coords.longitude + '';
  }

  // Define callback function for failed attempt
  function errorCallback(error) {
    // if(error.code == 1) {
    //     swal({title: 'Oops!', text:'Anda telah memutuskan untuk tidak membagikan posisi Anda, Izinkan lokasi di browser Anda.', icon: 'error', timer: 3000,});
    // } else
    if (error.code == 2) {
      swal({
        title: 'Oops!',
        text: 'Jaringan tidak aktif atau layanan penentuan posisi tidak dapat dijangkau, Izinkan lokasi di browser Anda',
        icon: 'error',
        timer: 3000,
      });
    } else if (error.code == 3) {
      swal({
        title: 'Oops!',
        text: 'Waktu percobaan habis sebelum bisa mendapatkan data lokasi, Izinkan lokasi di browser Anda',
        icon: 'error',
        timer: 3000,
      });
    } else {
      swal({
        title: 'Oops!',
        text: 'Waktu percobaan habis sebelum bisa mendapatkan data lokasi, Izinkan lokasi di browser Anda',
        icon: 'error',
        timer: 3000,
      });
    }
  }

  var scanner = new Instascan.Scanner({
    video: document.getElementById('preview'),
    scanPeriod: 1,
    mirror: false,
  });

  scanner.addListener('scan', function (content) {
    var latitude = $('.latitude').html();
    document.getElementById('my_audio').play();

    var dataString = 'qrcode=' + content + '&latitude=' + latitude;
    $.ajax({
      type: 'POST',
      url: 'sw-mod/scan-absen/proses.php?action=absent',
      data: dataString,
      success: function (data) {
        var results = data.split('/');
        $results = results[0];
        $results2 = results[1];
        if ($results == 'success') {
          swal({
            title: 'Berhasil!',
            text: $results2,
            icon: 'success',
            timer: 3500,
          });
          loadData();
        } else {
          swal({ title: 'Oops!', text: data, icon: 'error', timer: 3500 });
        }
      },
    });
  });

  function reload_js(src) {
    $('script[src="' + src + '"]').remove();
    $('<script>').attr('src', src).appendTo('head');
  }
  reload_js(
    'https://sisters-kominda.eagleye.id/sw-mod/sw-assets/js/html5-qrcode.min.js'
  );

  $(document).ready(function () {
    const html5QrCode = new Html5Qrcode('reader');
    html5QrCode.clear();
    html5QrCode
      .start(
        { facingMode: 'environment' },
        {
          fps: 10,
          qrbox: { width: 250, height: 250 },
        },
        (decodedText, decodedResult) => {
          var latitude = $('.latitude').html();
          document.getElementById('my_audio').play();

          var dataString = 'qrcode=' + decodedText + '&latitude=' + latitude;
          $.ajax({
            type: 'POST',
            url: 'sw-mod/scan-absen/proses.php?action=absent',
            data: dataString,
            success: function (data) {
              var results = data.split('/');
              $results = results[0];
              $results2 = results[1];
              if ($results == 'success') {
                swal({
                  title: 'Berhasil!',
                  text: $results2,
                  icon: 'success',
                  timer: 3500,
                });
                loadData();
              } else {
                swal({
                  title: 'Oops!',
                  text: data,
                  icon: 'error',
                  timer: 3500,
                });
              }
            },
          });
        },
        (errorMessage) => {
          document.getElementById('notee').classList.add('text-primary');
          document.getElementById('notee').innerHTML = 'Sedang Membaca QRCode!';
          html5QrCode.clear();
        }
      )
      .catch((err) => {
        document.getElementById('notee').innerHTML = 'Gagal Akses Kamera!';
        document.getElementById('notee').classList.add('text-danger');
      });
  });

  // Instascan.Camera.getCameras().then(function (cameras){
  //     if(cameras.length>0){
  //         scanner.start(cameras[0]);
  //         $('[name="options"]').on('change',function(){
  //             if($(this).val()==1){
  //                 if(cameras[0]!=""){
  //                     scanner.start(cameras[0]);
  //                 }else{
  //                     alert('No Front camera found!');
  //                 }
  //             }else if($(this).val()==2){
  //                 if(cameras[1]!=""){
  //                     scanner.start(cameras[1]);
  //                 }else{
  //                     alert('No Back camera found!');
  //                 }
  //             }
  //         });
  //     }else{
  //         alert('No cameras found.');
  //     }
  // });

  loadData();
  function loadData() {
    var id = $('.id').val();
    $.ajax({
      url: 'sw-mod/scan-absen/proses.php?action=data',
      type: 'POST',
      success: function (data) {
        $('.loaddata').html(data);
      },
    });
  }
});
