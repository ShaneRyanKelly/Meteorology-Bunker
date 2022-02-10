<?php
    $remote = 'https://wwwbis.sidc.be/silso/DATA/EISN/EISN_current.csv';
    $local = '../../data/silso/EISN_current.csv';
    
    if (file_put_contents($local, file_get_contents($remote)))
    {
        echo "SILSO data retreived";
    }
    else
    {
        echo "Data retreival failed";
    }
?>
