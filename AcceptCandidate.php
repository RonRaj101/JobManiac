<?php
include('DBCONNECT.php');
$u_id = $_GET['ID'];
$j_id = $_GET['J_ID'];

$AcceptCandidatesql = "UPDATE jobapplications SET Accepted = '1' WHERE J_ID='$j_id' AND U_ID='$u_id'";
$AcceptCandidate = mysqli_query($connectionstring,$AcceptCandidatesql);

header("location:JobApplicants.php?U_ID=$u_id & J_ID=$j_id & s=a"); 


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Accepting Candidate....</title>
<link href="https://fonts.googleapis.com/css2?family=Recursive:wght@500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet"> 
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