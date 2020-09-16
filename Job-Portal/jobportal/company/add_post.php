<?php
session_start();
require_once("../db.php");

//if user click register button
if(isset($_POST))
{
    $companyname= mysqli_real_escape_string($conn, $_POST["companyname"]);
	$jobtitle = mysqli_real_escape_string($conn, $_POST["jobtitle"]);
	$jobdescription = mysqli_real_escape_string($conn, $_POST["jobdescription"]);
	$minsalary = mysqli_real_escape_string($conn, $_POST["minsalary"]);
	$maxsalary = mysqli_real_escape_string($conn, $_POST["maxsalary"]);
    $exprequired = mysqli_real_escape_string($conn, $_POST["exprequired"]);
    $qualrequired = mysqli_real_escape_string($conn, $_POST["qualrequired"]);


         $sql= "INSERT INTO job_post(id_company,company_name, jobtitle, description, minimumsalary, maximumsalary,exprequired,qualrequired) VALUES ('$_SESSION[id_user]','$companyname', '$jobtitle', '$jobdescription', '$minsalary', '$maxsalary', '$exprequired', '$qualrequired')";

    
         if($conn->query($sql)===TRUE)
         {
    	     $_SESSION['jobPostSuccess'] = true;
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
