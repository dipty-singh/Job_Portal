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

      <?php if(isset($_SESSION['jobApplySuccess']))
      { ?>
      <div class="row">
        <div class="col-md-12">
          <alert class="alert-success">
          You Have Successfully Applied!!
        </alert>
        </div>
      </div>
      <?php unset($_SESSION['jobApplySuccess']); } ?>


      <!--Other Functions-->
      <div class="row">
        <h2 class="text-center"> My Dashboard </h2>
        <div class="col-md-2">
          <a href="applied_jobs.php" class="btn btn-success"> Applied Jobs </a> 

        </div>
        <div class="col-md-2">
          <a href="" class="btn btn-success"> My Resume </a> 

        </div>
      </div>

        <!--Search And Apply To Job Posts-->
        <div class="row">

          <div class="col-md-12">
            <div class="table responsive">
            <h2 class="text-center"> Active Job Posts </h2>
             <table class="table table-striped">
              <thead>
            <th> Job Name</th>
            <th> Job Description </th>
            <th> Minimum Salary </th>
            <th> Maximum Salary </th>
            <th> Experience Required </th>
            <th> Qualification </th>
            <th> Created At </th>
            <th> Action </th>
          </thead>
          <tbody>
            <?php
            $sql= "SELECT * FROM job_post";
            $result= $conn->query($sql);

           if($result->num_rows > 0)
            {
               while($row = $result->fetch_assoc())
               {
                  $sql1= "SELECT * FROM apply_job WHERE id_user= '$_SESSION[id_user]' AND id_jobpost= '$row[id_jobpost]'";
                  $result1= $conn->query($sql1);
           
           ?>
           <tr>
            <td> <?php echo $row['jobtitle']; ?> </td>
            <td> <?php echo $row['description']; ?> </td>
            <td> <?php echo $row['minimumsalary']; ?> </td>
            <td> <?php echo $row['maximumsalary']; ?> </td>
            <td> <?php echo $row['exprequired']; ?> </td>
            <td> <?php echo $row['qualrequired']; ?> </td>
            <td> <?php echo date("d-M-Y", strtotime($row['createdAt'])); ?> </td>
            <?php
            if($result1->num_rows > 0)
            {
              ?> 
              <td> <strong> Applied </strong>  </td>
              <?php
            }
            else {
              ?>
              <td> <a href="apply_job.php? id= <?php echo $row['id_jobpost']; ?>"> Apply </a>  </td>

              <?php } ?>
            
          </tr>
        <?php
       }
    }

    $conn->close();

  ?>
          </tbody> 
        </table>
      </div>



        </div>
      </div>
    </div>







    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>