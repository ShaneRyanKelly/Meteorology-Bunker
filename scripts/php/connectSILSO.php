<?php
	$connection = mysqli_connect('localhost', 'root', '', 'silso');
	if (!$connection)
	{
		die('Not Connected: ' . mysqli_connect_error());
	}
    else if ($connection)
    {
        // echo "Mysql Connected!<br>";
    }
?>