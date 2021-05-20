  <?php  
  $uname = $sid = '';
  session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
}
  if (isset($_SESSION['username'])){

$uname =  $_SESSION['username']; 
$sid =  $_SESSION['id'];

}


if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
}
?>

<?php 

require_once "config.php";

$sql = "SELECT * FROM coviddetails WHERE Email = '$sid'";
$retval = mysqli_query( $link, $sql);
 
if(! $retval ) {
  die('Could not get data: ' . mysql_error());
}
 
while($row = mysqli_fetch_assoc($retval)) {
      $resultset = $row;
   }

?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>Incentivised Tech Bin</title>
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>


 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
 


  <link rel="import" type="css" href="podium-chart.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://use.fontawesome.com/7e620112a0.js"></script>

  </head>
  

<!-- ========================================================================================================= -->

  <body class="pt-2">
<!-- =================== -->
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid  ">

    <div class="navbar-header">
      <a class="navbar-brand" href="#">Covid Vaccination Drive</a>
      <!-- <h6 class=" navbar-text d-inline-flex  ">Welcome : <?php echo $uname ?> </h6> -->
    </div>

    <div class="navbar-nav mr-auto">
   

    </div>

    <div class="nav navbar-right">
      <li class="nav-item dropdown">
        <div class="dropdown-content">
          <ul class="nav navbar-nav">

        <a class="nav-item nav-link mx-5"> <h5>Welcome : <?php echo $uname ?> </h5> </a>

      </ul>

            <li><a class="dropdown-item active " href="logout.php">Log Out</a></li>
      </div>
      </li>
    </div>
    
    </div>

</nav>

<!-- ========================= -->
<!-- Navbar -->

<div class="row">

<div class="col-md-4" > </div>


<div class="col-md-4 mt-5 border border-success rounded">
      <div class="align-middle ">
        <h2 class="text-success text-center">Registration Success</h2>
        <div class="mt-2 border-top border-success">
          
          <div class="row">
             <div class="col-sm-4 ">
               Name : 
             </div>
             <div class="col-sm-6 ">
               <?php echo $uname ?>
             </div>
          </div>

           <div class="row">
             <div class="col-sm-4 ">
               Gender : 
             </div>
             <div class="col-sm-6 ">
               <?php echo $resultset['gndr'] ?>
             </div>
          </div>

          <div class="row">
             <div class="col-sm-4 ">
               Age : 
             </div>
             <div class="col-sm-6">
               <?php echo $resultset['age'] ?>
             </div>
          </div>

          <div class="row">
             <div class="col-sm-4 ">
               Weight : 
             </div>
             <div class="col-sm-6 ">
               <?php echo $resultset['weight'] ?>
             </div>
          </div>

          <div class="row">
             <div class="col-sm-4">
               Blood Group : 
             </div>
             <div class="col-sm-6 ">
               <?php echo $resultset['bgrp'] ?>
             </div>
          </div>

          <div class="row">
             <div class="col-sm-4 ">
               Mobile Number : 
             </div>
             <div class="col-sm-6 ">
               <?php echo $resultset['mobno'] ?>
             </div>
          </div>

           <div class="row">
             <div class="col-sm-4 ">
               Address : 
             </div>
             <div class="col-sm-6 ">
               <?php echo $resultset['addr'] ?>
             </div>
          </div>




        </div>
      </div>
</div>

</div>





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
  </html>