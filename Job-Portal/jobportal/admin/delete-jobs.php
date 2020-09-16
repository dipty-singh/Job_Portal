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
	$sql = "DELETE FROM job_post WHERE id_jobpost = '$_GET[id]'";
	if($conn->query($sql))
	{
		
		header("Location: job-posts.php");
		exit();
	} else
	{
		echo "Error";
	}
}