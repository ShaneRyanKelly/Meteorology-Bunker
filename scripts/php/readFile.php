<?php
    $dataPath = "../../data/silso/EISN_current.csv";
    $dataFile = fopen($dataPath, "r") or die("Cannot Open Data File");
    
    while(!feof($dataFile)){
        $currentLine = fgets($dataFile);
        trim($currentLine);
        echo $currentLine;
    }
    fclose($dataFile);
?>
