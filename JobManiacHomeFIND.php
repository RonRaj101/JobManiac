<?php
include("DBCONNECT.php");
error_reporting(0);  
session_start();

$field = $_GET['field'];

$selectjobs = "SELECT * FROM jobs WHERE J_FIELD = '$field' AND Active = 1";
$result = mysqli_query($connectionstring,$selectjobs);   

$user = $_SESSION['user'];

$userid = "SELECT ID FROM userprofiles WHERE Name = '$user'";
$useridget = mysqli_query($connectionstring,$userid);

while($id = mysqli_fetch_assoc($useridget)){
    $u_id = $id['ID'];
}

$getuserauthsql = "SELECT Purpose FROM userprofiles WHERE ID='$u_id'";
$getuserauth = mysqli_query($connectionstring,$getuserauthsql);

while($a = mysqli_fetch_assoc($getuserauth)){
    $auth = $a['Purpose'];
}

if($auth == 0){
    header("location:JobManiacHomeHIRE.php");
}

else{
    echo "";
}



if($user == null){
    header("location:Login.php");
}

$getfieldquery = "SELECT * FROM fields";
$fields = mysqli_query($connectionstring,$getfieldquery);



if(isset($_POST['field'])){
extract($_POST); 
$selectjobs = "SELECT * FROM jobs WHERE J_FIELD = '$field' AND Active=1";
$result = mysqli_query($connectionstring,$selectjobs);  
}

    

$getcompanies = "SELECT J_COMPANY FROM JOBS";
$companynames = mysqli_query($connectionstring,$getcompanies);

$getjobtitles = "SELECT J_TITLE FROM JOBS";
$jobtitles = mysqli_query($connectionstring,$getjobtitles);

$getsavedjobsall = "SELECT * FROM savedjobs WHERE U_ID = '$u_id' ";
$getsaved = mysqli_query($connectionstring,$getsavedjobsall);

$getprofiledetailsquery = "SELECT * FROM userprofiles WHERE ID='$u_id'";
$getprofiledetails = mysqli_query($connectionstring,$getprofiledetailsquery);

while($pic = mysqli_fetch_assoc($getprofiledetails)){
    $imgurl = $pic['profileimgurl'];
}

$rows = mysqli_num_rows($getsaved);

$getappliedjobssql = "SELECT J_ID FROM jobapplications WHERE U_ID = $u_id";
$getappliedjobs = mysqli_query($connectionstring,$getappliedjobssql);

$rows1 = mysqli_num_rows($getappliedjobs);

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
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">    
<link type="text/css" href="Style.css" rel="stylesheet">
<style>
    
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
        height: 3vh;
    }
    
    #profileimg{
        border-radius: 01vw;
    }
</style>    
 
<script>
$(document).ready(function() {
  const $valueSpan = $('.valueSpan2');
  const $value = $('#customRange11');
  $valueSpan.html($value.val());
  $value.on('input change', () => {
    $valueSpan.html($value.val());
  });
});    
</script>    
</head>

<body style="font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif';" >
    <?php
    if($_GET['saved'] == 1){ 
    $_GET['unsaved'] = 0;    
    ?>
    <div class="alert alert-info alert-dismissible">
    
    <center><strong>Job Saved Succesfully</strong></center>
    </div>
    <?php     
    }
    elseif($_GET['unsaved'] == 1){ 
    $_GET['unsaved'] = 0;    
    ?>
    <div class="alert alert-info alert-dismissible">
    
    <center><strong>Job Un-Saved Succesfully</strong></center>
    </div>
    <?php      
     }
    ?>     
   
<header style=" width: 98vw;">
<h1 style=" width: 25vw; padding: 1vw; float: left;" class="logo">QUICK NOKRI.com</h1>
    
<nav class="navbar navbar-expand-lg" style=" background-color: aliceblue; display: block; float: right; flex-flow: nowrap;">
  <div style="margin-right: 3vw;" class="collapse navbar-collapse" id="navbarNav">
      <center> 
    <ul class="navbar-nav">
      <li class="nav-item active" style="">
        <a class="nav-link" href="JobSearchResult.php?ID=<?php echo $u_id?>">Advanced Job Search</a> 
      </li>        
      <li class="nav-item active" style="">
        <a class="nav-link" href="SavedJobs.php?user=<?php echo $u_id?>">Saved Job's <span class="badge badge-info"><?php echo $rows ?></span></a> 
      </li>
      <li class="nav-item active" style="">
        <a class="nav-link" href="About.php?ID=<?php echo $u_id?>">About</a>
      </li>
       <li class="nav-item active" style="">
        <a class="nav-link" href="#">Job Offers</a>
      </li>    
       <li class="nav-item active" style="">
        <a class="nav-link" href="JobsAppliedFIND.php?ID=<?php echo $u_id?>" >Applied Job's
          <span class="badge badge-info"><?php echo $rows1 ?></span>
          </a> 
      </li>    
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <img id="profileimg" width="35px" height="37px;" title="Profile Information" src="<?php echo $imgurl?>">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="Profile.php?ID=<?php echo $u_id?>">Profile</a>
          <a class="dropdown-item" href="LogOut.php">Log Out <img width="24px" height="24px" src="logout.png"></a>    
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
<div style="float: left; width: auto; margin-left: 1vw;">
<br>    
<div class="searchjobs" style="">   
<form action="" method="post" class="" style="flo">
    
<h4><strong><?php echo $user?></strong> is Looking For a Job in </h4> 
<div class="jobsearchform">    
<div class="fieldselect">

<select name="field" class="form-control" style="width:400px;"> 
<?php
while ($fieldata = mysqli_fetch_assoc($fields)) {			 
?>        
 <option value="<?php echo $fieldata['F_ID']?>"><?php echo $fieldata['F_NAME']?></option>
<?php
    }
?>        
</select>

</div>
<div class="searchbutton">    
<input type="submit" class="btn btn-outline-success" value="Search" style="width:100px; margin-left: 1vw;"> 
</div>
</div>    
</form> 
</div>
<br> 

<div style="width: 45vw; height: 100vh; overflow-y: scroll;">     
<?php

    
if(mysqli_num_rows($result) > 0){  
    
while($jobs = mysqli_fetch_assoc($result)){
$j_id = $jobs['J_ID']; 
    
$checksavedquery = "SELECT S_ID FROM savedjobs WHERE J_ID = '$j_id' AND U_ID = '$u_id'";
$checksaved = mysqli_query($connectionstring,$checksavedquery);

$featured_bin = $jobs['Featured'];
    
$getemployerquery = "SELECT J_CREATOR FROM jobs WHERE J_ID = '$j_id'";
$getemployer = mysqli_query($connectionstring,$getemployerquery); 
    
while($n = mysqli_fetch_assoc($getemployer)){
    $employer_id = $n['J_CREATOR'];
} 

    
$checkverifiedquery = "SELECT Verified FROM userprofiles WHERE ID='$employer_id'";
$checkverified = mysqli_query($connectionstring,$checkverifiedquery);
    
while($cv = mysqli_fetch_assoc($checkverified)){
    if(!empty($cv)){
        $verified_bin = $cv['Verified'];
    }
    else{
        echo"";
    }
    
}    
    
?>
    
<div class="jobsearchresults" style=" background-color: #FFFFFF; width:40vw; border:0.1vw solid black; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 3px; border-radius: 0.4vw; padding: 1vw; word-break: break-all; box-sizing: content-box;">
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
    <h4><strong><?php echo $jobs['J_TITLE']?></strong>
    <?php     
    if($verified_bin == 1){    
    ?>
    <img style="" title="Verified Employer" src="verified.png" width="32px" height="32px">    
    <?php
    } 
    ?>    
    </h4>
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
    <?php
    if($featured_bin == 1){ 
    ?>
        <img style="float: right;1" title="Featured Job" src="featured.png" width="32px" height="32px">
    <?php
     }
    ?>
    <a href="MoreInfoJobs.php?J_ID=<?php echo $jobs['J_ID']?> & user=<?php echo $u_id?> & field=<?php echo $jobs['J_FIELD']?>"><input type="button" class="btn btn-info" value="More Information" style="width: 12vw;"></a>
    <br>
</div>     

</div> 
<br>    
<?php
    }
    }
    else{
        
        echo "No Results Found";
    }
    
  
?> 

</div>     
<br>    
</div>
<br>    
<br>
    
<!--Featured Jobs Section-->    
<div style=" background-color: #FFFFFF;  margin-right:2vw;  border: 1px solid black; float: right; width: 40vw;" class="featured-jobs">
    <br>
    <center>
    <h3>Check Out <strong>Featured Jobs </strong><img src="featured.png" width="30px" height="30px"></h3>  
    </center>
    <div style="overflow-y: scroll; height: 100vh;" >
    <?php
    $getfeaturedquery = "SELECT * FROM jobs WHERE Featured = '1' AND Active='1'";
    $getfeatured = mysqli_query($connectionstring,$getfeaturedquery);
    
    while($fjobs = mysqli_fetch_assoc($getfeatured)){
    
     $job_id = $fjobs['J_ID'];    
     $getemployerquery1 = "SELECT J_CREATOR FROM jobs WHERE J_ID = '$job_id'";
     $getemployer1 = mysqli_query($connectionstring,$getemployerquery1); 
    
     while($n = mysqli_fetch_assoc($getemployer1)){
    $employer = $n['J_CREATOR'];
     } 
    
$checkverifiedquery1 = "SELECT Verified FROM userprofiles WHERE ID='$employer'";
$checkverified1 = mysqli_query($connectionstring,$checkverifiedquery1);
    
while($cv = mysqli_fetch_assoc($checkverified1)){
    if(!empty($cv)){
        $verified_bin = $cv['Verified'];
    }
    else{
        echo"";
    }
        
}
    ?>
    
    <div class="jobsearchresults" style=" background-color: aliceblue; width:35vw;  margin: 0px auto; border:0.1vw solid black; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 3px; border-radius: 0.4vw; padding: 1vw; word-break: break-all; box-sizing: content-box;">
<div>
    <?php
    if(mysqli_num_rows($checksaved) > 0){
    ?>
    <a style="float: right;" href="Unsave.php?J_ID=<?php echo $fjobs['J_ID']?> & U_ID=<?php echo $u_id ?> & F_ID=<?php echo $field?>"><h5>Unsave</h5></a>
    <?php
    }    
    else{ 
    ?>
    <a href="SaveJob.php?J_ID=<?php echo $fjobs['J_ID']?> & U_ID=<?php echo $u_id?> & F_ID=<?php echo $field?>"><img style="float: right;" src="save.png" width="32px" height="32px"></a>
    <?php
    }
    ?>
    <h6 hidden=""><?php echo $fjobs['J_ID']?></h6>    
    <h4><strong><?php echo $fjobs['J_TITLE']?></strong>
    <?php      
    if($verified_bin == 1){    
    ?>
    <img style="" title="Verified Employer" src="verified.png" width="32px" height="32px">    
    <?php
    } 
    ?>    
    </h4>
    <hr>
    <h5><strong><?php echo $fjobs['J_COMPANY']?></strong></h5>    
   
    <?php
    $type_id = $fjobs['J_TYPE'];      
    $gettypenamequery = "SELECT T_NAME FROM jobtype WHERE T_ID = '$type_id'";
    $gettypename = mysqli_query($connectionstring,$gettypenamequery);        
    while($name = mysqli_fetch_assoc($gettypename)){ 
    $typename = $name['T_NAME'];
    }      
    ?>    
    <h6><?php echo $typename?></h6>
    
    <?php
    $FNUM = $fjobs['J_FIELD'];    
    $fieldnamequery = "SELECT F_NAME FROM fields where F_ID = '$FNUM'";
    $fieldnameget = mysqli_query($connectionstring,$fieldnamequery);
    while($get = mysqli_fetch_assoc($fieldnameget)){
    $fieldname = $get['F_NAME'];
    }
    ?>
    <h6><strong><span class="badge-light"><?php echo $fieldname?></span></strong></h6>
    <hr>
    <img style=" float: right;" title="Featured Job" src="featured.png" width="32px" height="32px">
    
    <a href="MoreInfoJobs.php?J_ID=<?php echo $fjobs['J_ID']?> & user=<?php echo $u_id?> & field=<?php echo $jobs['J_FIELD']?>"><input type="button" class="btn btn-info" value="More Information" style="width: 12vw;"></a>
    <br>
</div>     

</div> 
<br>    
<?php
    }
         
?> 
 
</div>     
</div>
      
</div>
  
</div>

 
</body>

</html>