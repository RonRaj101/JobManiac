<?php
include("DBCONNECT.php");
session_start();
if(isset($_POST['email']) and isset($_POST['pass'])){
      if($_SERVER["REQUEST_METHOD"] == "POST"){
      $email =  mysqli_real_escape_string($connectionstring,$_POST['email']);
      $pass = mysqli_real_escape_string($connectionstring,$_POST['pass']);     
      $query = "SELECT * FROM userprofiles WHERE Email = '$email' AND Password = '$pass'";
      $result = mysqli_query($connectionstring,$query);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);      
      $count = mysqli_num_rows($result);
          
      $username = $row['Name'];
      $_SESSION['user'] = $username;      
          
      $goto = $row['redirectURL'];      
      if($count = 1){
          header("location:$goto");
      }      
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login To Your Account</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<link type="text/css" href="Style.css" rel="stylesheet"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
 a{
        color: green;
    }
    
    a:hover{
        color: greenyellow;
        
    }
    
    nav ul li{
        padding: 0.5vw;    
    }
    
    nav{
        height: 3vh;
    } 
    
</style>    
</head>
<body style="font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif';" >
    <br>

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
      <h4 style="float: left;">Sign In</h4>
        <br>
        <hr>
     <h6 style="float: left;">Email Address</h6> 
        <center> 
     <input type="email" class="form-control" style="width:25vw;" name="email" required>
        </center> 
        <br>
      
     <h6 style="float: left;">Password</h6>        
     <input type="password" class="form-control" style="width:25vw;" name="pass" required >
    <br>
     <input type="submit" class="btn btn-success" value="Sign In"> 
    </form>
        <br>    
     <a class="nav-link" href="SignUp.php">Sign Up Instead</a>        
            </center>
        <br>
    </div>    
       
</body>
</html>