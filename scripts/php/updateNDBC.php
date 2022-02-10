<?php
    require("connectNDBC.php");
    require("getNDBC.php");
    require("parseNDBC.php");
    $dataFilePath = "../../data/ndbc/44065_clean.csv";
    $dataFile = fopen($dataFilePath, "r") or die("Cannot Open Data File");
    while (!feof($dataFile)){
        $data = fgets($dataFile);
        $lineArray = str_getcsv($data, ',');
        $total = count($lineArray);
        $currentEntry = 0;
        $newLine = "";
        foreach ($lineArray as $element){
            if (++$currentEntry === $total){
                $newLine .= "'" . $element . "'";
            }
            else {
                $newLine .= "'" . $element . "',";
            }
        }
        $sql = "INSERT INTO `44065` (timestamp, year, month, day, hour, minute, wdir, wspd, gst, wvht, dpd, apd, mwd, pres, atmp, wtmp, dewp, vis, ptdy, tide) VALUES (" . $newLine . ");";
        if ($connection->query($sql) === TRUE){
            echo "NDBC Updated<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
            break;
        }
    }
    fclose($dataFile);
?>