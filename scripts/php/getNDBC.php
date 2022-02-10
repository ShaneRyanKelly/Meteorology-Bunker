<?php
    //$buoyNumber = $_POST['buoyNumber'];
    $remote = 'https://www.ndbc.noaa.gov/data/5day2/44065_5day.txt';
    $local = '../../data/ndbc/44065.csv';
    
    if (file_put_contents($local, file_get_contents($remote)))
    {
        echo "NDBC data retreived";
    }
    else
    {
        echo "NDBC Data retreival failed";
    }
?>