var context = {
  body: $('body'),
  app: $('#app'),
  module: $('#app').data('module'),
  base_url: base_url,
  load: function (strpath) {
    return `${this.base_url}sw-assets/js/app/${strpath}.js`;
  },
  loadModule: function () {
    return `${this.base_url}sw-assets/js/app/module/${this.module}.js`;
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
};
