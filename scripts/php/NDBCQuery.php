<?php
    require("connectNDBC.php");
    $sql = "SELECT `wdir`, `wspd`, `gst`, `wvht`, `dpd`, `apd`, `mwd`, `pres`, `wtmp` FROM `44065` WHERE minute=50 order by timestamp DESC limit 1"; 

    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $connection->close();
    echo json_encode($row);
?>