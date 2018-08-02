<?php
	//$kanta = 'saatiedot';
	//$con=mysqli_connect("mydb.tamk.fi","e2shetek","Dofzk30k","dbe2shetek1");
	$kanta = 'b1_ict_saa';
	$con = mysqli_connect("mydb.tamk.fi","poypek","Keke1234","dbpoypek3");
	$devices = mysqli_query($con, "SELECT DISTINCT laiteid FROM $kanta ORDER BY laiteid ASC;");
	$data_connect = mysqli_query($con, "SELECT MIN(tuulennopeus),MIN(tuulensuunta),MIN(sademaara),MIN(sisailmankosteus),MIN(ulkoilmankosteus),MIN(ulkolampotila),
								MAX(tuulennopeus),MAX(tuulensuunta),MAX(sademaara),MAX(sisailmankosteus),MAX(ulkoilmankosteus),MAX(ulkolampotila),
								AVG(tuulennopeus),AVG(tuulensuunta),AVG(sademaara),AVG(sisailmankosteus),AVG(ulkoilmankosteus),AVG(ulkolampotila)
								FROM $kanta WHERE pvm >= '$s_date' AND pvm <= '$e_date' $device ORDER BY $sort $by;");
	$data = mysqli_fetch_array($data_connect);
	$zero = 0;
	$two = 2;
	$high_no = 99999;
	$counter = $zero;
?>
