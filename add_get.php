<?php
	if($_REQUEST['device'])
	{
		echo "&device=".$_REQUEST['device'];
	}
	if($_REQUEST['s_date'])
	{
		echo "&s_date=".$_REQUEST['s_date'];
	}
	if($_REQUEST['e_date'])
	{
		echo "&e_date=".$_REQUEST['e_date'];
	}
	if($_REQUEST['all'])
	{
		echo "&all=".$_REQUEST['all'];
	}
	
?>