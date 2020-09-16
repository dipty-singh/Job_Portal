<?php
session_start();
require_once("db.php");

//if user click register button
if(isset($_POST))
{
	$companyname = mysqli_real_escape_string($conn, $_POST["companyname"]);
	$headofficecity = mysqli_real_escape_string($conn, $_POST["headofficecity"]);
    $contactno = mysqli_real_escape_string($conn, $_POST["contactno"]);
    $website = mysqli_real_escape_string($conn, $_POST["website"]);
	$email = mysqli_real_escape_string($conn, $_POST["email"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);

	//encrypt password
	$password = base64_encode(strrev(md5($password)));

    $sql= "SELECT email FROM company WHERE email= '$email'";
    $result= $conn->query($sql);

    if($result->num_rows == 0)
    {


         $sql= "INSERT INTO company( companyname, headofficecity, contactno, website, email, password) VALUES ('$companyname', '$headofficecity', '$contactno', '$website', '$email', '$password')";

    
         if($conn->query($sql)===TRUE) 
         {
    	     $_SESSION["registercompleted"] = true;
    	     header("Location: company_login.php");
    	     exit();
         }else
         {
    	     echo "Error " .  $sql . "<br>" . $conn->error;    
         }

     }else {

     	$_SESSION['registerError'] = true;
     	header("Location: company_register.php");
	    exit();

     }


}
else 
{
	header("Location: company_register.php");
	exit();
}
