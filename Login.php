<?php
error_reporting(0);
include("DBCONNECT.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login To Your Account</title>
<link rel="shortcut icon" href="logoinv.ico"/>      
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">  
<link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">    

<link type="text/css" href="all.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    .logo{
        font-family: 'Lobster', cursive;
        text-decoration: none;
    }
    
    a{
        color: green;
    }

    .login-form-container{
    min-width:450px;
    max-width: 450px;
    background-color: white;
    margin:0 auto;
    border-radius: 0.3vw;
}

.login-form{
  min-width:350px;
    max-width: 350px;
    
}



body{
    background-color:aliceblue;
}

.logo{
    color:lawngreen;
    
}
</style>    
</head>
<body style="font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif';" >
<?php
if(isset($_POST['email']) and !empty($_POST['email']) and isset($_POST['pass']) and !empty($_POST['pass'])){
      if($_SERVER["REQUEST_METHOD"] == "POST"){
      $email =  mysqli_real_escape_string($connectionstring,$_POST['email']);
      $pass = mysqli_real_escape_string($connectionstring,$_POST['pass']);
          
      $query = "SELECT * FROM userprofiles WHERE Email = '$email' AND Password = '$pass'";
      $result = mysqli_query($connectionstring,$query);
          
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);      
      $count = mysqli_num_rows($result);
          
      $username = $row['Name'];
      $_SESSION['user'] = $username;      
        
      if($row['Purpose'] == 1){
          $goto = "JobManiacHomeFIND.php";
      }  
    
      elseif($row['Purpose'] == 0){
          $goto = "JobManiacHomeHIRE.php";
      } 
      
            if($count == 1){
          header("location:$goto");
      }
      elseif($count == 0){ 
        echo "<div class='alert alert-danger alert-dismissible'>
    <center><strong>Your Email and/or Password is Incorrect</strong></center>
    </div>";  
          
      }
          
    }
}    
?>    
    <br>

    <br>
    <br>
    <center>
    <a href="Index.html" style="text-decoration: none;"><h1 style=" min-width:450px;
    max-width: 450px; padding: 1vw;" class="logo"><img src="logoinv.png" alt="" width="50px" height="50px"> QUICK NOKRI.com</h1></a>
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
     <input type="email" class="form-control" style="min-width:350px;
    max-width: 350px;" name="email" required>
        </center> 
        <br>
      
     <h6 style="float: left;">Password</h6>        
     <input type="password" class="form-control" style="min-width:350px;
    max-width: 350px;" name="pass" required >
    <br>
     <input type="submit" style="min-width:350px;
    max-width: 350px;" class="btn btn-success" value="Sign In"> 
    </form>
        <br>    
     <a class="nav-link" href="SignUp.php">Don't Have an Account, Sign Up Instead</a>        
            </center>
        <br>
    </div>    
       
</body>
</html>