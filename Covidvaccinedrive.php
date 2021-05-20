<?php
// Include config file
require_once "config.php";

$uname = $sid = '';
  session_start();
if (!isset($_SESSION['loggedin'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: index.php');
}
  if (isset($_SESSION['username'])){

$email =  $_SESSION['id'];

$sql = "SELECT email FROM coviddetails WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $loggedin_err = "This User is already registered.";
                    
                    echo "<script>alert('$loggedin_err');
                    window.location.href='success.php';
                    </script>";

                } 
            } else{
                echo "Oops! Something went wrong in username. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }


                    
}
// Define variables and initialize with empty values
$fname = $lname = $age = $weight= $bgrp= $gndr = $mobno = $addr   = "";
$insert_error = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(empty(trim($_POST["fname"]))){
        $insert_error = "Please enter a First name.";
    } else{
		$fname = trim($_POST["fname"]);
	}

	if(empty(trim($_POST["lname"]))){
        $insert_error = "Please enter a Last name.";
    } else{
		$lname = trim($_POST["lname"]);
	}

	if(empty(trim($_POST["age"]))){
        $insert_error = "Please enter a first name.";
    } else{
		$age = trim($_POST["age"]);
	}

	if(empty(trim($_POST["weight"]))){
        $insert_error = "Please enter a first name.";
    } else{
		$weight = trim($_POST["weight"]);
	}

	if(empty(trim($_POST["bgrp"]))){
        $insert_error = "Please enter a first name.";
    } else{
		$bgrp = trim($_POST["bgrp"]);
	}

	if(empty(trim($_POST["gndr"]))){
        $insert_error = "Please enter a first name.";
    } else{
		$gndr = trim($_POST["gndr"]);
	}

	if(empty(trim($_POST["mobno"]))){
        $insert_error = "Please enter a first name.";
    } else{
		$mobno = trim($_POST["mobno"]);
	}

	if(empty(trim($_POST["addr"]))){
        $insert_error = "Please enter a first name.";
    } else{
		$addr = trim($_POST["addr"]);
	}
    
    if(empty($email)){
        $loggedin_err = "Not loggedin";
    } else{
        // Prepare a select statement
        $sql = "SELECT email FROM coviddetails WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $loggedin_err = "This User is already registered.";
                    
                    echo "<script>alert('$loggedin_err');
                    window.location.href='success.php';
                    </script>";

                } 
            } else{
                echo "Oops! Something went wrong in username. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    

    
    // Check input errors before inserting in database
    if(empty($insert_error)){
    		$param_fname = $fname;
			$param_lname = $lname;
			$param_age = $age;
			$param_weight = $weight;
			$param_bgrp = $bgrp;
			$param_gndr = $gndr;
			$param_mobno = $mobno;
			$param_addr = $addr;



        
        // Prepare an insert statement
        $sql = "INSERT INTO coviddetails(fname,lname,age,weight,bgrp,gndr,mobno,addr,Email) VALUES ('$param_fname','$param_lname','$param_age','$param_weight','$param_bgrp','$param_gndr','$param_mobno','$param_addr','$email')";
       // $sql = "UPDATE covidDetails SET fname =  $param_fname,lname =  $param_lname,age=  $param_age,weight=  $param_weight,bgrp=  $param_bgrp,gndr=  $param_gndr,mobno=  $param_mobno,add=  $param_addr where Email = $email ";  

            if(mysqli_query($link, $sql)){
                header("location: success.php");
            } else{
                echo "Oops! Something went wrong.Please try again later.";
            }

        
    }
    

    mysqli_close($link);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Covid Vaccine Drive</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	

<!-- ============================================================================================= -->
</head>
<body>
	<div class="container-login101" style="background-image: url('images/14.jpg');">
		<div class="wrap-login101 p-l-55 p-r-55 p-t-40 p-b-30">
			<form class="login100-form validate-form"  method="post" enctype="multipart/form-data">
				<span class="login100-form-title p-b-37">
					Covid Drive
				</span>
<div class="row">
	<div class="col-sm col-md col-lg">
				<div class="wrap-input100 validate-input m-b-10" data-validate="Enter First Name">
					<input class="input100" type="text" name="fname" placeholder="First Name">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-10" data-validate = "Enter Age">
					<input class="input100" type="number" name="age" placeholder="Age">
					<span class="focus-input100"></span>
				</div>
</div>
<div class="col-sm col-md col-lg">
				<div class="wrap-input100 validate-input m-b-10" data-validate="Enter Last Name">
					<input class="input100" type="text" name="lname" placeholder="Last Name">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-10" data-validate = "Enter weight">
					<input class="input100" type="number" name="weight" placeholder="weight">
					<span class="focus-input100"></span>
				</div>
</div>
</div>
<div class="row">
	<div class="col-sm col-md col-lg">
				<div class="wrap-input100 validate-input m-b-10" data-validate="Choose Blood Group">
					<select class="input100" name="bgrp">
						  <option value="O+">O +ve</option>
						  <option value="O-">O -ve</option>

						  <option value="A+">A +ve</option>
						  <option value="A-">A -ve</option>
						  
						  <option value="B+">B +ve</option>
						  <option value="B-">B -ve</option>

						  <option value="AB+">AB +ve</option>
						  <option value="AB-">AB -ve</option>
						  
					</select>
					<span class="focus-input100"></span>
				</div>

</div>
<div class="col-sm col-md col-lg">
				<div class="wrap-input100 validate-input m-b-10" data-validate="Choose Gender">
					<select class="input100" name="gndr">
						  <option value="male">Male</option>
						  <option value="female">Female</option>
						  <option value="other">Other</option>

						  
					</select>
					<span class="focus-input100"></span>
				</div>

</div>
				<div class="wrap-input100 validate-input m-b-10" data-validate = "Enter Mobile number">
					<input class="input100" type="number" name="mobno" placeholder="Mobile Number">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input m-b-10" data-validate = "Enter Address">
					<input class="input100" type="textarea" name="addr" placeholder="Address">
					<span class="focus-input100"></span>
				</div>

</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn">
						Vaccinate Me!
					</button>
				</div>

				
			</form>

			
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script src="app.js"></script>

</body>
</html>