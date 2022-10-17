<?php
session_start();
if (!isset($_COOKIE['COOKIES_MEMBER']) && !isset($_COOKIE['COOKIES_COOKIES'])) {
  header("Location:./login");
} else {
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./sw-mod/sw-assets/css/global.css" />
    <title>Analisis</title>
  </head>

  <body>
    <!------------------------------->
    <!--HEADER-->
    <!------------------------------->
    <div class="header-wrapper">
      <div>
        <a href="home.html">
          <i class="fa fa-chevron-left" style="font-size: 40px; color: #fff"></i>
        </a>
      </div>
      <div>
        <a href="overview.html">
          <h1 class="text-menu-non-active">Overview</h1>
        </a>
      </div>
      <div>
        <h1 class="text-menu-active">Data</h1>
      </div>
      <div>
        <i class="fa fa-bars" style="font-size: 40px; color: #fff"></i>
      </div>
    </div>
    <!------------------------------->
    <!-- END HEADER-->
    <!------------------------------->
    <div id="container-news">
      <div id="loading-data" class="loading-data">
        <div class="col-12 text-center">Loading data...</div>
      </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <!-- Optional JavaScript -->
    <script>
      // tambahan 
      $(document).ready(function() {
        let dom = $(document);

        let containerNews = dom.find('#container-news');
        let loadingData = dom.find('#loading-data');
        let labelPositif = dom.find('#label-positif');
        let labelNegatif = dom.find('#label-negatif');
        let labelNetral = dom.find('#label-netral');
        let sentimenDate = dom.find('#sentimen-date');
        let inputDate = dom.find('#input-date');

        let data = {
          newsid: null,
        };

        dom.on('click', '.btn-read-more', (e) => {
          let current = $(e.currentTarget);
          let card = $(e.currentTarget).closest('.card');
          let newsShort = card.find('.news-short');
          let newsLong = card.find('.news-long');

          current.text(
            current.text() == 'Baca Lebih Banyak' ?
            'Baca Lebih Sedikit' :
            'Baca Lebih Banyak'
          );

          newsShort.toggleClass('d-none');
          newsLong.toggleClass('d-none');
        });

        function init() {
          const params = new Proxy(
            new URLSearchParams(window.location.search), {
              get: (searchParams, prop) => searchParams.get(prop),
            }
          );
          let currentDate = params.date ?
            moment(parseInt(params.date)).format('DD/MM/YYYY') :
            moment().format('DD/MM/YYYY');
          getData(currentDate);
        }

        function getData(currentDate) {
          $('#loader').show();

          let getdatacart = $.post(
            'https://analytics.kazee.id/api/api-data-test', {
              token: '09e6c378115106b794a7176f7f21730x',
              max_post: 1000,
              source: 'twitter,news,facebook,instagram,youtube',
              page: 1,
              daterange: `${currentDate}-${currentDate}`,
            },
            function(response) {
              loadingData.addClass('d-none');
              const dataresponse = response.data;

              dataresponse.forEach((news) => {
                if (news.title) {
                  containerNews.append(createCard(news));
                }
              });
            }
          );

          $.when(getdatacart).done(function() {
            $('#loader').fadeOut(300);
          });
        }

        function createCard(news) {
          let sentiment = news.analysis.sentiment.sentiment;
          let labelSentiment = 'netral';
          let badgeSentiment = 'secondary';
          if (sentiment == 'pos') {
            labelSentiment = 'positif';
            badgeSentiment = 'primary';
          } else if (sentiment == 'neg') {
            labelSentiment = 'negatif';
            badgeSentiment = 'danger';
          }
          return `
              <div class="row card-container mt-4">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title">
                          <div class="wrapper-card-title">
                            <div class="wrapper-news-title">
                              <div class="wrapper-image-title">
                                <span class="wrapper-image-transparent">
                                  <img
                                    alt=""
                                    aria-hidden="true"
                                    src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"
                                    class="image-transparent"
                                  />
                                </span>

                                <img
                                  height="30px"
                                  src="${news.meta.avatar}"
                                  decoding="async"
                                  data-nimg="intrinsic"
                                  class="image-news"
                                />
                                <noscript></noscript>
                              </div>
                              <div class="wrapper-title-category">
                                <h4 class="news-title">${
                                  news.meta.source.name
                                }</h4>
                                <div>
                                  <span class="badge badge-${badgeSentiment}">${labelSentiment}</span>
                                </div>
                              </div>
                            </div>
                            <div>
                              <i class="fa fa-file-text-o" style="font-size: 48px"></i>
                            </div>
                          </div>
                        </div>
                        <h4 class="news-title">
                          ${news.title}
                        </h4>
                        <div class="wrapper-news-descs">
                          <p class="news-desc news-short">
                            ${news.content.substring(0, 100)}...
                          </p>
                          <p class="news-desc news-long d-none">
                            ${news.content}
                          </p>
                        </div>
                        <p style="font-size: 14px; color: blue" class="btn-read-more">Baca Lebih Banyak</p>
                        <p style="font-size: 12px; color: grey">
                          ${news.datetime_str}
                        </p>
                        <div style="display: flex">
                          <div>
                            <button class="btn btn-outline-primary" style="margin: 0 6px">
                              Bookmark
                            </button>
                          </div>
                          <div>
                            <button class="btn btn-outline-primary" style="margin: 0 6px">
                              Profil
                            </button>
                          </div>
                          <div>
                            <a href="${
                              news.url
                            }" class="btn btn-outline-primary" style="margin: 0 6px">
                              Lihat
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          `;
        }

        init();
      });
    </script>
  </body>

  </html>

<?php
}
?>