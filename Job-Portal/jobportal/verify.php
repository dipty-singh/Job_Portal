<?php
session_start();
require_once("db.php");

//if user click register button
if(isset($_GET))
{
	$hash = urldecode("Ixe7nefO8UiBwyNdk+DgyA3NVZ15LLo6R9QgoiWtL1o=");
	echo $hash;
	$email = mysqli_real_escape_string($conn, $_GET['email']);
	

    $sql= "SELECT email FROM users WHERE email= '$email' AND hash= '$hash'";
    $result= $conn->query($sql);

    if($result->num_rows > 0)
    {
    	$row = $result->fetch_assoc();
    	if($row['active']== '1'){
    		echo 'You have already activated your account';
    	}else{
    		    $sql1= "UPDATE users SET active='1' WHERE email= '$email' AND hash= '$hash'";
    		    if($conn->query($sql1)){
    		    	$_SESSION['userActivated']= true;
    		    	header("Location: login.php");
    		    	exit();
    		    }
    	}
    }else{
    	echo'Token Mismatch';

    }
}
