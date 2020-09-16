<?php
session_start();
if(empty($_SESSION['id_user']))
{
	header("Location: ../index.php");
	exit();
}
require_once("../db.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Job Portal</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <header>
      <nav class="navbar navbar-default">
      <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded=" false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="../index.php">Job Portal</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
      	<li> <a href= "profile.php"> Profile </a></li>
        <li><a href="../logout.php">Log Out</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    </header>

    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">Generate Resume</div>
              <div class="panel-body">
              <form class="form-horizontal" method="post" action="generate-resume-data.php">
                <h3> Personal Details </h3>
                <div class="form-group">
                  <label class="col-md-4 control-label">Name</label>
                  <div class="col-md-6">
                    <input type="text" name="name" class="form-control" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Address</label>
                  <div class="col-md-6">
                    <input type="text" name="address" class="form-control" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Phone</label>
                  <div class="col-md-6">
                    <input type="text" name="phone" class="form-control" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Email</label>
                  <div class="col-md-6">
                    <input type="text" name="email" class="form-control" required="">
                  </div>
                </div>
                <h3>Experinece Section</h3>

                <div class="form-group">
                  <label class="col-md-4 control-label">Number of company you want to add your experince</label>
                  <div class="col-md-6">
                    <select name="experinceNo" class="form-control" id="experinceNo" required="">
                      <option>Select Value</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                </div>
                    <div id="experinecesection"></div>
                  <div class="form-group">
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Generate</button>
                  </div>
                </div>
                    
                
              </form>
            </div>
          </div>
        </div>
        
      </div>
    </div>

        



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
      $("#experinceNo").on("change",function(){
        var numInputs - $(this).val();
        $("#experinecesection").html('');
        for(var i=0; i<numInputs; i++){
          var j= i + 1;
          $("#experinecesection").append('<div class= "form-group"><label class= "col-md-4 control-label">Company Name' + j + '</label><div class = "col-md-6"><input type= "text" name= "companyname[]" class= "form-control" required></div></div><div class= "form-group"><label class= "col-md-4 control-label">Location ' + j +'</label><div class= "col-md-6"><input type= "text" name= "location[]" class="form-control" required></div></div><div class = "form-group"><label class= "col-md-4 control-label">Time Period')
        }
      })
    </script>
  </body>
</html>