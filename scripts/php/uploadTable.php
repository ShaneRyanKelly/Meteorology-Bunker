<?php
    require("connectNDBC.php");

    $sql = "LOAD DATA INFILE 'D:/xampp/htdocs/sunspot/data/ndbc/44065_clean.csv' 
    INTO TABLE `44065` FIELDS TERMINATED BY ','"; 

    if ($connection->query($sql) === TRUE){
        echo "Upload Success<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
    $connection->close();
?>