<?php
error_reporting(0);
include("DBCONNECT.php");
session_start();
$id = $_SESSION['id'];
$checkseen = "UPDATE jobs SET Seen = '1' WHERE Seen = 0";
$execute = mysqli_query($connectionstring,$checkseen);

$countquery = "SELECT * FROM jobs WHERE J_CREATOR = '$id'";
$countexec = mysqli_query($connectionstring,$countquery);

$count_all = mysqli_num_rows($countexec);

$getprofiledetailsquery = "SELECT * FROM userprofiles WHERE ID='$id'";
$getprofiledetails = mysqli_query($connectionstring,$getprofiledetailsquery);

while($pic = mysqli_fetch_assoc($getprofiledetails)){
    $imgurl = $pic['profileimgurl'];
}

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
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">       
<link type="text/css" href="Style.css" rel="stylesheet">  
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})    
</script>

<style>
     #profileimg{
        border-radius: 01vw;
    }
     .logo{
        font-family: 'Lobster', cursive;
    }
    
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
        height: 5vh;
        background-color: aliceblue;
    } 
    
    *{
        box-sizing: border-box;
    }
</style>    
</head>

<body style="font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif';" >
<?php   
if($_GET['status'] == 1){    
?>
<div class="alert alert-success alert-dismissible">
    <center><strong>Job Listing Updated Succesfully</strong></center>
    </div>    
<?php   
} 
else{
    echo "";
}    
?>
<?php 
if($_GET['f'] == 1){    
?>
<div class="alert alert-success alert-dismissible">
    <center><strong>Job Listing Featured Succesfully</strong></center>
    </div>    
<?php    
} 
elseif($_GET['f'] == 2){   
?> 
<div class="alert alert-warning alert-dismissible">
    <center><strong>Job Listing Un-Featured Succesfully</strong></center>
    </div>     
<?php
}
?>   
<?php 
if($_GET['status'] == 'ra'){    
?>
<div class="alert alert-success alert-dismissible">
    <center><strong>Job Re-Activated Successfully</strong></center>
    </div>    
<?php    
}
elseif($_GET['status'] == 'ua'){
?>  
<div class="alert alert-success alert-dismissible">
    <center><strong>Job Un-Activated Successfully</strong></center>
    </div>     
<?php
    }
?>    
<br>    
   <header style=" width: 98vw;">
<a href="JobManiacHomeHIRE.php"><h1 style=" width: 25vw; padding-left: 1vw; float: left;" class="logo">QUICK NOKRI.com</h1></a>
    
<nav class="navbar navbar-expand-lg" style=" margin-right: 4vw; background-color: aliceblue; display: block; float: right; flex-flow: nowrap;">
  <div class="collapse navbar-collapse" id="navbarNav">
      <center> 
    <ul class="navbar-nav">
      <li class="nav-item active" style="">
        <a class="nav-link" href="JobManiacHomeHIRE.php">Create Job Listing</a> 
      </li>
      <li class="nav-item active" style="">
        <a class="nav-link" href="#">About</a>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <img id="profileimg" width="35px" height="37px;" title="Profile Information" src="<?php echo $imgurl?>">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="Profile.php?ID=<?php echo $id?>">Profile Information</a>
          <a class="dropdown-item" href="LogOut.php">Log Out</a>    
        </div>
      </li>     
    </ul>
        </center>  
  </div>
</nav>
</header>    
<br>    
<br>
<br>    
<hr>
<br>    
<center>
<?php
$getactivejobssql = "SELECT * FROM jobs WHERE J_CREATOR='$id' AND Active = 1";
$getactivejobs = mysqli_query($connectionstring,$getactivejobssql);

$count_active = mysqli_num_rows($getactivejobs);                
?>    
<h6><strong><u><?php echo $count_all ?></strong></u> Job Listings (<?php echo $count_active?> <span style="color:cornflowerblue;">Active</span> & <?php echo $count_all - $count_active?> <span style="color: gray;">Inactive</span>)</h6>
</center>    
<br>
    <div style=" flex-wrap: wrap; width: 90vw; box-sizing:border-box; margin-left: 3vw; ">
<?php
    $getlistingsquery = "SELECT * FROM jobs WHERE J_CREATOR = '$id' ";
    $list = mysqli_query($connectionstring,$getlistingsquery);
        
    $getstatussql = "SELECT Active FROM jobs WHERE J_CREATOR = '$id'"; 
    $getstatus = mysqli_query($connectionstring,$getstatussql);
                
    while($s = mysqli_fetch_assoc($getstatus)){
        $status = $s['Active'];
    }
                
    if(mysqli_num_rows($list) > 0 and $status == 1){
        while($row = mysqli_fetch_assoc($list)){
        $st = $row['Active'];    
        $FNUM = $row['J_FIELD'];
        $fieldnamequery = "SELECT F_NAME FROM fields where F_ID = '$FNUM'";
        $fieldnameget = mysqli_query($connectionstring,$fieldnamequery);
        while($get = mysqli_fetch_assoc($fieldnameget)){
         $fieldname = $get['F_NAME'];
        }
        
        $featured_bin = $row['Featured'];
        
        if($st == 0){         
        $border = "2px solid gainsboro";
        $bg = "gainsboro";
        $dis = "disabled";    
        } 
        elseif($st == 1){
          $border = "2px solid black";
          $bg = "transparent";
          $dis = "";    
        }    
      ?>
    
    <div style=" width:75vw; border:<?php echo $border?> ; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 3px; border-radius: 0.3vw; padding: 0.75vw; margin: 0px auto; background-color:<?php echo $bg?>; "> 
    <?php

         if($featured_bin == 1){ 
    ?>
        <img src="featured.png" width="32px" height="35px" style="float: right;">
    <?php
         }
    ?>    
    <h6 hidden=""><?php echo $row['J_ID']?></h6>     
    <h4>Job Title: <strong><?php echo $row['J_TITLE']?></strong></h4>
    <h6>Company Name: <strong><?php echo $row['J_COMPANY']?></strong></h4>    
    <h6>Job Description:<i><?php echo $row['J_DESC']?></i></h6> 
    <h5>Salary: <strong><?php echo $row['J_SALARY']?> PKR</strong> / Month</h4>
    <?php 
    $type_id = $row['J_TYPE'];      
    $gettypenamequery = "SELECT T_NAME FROM jobtype WHERE T_ID = '$type_id'";
    $gettypename = mysqli_query($connectionstring,$gettypenamequery);        
    while($name = mysqli_fetch_assoc($gettypename)){        
    ?>    
    <h6>Job Type: <strong><?php echo $name['T_NAME']?></strong></h5>
    <?php
      }  
    ?>    
    <h6>Field of Work: <strong><?php echo $fieldname?></strong></h5>   
    <hr>
    <a href="DelJob.php?J_ID=<?php echo $row['J_ID']?>"><input type="button" class="btn btn-danger" value="Remove Job Listing" style="width: 10vw;"></a>
    <a href="EditJob.php?J_ID=<?php echo $row['J_ID']?>"><input type="button" class="btn btn-secondary" value="Edit Job Listing" style="width: 10vw;"></a>
    <?php
     $jobid = $row['J_ID'];
     $featurechecksql = "SELECT Featured FROM jobs WHERE J_ID='$jobid'";
     $featurecheck = mysqli_query($connectionstring,$featurechecksql);
     while($abc = mysqli_fetch_assoc($featurecheck)){
         $f_check = $abc['Featured'];
     } 
     if($f_check == 0){        
     ?>    
    <a href="FeatureJob.php?J_ID=<?php echo $row['J_ID']?>"><button style="width: 12vw;" type="button" class="btn btn-success" data-toggle="tooltip" data-placement="right" title="Feature your Job on the Front Page of the Website and gain more applicants on your Listing."<?php echo $dis?>>
  Feature Job
</button></a>
    <?php    
    } 
    else{       
    ?>
      <a href="UnFeature.php?J_ID=<?php echo $row['J_ID']?>"><button style="width: 12vw;" type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="right" title="Un-Feature your Job">
  Un-Feature Job
</button></a> 
    <?php 
    }
    ?>
    <a href="JobApplicants.php?J_ID=<?php echo $row['J_ID']?> & U_ID=<?php echo $id?>"><input type="button" class="btn btn-primary" value="Job Applicants" style="width: 10vw;" title="People who applied for this Job"></a> 
     <?php 
    if($st == 0){
    ?>
    <a href="Reactivate.php?J_ID=<?php echo $row['J_ID']?> & U_ID=<?php echo $id?>"><input type="button" class="btn btn-info" value="Re-Activate" style="width: 10vw;" title="Want Another Employee? Reactivate the Job"></a>
    <?php
    }
    elseif($st == 1){        
    ?>
    <a href="Un-Activate.php?J_ID=<?php echo $row['J_ID']?> & U_ID=<?php echo $id?>"><input type="button" class="btn btn-dark" value="Un-Activate" style="width: 10vw;" title="Disable the Job Listing"></a>    
    <?php
        }
    ?>    
    <br> 
      </div> 
    <br>    
    
    <?php    
    }
    }
    else{
    ?>
     <center>No Jobs Posted</center>   
    <?php
       }  
    ?>
        
   </div>
<?php include('footer.php');?>   
</body>
</html>