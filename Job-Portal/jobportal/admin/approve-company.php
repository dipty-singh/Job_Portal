<?php

session_start();
if(empty($_SESSION['id_admin']))
{
	header("Location: indexadmin.php");
	exit();
}

require_once("../db.php");
if(isset($_GET))
{
	$sql = "UPDATE company SET active = '1' WHERE id_company= '$_GET[id]'";
	if($conn->query($sql))
	{
		header("Location: dashboard.php");
		exit();
	} else
	{
		echo "Error";
	}
}