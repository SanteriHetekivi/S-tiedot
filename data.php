<?php
	mysqli_data_seek ( $result , NULL );
	while($row = mysqli_fetch_array($result))
	{
		++$counter;
		if ($counter % $two == $zero)
		{
			echo "<tr class='alt'>";
		}
		else
		{
			echo "<tr>";
		}
		echo "<td>" . $row['id'] . "</td>";
		echo "<td>" . $row['laiteid'] . "</td>";
		echo "<td>" . $row['pvm'] . "</td>";
		echo "<td>" . $row['kellonaika'] . "</td>";
		echo "<td>" . $row['tuulennopeus'] . "</td>";
		echo "<td>" . $row['tuulensuunta'] . "</td>";
		echo "<td>" . $row['sademaara'] . "</td>";
		echo "<td>" . $row['sisailmankosteus'] . "</td>";
		echo "<td>" . $row['ulkoilmankosteus'] . "</td>";
		echo "<td>" . $row['ulkolampotila'] . "</td>";
	}
?>