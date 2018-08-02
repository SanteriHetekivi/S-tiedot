<?php
	include 'values.php';
	$heat = false;
	$freeze = false;
	$storm = false;
	$date = date('Y-m-d');
	$time = date('H:i:s', strtotime('-1 hour'));
	$extreme = mysqli_query($con,"SELECT * FROM $kanta WHERE pvm = '$date' AND kellonaika > '$time'");
	mysqli_data_seek ( $extreme , NULL );
	while($data = mysqli_fetch_array($extreme))
	{
		if ($data['ulkolampotila'] > 25 && $data['ulkolampotila'] != NULL)
		{
			$heat = true;
		}
		if ($data['tuulennopeus'] > 2 && $data['tuulennopeus'] != NULL)
		{
			if ((13.12 + 0.6215 * $data['ulkolampotila'] - 13.9563 * $data['tuulennopeus'] ^ 0.16 + 0.4867 * T * $data['tuulennopeus'] ^ 0.16) < -35 )
			{
				$temp = (13.12 + 0.6215 * $data['ulkolampotila'] - 13.9563 * $data['tuulennopeus'] ^ 0.16 + 0.4867 * T * $data['tuulennopeus'] ^ 0.16);
				$freeze = true;
			}
		}
		else
		{
			if ($data['ulkolampotila'] < -35 && $data['ulkolampotila'] != NULL)
			{
				$freeze = true;
			}
		}
		if ($data['tuulennopeus'] > 20.7 && $data['tuulennopeus'] != NULL)
		{
			$storm = true;
		}
	}
	mysqli_data_seek ( $extreme , NULL );
?>
