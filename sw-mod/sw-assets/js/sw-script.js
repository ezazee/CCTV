$(document).ready(function () {
  if (!sessionStorage.getItem('splashscreen')) {
    $('.splashscreen').show();
    $('.splashscreen').delay(6000).fadeOut(600);
    sessionStorage.setItem('splashscreen', 'ok');
  }

  function loading() {
    $('.loading').show();
    $('.loading').delay(2500).fadeOut(600);
  }

  /* ----------- LOGIN ------------*/
  $('#form-login').submit(function (e) {
    e.preventDefault();
    if ($('#email').val() == '' && $('#password').val() == '') {
      swal({
        title: 'Oops!',
        text: 'Harap bidang inputan tidak boleh ada yang kosong.!',
        icon: 'error',
        timer: 2500,
      });
      return false;
      loading();
    } else {
      loading();
      $.ajax({
        url: './sw-proses?action=login',
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        beforeSend: function () {
          loading();
        },
        success: function (data) {
          if (data == 'success') {
            swal({
              title: 'Berhasil!',
              text: 'Selamat datang.!',
              icon: 'success',
              timer: 2500,
            });
            //setTimeout(function(){location.reload(); }, 2500);
            setTimeout("location.href = '../home.html';", 2000);
          } else {
            swal({ title: 'Oops!', text: data, icon: 'error', timer: 2500 });
          }
        },
        complete: function () {
          $('.loading').hide();
        },
      });
    }
  });

  /* ----------- REGISTRASI ------------*/
  $('#form-registrasi').submit(function (e) {
    e.preventDefault();
    if (
      $('#email').val() == '' &&
      $('#password').val() == '' &&
      $('#position_id').val() == '' &&
      $('#shift_id').val() == '' &&
      $('#building').val() == ''
    ) {
      swal({
        title: 'Oops!',
        text: 'Harap bidang inputan tidak boleh ada yang kosong.!',
        icon: 'error',
        timer: 2500,
      });
      return false;
      loading();
    } else {
      loading();
      $.ajax({
        url: './sw-proses?action=registrasi',
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        beforeSend: function () {
          loading();
        },
        success: function (data) {
          if (data == 'success') {
            swal({
              title: 'Berhasil!',
              text: 'Selamat Anda berhasil mendaftar!',
              icon: 'success',
              timer: 2500,
            });
            setTimeout("location.href = './';", 2600);
          } else {
            swal({ title: 'Oops!', text: data, icon: 'error', timer: 2500 });
          }
        },
        complete: function () {
          $('.loading').hide();
        },
      });
    }
  });

  /* ----------- FORGOT ------------*/
  $('#form-forgot').submit(function (e) {
    e.preventDefault();
    if ($('#email').val() == '') {
      swal({
        title: 'Oops!',
        text: 'Harap bidang inputan tidak boleh ada yang kosong.!',
        icon: 'error',
        timer: 2500,
      });
      return false;
      loading();
    } else {
      loading();
      $.ajax({
        url: './sw-proses?action=forgot',
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        beforeSend: function () {
          loading();
        },
        success: function (data) {
          // console.log(data);
          if (data == 'success') {
            swal({
              title: 'Berhasil!',
              text: 'Password baru berhasil disetel ulang, silahkan cek email masuk/spam!',
              icon: 'success',
              timer: 2000,
            });
            //setTimeout(function(){ location.reload(); }, 2500);
            setTimeout("location.href = './';", 3000);
          } else {
            swal({ title: 'Oops!', text: data, icon: 'error', timer: 2500 });
          }
        },
        complete: function () {
          $('.loading').hide();
        },
      });
    }
  });

  /* ---------- UPDATE PROFILE -----------------*/
  $('#update-profile').submit(function (e) {
    e.preventDefault();
    if ($('#name').val() == '') {
      swal({
        title: 'Oops!',
        text: 'Harap bidang inputan tidak boleh ada yang kosong.!',
        icon: 'error',
        timer: 2500,
      });
      return false;
      loading();
    } else {
      loading();
      $.ajax({
        url: './sw-proses?action=profile',
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        beforeSend: function () {
          loading();
        },
        success: function (data) {
          if (data == 'success') {
            swal({
              title: 'Berhasil!',
              text: 'Profil berhasil di perbaharui!',
              icon: 'success',
              timer: 2000,
            });
            setTimeout(function () {
              location.reload();
            }, 2500);
            $('.btn-profile').text('Simpan');
          } else {
            swal({ title: 'Oops!', text: data, icon: 'error', timer: 2000 });
            $('.btn-profile').text('Simpan');
          }
        },
        complete: function () {
          $('.loading').hide();
        },
      });
    }
  });

  /* ---------- UPDATE PASSWORD-----------------*/
  $('#update-password').submit(function (e) {
    e.preventDefault();
    if ($('#employees_password').val() == '') {
      swal({
        title: 'Oops!',
        text: 'Harap bidang inputan tidak boleh ada yang kosong.!',
        icon: 'error',
        timer: 2500,
      });
      return false;
      loading();
    } else {
      loading();
      $.ajax({
        url: './sw-proses?action=update-password',
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        beforeSend: function () {
          loading();
        },
        success: function (data) {
          if (data == 'success') {
            swal({
              title: 'Berhasil!',
              text: 'Password berhasil di perbaharui!',
              icon: 'success',
              timer: 2000,
            });
            setTimeout(function () {
              location.reload();
            }, 2500);
          } else {
            swal({ title: 'Oops!', text: data, icon: 'error', timer: 2000 });
          }
        },

        complete: function () {
          $('.loading').hide();
        },
      });
    }
  });

  /* --------- UPDATE PHOTO PROFILE ---------------*/
  $(document).on('change', '#avatar', function () {
    var maxfilesize = 1024 * 1024 * 5;
    var file_data = $('#avatar').prop('files')[0];
    var image_name = file_data.name;
    var image_extension = image_name.split('.').pop().toLowerCase();

    if (file_data.size > maxfilesize) {
      swal({
        title: 'Oops!',
        text: 'File yang di unggah tidak boleh lebih dari 5mb!',
        icon: 'error',
        timer: 2000,
      });
      return;
    }

    if (jQuery.inArray(image_extension, ['gif', 'jpg', 'jpeg', 'png']) == -1) {
      swal({
        title: 'Oops!',
        text: 'File yang di unggah tidak sesuai dengan format, File harus jpg, jpeg, gif, png.!',
        icon: 'error',
        timer: 2000,
      });
    }

    var form_data = new FormData();
    form_data.append('file', file_data);
    $.ajax({
      url: './sw-proses?action=update-photo',
      method: 'POST',
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function () {
        loading();
      },
      success: function (data) {
        if (data == 'success') {
          swal({
            title: 'Behasil!',
            text: 'Photo Profil berhasil diperbaharui.!',
            icon: 'success',
            timer: 2500,
          });
          setTimeout(function () {
            location.reload();
          }, 1600);
        } else {
          swal({ title: 'Oops!', text: data, icon: 'error', timer: 2000 });
        }
      },
    });
  });

  // UPDATE PHOTO PROFILE TAKE CAMERA
  $(document).on('shown.bs.modal', '#modalCamera', function () {
    const video = document.querySelector('#avatarcamera');
    if (navigator.mediaDevices.getUserMedia) {
      navigator.mediaDevices
        .getUserMedia({
          video: {
            facingMode: 'user',
          },
        })
        .then((stream) => {
          video.srcObject = stream;
        })
        .catch((error) => console.error('error akses webcam'));
    }
    // Webcam.attach('#avatarcamera');
  });

  $(document).on('click', '#takeavatar', function (e) {
    const output = document.getElementById('output');
    const video = document.getElementById('avatarcamera');
    const canvas = document.getElementById('canvas');
    const buttonupload = document.getElementById('uploadavatar');
    const width = video.videoWidth,
      height = video.videoHeight;
    const context = canvas.getContext('2d');
    if (!output.classList.contains('d-none')) {
      $(this).html('<ion-icon name="camera-outline"></ion-icon>');
      video.classList.remove('d-none');
      buttonupload.classList.add('d-none');
      output.classList.add('d-none');
      return;
    }

    canvas.width = width;
    canvas.height = height;

    context.drawImage(video, 0, 0, width, height);
    const imgURL = canvas.toDataURL('image/jpg', 1.0);
    output.src = imgURL;
    video.classList.add('d-none');
    buttonupload.classList.remove('d-none');
    output.classList.remove('d-none');
    $(this).html('<ion-icon name="refresh-outline"></ion-icon>');
  });

  $(document).on('click', '#uploadavatar', function (e) {
    const canvas = document.getElementById('canvas');
    canvas.toBlob(
      function (blob) {
        const formData = new FormData();
        const name =
          'avatar_' +
          Math.random().toString(36).substring(2, 15) +
          Math.random().toString(36).substring(2, 15) +
          '.jpeg';

        formData.append('file', blob, name);
        $.ajax({
          url: './sw-proses?action=update-photo',
          method: 'POST',
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function () {
            loading();
          },
          success: function (data) {
            if (data == 'success') {
              swal({
                title: 'Behasil!',
                text: 'Photo Profil berhasil diperbaharui.!',
                icon: 'success',
                timer: 2500,
              });
              setTimeout(function () {
                location.reload();
              }, 1600);
            } else {
              swal({ title: 'Oops!', text: data, icon: 'error', timer: 2000 });
            }
          },
        });
      },
      'image/jpeg',
      1
    );
  });

  /* --------- LOAD DATA HISTORY ---------------*/
  loadData();
  function loadData() {
    $.ajax({
      url: './sw-proses?action=history',
      type: 'POST',
      success: function (data) {
        $('.loaddata').html(data);
      },
    });
  }

  $('.btn-clear').click(function (e) {
    loadData();
    $('.start_date').val();
    $('.start_date').val();
  });

  $('.btn-sortir').click(function (e) {
    var from = $('.start_date').val();
    var to = $('.end_date').val();

    $.ajax({
      url: './sw-proses?action=history',
      method: 'POST',
      data: { from: from, to: to },
      dataType: 'text',
      cache: false,
      async: false,
      beforeSend: function () {
        loading();
      },
      success: function (data) {
        $('.loaddata').html(data);
      },
      complete: function () {
        $('.loading').hide();
      },
    });
  });

  $('.btn-print').click(function (e) {
    var from = $('.start_date').val();
    var to = $('.end_date').val();
    var type = $('.type').val();
    if (type == 'pdf') {
      // cek berdasarkan bulan
      if (from == '') {
        var url = './print?action=pdf';
      } else {
        var url = './print?action=pdf&from=' + from + '&to=' + to + '';
      }
    } else {
      if (from == '') {
        var url = './print?action=excel';
      } else {
        var url = './print?action=excel&from=' + from + '&to=' + to + '';
      }
    }
    window.open(url, '_blank');
  });

  /* ------------------- UPDATE DATA HISTORY ------------------------- */
  $(document).on('click', '.modal-update', function () {
    $('#modal-show').modal('show');
    var presence_id = $(this).attr('data-id');
    document.getElementById('presence_id').value = presence_id;

    /*var masuk = $(this).attr("data-masuk"); 
        document.getElementById('timein').value = masuk;

        var pulang = $(this).attr("data-pulang"); 
        document.getElementById('timeout').value = pulang;*/

    var status = $(this).attr('data-status');
    document.getElementById('status').value = status;

    var information = $(this).attr('data-information');
    document.getElementById('information').value = information;

    var tanggal = $(this).attr('data-date');
    $('.status-date').html(tanggal);
  });

  /* ---------- UPDATE HISTORY-----------------*/
  $('#update-history').submit(function (e) {
    e.preventDefault();
    if ($('#timein').val() == '' && $('#timeout').val() == '') {
      swal({
        title: 'Oops!',
        text: 'Harap bwidang inputan tidak boleh ada yang kosong.!',
        icon: 'error',
        timer: 2500,
      });
      return false;
      loading();
    } else {
      loading();
      $.ajax({
        url: './sw-proses?action=update-history',
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        beforeSend: function () {
          loading();
        },
        success: function (data) {
          if (data == 'success') {
            swal({
              title: 'Berhasil!',
              text: 'Absensi berhasil di perbaharui!',
              icon: 'success',
              timer: 2000,
            });
            //setTimeout(function(){ location.reload(); }, 2500);
            $('#modal-show').modal('hide');
            loadData();
          } else {
            swal({ title: 'Oops!', text: data, icon: 'error', timer: 2000 });
          }
        },

        complete: function () {
          $('.loading').hide();
          $('#modal-show').modal('hide');
        },
      });
    }
  });

  /* --------------------------------
        LOAD DATA CUTY
    ----------------------------------*/
  loadDataCuty();
  function loadDataCuty() {
    $.ajax({
      url: './sw-proses?action=cuty',
      type: 'POST',
      success: function (data) {
        $('.loaddatacuty').html(data);
      },
    });
  }

  $('.btn-clear-cuty').click(function (e) {
    loadDataCuty();
    $('.start_date').val();
    $('.start_date').val();
  });

  $('.btn-sortir-cuty').click(function (e) {
    var from = $('.start_date').val();
    var to = $('.end_date').val();

    $.ajax({
      url: './sw-proses?action=cuty',
      method: 'POST',
      data: { from: from, to: to },
      dataType: 'text',
      cache: false,
      async: false,
      beforeSend: function () {
        loading();
      },
      success: function (data) {
        $('.loaddatacuty').html(data);
      },
      complete: function () {
        $('.loading').hide();
      },
    });
  });

  /* ----------- ADD DATA CUTY ------------*/
  $('#form-add-cuty').submit(function (e) {
    e.preventDefault();
    console.log($('input#selisih').val());
    let tgl1 = $('#tgl1').data('DateTimePicker').date();
    let tgl2 = $('#tgl2').data('DateTimePicker').date();
    let dateTgl1 = new Date(tgl1).toLocaleDateString('fr-CA');
    let dateTgl2 = new Date(tgl2).toLocaleDateString('fr-CA');
    if (
      dateTgl1 == '' ||
      dateTgl2 == '' ||
      $('input#selisih').val() == '' ||
      $('textarea.cuty_description').val() == ''
    ) {
      swal({
        title: 'Oops!',
        text: 'Harap bidang inputan tidak boleh ada yang kosong.!',
        icon: 'error',
        timer: 2500,
      });
      return false;
      loading();
    } else {
      loading();
      $.ajax({
        url: './sw-proses?action=add-cuty',
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        beforeSend: function () {
          loading();
        },
        success: function (data) {
          if (data == 'success') {
            swal({
              title: 'Berhasil!',
              text: 'Data Cuti berhasil ditambah!',
              icon: 'success',
              timer: 2500,
            });
            loadDataCuty();
            $('#modal-add').modal('hide');
            $('#form-add-cuty').trigger('reset');
          } else {
            swal({ title: 'Oops!', text: data, icon: 'error', timer: 2500 });
          }
        },
        complete: function () {
          $('.loading').hide();
        },
      });
    }
  });

  $(document).on('click', '.btn-update-cuty', function () {
    $('#modal-update').modal('show');
    var id = $(this).attr('data-id');
    document.getElementById('city-id').value = id;

    var start = $(this).attr('data-start');
    document.getElementById('cuty-start').value = start;

    var end = $(this).attr('data-end');
    document.getElementById('cuty-end').value = end;

    var work = $(this).attr('data-work');
    document.getElementById('date-work').value = work;

    var total = $(this).attr('data-total');
    document.getElementById('total').value = total;

    var cuty_description = $(this).attr('data-description');
    document.getElementById('cuty_description').value = cuty_description;
    /*var cuty_description = $(this).attr("data-date"); 
        $('.status-date').html(tanggal);*/
  });

  /* ----------- UPDATE DATA CUTY ------------*/
  $('#form-update-cuty').submit(function (e) {
    e.preventDefault();
    if (
      $('#cuty-start').val() == '' ||
      $('#cuty-end').val() == '' ||
      $('#total').val() == '' ||
      $('textarea#cuty_description').val() == ''
    ) {
      swal({
        title: 'Oops!',
        text: 'Harap bidang inputan tidak boleh ada yang kosong.!',
        icon: 'error',
        timer: 2500,
      });
      return false;
      loading();
    } else {
      loading();
      $.ajax({
        url: './sw-proses?action=update-cuty',
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        beforeSend: function () {
          loading();
        },
        success: function (data) {
          if (data == 'success') {
            swal({
              title: 'Berhasil!',
              text: 'Data Cuti berhasil disimpan!',
              icon: 'success',
              timer: 2500,
            });
            loadDataCuty();
            $('#modal-update').modal('hide');
            $('#form-update-cuty').trigger('reset');
          } else {
            swal({ title: 'Oops!', text: data, icon: 'error', timer: 2500 });
          }
        },
        complete: function () {
          $('.loading').hide();
        },
      });
    }
  });

  /* ------------------ LOAD DATA COUNT ABSENSI HOME ------------------*/
  function loadDataCounter() {
    $.ajax({
      url: './sw-proses?action=load-home-counter',
      type: 'POST',
      success: function (data) {
        $('.load-home').html(data);
      },
    });
  }
  loadDataCounter();
  $('.select-change').on('change', function () {
    var month_filter = this.value;
    $.ajax({
      url: './sw-proses?action=load-home-counter',
      method: 'POST',
      data: { month_filter: month_filter },
      dataType: 'text',
      cache: false,
      async: false,
      beforeSend: function () {
        loading();
      },
      success: function (data) {
        $('.load-home').html(data);
      },
      complete: function () {
        $('.loading').hide();
      },
    });
  });

  /* ------------------ FAILED ACCESS ------------------*/
  $(document).on('click', '.access-failed', function () {
    swal({
      title: 'Error!',
      text: 'Anda tidak memiliki hak akses lagi!',
      icon: 'error',
      timer: 2500,
    });
  });

  //TAMBAHAN AGUNG
  $('#showPassword').click(function () {
    $(this).is(':checked')
      ? $('#password').attr('type', 'text')
      : $('#password').attr('type', 'password');
  });
});

/* ------------------- INPUT ABSEN MASUK DAN PULANG ------------------------*/
function Absent() {
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
    if (error.code == 1) {
      swal({
        title: 'Oops!',
        text: 'Anda telah memutuskan untuk tidak membagikan posisi Anda, Izinkan lokasi di browser Anda.',
        icon: 'error',
        timer: 3000,
      });
    } else if (error.code == 2) {
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

  function reload_js(src) {
    $('script[src="' + src + '"]').remove();
    $('<script>').attr('src', src).appendTo('head');
  }
  reload_js(
    'https://sisters-kominda.eagleye.id/sw-mod/sw-assets/js/html5-qrcode.min.js'
  );

  $(document).ready(function () {
    // const html5QrCode = new Html5Qrcode("reader");
    // html5QrCode.clear();
    // html5QrCode.start(
    //       { facingMode: "environment"},
    //       {
    //         fps: 10, qrbox: { width: 250, height: 250 }
    //       },
    //       (decodedText, decodedResult) => {
    //                document.getElementById("my_audio").play();
    //                var latitude = $('.latitude').html();
    //                var dataString = 'qrcode='+ decodedText + '&latitude='+ latitude;
    //                 $.ajax({
    //                     type: "POST",
    //                     url: "./sw-proses?action=absent",
    //                     data: dataString,
    //                     success: function (data) {
    //                         var results = data.split("/");
    //                         $results = results[0];
    //                         $results2 = results[1];
    //                         if ($results== 'success') {
    //                              swal({title: 'Berhasil!', text:$results2, icon: 'success', timer: 2500,});
    //                              setTimeout("location.href = './';",2500);
    //                         } else {
    //                             swal({title: 'Oops!', text:data, icon: 'error', timer: 2500,});
    //                         }
    //                           html5QrCode.clear();
    //                     }
    //                 });
    //       },
    //       (errorMessage) => {
    //             html5QrCode.clear();
    //       })
    //     .catch((err) => {
    //          alert('No Back camera found!');
    //     });
    $('.btn-show-camera').hide();
    var scanner = new Instascan.Scanner({
      video: document.getElementById('preview'),
      scanPeriod: 1,
      mirror: false,
    });
    scanner.addListener('scan', function (content) {
      //alert(content);
      document.getElementById('my_audio').play();
      var latitude = $('.latitude').html();
      var dataString = 'qrcode=' + content + '&latitude=' + latitude;
      $.ajax({
        type: 'POST',
        url: './sw-proses?action=absent',
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
              timer: 2500,
            });
            setTimeout("location.href = './';", 2500);
            $('canvas').hide();
            $('.btn-show-camera').show();
          } else {
            swal({ title: 'Oops!', text: data, icon: 'error', timer: 2500 });
            $('canvas').show();
          }
        },
      });
    });
    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
        $('[name="options"]').on('change', function () {
          if ($(this).val() == 2) {
            if (cameras[1] != '') {
              scanner.start(cameras[1]);
            } else {
              alert('No Back camera found!');
            }
          } else if ($(this).val() == 1) {
            if (cameras[0] != '') {
              scanner.start(cameras[0]);
            } else {
              alert('No Front camera found!');
            }
          }
        });
      } else {
        alert('No cameras found.');
      }
    });
  });

  /*$(".btn-show-camera").hide();
    var result_location;
    $(document).ready(function getLocation() {
        result_location = document.getElementById("latitude");
       // 
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        } else {
            swal({title: 'Oops!', text:'Maaf, browser Anda tidak mendukung geolokasi HTML5.', icon: 'error', timer: 3000,});
        }
    });
    
    // Define callback function for successful attempt
    function successCallback(position) {
       result_location.innerHTML =""+ position.coords.latitude + ","+position.coords.longitude + "";
    }

    // Define callback function for failed attempt
    function errorCallback(error) {
        if(error.code == 1) {
            swal({title: 'Oops!', text:'Anda telah memutuskan untuk tidak membagikan posisi Anda, Izinkan lokasi di browser Anda.', icon: 'error', timer: 3000,});
        } else if(error.code == 2) {
            swal({title: 'Oops!', text:'Jaringan tidak aktif atau layanan penentuan posisi tidak dapat dijangkau, Izinkan lokasi di browser Anda', icon: 'error', timer: 3000,});
        } else if(error.code == 3) {
            swal({title: 'Oops!', text:'Waktu percobaan habis sebelum bisa mendapatkan data lokasi, Izinkan lokasi di browser Anda', icon: 'error', timer: 3000,});
        } else {
            swal({title: 'Oops!', text:'Waktu percobaan habis sebelum bisa mendapatkan data lokasi, Izinkan lokasi di browser Anda', icon: 'error', timer: 3000,});
        }
    }

  var arg = {
        resultFunction: function(result){
            //$('.hasilscan').append($('<input name="noijazah" value=' + result.code + ' readonly><input type="submit" value="Cek"/>'));
           // $.post("../cek.php", { noijazah: result.code} );
            //var redirect = '#';
            //$.redirectPost(redirect, {noijazah: result.code});
            //alert(result.code);
            var latitude = $('.latitude').html();
            var dataString = 'qrcode='+ result.code + '&latitude='+ latitude;
            $("canvas").hide();
             $.ajax({
                type: "POST",
                url: "./sw-proses?action=absent",
                data: dataString,
                success: function (data) {
                    var results = data.split("/");
                    $results = results[0];
                    $results2 = results[1];
                    if ($results== 'success') {
                         swal({title: 'Berhasil!', text:$results2, icon: 'success', timer: 2500,});
                         setTimeout("location.href = './';",2500);
                         $("canvas").hide()
                         $(".btn-show-camera").show();
                    } else {
                        swal({title: 'Oops!', text:data, icon: 'error', timer: 13500,});
                        $("canvas").show();
                    }

                }
            });
        }
    };
    var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
    decoder.buildSelectMenu("select");
    decoder.play();*/
}

$(document).on('click', '.btn-show-camera', function () {
  $('canvas').show();
});

jQuery(function ($) {
  setInterval(function () {
    var date = new Date(),
      time = date.toLocaleTimeString();
    $('.clock').html(time);
  }, 1000);
});

/* ---------- Print -----------------*/
function nWin(context, title) {
  var printWindow = window.open('', '');
  var doc = printWindow.document;
  doc.write('<html><head>');
  doc.write('<title>' + title + ' - Print Mode</title>');
  doc.write(
    "<link href='sw-mod/sw-assets/css/sw-print.css' rel='stylesheet' type='text/css' media='print'>"
  );
  doc.write('</head><body>');
  doc.write(context);
  doc.write('</body></html>');
  doc.close();
  function show() {
    if (doc.readyState === 'complete') {
      printWindow.focus();
      printWindow.print();
      printWindow.close();
    } else {
      setTimeout(show, 100);
    }
  }
  show();
}

$(function () {
  $('.print').click(function () {
    nWin($('#divToPrint').html(), $('#pagename').html());
  });
});

function printData() {
  var divToPrint = document.getElementById('printArea');
  newWin = window.open('');
  newWin.document.write(divToPrint.outerHTML);
  newWin.print();
  newWin.close();
}

/*$('.btn-print').on('click',function(){
    printData();
})*/
