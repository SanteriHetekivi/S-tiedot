<!DOCTYPE html>
<html>
<meta charset="ISO-8859-1">
<link rel="stylesheet" type="text/css" href="style.css">
	<head>
		<title>Säätiedot</title>
		<?php
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$s_date = $_GET['s_date'];
		$e_date = $_GET['e_date'];
		$device = "AND laiteid = " . $_GET['device'];
		$sort = $_GET['Sort'];
		$by = $_GET['By'];
		$all = $_GET['all'];
		if (empty($e_date))
		{
			$e_date = date('Y-m-d');
		}
		if (empty($s_date))
		{
			if($all == true)
			{
				$s_date = 0000-00-00;
			}
			else
			{
				$s_date = date('Y-m-d', strtotime('-7 day'));
			}
		}
		if (empty($_REQUEST['device']))
		{
			$device = '';
		}
		if (empty($sort))
		{
			$sort = 'id';
		}
		if (empty($by))
		{
			$by = 'DESC';
		}
		include 'values.php';
		$result = mysqli_query($con,"SELECT * FROM $kanta WHERE pvm >= '$s_date' AND pvm <= '$e_date' $device ORDER BY $sort $by;");
		mysqli_close($con);
		?>
	</head>
	<body>
		<form action='index.php' method='get'>
			<select name = 'device'>
			<option value=''> Kaikki</option>
			<?php
				while($row = mysqli_fetch_array($devices))
				{
				if ($_GET['device'] == $row['laiteid'] )
				{
					$default = "selected";
				}
				else
				{
					$default = "";
				}
					echo "<option value = '" . $row['laiteid'] . "' ". $default ."> Laite " .  $row['laiteid']. "</option>";
				}
			?>
			<input type='submit' value='Submit'>
		</form>
		<?php echo $temp3; ?>
		<h1>Tilastotiedot</h1>
		<table class='Tilastotietoja'>
			<tr>
				<td></td>
				<td>Keskiarvo</td>
				<td>Min</td>
				<td>Max</td>
			</tr>
			<tr>
				<td class='info'>Lämpötila:</td>
				<td><?php echo number_format($data['AVG(ulkolampotila)'],2); ?></td>
				<td><?php echo $data['MIN(ulkolampotila)'];?> </td>
				<td><?php echo $data['MAX(ulkolampotila)']; ?> </td>
			</tr>
			<tr>
				<td class='info'>Tuulensuunta:</td>
				<td> <?php echo number_format($data['AVG(tuulensuunta)'],2); ?> </td>
				<td> <?php echo $data['MIN(tuulensuunta)']; ?> </td>
				<td> <?php echo $data['MAX(tuulensuunta)']; ?> </td>
			</tr>
			<tr>
				<td class='info'>Tuulennopeus:</td>
				<td> <?php echo number_format($data['AVG(tuulennopeus)'],2); ?> </td>
				<td> <?php echo $data['MIN(tuulennopeus)']; ?> </td>
				<td> <?php echo $data['MAX(tuulennopeus)']; ?> </td>
			</tr>
			<tr>
				<td class='info'>Sademäärä:</td>
				<td> <?php echo number_format($data['AVG(sademaara)'],2); ?> </td>
				<td> <?php echo $data['MIN(sademaara)']; ?> </td>
				<td> <?php echo $data['MAX(sademaara)']; ?> </td>
			</tr>
			<tr>
				<td class='info'>Sisäilmankosteus:</td>
				<td> <?php echo number_format($data['AVG(sisailmankosteus)'],2); ?> </td>
				<td> <?php echo $data['MIN(sisailmankosteus)']; ?> </td>
				<td> <?php echo $data['MAX(sisailmankosteus)']; ?> </td>
			</tr>
			<tr>
				<td class='info'>Ulkoilmankosteus:</td>
				<td> <?php echo number_format($data['AVG(ulkoilmankosteus)'],2); ?> </td>
				<td> <?php echo $data['MIN(ulkoilmankosteus)']; ?> </td>
				<td> <?php echo $data['MAX(ulkoilmankosteus)']; ?> </td>
			</tr>
		</table>
		<BR><BR>
		<table class = 'warnings'>
			<tr>
				<th>Varoitukset:</th>
			</tr>
			<tr>
				<th
				<?php
					include 'extremes.php';
					if ($heat == true)
					{
						echo "class = 'warning'";
					}
					else
					{
						echo " hidden ";
					}
				?>
				>Helle</th>
				<th				
				<?php
					if ($storm == true)
					{
						echo "class = 'warning'";
					}
					else
					{
						echo " hidden ";
					}
				?>
				>Myrskyvaroitus</th> 
				<th
				<?php
					if ($freeze == true)
					{
						echo "class = 'warning'";
					}
					else
					{
						echo " hidden ";
					}
				?>
				>Paleltumisvaara</th>
			</tr>
		</table>
		<BR><BR><BR>
		<form action='index.php' method='get'>
		Ajanjakso:
			<input type='date' name='s_date' value = <?php echo $s_date; ?>></input>
			 - 
			<input type='date' name='e_date' value = <?php echo $e_date; ?>></input>
			<input type="hidden" name = device value = <?php echo $_GET['device']; ?>>
			<input type="hidden" name = Sort value = <?php echo $_GET['Sort']; ?>>
			<input type="hidden" name = By value = <?php echo $_GET['By']; ?>>
			<input type="hidden" name = all value = <?php echo $_GET['all']; ?>>
			<input input type='submit' value='Submit'>
		</form>
		<table class = 'weather'>
			<tr>
				<th><a href="?Sort=id&By=
				<?php 
					if($_GET['By'] == 'ASC' && $_GET['Sort'] == 'id') { echo "DESC"; }
					else  { echo "ASC"; }
					include 'add_get.php';
				?>
				">Id</a></th>
				<th><a href="?Sort=laiteid&By=
				<?php 
					if($_GET['By'] == 'ASC' && $_GET['Sort'] == 'laiteid')	{ echo "DESC"; }
					else { echo "ASC"; }
					include 'add_get.php';
				?>
				">Laiteid</a></th>
				<th><a href="?Sort=pvm&By=
				<?php 
					if($_GET['By'] == 'ASC' && $_GET['Sort'] == 'pvm') { echo "DESC"; }
					else { echo "ASC"; }
					include 'add_get.php';
				?>
				">Päivämäärä</a></th>	
				<th><a href="?Sort=kellonaika&By=
				<?php 
					if($_GET['By'] == 'ASC' && $_GET['Sort'] == 'kellonaika') {	echo "DESC"; }
					else { echo "ASC"; }
					include 'add_get.php';
				?>
				">Kellonaika</a></th>
				<th><a href="?Sort=tuulennopeus&By=
				<?php 
					if($_GET['By'] == 'ASC' && $_GET['Sort'] == 'tuulennopeus') { echo "DESC"; }
					else { echo "ASC"; }
					include 'add_get.php';
				?>
				">Tuulennopeus</a></th>
				<th><a href="?Sort=tuulensuunta&By=
				<?php 
					if($_GET['By'] == 'ASC' && $_GET['Sort'] == 'tuulensuunta') { echo "DESC"; }
					else { echo "ASC"; }
					include 'add_get.php';
				?>
				">Tuulensuunta</a></th>
				<th><a href="?Sort=sademaara&By=
				<?php 
					if($_GET['By'] == 'ASC' && $_GET['Sort'] == 'sademaara') { echo "DESC"; }
					else { echo "ASC"; }
					include 'add_get.php';
				?>
				">Sademäärä</a></th>
				<th><a href="?Sort=sisailmankosteus&By=
				<?php 
					if($_GET['By'] == 'ASC' && $_GET['Sort'] == 'sisailmankosteus')	{ echo "DESC"; }
					else { echo "ASC"; }
					include 'add_get.php';
				?>
				">Sisäilmankosteus</a></th>
				<th><a href="?Sort=ulkoilmankosteus&By=
				<?php 
					if($_GET['By'] == 'ASC' && $_GET['Sort'] == 'ulkoilmankosteus') { echo "DESC"; }
					else { echo "ASC"; }
					include 'add_get.php';
				?>
				">Ulkoilmankosteus</a></th>
				<th><a href="?Sort=ulkolampotila&By=
				<?php 
					if($_GET['By'] == 'ASC' && $_GET['Sort'] == 'ulkolampotila' ) { echo "DESC"; }
					else { echo "ASC"; }
					include 'add_get.php';
				?>
				">Ulkolampotila</a></th>
			</tr>
			<?php
				include'data.php';
			?>		
		</table>
		<BR>
		<a href="?all=true">Kaikkien aikojen tiedot</a>
		<BR><BR>
		<footer>Tampere University of Applied Sciences: Santeri Hetekivi  (1202466) </footer>
	</body>
</html>
