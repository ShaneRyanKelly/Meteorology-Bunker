<?php
    $curlHandle = curl_init();
    curl_setopt($curlHandle, CURLOPT_URL, "https://api.weather.gov/gridpoints/OKX/30,47/forecast");
    curl_setopt($curlHandle, CURLOPT_USERAGENT, "User-Agent: (localApp, 2002rips@gmail.com)");
    curl_setopt($curlHandle, CURLOPT_ACCEPT_ENCODING, "Accept: application/ld+json");
    $forecast = curl_exec($curlHandle);
    curl_close($curlHandle);
    $jsonCast = json_decode($forecast, true);

    echo $jsonCast['properties'];
?>