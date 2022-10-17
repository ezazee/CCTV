<?php

$json = '{
        "token" : "09e6c378115106b794a7176f7f21730x",
        "max_post" : 10,
        "source" : "twitter,news,facebook,instagram,youtube",
        "page": 3,
        "daterange": "01/11/2021 - 31/12/2021"
      }';

$url = "https://analytics.kazee.id/api/api-data-test";

$ch  = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$data = curl_exec($ch);
curl_close($ch);

echo "<pre>";
echo print_r($data);
echo "</pre>";
