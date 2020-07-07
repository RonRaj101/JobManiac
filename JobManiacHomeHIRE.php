<?php
include("DBCONNECT.php");
session_start();

$user = $_SESSION['user'];

if($user == null){
    header("location:Login.php");
}

$getid = "SELECT ID FROM userprofiles WHERE Name = '$user'";
$idresult = mysqli_query($connectionstring,$getid);

while($row = mysqli_fetch_assoc($idresult)){
    $id = $row['ID'];
}

$_SESSION['id'] = $id;

$getfieldquery = "SELECT * FROM fields";
$fields = mysqli_query($connectionstring,$getfieldquery);


if(isset($_POST['title']) and isset($_POST['desc']) and isset($_POST['salary']) and isset($_POST['type']) and isset($_POST['field']) and isset($_POST['org']) and $id != null){
    extract($_POST);
    $addjobquery = "INSERT INTO jobs(J_TITLE,J_DESC,J_SALARY,J_TYPE,J_FIELD,J_COMPANY,J_CREATOR) values('$title','$desc','$salary','$type','$field','$org','$id')";
    $joblist = mysqli_query($connectionstring,$addjobquery);
    
    echo('<script>alert("Job Listing Created");</script>');
    
}

$getunseenjobs = "SELECT * FROM jobs WHERE J_CREATOR = '$id' AND Seen = 0 ";
$unseen = mysqli_query($connectionstring,$getunseenjobs);

$rows = mysqli_num_rows($unseen);




?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>JOB MANIAC</title>
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
        border-bottom: 2px solid lawngreen;
    }
    
    nav ul li{
        padding: 0.5vw;
        
    }
    
    nav{
        height: 5vh;
    }
</style>    
</head>

<body style="font-family: Helvetica, Arial, sans-serif;">
    <br>
     <center>
    <h1 class="logo"><ins>JOB MANIAC</ins></h1>
    </center> 
    <br>
    
<nav class="navbar navbar-expand-lg" style="border: 1px solid aliceblue; background-color: aliceblue;">
    <ul class="navbar-nav">
      <li class="nav-item" style="margin-left: 14vw;">
        <a class="nav-link" href="EmployerListings.php">Your Job Listings
          <span class="badge badge-danger"><?php echo $rows;?></span>
          </a>
      </li>
      <li class="nav-item" style="margin-left: 16vw;">
        <a class="nav-link"   href="#">About</a>
      </li>
      <li class="nav-item" style="margin-left: 16vw;">
        <a class="nav-link"  href="Profile.php">Profile Information</a>
      </li>
       <li class="nav-item" style="margin-left: 16vw;">
        <a class="nav-link"  href="LogOut.php">Log Out</a>
      </li>    
    </ul>  
</nav>

<br>
<br>
<br>


 <center>   
<h5>Welcome <strong><?php echo $_SESSION['user']?></strong></h5>
 </center>     
<br>
    <div class="create-job" style="box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 5px; ">
        <br>
    <center>    
    <h3>Create Job Listing</h3> 
    <hr>    
 </center> 
        
    <div class="joblistform" style="margin-left: 1vw; width: 65vw; margin: 0px auto; ">
    <form method="post" action="">    
       <br> 
    <input type="text" class="form-control" style="width:18vw;" name="title" placeholder="Job Title" required>
  <br>
    <textarea cols="10vh" rows="4vh" class="form-control" placeholder="Job Description" name="desc" required></textarea>
    <br>
    <input type="number" class="form-control" style="width:15vw;" name="salary" placeholder="Salary(Rs Per Month)" required>   
<br>
    <select class="form-control" style="width: 15vw;" name="type" required>
        <option selected disabled>Job Type</option>
        <option>Full-Time</option>
        <option>Part-Time</option> 
        <option>Contract</option>
    </select> 
        <br>
<select name="field" class="form-control" style="width: 25vw;"> 
     <option selected disabled>Field of Job</option>
     <?php
     while ($fieldata = mysqli_fetch_assoc($fields)) {			 
     ?>        
     <option value="<?php echo $fieldata['F_ID']?>"><?php echo $fieldata['F_NAME']?></option>
     <?php
         }
     ?>        
</select>
    <br>    
    <input type="text" class="form-control" style="width:18vw;" name="org" placeholder="Organization">
        <hr>
    <input type="submit" class="btn btn-success" style="width: 15vw; float: right;" value="Create Job Listing">
        <br>
        <br>
    </form>    
    </div>
        
    </div>
    
    <br>
    <br>
<div class="searchresults">

   
</div>    
    
</body>
</html>