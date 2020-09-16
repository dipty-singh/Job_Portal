<?php

//To Handle Session Variables on This Page
session_start();


//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Job Portal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="css/custom.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

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
        <li><a href="admin/indexadmin.php">Admin</a></li>
        <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    </header>

    
   <section class="content-header bg-main" style=" height: 300px; ">
          <div class="col-md-12 text-center index-head" style="background-image: url(images/theme.jpg); height: 500px;" >
            <h1 style="color: white; margin-top: 0px;">All <strong>JOBS</strong> In One Place</h1>
            <p style="color: white;">One search, global reach</p>
            <p><a class="btn btn-success btn-lg" href="search.php" role="button">Search Jobs</a></p>
          </div>
    </section>
<!--LATEST JOB POST -->
    <section class="content-header">
      <div class="container" style="margin-top: 20px;">
       <div class="col-md-12 latest-job margin-bottom-20">
            <h1 class="text-center">Latest Jobs</h1>            
            <?php 
            $sql= "SELECT * FROM job_post Order By Rand() Limit 4";
            $result= $conn->query($sql);
            if($result->num_rows > 0)
            {
               while($row = $result->fetch_assoc())
               {

             ?>
           <div class="attachment-block clearfix">
            <img class="attachment-img" src="image/job.jpg" alt="Attachment Image">
            <div class="attachment-pushed">
              <h5 class="attachment-heading"><a href="user/apply_job.php? id= <?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle'];?></a> <span class="attachment-heading pull-right"><?php echo $row['maximumsalary'];?>/Month</span></h5>
              <div class="attachment-text">
                <div><strong><?php echo $row['company_name'];?> | <?php echo $row['exprequired'];?></strong></div>
                <?php echo $row['description'];?>
              </div>
           </div>
         </div>
           
        <?php 
         }
        }
        ?>
      </div>
    </div>
    </section>
    
    <!--COMPANIES LIST-->
    <!--<section>
      <div class="container">
        <div class="row">
          <h2 class="text-center"> Companies List </h2>
          <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
            <img src="..." alt="...">
           </a>
          </div>
          <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
               <img src="..." alt="...">
            </a>
         </div>
         <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
               <img src="..." alt="...">
            </a>
         </div>
         <div class="col-xs-6 col-md-3">
           <a href="#" class="thumbnail">
              <img src="..." alt="...">
           </a>
          </div>
        </div>
      </div>
      
    </section>-->
    <section id="company" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1 style="font-size: 30pt;">Companies</h1>
            <p>Hiring? Register your company for free, browse our talented pool, post and track job applications</p>            
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail company-img">
              <img src="images/postjob.png" alt="Browse Jobs" width="200" height="200">
              <div class="caption">
                <h3 class="text-center">Post A Job</h3>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail company-img">
              <img src="images/manage.jpg" alt="Apply & Get Interviewed" width="280" height="250">
              <div class="caption">
                <h3 class="text-center">Manage & Track</h3>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail company-img">
              <img src="images/hire.png" alt="Start A Career" width="400" height="200">
              <div class="caption">
                <h3 class="text-center">Hire</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="statistics" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1>Our Statistics</h1>
          </div>
        </div>
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
             <?php
                      $sql = "SELECT * FROM job_post";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>Job Offers</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
                  <?php
                      $sql = "SELECT * FROM company WHERE active='1'";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>Registered Company</p>
            </div>
            <div class="icon">
                <i class="ion ion-briefcase"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
             <?php
                      $sql = "SELECT * FROM users WHERE resume!=''";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>CV'S/Resume</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-list"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
               <?php
                      $sql = "SELECT * FROM users WHERE active='1'";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>Daily Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      </div>
    </section>



     <section id="about" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1 style="font-size: 30pt;">About US</h1>                      
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <img src="images/browse.jpg" class="img-responsive">
          </div>
          <div class="col-md-6 about-text margin-bottom-20">
            <p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipisicing <p style="text-align: justify;">The online job portal application allows job seekers and recruiters to connect.The application provides the ability for job seekers to create their accounts, upload their profile and resume, search for jobs, apply for jobs, view different job openings. The application provides the ability for companies to create their accounts, search candidates, create job postings, and view candidates applications.
            </p>
            <p style="text-align: justify;">
              This website is used to provide a platform for potential candidates to get their dream job and excel in yheir career.
              This site can be used as a paving path for both companies and job-seekers for a better life .
              
            </p>
          </div>
        </div>
      </div>
    </section>
    <footer class="main-footer" style="margin-left: 0px; margin-top: 30px;" >
    <div class="text-center">
      <strong>Copyright &copy; 2016-2017 <a href="learningfromscratch.online">Job Portal</a>.</strong> All rights
    reserved.
    </div>
  </footer>








    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript">
      
      $(function(){
        var maxHeight = 0;
        $(".fixHeight").each(function(){
          maxHeight = ($(this).height() > maxHeight ? $(this).height() : maxHeight);
        });
        $(".fixHeight").height(maxHeight);
      });
    </script>
  </body>
</html>