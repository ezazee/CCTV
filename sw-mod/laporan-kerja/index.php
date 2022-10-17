<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>laporan kerja</title>
  <link rel="icon" href="<?= $base_url; ?>sw-mod/laporan-kerja/assets/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="<?= $base_url; ?>sw-mod/laporan-kerja/assets/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.1/css/font-awesome.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="<?= $base_url; ?>sw-mod/sw-assets/loading-modal/jquery.loadingModal.min.css">
  <!-- ./sw-assets/css/jquery.loadingModal.min.css -->
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
  <script src="<?= $base_url; ?>sw-mod/sw-assets/loading-modal/jquery.loadingModal.min.js"></script>

</head>

<body>
  <div class="container-fluid">
    <div class="row" id="tibo">
      <label class="ml-16">
        <ion-icon name="chevron-back-outline" size="large" id="back-button"></ion-icon>
      </label>
      <label class="title">Laporan Kerja</label>
      <!-- <div id="list-laporan" class="col-12">
        <div class="row" action="#" id="form-list">
          <div class="col-12">
            <div class="input-group mb-3">
              <input type="text" name="search" class="form-control right-icon search-laporan" placeholder="Cari Laporan" autocomplete="off">
              <div class="input-group-append" class="btn-search">
                <span class="input-group-text right-icon" id="basic-addon2">
                  <ion-icon name="search-outline"></ion-icon>
                </span>
              </div>
            </div>
          </div>

          <div class="col-12 tampung-laporan">
            <div class="row card-container none" id="card-container">
            </div>
            <div class="empty none">
              <img src="<?= $base_url; ?>sw-mod/laporan-kerja/assets/kosong.png" width="100">
              <br>
              Laporan tidak ditemukan
            </div>
          </div>

          <div class="col-12">
            <button type="button" value="1" class="btn btn-success btn-form btn-create-laporan">
              <span>Buat Laporan</span>
              <span class="pull-right">
                <ion-icon name="add-circle"></ion-icon>
              </span>
            </button>
          </div>
        </div>
      </div> -->

      <div id="form-laporan" class="col-12">
        <form id="form-submit" class="ml-16 mr-16 mb-16">
          <div id="page1" class="">
            <label>Kirim Ke</label>
            <div class="field-wrapper-kepada">
              <input name="employe_id" value="<?= $row_user['id']; ?>" type="hidden" />
              <input name="employe_name" value="<?= $row_user['employees_name']; ?>" type="hidden" />
              <div class="input-group mb-3">
                <input type="text" name="kepada[]" class="form-control kepada" placeholder="Kepada" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off">
                <div class="input-group-append add-kepada">
                  <span class="input-group-text" id="basic-addon2">
                    <ion-icon name="add-circle"></ion-icon>
                  </span>
                </div>
              </div>
            </div>
            <div class="field-wrapper-tembusan">
              <div class="input-group mb-3">
                <input type="text" name="tembusan[]" class="form-control tembusan" placeholder="Tembusan" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off">
                <div class="input-group-append add-tembusan">
                  <span class="input-group-text" id="basic-addon2">
                    <ion-icon name="add-circle"></ion-icon>
                  </span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1">Nilai</label>
              <br>
              <label class="radio">
                <input type="radio" name="point" value="1" class="point" checked>
                <span>1</span>
              </label>
              <label class="radio">
                <input type="radio" name="point" value="2" class="point">
                <span>2</span>
              </label>
              <label class="radio">
                <input type="radio" name="point" value="3" class="point">
                <span>3</span>
              </label>
              <label class="radio">
                <input type="radio" name="point" value="4" class="point">
                <span>4</span>
              </label>
              <label class="radio">
                <input type="radio" name="point" value="5" class="point">
                <span>5</span>
              </label>
              <textarea name="about" class="form-control about" id="exampleFormControlTextarea1" rows="7" placeholder="Perihal"></textarea>
            </div>
          </div>

          <div id="page2" class="none">
            <label>Fakta fakta : </label>
            <div class="form-group">
              <textarea name="fakta" class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
            </div>

            <div class="field-wrapper-image">
              <div class="tampung-image" data-id="1">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text icon-before" for="image-file1">
                      <i class="fa fa-paperclip" aria-hidden="true"></i>
                    </label>
                  </div>
                  <input type="text" class="form-control two image-text" placeholder="JPG/PNG" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off" readonly style="background:none">
                  <div class="input-group-append add-image">
                    <span class="input-group-text" id="basic-addon2">
                      <ion-icon name="add-circle"></ion-icon>
                    </span>
                  </div>
                </div>
                <input type="file" id="image-file1" class="none image-file" name="image[]">
                <img class="img-responsive previewImage1 none readimage" id="previewImage" src="" alt="">
                <div class="form-group">
                  <textarea name="keterangan[]" class="form-control keterangan none" rows="2" placeholder="Keterangan"></textarea>
                </div>
              </div>
            </div>

            <div class="field-wrapper-camera">
              <div class="tampung-camera" data-id="1">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text icon-before" for="camera-file1">
                      <i class="fa fa-paperclip" aria-hidden="true"></i>
                    </label>
                  </div>
                  <input type="text" class="form-control two camera-text" placeholder="Camera" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off" readonly style="background:none">
                  <div class="input-group-append add-camera">
                    <span class="input-group-text" id="basic-addon2">
                      <ion-icon name="chevron-forward-outline"></ion-icon>
                    </span>
                  </div>
                </div>
                <div class="row open-camera none">
                  <div class="col-md-6 col-sm-12">
                    <div class="row col-md-12" id="my_camera"></div><br />
                    <input type="hidden" name="camera" class="image-tag">
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div id="results" style="width: 200px; height:160px;"></div>
                  </div>
                  <div class="col-12 form-group">
                    <br>
                    <input type=button value="Take Snapshot" class="btn btn-primary form-control take-picture">
                  </div>
                </div>
              </div>
            </div>

            <!-- <div class="field-wrapper-video">
                        <div class="tampung-video" data-id="1">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text icon-before" for="video-file1">
                                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                                    </label>
                                </div>
                                <input type="text" class="form-control two video-text" placeholder="Video" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off" readonly style="background:none">
                                <div class="input-group-append add-video">
                                    <span class="input-group-text" id="basic-addon2">
                                    <ion-icon name="chevron-forward-outline"></ion-icon>
                                    </span>
                                </div>
                            </div>
                            <input type="file" id="video-file1" class="none video-file" name="video[]">   
                            <img class="img-responsive previewImageV1 none readvideo" id="previewImageV" src="" alt=""> 
                        </div>
                    </div>  -->

            <div class="field-wrapper-url">
              <div class="tampung-url" data-id="1">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text icon-before">
                      <i class="fa fa-paperclip" aria-hidden="true"></i>
                    </label>
                  </div>
                  <input type="text" name="link" class="form-control two url-text" placeholder="Url Link" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off">
                  <div class="input-group-append add-link">
                    <span class="input-group-text" id="basic-addon2">
                      <!-- <ion-icon name="pencil-circle"></ion-icon> -->
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div id="page3" class="none">
            <label>Catatan : </label>
            <div class="field-wrapper-analisa">
              <div class="input-group mb-3">
                <textarea name="analisa" class="form-control icon-right analisa" rows="4" placeholder="Analisa"></textarea>
                <div class="input-group-append add-analisa">
                  <span class="input-group-text" id="basic-addon2">
                    <ion-icon name="pencil-outline"></ion-icon>
                  </span>
                </div>
              </div>
            </div>
            <div class="field-wrapper-upaya">
              <div class="input-group mb-3">
                <textarea name="upaya" class="form-control icon-right upaya" rows="4" placeholder="Upaya"></textarea>
                <div class="input-group-append add-upaya">
                  <span class="input-group-text" id="basic-addon2">
                    <ion-icon name="pencil-outline"></ion-icon>
                  </span>
                </div>
              </div>
            </div>
            <div class="field-wrapper-rekomendasi">
              <div class="input-group mb-3">
                <textarea name="rekomendasi" class="form-control icon-right rekomendasi" rows="4" placeholder="Rekomendasi"></textarea>
                <div class="input-group-append add-rekomendasi">
                  <span class="input-group-text" id="basic-addon2">
                    <ion-icon name="pencil-outline"></ion-icon>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <button type="button" data-id="1" class="btn btn-success btn-form btn-form-insert">
              <span class="text-button">Selanjutnya</span>
              <span class="pull-right">
                <ion-icon name="chevron-forward-circle"></ion-icon>
              </span>
            </button>
            <button type="submit" class="btn btn-success btn-form btn-form-insert-yes none">
              <span class="text-button">Simpan</span>
              <span class="pull-right">
                <ion-icon name="chevron-forward-circle"></ion-icon>
              </span>
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script>
    var login = '<?= $row_user['id']; ?>';
  </script>
  <!--function-->
  <script>
    function kepada(x = 0) {
      var i = x + 1;
      var txt = `<div class="input-group mb-3">
                <input type="text" name="kepada[]" class="form-control kepada" placeholder="Kepada" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off">
                <div class="input-group-append remove-kepada">
                    <span class="input-group-text" id="basic-addon2">
                    <ion-icon name="remove-circle"></ion-icon>
                    </span>
                </div>
            </div>`;
      return txt;
    };

    function tembusan(x = 0) {
      var i = x + 1;
      var txt = `
            <div class="input-group mb-3">
                <input type="text" name="tembusan[]" class="form-control tembusan" placeholder="Tembusan" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off">
                <div class="input-group-append remove-tembusan">
                    <span class="input-group-text" id="basic-addon2">
                    <ion-icon name="remove-circle"></ion-icon>
                    </span>
                </div>
            </div>
        `;
      return txt;
    };

    function image(x = 0) {
      var i = x + 1;
      var txt = `
            <div class="tampung-image" data-id="${i}">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text icon-before" for="image-file${i}">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                        </label>
                    </div>
                    <input type="text" class="form-control two image-text" placeholder="JPG/PNG" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off" readonly style="background:none">
                    <div class="input-group-append remove-image">
                        <span class="input-group-text" id="basic-addon2">
                        <ion-icon name="remove-circle"></ion-icon>
                        </span>
                    </div>
                </div>
                <input type="file" id="image-file${i}" class="none image-file" name="image[]">   
                <img class="img-responsive previewImage${i} none readimage" id="previewImage" src="" alt=""> 
                <div class="form-group">
                <textarea name="keterangan[]" class="form-control keterangan none" rows="2" placeholder="Keterangan"></textarea>
                </div>
            </div>
        `;
      return txt;
    }

    function urlField(x = 0) {
      var i = x + 1;
      var txt = `
            <div class="tampung-url" data-id="1">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text icon-before">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                        </label>
                    </div>
                    <input type="text" name="url[]" class="form-control two url-text" placeholder="Url Link" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off">
                    <div class="input-group-append remove-url">
                        <span class="input-group-text" id="basic-addon2">
                        <ion-icon name="remove-circle"></ion-icon>
                        </span>
                    </div>
                </div>
            </div>
        `;
      return txt;
    };

    function catatan(x = 0) {
      var i = x + 1;
      var txt = `
            <div class="input-group mb-3">
                <textarea name="catatan[]" class="form-control icon-right catatan" rows="4" placeholder="Catatan"></textarea>    
                <div class="input-group-append remove-catatan">
                    <span class="input-group-text" id="basic-addon2">
                    <ion-icon name="remove-circle"></ion-icon>
                    </span>
                </div>
            </div>  
        `;
      return txt;
    };

    /*FILE*/
    function readImage(input, showNumber = 0) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          /* $('#previewImage').attr('src', e.target.result);// $('#previewImage').hide();// $('#previewImage').fadeIn(650); */
          $('.previewImage' + showNumber).attr('src', e.target.result);
          $('.previewImage' + showNumber).hide();
          $('.previewImage' + showNumber).fadeIn(650);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    function getfileNeme(e) {
      var val = e.target.files[0].name;
      return val;
    }

    function getfileSize(e) {
      var val = e.target.files[0].size;
      return val;
    }

    function getfileExt(e, filename) {
      var val = filename.split('.').pop().toLowerCase();
      return val;
    }

    function listLaporan(val) {
      $.ajax({
        url: '<?= $base_url; ?>sw-mod/laporan-kerja/' + 'proses.php?aksi=search-laporan',
        type: 'POST',
        data: {
          'search': val,
          'login': login
        },
        dataType: 'json',
        success: function(res) {
          var html = '';
          if (res['success'] == true) {
            $.each(res['data'], function(index, view) {
              /*var id = atob(view['id']) */
              html += `
                            <div class="col-lg-4 col-md-4 col-sm-4 laporan-klik" data-nomor="${view['id']}">
                                <div class="col-12 card-laporan">  
                                  <div class="row">
                                    <div class="col-9 col-lg-12">

                                      <small>
                                          <p class="font-weight-light mb-1 d-block text-truncate w-75">
                                          Perihal : ${view['about']}
                                          </p>
                                          <p class="font-weight-light mb-0">
                                          ${view['created_at']}
                                          </p>
                                      </small>
                                    </div>
                                    <div class="col-3 col-lg-12">
                                      <badge type="button" class="badge badge-success btn-card pull-right">
                                        <small>
                                        No Laporan: ${view['id']}
                                        </small>
                                      </badge>
                                    </div>
                                  </div>
                                </div>
                            </div>   
                        `;
            });
            $('.tampung-laporan').find('.empty').addClass('none');
            $('.tampung-laporan').find('.card-container').removeClass('none');
            $('.tampung-laporan').find('.card-container').html(html);
          } else {
            $('.tampung-laporan').find('.empty').removeClass('none');
            $('.tampung-laporan').find('#card-container').addClass('none');
          }

        }
      })




    }
  </script>

  <!-- button-->
  <script>
    $(document).ready(function() {
      let btn_insert = $('.btn-form-insert');
      let search_laporan = $('.search-laporan');
      let max_form = 3;
      var i_btn = 1;
      $('.btn-create-laporan').click(function() {
        $('#list-laporan').addClass('none');
        $('#form-laporan').removeClass('none');
      });

      $(btn_insert).click(function(e) {
        var kepadaInput = $('.kepada');
        var tembusanInput = $('.tembusan');
        var dariInput = $('.dari');
        var aboutInput = $('.about');

        $('.kepada').keypress(function() {
          $(this).removeClass("is-invalid");
        });

        $('.tembusan').keypress(function() {
          $(this).removeClass("is-invalid");
        });

        $('.dari').keypress(function() {
          $(this).removeClass("is-invalid");
        });

        $('.about').keypress(function() {
          $(this).removeClass("is-invalid");
        });

        if (kepadaInput.val() === "") {
          kepadaInput.addClass("is-invalid");
        } else {
          if (tembusanInput.val() === "") {
            tembusanInput.addClass("is-invalid");
          } else {
            if (dariInput.val() === "") {
              dariInput.addClass("is-invalid");
            } else {
              if (aboutInput.val() === "") {
                aboutInput.addClass("is-invalid");
              } else {
                e.preventDefault();
                i_btn++;
                var close = i_btn - 1;
                if (i_btn <= max_form) {
                  $('#page' + i_btn).removeClass('none');
                  $('#page' + close).addClass('none');
                  if (i_btn == 3) {
                    $('#form-submit').find('.btn-form-insert-yes').removeClass('none');
                    $(this).addClass('none');
                  }
                }
              }
            }
          }
        }
      });

      $(document).on('submit', '#form-submit', function(e) {
        e.preventDefault();
        let valid = true;
        if (valid) {
          let formValue = new FormData(this);
          $.ajax({
            url: '<?= $base_url; ?>sw-mod/laporan-kerja/' + 'proses.php?aksi=tambah-laporan',
            type: 'POST',
            data: formValue,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            beforeSend: function() {
              showModal();
            },
            success: function(res) {
              if (res['success'] == true) {
                alert('sukses');
                window.setTimeout(window.location.href = "./lembarkerja.php", 2500);
                /* history.go(0); */
                destroyModal()
              } else {
                alert('gagal');
                destroyModal()
              }
            }
          });
        }
      });

      listLaporan("");
      $(search_laporan).keyup(function(e) {
        e.preventDefault();
        var val = $(this).val();
        listLaporan(val);
      })
    })
  </script>

  <script>
    $(document).ready(function() {
      var btnBack = $("#back-button").on("click", function() {
        window.location.href = './home.html';
      });
    })
  </script>


  <!--input-->
  <script>
    $(document).ready(function() {
      let max_field = 100;
      /*kepada*/
      let add_kepada = $('.add-kepada');
      let remove_kepada = $('.remove-kepada');
      let wrapper_kepada = $('.field-wrapper-kepada');
      var i_kepada = 0;
      $(add_kepada).on('click', function(e) {
        e.preventDefault();
        i_kepada++;
        if (i_kepada <= max_field) $(wrapper_kepada).append(kepada(i_kepada));
      });
      $(wrapper_kepada).on('click', '.remove-kepada', function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        i_kepada--;
      });


      /*tembusan */
      let add_tembusan = $('.add-tembusan');
      let remove_tembusan = $('.remove-tembusan');
      let wrapper_tembusan = $('.field-wrapper-tembusan');
      var i_tembusan = 0;
      $(add_tembusan).on('click', function(e) {
        e.preventDefault();
        i_tembusan++;
        if (i_tembusan <= max_field) $(wrapper_tembusan).append(tembusan(i_tembusan));
      });
      $(wrapper_tembusan).on('click', '.remove-tembusan', function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        i_tembusan--;
      });


      /*image */
      let add_image = $('.add-image');
      let remove_image = $('.remove-image');
      let wrapper_image = $('.field-wrapper-image');
      var i_image = 0;
      $(add_image).on('click', function(e) {
        e.preventDefault();
        i_image++;
        if (i_image <= max_field) $(wrapper_image).append(image(i_image))
      });
      $(wrapper_image).on('click', '.remove-image', function(e) {
        e.preventDefault();
        $(this).closest('.tampung-image').remove();
        i_image--;
      });

      $(wrapper_image).on('change', '.image-file', function(e) {
        let filename = getfileNeme(e);
        let size = getfileSize(e);
        let ext = getfileExt(e, filename);

        if (filename != '') {
          if (ext == 'jpg' || ext == 'jpeg' || ext == 'png') {
            if (size <= 3000000) {
              $(this).closest('.tampung-image').find('#previewImage').removeClass('none');
              $(this).closest('.tampung-image').find('.keterangan').removeClass('none');
              var showNumber = $(this).closest('.tampung-image').attr('data-id');
              readImage(this, showNumber);
            } else {
              /*$('#previewImage').attr('src',baseUrl+'public/assets/images/default_image.png')*/
              alert('maximal 3 Mb');
            }
          } else {
            /*$('#previewImage').attr('src',baseUrl+'public/assets/images/default_image.png') */
            alert('jpg/png only');
          };
        };
      });

      /*url*/
      let add_url = $('.add-url');
      let remove_url = $('.remove-url');
      let wrapper_url = $('.field-wrapper-url');
      var i_url = 0;
      $(add_url).on('click', function(e) {
        e.preventDefault();
        i_url++;
        if (i_url <= max_field) $(wrapper_url).append(urlField(i_url))
      });
      $(wrapper_url).on('click', '.remove-url', function(e) {
        e.preventDefault();
        $(this).closest('.tampung-url').remove();
        i_url--;
      });

      /*camera*/
      Webcam.set({
        width: 200,
        height: 160,
        image_format: 'jpeg',
        jpeg_quality: 120
      });
      $(document).on('click', '.camera-text', function(e) {
        $('.open-camera').removeClass('none');
        Webcam.attach('#my_camera');
      });
      $(document).on('click', '.take-picture', function(e) {
        e.preventDefault();
        Webcam.snap(function(data_uri) {
          $(".image-tag").val(data_uri);
          document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
        });
      });


      /*catatan*/
      let add_catatan = $('.add-catatan');
      let remove_catatan = $('.remove-catatan');
      let wrapper_catatan = $('.field-wrapper-catatan');
      var i_catatan = 0;
      $(add_catatan).on('click', function(e) {
        e.preventDefault();
        i_catatan++;
        if (i_catatan <= max_field) $(wrapper_catatan).append(catatan(i_catatan));
      });
      $(wrapper_catatan).on('click', '.remove-catatan', function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        i_catatan--;
      });




    });
  </script>

  <script>
    $(document).on('click', '.laporan-klik', function() {
      var nomor = $(this).data('nomor');
      location.href = `<?= $base_url; ?>detail-laporan-kerja?nomor=${nomor}`;
    })
  </script>

  <script>
    $(function() {
      $(document).on('focus', '.kepada', function() {
        $(this).autocomplete({
          source: '<?= $base_url; ?>sw-mod/laporan-kerja/proses.php?aksi=get-employe',
          select: function(event, data) {
            /* $('.kepada').val(data.item.id); */
            /* $('.kepada').val(data.item.id);*/
          }
        });
      })
    });
  </script>

  <script>
    $(function() {
      $(document).on('focus', '.tembusan', function() {
        $(this).autocomplete({
          source: '<?= $base_url; ?>sw-mod/laporan-kerja/proses.php?aksi=get-employe',
          select: function(event, data) {
            /* $('.tembusan').val(data.item.id); */
          }
        });
      })
    });
  </script>

  <script>
    function destroyModal() {
      $('body').loadingModal('destroy');
    }

    function showModal() {
      $('body').loadingModal({
          text: 'Mohon Tunggu Sebentar...'
        })
        .loadingModal('animation', 'wave')
        .loadingModal('backgroundColor', '#00C3B6');
    }
  </script>