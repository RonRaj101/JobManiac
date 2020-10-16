<?php
include('DBCONNECT.php');
$u_id = $_GET['ID'];

$getprofileimgsql = "SELECT profileimgurl FROM userprofiles WHERE ID='$u_id'";
$getprofileimg = mysqli_query($connectionstring,$getprofileimgsql);

while($img = mysqli_fetch_assoc($getprofileimg)){
        $imgurl = $img["profileimgurl"];
} 

$getappliedjobssql = "SELECT J_ID FROM jobapplications WHERE U_ID = $u_id";
$getappliedjobs = mysqli_query($connectionstring,$getappliedjobssql);

$getappliedjobstatussql = "SELECT Accepted FROM jobapplications WHERE U_ID='$u_id'";
$getappliedjobstatus = mysqli_query($connectionstring,$getappliedjobstatussql);
    
$appli_status = array();
    
while($appl = mysqli_fetch_assoc($getappliedjobstatus)){
        $appli_status[] = $appl["Accepted"];
} 

$getsavedjobssql = "SELECT * FROM savedjobs WHERE U_ID='$u_id'";
$getsavednum = mysqli_query($connectionstring,$getsavedjobssql);

$sjs = mysqli_num_rows($getsavednum);


$rows = mysqli_num_rows($getappliedjobs);

$jobids = array();

$j_ids = array();
$j_titles = array();
$j_descs = array();
$j_salaries = array();
$j_typeids = array();
$j_fieldids = array();
$j_companies = array();

while($ids = mysqli_fetch_array($getappliedjobs)){
    $j_ids[] = $ids['J_ID'];
    
}

for($x = 0;$x<=count($j_ids)-1;$x++){
    $getjobinfoquery = "SELECT * FROM jobs WHERE J_ID= '$j_ids[$x]'";
    $getjobinfo = mysqli_query($connectionstring,$getjobinfoquery);
    
    while($info = mysqli_fetch_assoc($getjobinfo)){
        $j_titles[] = $info['J_TITLE'];
        $j_descs[] = $info['J_DESC'];
        $j_salaries[] = $info['J_SALARY'];
        $j_typeids[] = $info['J_TYPE'];
        $j_fieldids[] = $info['J_FIELD'];
        $j_companies[] = $info['J_COMPANY'];
        
    }
    
}    
  

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>QUICKNOKRI | Applied Jobs (<?php echo $rows?>)</title>
<link rel="shortcut icon" href="logoinv.ico"/>      
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

 body{
        
    }

    nav li{
        padding-left: 10px;
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

<body>
   
<nav class="navbar navbar-expand-lg navbar-light bg-light display-4" style="font-size:15px;" >
  <a class="navbar-brand" href="#"><img width="50px" height="50px" src="logoinv.png" alt="QuickNokri"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav" style="">
    <ul class="navbar-nav ml-auto" style="float: right!important;">
     <li class="nav-item">
        <a class="nav-link" href="JobManiacHomeFIND.php">Home</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="JobSearchResult.php?ID=<?php echo $u_id?>">Advanced Job Search</a>
      </li>
       <li class="nav-item " style="">
        <a class="nav-link" href="SavedJobs.php?user=<?php echo $u_id?>">Saved Job's <span class="badge badge-info"><?php echo $sjs ?></span></a> 
      </li>
             <li class="nav-item" style="">
        <a class="nav-link" href="#">Featured Jobs</a>
      </li>    

      <li class="nav-item" style="">
        <a class="nav-link active" href="#">Applied Jobs <span class="badge badge-info"><?php echo $rows ?></span></a>
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
<br>    
<center>
<h6>You Have Applied for a Total of <strong><u><?php echo $rows ?></strong></u> Jobs</h6>
</center>  
    <br>
    <?php
  for($c = 0;$c <= $rows - 1 ;$c++){          
?>
    
<div class="jobsearchresults" style=" margin: 0px auto; width:600px; border:0.1vw solid black; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 3px; border-radius: 5px; padding: 10px; word-break: break-all; box-sizing: content-box;">
<div>
   <?php
    if($appli_status[$c] == 0){
    $appli_status_name = "Job Application Sent! Awaiting Response";
    $button_color = "dark";
    }
   elseif($appli_status[$c] == 1){
    $appli_status_name = "Job Application Accepted! Accept Job Offer";
    $button_color = "success";
    }
   elseif($appli_status[$c] == 2){
    $appli_status_name = "Job Application Rejected";
    $button_color = "danger";
    }

    ?>
 
    <h6 hidden=""><?php ?></h6>    
    <h4><strong><?php echo $j_titles[$c] ?></strong></h4>
    <hr>
    <h5><strong><?php echo $j_companies[$c] ?></strong></h5>    
   
    <?php
    $typeid = $j_typeids[$c];                                               
    $gettypenamequery = "SELECT T_NAME FROM jobtype WHERE T_ID = '$typeid'";
    $gettypename = mysqli_query($connectionstring,$gettypenamequery);
    while($n = mysqli_fetch_assoc($gettypename)){
    $typename = $n['T_NAME'];
    }                            
    ?>    
    <h6> <?php echo $typename ?> </h6>
    
    <?php
    $fieldid = $j_fieldids[$c];                                               
    $getfieldnamequery = "SELECT F_NAME FROM fields WHERE F_ID = '$fieldid'";
    $getfieldname = mysqli_query($connectionstring,$getfieldnamequery);
    while($n = mysqli_fetch_assoc($getfieldname)){
    $fieldname = $n['F_NAME'];
    }
    $curr_jobid = $j_ids[$c];                                
    ?>

    <h6><strong><span class="badge-light"><?php echo $fieldname ?></span></strong></h6>
    <hr>
    <a href="MoreInfoJobs.php?J_ID=<?php echo $j_ids[$c] ?> & user=<?php echo $u_id ?>"><input type="button" class="btn btn-info" value="More Information" style="width: 180px;"></a>
    <input style="float: right; width: 400px; border-radius: 0px;" class="btn btn-<?php echo $button_color?>" type="button" value="<?php echo $appli_status_name?>">
    <br>
</div>     
</div>
 
<br>
<?php
}

?> 
<?php include('footer.php');?>  

</body>
</html>