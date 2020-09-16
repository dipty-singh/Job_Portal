<?php
session_start();
require_once("../db.php");

//if user click register button
if(isset($_POST))
{
	$jobtitle = mysqli_real_escape_string($conn, $_POST["jobtitle"]);
	$jobdescription = mysqli_real_escape_string($conn, $_POST["jobdescription"]);
	$minsalary = mysqli_real_escape_string($conn, $_POST["minsalary"]);
	$maxsalary = mysqli_real_escape_string($conn, $_POST["maxsalary"]);
    $exprequired = mysqli_real_escape_string($conn, $_POST["exprequired"]);
    $qualrequired = mysqli_real_escape_string($conn, $_POST["qualrequired"]);


         $sql= "UPDATE job_post set jobtitle = '$jobtitle' , description= '$jobdescription', minimumsalary = '$minsalary',maximumsalary= '$maxsalary',exprequired =  '$exprequired',qualrequired=  '$qualrequired' WHERE id_jobpost='$_POST[target_id]'";

    
         if($conn->query($sql)===TRUE)
         {
    	     $_SESSION['jobUpdateSuccess'] = true;
    	     header("Location: dashboard.php");
    	     exit();
         }else
         {
    	     echo "Error " .  $sql . "<br>" . $conn->error;    
         }
    $conn-> close();
}
else 
{
	header("Location: register.php");
	exit();
}
