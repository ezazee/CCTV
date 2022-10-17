// import api from '../request/apiAbsent.js';

export default (function () {
  // init scope
  let body = context.body;
  let app = context.app;

  // component
  // let cameraField = app.find('.camera_field');
  let popupContainer = document.getElementById('popup');

  // event
  //   btnAnswer.on('click', actionClickBtnAnswer);

  // delegation event
  // body
  //   .on('click', '.take-picture', onTakePicture)
  //   .on('click', '.retake-picture', onRetakePicture)
  //   .on('click', '#absen-selfie', onSubmit);

  // delegation event

  // data
  let data = {
    map: null,
    popup: null,
    dataBuilding: [
      {
        code: 'SWUKZ/2021',
        name: 'BIN KETINTANG',
        address: 'JL KETINTANG  MADYA',
        latitude_longtitude: '112.90374755859375,-7.637498152147215',
      },
      {
        code: 'SW016/2022',
        name: 'KOTA SURABAYA',
        address: 'JL KETINTANG  MADYA',
        latitude_longtitude: '112.74148115065746,-7.261549201666966',
      },
      {
        code: 'SW2UL/2022',
        name: 'KAB. SIDOARJO',
        address: 'JL KETINTANG  MADYA',
        latitude_longtitude: '112.7218941294551,-7.4604988760729185',
      },
      {
        code: 'SWW3F/2022',
        name: 'KOTA BATU',
        address: '-',
        latitude_longtitude: '112.52724885720697,-7.871612623754274',
      },
    ],
    dataEmployee: [
      {
        employees_nip: '09765572',
        employees_name: 'Emil Mutaqin',
        latitude_longtitude_in: '-6.2633633,106.8441532',
      },
      {
        employees_nip: '000100092022',
        employees_name: 'FauziF',
        latitude_longtitude_in: '-6.9174639,107.6191228',
      },
      {
        employees_nip: '75060715',
        employees_name: 'Yusup Saprudin',
        latitude_longtitude_in: '-6.209536,106.610688',
      },
    ],
  };

  function init() {
    //   attach camera
    createMap();

    data.map.on('pointermove', function (evt) {
      var feature = data.map.forEachFeatureAtPixel(
        evt.pixel,
        function (feat, layer) {
          return feat;
        }
      );

      if (feature && feature.get('type') == 'Point') {
        var coordinate = evt.coordinate; //default projection is EPSG:3857 you may want to use ol.proj.transform

        popupContainer.innerHTML = feature.get('desc');
        data.popup.setPosition(coordinate);
      } else {
        data.popup.setPosition(undefined);
      }
    });
  }

  // function action
  function createMap() {
    data.map = new ol.Map({
      target: 'map',
      layers: [
        new ol.layer.Tile({
          title: 'OSM',
          type: 'base',
          source: new ol.source.OSM(),
        }),
      ],
      view: new ol.View({
        center: ol.proj.fromLonLat([112.90374755859375, -7.637498152147215]),
        zoom: 8.5,
      }),
    });

    data.popup = new ol.Overlay({
      element: popupContainer,
      autoPan: true,
      autoPanAnimation: {
        duration: 250,
      },
    });

    data.map.addOverlay(data.popup);

    // style layer
    const fillStyle = new ol.style.Fill({
      color: [84, 118, 255, 1],
    });

    // vector layer
    const JatimGeoJSON = new ol.layer.VectorImage({
      source: new ol.source.Vector({
        url: base_url + 'sw-assets/json/mapgeo-jatim.geojson',
        format: new ol.format.GeoJSON(),
      }),
      visible: true,
      title: 'Region',
      fill: fillStyle,
    });

    // data.map.addLayer(JatimGeoJSON);

    Promise.all([getLocation(), getEmployees()]).then((values) => {
      const branchFeatures = addPointGeom(values[0], 'building');
      const personilFeatures = addPointGeom(values[1], 'user');

      let styleBranchilCache = {},
        stylePersonilCache = {};

      const clusterBranchLayer = new ol.layer.Vector({
        source: new ol.source.Cluster({
          distance: 60,
          source: new ol.source.Vector({
            features: branchFeatures,
          }),
        }),
        style: function (feature) {
          let size = feature.get('features').length;
          console.log(size);
          let style = styleBranchilCache[size];
          if (!style) {
            style = new ol.style.Style({
              image: new ol.style.Circle({
                radius: 10,
                stroke: new ol.style.Stroke({
                  color: '#fff',
                }),
                fill: new ol.style.Fill({
                  color: '#00C3B6',
                }),
              }),
              text: new ol.style.Text({
                text: size.toString(),
                fill: new ol.style.Fill({
                  color: '#fff',
                }),
              }),
            });
            styleBranchilCache[size] = style;
          }
          return style;
        },
        minResolution: 101,
      });

      const clusterPersonilLayer = new ol.layer.Vector({
        source: new ol.source.Cluster({
          distance: 10,
          source: new ol.source.Vector({
            features: personilFeatures,
          }),
        }),
        style: function (feature) {
          let size = feature.get('features').length;
          let style = stylePersonilCache[size];
          if (!style) {
            style = new ol.style.Style({
              image: new ol.style.Circle({
                radius: 8,
                stroke: new ol.style.Stroke({
                  color: '#fff',
                }),
                fill: new ol.style.Fill({
                  color: '#6081fc',
                }),
              }),
              text: new ol.style.Text({
                text: size.toString(),
                fill: new ol.style.Fill({
                  color: '#fff',
                }),
              }),
            });
            stylePersonilCache[size] = style;
          }
          return style;
        },
        minResolution: 21,
      });

      const branchLayer = new ol.layer.Vector({
        title: 'Cabang',
        source: new ol.source.Vector({
          features: branchFeatures,
        }),
        maxResolution: 100,
      });

      const personilLayer = new ol.layer.Vector({
        title: 'Agen',
        source: new ol.source.Vector({
          features: personilFeatures,
        }),
        maxResolution: 20,
      });

      data.map.addLayer(clusterBranchLayer);
      data.map.addLayer(clusterPersonilLayer);
      data.map.addLayer(branchLayer);
      data.map.addLayer(personilLayer);

      const layerSwitcher = new ol.control.LayerSwitcher({
        reverse: true,
        groupSelectStyle: 'group',
      });
      data.map.addControl(layerSwitcher);
    });
  }

  function getStyleIcon(icon = 'user') {
    return new ol.style.Style({
      image: new ol.style.Icon({
        anchor: [0.5, 46],
        scale: 0.05,
        anchorXUnits: 'fraction',
        anchorYUnits: 'pixels',
        src: context.base_url + 'sw-assets/img/maps/' + icon + '.png',
      }),
    });
  }

  function addPointGeom(data, type = 'user') {
    return data.map(function (item) {
      let icontype = type;
      let desc = ``,
        location;
      if (icontype == 'building') {
        location = ol.proj.fromLonLat(item.latitude_longtitude.split(','));
        let longitude = location[0];
        let latitude = location[1];
        desc =
          '<pre> <b>' +
          item.name +
          '</b> ' +
          '<br>' +
          'Code : ' +
          item.code +
          '<br>' +
          'Alamat : ' +
          item.address +
          '<br>' +
          'Latitude : ' +
          latitude +
          '<br>Longitude: ' +
          longitude +
          '</pre>';
      }
      if (icontype == 'user') {
        if (item.absen == '0') {
          icontype = 'user-red';
        }
        let loc = item.latitude_longtitude.split(',');
        let longitude = loc[1];
        let latitude = loc[0];
        location = ol.proj.fromLonLat([longitude, latitude]);
        desc =
          '<pre><b>Name : ' +
          item.employees_name +
          '</b> ' +
          '<br>' +
          'NIP : ' +
          item.employees_nip +
          '<br>' +
          'Latitude : ' +
          latitude +
          '<br>Longitude: ' +
          longitude +
          '</pre>';
      }
      //iterate through array...
      let iconFeature = new ol.Feature({
        geometry: new ol.geom.Point(location),
        type: 'Point',
        desc: desc,
      });

      iconFeature.setStyle(getStyleIcon(icontype));
      return iconFeature;
    });
  } // End of function showStraits()

  function getLocation() {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: 'sw-mod/home/proses.php?action=get-location',
        type: 'GET',
        success: function (data) {
          resolve(data);
        },
        error: function (error) {
          reject(error);
        },
      });
    });
  }

  function getEmployees() {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: 'sw-mod/home/proses.php?action=get-employees',
        type: 'GET',
        success: function (data) {
          resolve(data);
        },
        error: function (error) {
          reject(error);
        },
      });
    });
  }
  // end function action

  return {
    init,
  };
})();
