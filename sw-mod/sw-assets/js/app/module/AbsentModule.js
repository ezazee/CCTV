import api from '../request/apiAbsent.js';

export default (function () {
  // init scope
  let body = context.body;
  let app = context.app;

  // component
  let cameraField = app.find('.camera_field');
  let resultField = app.find('#results');
  let latitude = app.find('#latitude');

  // event
  //   btnAnswer.on('click', actionClickBtnAnswer);

  // delegation event
  body
    .on('click', '.take-picture', onTakePicture)
    .on('click', '.retake-picture', onRetakePicture)
    .on('click', '#absen-selfie', onSubmit);

  // delegation event

  // data
  let data = {
    data_img: null,
    locations: null,
    idfieldCamera: '#my_camera',
  };

  function init() {
    //   attach camera
    Webcam.set({
      width: 240,
      height: 240,
      image_format: 'jpeg',
      jpeg_quality: 120,
    });
    Webcam.attach(data.idfieldCamera);
  }

  // function action
  function onTakePicture(e) {
    e.preventDefault();
    let self = $(e.currentTarget);
    self.addClass('d-none');
    app.find('.retake-picture').removeClass('d-none');
    Webcam.snap(function (data_uri) {
      data.data_img = data_uri;
      resultField.html(`<img src="${data_uri}">`).removeClass('d-none');
      cameraField.addClass('d-none');
      app.find('#absen-selfie').prop('disabled', false);
    });
  }

  function onRetakePicture(e) {
    e.preventDefault();
    let self = $(e.currentTarget);
    self.addClass('d-none');
    app.find('.take-picture').removeClass('d-none');
    data.data_img = null;
    resultField.html(``).addClass('d-none');
    cameraField.removeClass('d-none');
    app.find('#absen-selfie').prop('disabled', true);
  }

  function onSubmit(e) {
    e.preventDefault();
    getLocation(function (position) {
      var fd = new FormData();
      fd.append('img', data.data_img);
      fd.append(
        'latitude',
        `${position.coords.latitude},${position.coords.longitude}`
      );
      // console.log(data.location);
      $('.loading').show();
      api.postPresent(
        fd,
        function (data) {
          $('.loading').hide();
          var results = data.split('/');
          let res = results[0];
          let body = results[1];
          if (res == 'success') {
            swal({
              title: 'Berhasil!',
              text: body,
              icon: 'success',
              timer: 2500,
            });
            setTimeout("location.href = './';", 2500);
          } else {
            swal({
              title: 'Oops!',
              text: data,
              icon: 'error',
              timer: 2500,
            });
          }
        },
        function (XMLHttpRequest, textStatus, errorThrown) {
          // hide loading here
          $('.loading').hide();
        }
      );
    });
  }

  function getLocation(callBack) {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(callBack);
    } else {
      swal({
        title: 'Oops!',
        text: 'Maaf, browser Anda tidak mendukung geolokasi HTML5.',
        icon: 'error',
        timer: 3000,
      });
    }
  }

  // end function action

  return {
    init,
  };
})();
