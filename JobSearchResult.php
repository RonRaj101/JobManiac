<?php
include("DBCONNECT.php");

$field = $_GET['field'];
$u_id = $_GET['user'];



$selectjobs = "SELECT * FROM jobs WHERE J_FIELD = '$field'";
$result = mysqli_query($connectionstring,$selectjobs);      

$getcompanies = "SELECT J_COMPANY FROM JOBS";
$companynames = mysqli_query($connectionstring,$getcompanies);

$getjobtitles = "SELECT J_TITLE FROM JOBS";
$jobtitles = mysqli_query($connectionstring,$getjobtitles);


error_reporting(0);
?> 

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Job Search Result</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>    
<link type="text/css" href="Style.css" rel="stylesheet"> 
<style>
    nav a{
        color: green;
        
    }
    
    nav a:hover{
        color: greenyellow;
        border-bottom: 2px solid lawngreen;
    }
    
    nav ul li{
        padding: 0.5vw;    
    }
    
    nav{
        height: 3vh;
    }

</style>    
     
</head>

<body style="padding: 1vw;">
<?php
    if($_GET['saved'] == 1){ 
    $_GET['unsaved'] = 0;    
    ?>
    <div class="alert alert-info alert-dismissible">
    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <center><strong>Job Saved Succesfully</strong></center>
    </div>
    <?php     
    }
    elseif($_GET['unsaved'] == 1){ 
    $_GET['unsaved'] = 0;    
    ?>
    <div class="alert alert-info alert-dismissible">
    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <center><strong>Job Un-Saved Succesfully</strong></center>
    </div>
    <?php      
     }
    ?>     
<br>   
    <center>
    <h1 class="logo"><ins>JOB MANIAC</ins></h1>
    </center> 
<br>    
 
<nav class="navbar navbar-expand-lg" style="border: 1px solid aliceblue; border-radius: 1vw; background-color: aliceblue; ">
  <div class="collapse navbar-collapse" id="navbarNav">
      <center>
    <ul class="navbar-nav">
       <li class="nav-item active" style="margin-left: 10vw;">
        <a class="nav-link" href="JobManiacHomeFIND.php">Home Page</a>
        <span class="badge badge-danger"><?php?></span>  
      </li>    
      <li class="nav-item active" style="margin-left: 11vw;">
        <a class="nav-link" href="#">Saved Job's</a>
        <span class="badge badge-danger"><?php?></span>  
      </li>
      <li class="nav-item active" style="margin-left: 11vw;">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item active" style="margin-left: 11vw;">
        <a class="nav-link" href="Profile.php">Profile Information</a>
      </li>
      <li class="nav-item active" style="margin-left: 10vw;">
        <a class="nav-link" href="LogOut.php">Log Out</a>
      </li>    
    </ul>
        </center>  
  </div>
</nav>
  <br>  
<?php 
if(isset($_POST['jobtitle']) and isset($_POST['prefsalary']) and isset($_POST['c_name'])){
    extract($_POST);
    $selectjobs = "SELECT * FROM jobs WHERE J_TITLE = '$jobtitle' AND J_SALARY <= $prefsalary AND J_COMPANY = '$c_name'";
    $result = mysqli_query($connectionstring,$selectjobs);      
 
}    
?>
<br>    
<div style="box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 5px; width: 1000px; margin:0px auto;">    
<br>
    <center><h4>Advanced Job Search</h4></center>
    
<br>    
<form method="post" action="" class="form-inline" style=" margin: 0px auto; border: 1px solid aliceblue; width:950px; ">
  <div class="form-group mb-2">
    <label for="jobtitle" class="sr-only">Job Title</label>
    <select name="jobtitle" class="form-control" style="width: 250px;">
    <?php
    while($titles = mysqli_fetch_assoc($jobtitles)){
    ?> 
    <option><?php echo $titles["J_TITLE"]?></option>    
    <?php    
    }    
    ?>  
    </select>  
  </div>
  <div class="form-group mb-2">
    <label for="prefsalary" class="sr-only"></label>
    <input type="text" class="form-control" style="width: 250px;" name="prefsalary" id="" placeholder="Preferred Salary(Upto)">
  </div>
<br>    
   <div class="form-group mb-2">
    <select class="form-control" style="width: 250px;" name="c_name" required>
     <option selected disabled>Company Names</option>
     <option value="*">Any</option>    
     <?php
     while($names = mysqli_fetch_assoc($companynames)){   
     ?>
      <option><?php echo $names['J_COMPANY']?></option>   
     <?php
         }
     ?>    
    </select>
  </div> 
<center>    
  <input style="width: 10vw; margin-left: 1vw; " type="submit" class="btn btn-success mb-2" value="Advanced Search">
</center>    
</form>    
<br>
</div>
<br>
<br>   
<div style="display: flex; flex-wrap: wrap; width: 50vw; float: left; padding-left: 0.75vw; margin: 0px auto;"> 

    
<?php

if(mysqli_num_rows($result) > 0){  
    
while($jobs = mysqli_fetch_assoc($result)){
$j_id = $jobs['J_ID']; 
    
$checksavedquery = "SELECT S_ID FROM savedjobs WHERE J_ID = '$j_id' AND U_ID = '$u_id'";
$checksaved = mysqli_query($connectionstring,$checksavedquery);

?>
    
<div class="jobsearchresults" style="width:30vw; border:0.1vw solid black; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 3px; border-radius: 0.4vw; padding: 1vw; word-break: break-all; box-sizing: content-box;">
<div>
    <?php
    if(mysqli_num_rows($checksaved) > 0){
    ?>
    <a style="float: right;" href="Unsave.php?J_ID=<?php echo $jobs['J_ID']?> & U_ID=<?php echo $u_id ?> & F_ID=<?php echo $field?>"><h5>Unsave</h5></a>
    <?php
    }    
    else{ 
    ?>
    <a href="SaveJob.php?J_ID=<?php echo $jobs['J_ID']?> & U_ID=<?php echo $u_id?> & F_ID=<?php echo $field?>"><img style="float: right;" src="save.png" width="32px" height="32px"></a>
    <?php
    }
    ?>
    <h6 hidden=""><?php echo $jobs['J_ID']?></h6>    
    <h4><strong><?php echo $jobs['J_TITLE']?></strong></h4>
    <hr>
    <h5><strong><?php echo $jobs['J_COMPANY']?></strong></h5>    
   
    <?php
    $type_id = $jobs['J_TYPE'];      
    $gettypenamequery = "SELECT T_NAME FROM jobtype WHERE T_ID = '$type_id'";
    $gettypename = mysqli_query($connectionstring,$gettypenamequery);        
    while($name = mysqli_fetch_assoc($gettypename)){ 
    $typename = $name['T_NAME'];
    }      
    ?>    
    <h6><?php echo $typename?></h6>
    
    <?php
    $FNUM = $jobs['J_FIELD'];    
    $fieldnamequery = "SELECT F_NAME FROM fields where F_ID = '$FNUM'";
    $fieldnameget = mysqli_query($connectionstring,$fieldnamequery);
    while($get = mysqli_fetch_assoc($fieldnameget)){
    $fieldname = $get['F_NAME'];
    }
    ?>
    <h6><strong><span class="badge-light"><?php echo $fieldname?></span></strong></h6>
    <hr>
    <a href="MoreInfoJobs.php?J_ID=<?php echo $jobs['J_ID']?> & user=<?php echo $u_id?> & field=<?php echo $jobs['J_FIELD']?>"><input type="button" class="btn btn-info" value="More Info" style="width: 12vw;"></a>
    <br>
</div>     

</div>    
<?php
    }
    }
    else{
        
        echo "No Results Found";
    }
?> 

</div>    
        
</body>
</html>