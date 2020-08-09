<?php
include('DBCONNECT.php');
$u_id = $_GET['ID'];
$j_id = $_GET['J_ID'];

$AcceptCandidatesql = "UPDATE jobapplications SET Accepted = '1' WHERE J_ID='$j_id' AND U_ID='$u_id'";
$AcceptCandidate = mysqli_query($connectionstring,$AcceptCandidatesql);

$RejectRestsql = "UPDATE jobapplications SET Accepted='2' WHERE Accepted='0' AND J_ID='$j_id'";
$RejectRest = mysqli_query($connectionstring,$RejectRestsql);

$InactivateJobsql = "UPDATE jobs SET Active='0' WHERE J_ID='$j_id'";
$InactivateJob = mysqli_query($connectionstring,$InactivateJobsql);

$UnFeatureJobsql = "UPDATE jobs SET Featured = 0 WHERE Active = 0 AND J_ID='$j_id' ";
$UnFeatureJob = mysqli_query($connectionstring,$UnFeatureJobsql);


header("location:JobApplicants.php?U_ID=$u_id & J_ID=$j_id & s=a");  

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Accepting Candidate....</title>
<link href="https://fonts.googleapis.com/css2?family=Recursive:wght@500&display=swap" rel="stylesheet">
<style>
   
</style>    
</head>
<body>
    
<center> 
<h2 style="font-family: 'Recursive', sans-serif; "><strong style="color: #42FF2C;">Congratulations!</strong> For Selecting Your Perfect Candidate.</h2>
<br>    
<img src="tick.png" width="350px" height="360px">
</center> 
    
<?php include('footer.php');?>  
</body>
</html>