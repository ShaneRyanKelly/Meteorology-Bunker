<?php
    require("connectSILSO.php");

    // $sql = "SELECT sspotnum FROM `eisn` WHERE month='" . date("m") . "' AND day='" . date("d") . "'"; 
    $sql = "SELECT sspotnum FROM `eisn` ORDER BY datekey DESC LIMIT 1"; 

    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    echo $row["sspotnum"];
    $connection->close();
?>