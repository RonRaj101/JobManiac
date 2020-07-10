<?php
include("DBCONNECT.php");
session_start();
$id = $_SESSION['id'];
$checkseen = "UPDATE jobs SET Seen = '1' WHERE Seen = 0";
$execute = mysqli_query($connectionstring,$checkseen);

$countquery = "SELECT * FROM jobs WHERE J_CREATOR = '$id'";
$countexec = mysqli_query($connectionstring,$countquery);

$count = mysqli_num_rows($countexec);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Your Listings</title>
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
        background-color: aliceblue;
    } 
</style>    
</head>

<body style="font-family: Helvetica, Arial, sans-serif;">
      <br>
     <center>
    <h1 class="logo"><ins>JOB MANIAC</ins></h1>
    </center> 
    <br>
    <nav class="navbar navbar-expand-lg">
  <div class="collapse navbar-collapse" id="navbarNav">
      <center>
    <ul class="navbar-nav">
      <li class="nav-item active" style="padding-left: 16vw;">
        <a class="nav-link" href="JobManiacHomeHIRE.php">Create Job Listing</a>
      </li>
      <li class="nav-item active" style="padding-left: 16vw;">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item active" style="padding-left: 16vw;">
        <a class="nav-link" href="Profile.php">Profile Information</a>
      </li>
       <li class="nav-item active" style="padding-left: 16vw;">
        <a class="nav-link" href="LogOut.php">Log Out</a>
      </li>    
    </ul>
        </center>  
  </div>
</nav>
<br>
<center>    
<h6><strong><u><?php echo $count ?></strong></u> Job Listings </h6>
</center>    
<br>
    <div style="display: flex; flex-wrap: wrap; width: 80vw; margin-left: 10vw;">
<?php
    $getlistingsquery = "SELECT * FROM jobs WHERE J_CREATOR = '$id' ";
    $list = mysqli_query($connectionstring,$getlistingsquery);
    
    while($row = mysqli_fetch_assoc($list)){
        $FNUM = $row['J_FIELD'];
        $fieldnamequery = "SELECT F_NAME FROM fields where F_ID = '$FNUM'";
        $fieldnameget = mysqli_query($connectionstring,$fieldnamequery);
        while($get = mysqli_fetch_assoc($fieldnameget)){
            $fieldname = $get['F_NAME'];
        }
          
      ?>
    
    <div style=" width: 25vw; border:1px solid black; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 3px; border-radius: 0.4vw; padding: 0.75vw; word-break: break-all; box-sizing: content-box;">   
    <div style="">     
    <h6 hidden=""><?php echo $row['J_ID']?></h6>    
    <h4>Job Title: <strong><?php echo $row['J_TITLE']?></strong></h4>
    <h6>Company Name: <strong><?php echo $row['J_COMPANY']?></strong></h4>    
    <h6>Job Description:<i><?php echo $row['J_DESC']?></i></h6> 
    <h5>Salary: <strong><?php echo $row['J_SALARY']?> PKR</strong></h4>
    <h6>Job Type: <strong><?php echo $row['J_TYPE']?></strong></h5>
    <h6>Field of Work: <strong><?php echo $fieldname?></strong></h5>    
    <a href="DelJob.php?J_ID=<?php echo $row['J_ID']?>"><input type="button" class="btn btn-danger" value="Remove Job Listing" style="width: 10vw;"></a>
    <a href="#EditJob.php?J_ID=<?php echo $row['J_ID']?>"><input type="button" class="btn btn-secondary" value="Edit Job Listing" style="width: 10vw;"></a>
    </div>   
    </div>

    <?php      
    }
    ?>
   </div>
 <br><br>
</body>
</html>