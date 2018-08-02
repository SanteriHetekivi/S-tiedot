<?php
//http://home.tamk.fi/~e2shetek/saatiedot/lisaa.php?laiteid=2&tuulennopeus=65&tuulensuunta=4&sademaara=12&sisailmankosteus=89&ulkoilmankosteus=45&ulkolampotila=-35
	$con=mysqli_connect("mydb.tamk.fi","e2shetek","Dofzk30k","dbe2shetek1");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		//Mittalaiteid
		if(isset($_GET['laiteid']))
		{
			$mittalaiteid = $_GET['laiteid'];
		}
		else
		{
			$mittalaiteid = 'NULL';
		}
		//Paivamaara
		$paivamaara = date('Y-m-d');
		//Kellonaika
		$kellonaika = date('H:i:s');
		//Tuulennopeus
		if(isset($_GET['tuulennopeus']))
		{
			$tuulennopeus = $_GET['tuulennopeus'];
		}
		else
		{
			$tuulennopeus = 'NULL';
		}
		//Tuulensuunta
		if(isset($_GET['tuulensuunta']))
		{
			$tuulensuunta = $_GET['tuulensuunta'];
		}
		else
		{
			$tuulensuunta = 'NULL';
		}
		//Sademaara
		if(isset($_GET['sademaara']))
		{
			$sademaara = $_GET['sademaara'];
		}
		else
		{
			$sademaara = 'NULL';
		}
		//Sisailmankosteus
		if(isset($_GET['sisailmankosteus']))
		{
			$sisailmankosteus = $_GET['sisailmankosteus'];
		}
		else
		{
			$sisailmankosteus = 'NULL';
		}
		//Ulkoilmankosteus
		if(isset($_GET['ulkoilmankosteus']))
		{
			$ulkoilmankosteus = $_GET['ulkoilmankosteus'];
		}
		else
		{
			$ulkoilmankosteus = 'NULL';
		}
		//Ulkolampotila
		if(isset($_GET['ulkolampotila']))
		{
			$ulkolampotila = $_GET['ulkolampotila'];
		}
		else
		{
			$ulkolampotila = 'NULL';
		}
		$sql = "insert into saatiedot values (NULL, $mittalaiteid, '$paivamaara', '$kellonaika', $tuulennopeus, $tuulensuunta, $sademaara, $sisailmankosteus, $ulkoilmankosteus, $ulkolampotila)";
		echo $sql;
		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));
		}
?>