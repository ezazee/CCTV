// import api from '../request/apiAbsent.js';

export default (function () {
  // init scope
  let body = context.body;
  let app = context.app;

  // component
  let modalAdd = app.find('#modalAdd');
  let modalEdit = app.find('#modalEdit');
  let markerView = document.getElementById('marker');

  // event
  modalAdd
    .on('shown.bs.modal', function (e) {
      let inputLokasi = modalAdd.find('input.input-map');
      let coordinate = ol.proj.toLonLat(data.defaultLokasi);
      let long = coordinate[0];
      let lat = coordinate[1];
      inputLokasi.val(`${lat},${long}`);
      data.marker.setPosition(ol.proj.fromLonLat(data.defaultLokasi));
      data.map.setTarget('map-add');
      data.map.getView().setCenter(ol.proj.fromLonLat(data.defaultLokasi));
      data.map.on('click', (e) => {
        data.marker.setPosition(e.coordinate);
        let coordinate = ol.proj.toLonLat(e.coordinate);
        let long = coordinate[0];
        let lat = coordinate[1];
        inputLokasi.val(`${long},${lat}`);
      });
    })
    .on('hide.bs.modal', function (e) {
      let inputLokasi = modalAdd.find('input.input-map');
      let long = data.defaultLokasi[0];
      let lat = data.defaultLokasi[1];
      inputLokasi.val(`${long},${lat}`);
      data.marker.setPosition(ol.proj.fromLonLat(data.defaultLokasi));
    });
  modalEdit
    .on('shown.bs.modal', (e) => {
      let currentLocation = $(e.relatedTarget).data('koordinat');
      let inputLokasi = modalEdit.find('input.input-map');
      data.marker.setPosition(ol.proj.fromLonLat(currentLocation.split(',')));
      inputLokasi.val(currentLocation);
      data.defaultInputLocation = currentLocation;
      data.map.setTarget('map-edit');
      data.map
        .getView()
        .setCenter(ol.proj.fromLonLat(currentLocation.split(',')));
      data.map.on('click', (e) => {
        data.marker.setPosition(e.coordinate);
        let coordinate = ol.proj.toLonLat(e.coordinate);
        let long = coordinate[0];
        let lat = coordinate[1];
        inputLokasi.val(`${long},${lat}`);
      });
    })
    .on('hide.bs.modal', function (e) {
      let inputLokasi = modalEdit.find('input.input-map');
      inputLokasi.val(data.defaultInputLocation);
      data.marker.setPosition(
        ol.proj.fromLonLat(data.defaultInputLocation.split(','))
      );
      data.defaultInputLocation = '';
    });

  // delegation event
  // body
  //   .on('click', '.take-picture', onTakePicture)
  //   .on('click', '.retake-picture', onRetakePicture)
  //   .on('click', '#absen-selfie', onSubmit);

  // delegation event

  // data
  let data = {
    map: null,
    marker: null,
    targetLayer: null,
    defaultLokasi: [112.90374755859375, -7.637498152147215],
    defaultInputLocation: '',
  };

  function init() {
    createMap();
  }

  function to4326(coord) {
    return ol.proj.transform(
      [parseFloat(coord[0]), parseFloat(coord[1])],
      'EPSG:3857',
      'EPSG:4326'
    );
  }

  // function action
  function createMap() {
    data.map = new ol.Map({
      layers: [
        new ol.layer.Tile({
          title: 'OSM',
          type: 'base',
          source: new ol.source.OSM(),
        }),
      ],
      view: new ol.View({
        center: ol.proj.fromLonLat(data.defaultLokasi),
        zoom: 8,
      }),
    });

    //PICKER or MARKER

    data.marker = new ol.Overlay({
      positioning: 'center-center',
      element: markerView,
      // stopEvent: false,
    });
    data.map.addOverlay(data.marker);
  }

  return {
    init,
  };
})();
