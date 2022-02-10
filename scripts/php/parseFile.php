<?php
    $filePath = "../../data/silso/EISN_current.csv";
    $outFilePath = "../../data/silso/EISN_cleaned.csv";
    $outFile = fopen($outFilePath, "w");
    $fileData = file_get_contents($filePath);
    $fileLines = explode(PHP_EOL, $fileData);
    echo 'parse';
    print_r($fileLines);
    $array = array();
    $arrayIndex = 0;
    foreach ($fileLines as $line)
    {
        $data = str_getcsv($line, ',');
        $total = count($data);
        $currentItem = 0;
        foreach($data as $element){
            if (++$currentItem === $total){
                fwrite($outFile, trim($element, ' '));
            }
            else {
                fwrite($outFile, trim($element, ' ') . ',');
            }
        }
    }
    fclose($outFile);
    
?>