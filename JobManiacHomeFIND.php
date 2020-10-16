<?php
include("DBCONNECT.php");
error_reporting(1);  
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>QUICKNOKRI | Employee Portal</title>
<link rel="shortcut icon" href="logoinv.ico"/>      
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet"> 
<link type="text/css" href="Style.css" rel="stylesheet">
<link type="text/css" href="all.css" rel="stylesheet">


<style>
    
    .logo{
        font-family: 'Lobster', cursive;
    }
    
    #profileimg{
        border-radius: 100%;
    }

    body{
        padding: 1vw;
    }

    nav li{
        padding-left: 2vw;
    }
    *{
        font-family: 'Epilogue', sans-serif;

    }

    .dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
  right: 0;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>    
  
</head>

<body style="" class="">

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


<nav class="navbar navbar-expand-lg navbar-light bg-light display-4" style="font-size:15px; min-width: 500px;" >
  <a class="navbar-brand" href="#"><img width="50px" height="50px" src="logoinv.png" alt="QuickNokri"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav" style="">
    <ul class="navbar-nav ml-auto" style="float: right!important;">
     <li class="nav-item active">
        <a class="nav-link" href="JobManiacHomeFIND.php">Home</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="JobSearchResult.php?ID=<?php echo $u_id?>">Advanced Job Search</a>
      </li>
       <li class="nav-item " style="">
        <a class="nav-link" href="SavedJobs.php?user=<?php echo $u_id?>">Saved Job's <span class="badge badge-info"><?php echo $rows ?></span></a> 
      </li>
             <li class="nav-item " style="">
        <a class="nav-link" href="#">Featured Jobs</a>
      </li>    
       <li class="nav-item " style="">
        <a class="nav-link" href="JobsAppliedFIND.php?ID=<?php echo $u_id?>">Applied Job's
          <span class="badge badge-info"><?php echo $rows1 ?></span>
          </a> 
      </li> 
      <li class="nav-item " style="">
        <a class="nav-link" href="About.php?ID=<?php echo $u_id?>">About</a>
      </li> 
       <li class="nav-item">
        <div class="dropdown" style="float: right;">
           <center>
           <img id="profileimg" width="35px" height="30px" title="Profile Information" src="<?php echo $imgurl ?>">
           </center>
           <div class="dropdown-content">
           <img id="" width="75px" height="60px" title="Profile Information" src="<?php echo $imgurl ?>">
           <br><br>
           <a class="badge badge-light" style="padding:0.75vw;" href="Profile.php?ID=<?php echo $u_id?>">Profile Information</a>
           <br>
           <a class="badge badge-light" style="padding: 0.5vw;" href="LogOut.php">Log Out  <img width="15px" height="15px" src="logout.png" alt=""></a>
           </div>
        </div>
      </li>   
    </ul>
  </div>
</nav>
   
<hr>    
<div style="float: left; width: auto; margin-left: 1vw;">
<br>    
<div class="searchjobs" style="">   
<form action="" method="post" class="" style="flo">
    
<h4><strong><?php echo $user?></strong> is Looking For a Job in </h4> 
<div class="jobsearchform">    
<div class="fieldselect">

<select name="field" class="form-control" style="min-width:400px;"> 
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


<?php

$x = 0;    
if(mysqli_num_rows($result) > 0){  
while($jobs = mysqli_fetch_assoc($result)){
$x++;
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
    
<div class="jobsearchresults" style=" background-color: #FFFFFF; min-width:518px; max-width: 518px; border:3px solid black; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 3px; border-radius:5px; padding: 10px;">
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
        <img style="float: right; display: inline-flex;" title="Featured Job" src="featured.png" width="32px" height="32px">
    <?php
     }
    ?>


<p>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#a<?php echo $j_id?>" aria-expanded="false" aria-controls="a<?php echo $j_id?>">
    More Information
  </button>
</p>


<div class="collapse" id="a<?php echo $j_id?>">
  <div class="card card-body">
    <?php
    $getjobinfoquery = "SELECT * FROM jobs WHERE J_ID = '$j_id'";
    $getjobinfo = mysqli_query($connectionstring,$getjobinfoquery);
    
    $getjobapplsql = "SELECT A_ID FROM jobapplications WHERE J_ID = '$j_id' AND U_ID = '$u_id'";
    $getjobappl = mysqli_query($connectionstring,$getjobapplsql);

    $jobappl_bin = mysqli_num_rows($getjobappl);    

    ?>
    <?php
if($getjobinfo != NULL){    
while($info = mysqli_fetch_assoc($getjobinfo)){
?>

    
<h3><strong><?php echo $info['J_TITLE'] ?></strong></h3>

<h5>At <strong><?php echo $info['J_COMPANY'];?></strong></h5>      
<h6>"<strong><i><?php echo $info['J_DESC'];?></i></strong>"</h6>
<?php
    
?>    
<h5>Starting Salary of <strong><?php echo $info['J_SALARY']; ?></strong> Rs/Month</h5>
<?php
$typeid = $info['J_TYPE'];                                               
$gettypenamequery = "SELECT T_NAME FROM jobtype WHERE T_ID = '$typeid'";
$gettypename = mysqli_query($connectionstring,$gettypenamequery);
while($n = mysqli_fetch_assoc($gettypename)){
    $typename = $n['T_NAME'];
}                                               
?>    
<strong><i><?php echo $typename ?></i></strong>
<?php
$fieldid = $info['J_FIELD'];                                               
$getfieldnamequery = "SELECT F_NAME FROM fields WHERE F_ID = '$fieldid'";
$getfieldname = mysqli_query($connectionstring,$getfieldnamequery);
while($n = mysqli_fetch_assoc($getfieldname)){
    $fieldname = $n['F_NAME'];
}         
?>    
<h5><Strong><?php echo $fieldname ?></Strong></h5>    
<hr>
<?php
if($jobappl_bin == 0){    
?>    
<a href="JobApplication.php?ID=<?php echo $u_id?> & J_ID=<?php echo $j_id?> & field = <?php echo $fieldid?>"><input class="btn btn-success" style="width: 250px; float: right;" type="button" value="Apply For Job"></a>
<?php
}
elseif($jobappl_bin == 1){                                               
?>
<a><input class="btn btn-dark" style=" border-radius: 0px; width: 250px; float: right;" type="button" value="Already Applied For This Job" disabled></a>    
<?php
   } 
?>  
   

   
<?php
}
}
else{
    echo "";
}    

?>   
  </div>
</div>
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

   
<br>    
</div>
<br>    
<br>
    

 
</div>     
</div>
      
</div>
  
</div>


 
</body>

</html>