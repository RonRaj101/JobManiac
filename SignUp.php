<?php
include("DBCONNECT.php");

if(isset($_POST['name']) and isset($_POST['email']) and isset($_POST['num']) and isset($_POST['purpose']) and isset($_POST['pass'])){
    
      if($_POST['purpose'] == '0'){
          $url = "JobManiacHomeHIRE.php";
      }
      else if($_POST['purpose'] == '1'){
          $url = "JobManiacHomeFIND.php";
      }
    
      extract($_POST);
      $query = "INSERT INTO userprofiles(Name,Email,Phone,Purpose,Password,redirectURL) values('$name','$email','$num','$purpose','$pass','$url')";
      $result = mysqli_query($connectionstring,$query) or die("Connection Error! Cannot Perform Action");
      header("location:Login.php");   
          
          }
     ?>



  

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Up</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<link type="text/css" href="Style.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Advent Pro' rel='stylesheet'>
<meta name="viewport" content="width=device-width, initial-scale=1.0">    
<style>
    .nav-link{
        display: block!important;
    }    
.nav-link:hover{
        display: block !important;
        border-bottom: 1px solid lawngreen;
    }        
</style>   
</head>

<body style="font-family: Helvetica, Arial, sans-serif;">
    <br>
  <nav class="navbar navbar-expand-lg" style="border: 1px solid lawngreen;">
    <ul class="navbar-nav">
      <li class="nav-item active" style="padding-left: 16vw;">
        <a class="nav-link" href="#" >Find Jobs</a>
      </li>
      <li class="nav-item active" style="padding-left: 16vw;">
        <a class="nav-link" href="#" >Hire Job Seekers</a>
      </li>
      <li class="nav-item active" style="padding-left: 16vw;">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item active" style="padding-left: 16vw;">
        <a class="nav-link" href="Login.php" >Log In</a>
      </li>
    </ul>
          
</nav>
    
    <br>
    <br>
    <center>
    <h1 class="logo"><ins>JOB MANIAC</ins></h1>
    </center> 
    <br>
     <div class="login-form-container" style=" box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px;">   
        <br>
        <center>
    <form action="" method="post" class="login-form">
      <h4 style="float: left;">Sign Up</h4>
        <br>
        <hr>
     <h6 style="float: left;">Full Name</h6> 
        <center> 
     <input type="text" class="form-control" name="name" required>
        </center> 
        <br>
         <h6 style="float: left;">Email Address</h6> 
        <center> 
     <input type="email" class="form-control" name="email" required>
        </center> 
        <br>
     <h6 style="float: left;">Mobile Number</h6>        
     <input type="text" class="form-control" name="num" required>
        <br>  
      <h6 style="float: left;">Purpose</h6>     
      <select name="purpose" class="form-control" required>
        <option value="0">Hire an Employee</option>
        <option value="1">Be An Employee</option>
      </select>
        <br>        
     <h6 style="float: left;">Password</h6>        
     <input type="password" class="form-control" name="pass" required>
        <br>
     <input type="submit" class="btn btn-success" value="Create Account"> 
    </form>
            </center>
        <br>
    </div> 
    <br>
    
</body>
</html>