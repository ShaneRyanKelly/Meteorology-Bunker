<?php
	$connection = mysqli_connect('localhost', 'root', '', 'nws');
	if (!$connection)
	{
		die('Not Connected: ' . mysqli_connect_error());
	}
    else if ($connection)
    {
        //echo "NDBC Connected!<br>";
    }
?>