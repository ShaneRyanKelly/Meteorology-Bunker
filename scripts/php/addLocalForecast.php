<?php
    require("connectNWS.php");
    $dataString = "'" . $_POST['timestamp'] . "','" . date("Y") . "','" . date("m") . "','" . date("d") . "','" . $_POST['temperature'] . "','" . $_POST["shortForecast"] . "','" . $_POST["wDir"] . "','" . $_POST['wSpd'] . "'";
    
    $sql = "INSERT INTO `OKX` (timestamp, year, month, day, temp, sforecast, wdir, wspd) VALUES (" . $dataString . ");";
    if ($connection->query($sql) === TRUE){
        echo "Daily Weather Updated<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
?>