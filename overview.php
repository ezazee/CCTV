<?php
session_start();
if (!isset($_COOKIE['COOKIES_MEMBER']) && !isset($_COOKIE['COOKIES_COOKIES'])) {
  header("Location:./login");
} else {
?>


  <!doctype html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./sw-mod/sw-assets/css/global.css">
    <title>Overview</title>
  </head>

  <body>
    <!------------------------------->
    <!--HEADER-->
    <!------------------------------->
    <div class="header-wrapper">
      <div>
        <a href="home.html">
          <i class="fa fa-chevron-left" style="font-size:40px; color: #fff;"></i>
        </a>
      </div>
      <div>
        <h1 class="text-menu-active">Overview</h1>
      </div>
      <div>
        <a href="data.html" id="url-data">
          <h1 class="text-menu-non-active">Data</h1>
        </a>
      </div>
      <div>
        <i class="fa fa-bars" style="font-size:40px; color: #fff;"></i>
      </div>
    </div>
    <!------------------------------->
    <!-- END HEADER-->
    <!------------------------------->
    <div class="row mt-4">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="col-12">
          <form>
            <div class="form-row">
              <input type="date" class="form-control mb-2 input-date" id="input-date" placeholder="Cari Tanggal">
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="row card-container mt-2">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                Jumlah Sentimen
              </h5>
              <div class="dropdown-divider"></div>
              <div class="category-wrapper">
                <div style="background-color:#4FC566;" class="category-card">
                  <div class="category-quantity" id="label-positif">0</div>
                  <p>Positif</p>
                </div>
                <div style="background-color:#FA424A;" class="category-card">
                  <div class="category-quantity" id="label-negatif">0</div>
                  <p>Negatif</p>
                </div>
                <div style="background-color:#03A9F4;" class="category-card">
                  <div class="category-quantity" id="label-netral">0</div>
                  <p>Netral</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row card-container mt-2">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                Sentimen News <span id="sentimen-date">01-01-1900</span>
              </h5>
              <p class="card-text">
              <div id="chart"></div>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <!-- Optional JavaScript -->

    <!-- LINE CHART -->
    <script>
      // tambahan 
      $(document).ready(function() {

        let dom = $(document);

        let urlData = dom.find('#url-data');
        let labelPositif = dom.find('#label-positif');
        let labelNegatif = dom.find('#label-negatif');
        let labelNetral = dom.find('#label-netral');
        let sentimenDate = dom.find('#sentimen-date');
        let inputDate = dom.find('#input-date');

        let data = {
          newsid: null,
          chart: {}
        }

        dom.on('change', '#input-date', function(e) {
          let date = moment($(this).val());
          let changedDate = date.format("DD/MM/YYYY");
          data.chart = initiateCart();
          data.chart.render();
          sentimenDate.html(changedDate);

          labelPositif.html('0');
          labelNegatif.html('0');
          labelNetral.html('0');

          let url = urlData.prop('href');
          console.log(url)
          urlData.prop('href', updateQueryStringParameter(url, 'date', date));

          getChart(changedDate);
        })

        function init() {

          data.chart = initiateCart();
          data.chart.render();

          let now = moment();
          let charDate = now.format("DD/MM/YYYY");
          inputDate.val(now.format("YYYY-MM-DD"));
          sentimenDate.html(charDate);

          getChart(charDate);

        }

        function getChart(charDate) {

          $("#loader").show();

          let getdatacart = $.post("https://analytics.kazee.id/api/api-data-test", {
              "token": "09e6c378115106b794a7176f7f21730x",
              "max_post": 1000,
              "source": "twitter,news,facebook,instagram,youtube",
              "page": 1,
              "daterange": `${charDate}-${charDate}`
            },
            function(response) {
              const dataresponse = response.data;
              const result = dataresponse.reduce((acc, curr) => {
                const time = curr.datetime_str.split(" ")[3];
                const hour = time.split(':')[0];

                const accNode = acc.find((node) => node.category === hour);
                if (accNode) {
                  switch (accNode.sentiment) {
                    case 'pos':
                      accNode.pos++;
                      break;
                    case 'neg':
                      accNode.neg++;
                      break;
                    default:
                      accNode.net++;
                      break;
                  }

                } else {
                  let sentiment = curr.analysis.sentiment.sentiment;

                  let pos = 0,
                    neg = 0,
                    net = 0;
                  switch (curr.analysis.sentiment.sentiment) {
                    case 'pos':
                      curr.pos = 1;
                      break;
                    case 'neg':
                      curr.neg = 1;
                      break;
                    default:
                      curr.net = 1;
                      break;
                  }
                  acc.push({
                    pos: pos,
                    neg: neg,
                    net: net,
                    sentiment: curr.analysis.sentiment.sentiment,
                    category: hour
                  });
                }
                return acc;
              }, []);

              let pos = [];
              let neg = [];
              let net = [];

              const sortedresult = result.sort(function(a, b) {
                return b.category + a.category;
              });

              sortedresult.forEach(element => {
                pos.push(element.pos);
                net.push(element.net);
                neg.push(element.neg);
              });

              data.chart.updateSeries([{
                name: 'Positif',
                data: pos
              }, {
                name: 'Negatif',
                data: neg
              }, {
                name: 'Netral',
                data: net
              }])

              labelPositif.html(pos.reduce((a, b) => a + b, 0));
              labelNegatif.html(neg.reduce((a, b) => a + b, 0));
              labelNetral.html(net.reduce((a, b) => a + b, 0));

            });


          $.when(getdatacart).done(function() {
            $("#loader").fadeOut(300);
          });
        }

        function initiateCart() {

          var options = {
            series: [],
            chart: {
              height: 350,
              type: 'line',
              zoom: {
                enabled: false
              }
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              curve: 'straight'
            },
            title: {
              text: '',
              align: 'left'
            },
            grid: {
              borderColor: 'transparent',
              row: {
                colors: ['transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
              },
            },
            colors: ['#059169', '#CC0000', '#22B3BD'],
            xaxis: {
              labels: {
                show: false
              },
              lines: {
                show: false,
              }
            },
            yaxis: {
              lines: {
                show: false
              }
            },
            noData: {
              text: 'Loading...'
            },
          };

          return new ApexCharts(document.querySelector("#chart"), options);
        }


        function updateQueryStringParameter(uri, key, value) {
          var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
          var separator = uri.indexOf('?') !== -1 ? "&" : "?";
          if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
          } else {
            return uri + separator + key + "=" + value;
          }
        }

        init()
      });
    </script>
  </body>

  </html>
<?php
}
?>