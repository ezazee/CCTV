var context = {
  body: $('body'),
  app: $('#app'),
  module: $('#app').data('module'),
  base_url: base_url,
  load: function (strpath) {
    return `${this.base_url}sw-mod/sw-assets/js/app/${strpath}.js`;
  },
  loadModule: function () {
    return `${this.base_url}sw-mod/sw-assets/js/app/module/${this.module}.js`;
  },
  capitalize: (s) => {
    if (typeof s !== 'string') return '';
    return s.charAt(0).toUpperCase() + s.slice(1);
  },
  populatetoDom: function (data) {
    Object.entries(data).forEach(([key, value]) =>
      this.app.find(`.attr-data-${key}`).html(value)
    );
  },
  populate: function (key, value) {
    this.app.find(`.attr-data-${key}`).html(value);
  },

  getLocation: function () {
    if (navigator.geolocation) {
      var options = {
        maximumAge: 100000,
        timeout: 100000,
        enableHighAccuracy: true,
      };

      navigator.geolocation.getCurrentPosition(
        function (position) {
          let latlong = `${position.coords.latitude},${position.coords.longitude}`;
          $.ajax({
            url: 'sw-mod/home/proses.php?aksi=set-user-latitude-longtitude',
            type: 'POST',
            data: { latlong: latlong },
            success: function (data) {
              // console.log(data);
            },
          });
        },
        function () {},
        options
      );
    } else {
      x.innerHTML = 'Geolocation is not supported by this browser.';
    }
  },

  init() {
    setInterval(this.getLocation(), 30000);
  },
};

context.init();
