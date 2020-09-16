<?php
session_start();
require_once("db.php");

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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

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
      <a class="navbar-brand" href="index.php">Job Portal</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <?php
           if(isset($_SESSION['id_user']) && empty($_SESSION['companyLogged']))
        
           {
         ?>
              <li><a href="user/dashboard.php">Dashboard</a></li>
              <li><a href="logout.php">LogOut</a></li>
              <?php 
            } else if(isset($_SESSION['id_user']) && isset($_SESSION['companyLogged']))
            {
              ?>
              <li><a href="company/dashboard.php">Dashboard</a></li>
              <li><a href="logout.php">LogOut</a></li>
        <?php

           } else{ ?>
        <li><a href="company.php">Company</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
        <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    </header>
    <section>
         <div class="container-fluid" style="background-image: url(images/job.jpg); height: 400px;" >
             <div class="row">
            <div class=" text-center" style="margin-top: 150px;">
             <h1 style="color: #fff; font-size: 50pt;" >Search Job</h1>
            <p style="color: #fff; font-size: 20pt;">Find Your Dream Job</p>
            <!--<p><a class="btn btn-primary btn-lg" href="register.php" role="button">Register</a></p>-->
            <!--<p><a class="btn btn-primary btn-lg" href="search.php" role="button">Search Job</a></p>-->
          </div>
        
        </div>
      </div>
    </section>
    <!--LATEST JOB POST -->
    <section>
      <div class="container">

        <div class="row">
          <div class="col-md-12">
            <form id="myForm" class="form-inline">
              <div class="form-group">
                <label> Experience </label>
                <select id="experience" class="form-control">
                  <option value="" selected="">Select Experience</option>
                  <option value="1 year"> 1 Year</option>
                  <option value="2 year"> 2 Year</option>
                  <option value="3 year"> 3 Year</option>
                  <option value="4 year"> 4 Year</option>
                  <option value="5 year"> 5 Year</option>
                </select>
              </div>

           
              <div class="form-group">
                <label> Qualification </label>
                <select id="qualification" class="form-control">
                  <option value="" selected="">Select Qualification</option>
                  <?php
                   $sql = "SELECT DISTINCT(qualrequired) FROM job_post WHERE qualrequired IS NOT NULL";
                   $result = $conn -> query($sql);
                   if($result ->num_rows >0)
                   {
                    while ($row = $result ->fetch_assoc())
                     {
                         echo "<option value'".$row ['qualrequired']."'>".$row['qualrequired']."</option>";
                    }
                   }
                   ?>
                  
                </select>
              </div>
              <button class="btn btn-success">Search</button>

            </form>
          </div>
        </div>

        <div class="row" style="margin-top: 5%;">
          <div class="table-responsive">
            <table id="datatable" class="table">
              <thead>
            <th> Job Name</th>
            <th> Job Description </th>
            <th> Minimum Salary </th>
            <th> Maximum Salary </th>
            <th> Experience Required </th>
            <th> Qualification </th>
            <th> Action </th>
          </thead>
          <tbody>
         </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
   





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
      $(function() 
      {
        var oTable = $('#datatable').DataTable({
          "autoWidth": false,

          "ajax" : {
            "url" : "refresh_job_search.php",
            "dataSrc" : "",
            "data" : function(d)
            {
              d.experience = $("#experience").val();
              d.qualification = $("#qualification").val();
            }

          }
        });
        $("#myForm").on("submit", function(e){
          e.preventDefault();
          oTable.ajax.reload(null,false);
        })
      });

      
   </script>

  </body>
</html>