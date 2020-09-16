<?php
session_start();
require_once("db.php");

//if user click register button
if(isset($_POST))
{
	$firstname = mysqli_real_escape_string($conn, $_POST["fname"]);
	$lastname = mysqli_real_escape_string($conn, $_POST["lname"]);
	$email = mysqli_real_escape_string($conn, $_POST["email"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);

	//encrypt password
	$password = base64_encode(strrev(md5($password)));

    $sql= "SELECT email FROM users WHERE email= '$email'";
    $result= $conn->query($sql);

    if($result->num_rows == 0)
    {
         $bytes = openssl_random_pseudo_bytes(32);
         $hash = base64_encode($bytes);

         $sql= "INSERT INTO users( firstname, lastname, email, password,hash) VALUES ('$firstname', '$lastname', '$email', '$password', '$hash')";

    
         if($conn->query($sql)===TRUE) 
         {
            //$to = $email;

            //$subject= "Job Portal. Confirm your Email Address";

            //$message = '

            //<html>
            //<head>
            //<title> Confirm Your Email </title>
            //</head>
            //<body>
            //<p> Click Link To Confirm </p>
            //<a href= "www.yourdomain.com/>Verify Email Here</a>
            //</body>
            //</html>verify.php?token= ' .$hash. '&email= '.$email.'"
            //';
            //$headers[] = 'MIME-VERSION: 1.0';
            //$headers[] = 'Content-type: text/html; charset= iso-8859-1';
            //$headers[] = 'To: '.$to;
            //$headers[] = 'From: yourdomain@domain.com';

            //$result  = mail($to, $subject, $message, inplode("\r\n", $headers));

            //if($result === TRUE){
                     //$_SESSION["registercompleted"] = true;
                     //header("Location: login.php");
                     //exit();


            //} 



    	     $_SESSION["registercompleted"] = $hash = urlencode($hash);
    	     header("Location: login.php");
    	     exit();
         }else
         {
    	     echo "Error " .  $sql . "<br>" . $conn->error;    
         }

     }else {

     	$_SESSION['registerError'] = true;
     	header("Location: register.php");
	    exit();

     }


}
else 
{
	header("Location: register.php");
	exit();
}
