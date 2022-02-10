<?php
    require("connectSILSO.php");
    require("getSILSO.php");
    require("parseFile.php");

    $filePath = "../../data/silso/EISN_cleaned.csv";
    $fileOpen = fopen($filePath, "r");
    if ($fileOpen){
        while (! feof($fileOpen)){
            $line = fgets($fileOpen);
        }
    }
    else {
        echo "Error Opening EISN data";
    }    
    $line = substr($line, 0, strlen($line) - 1);
    $newEntry = str_getcsv($line, ',');
    $newLine = "";
    $total = count($newEntry);
    $currentItem = 0;
    foreach ($newEntry as $currentEntry){
        if (++$currentItem === $total){
            $newLine .= "'" . $currentEntry . "'";
        }
        else {
            $newLine .= "'" . $currentEntry . "',";
        }
        
    }
    $sql = "INSERT INTO `eisn` (year, month, day, datekey, sspotnum, sdev, sample, stations) VALUES (" . $newLine . ");";
    if ($connection->query($sql) === TRUE){
        echo "Daily Sunspot Data Updated<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
    fclose($fileOpen);
?>