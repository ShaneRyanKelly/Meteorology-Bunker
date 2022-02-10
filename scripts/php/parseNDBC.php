<?php
    $dataPath = "../../data/ndbc/44065.csv";
    $outFilePath = "../../data/ndbc/44065_clean.csv";
    $dataFile = fopen($dataPath, "r");
    $outFile = fopen($outFilePath, "w");
    $currentLine = 0;
    while (!feof($dataFile)){
        $line = fgets($dataFile);
        if (++$currentLine <= 2){
            continue;
        }
        $lineArray = array_map('trim' ,explode(' ', $line));
        $cleanedArray = array();
        foreach ($lineArray as $element){
            if ($element == " " || $element == ""){

            }
            else {
                array_push($cleanedArray, $element);
            }
        }
        $currentIndex = 0;
        if (count($cleanedArray) < 4){
            break;
        }
        $timestamp = $cleanedArray[0] . "-" . $cleanedArray[1] . "-" . $cleanedArray[2] . " " . $cleanedArray[3] . ":" . $cleanedArray[4] . ":00";
        fwrite($outFile, $timestamp . ",");
        $total = count($cleanedArray);
        $currentItem = 0;
        foreach ($cleanedArray as $cleanElement){
            if (++$currentIndex === $total){
                fwrite($outFile, $cleanElement . "\n");
            }
            else {
                fwrite($outFile, $cleanElement . ",");
            }
        }
    }
    fclose($dataFile);
    fclose($outFile);
?>