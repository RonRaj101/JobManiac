<?php
include('DBCONNECT.php');

$u_id = $_GET['ID'];
$j_id = $_GET['J_ID'];
$f_id = $_GET['field'];


$getcvnamesql = "SELECT cvfileurl FROM userprofiles WHERE ID='$u_id'";
$getcvname = mysqli_query($connectionstring,$getcvnamesql);

while($cv = mysqli_fetch_assoc($getcvname)){
    $cvname = $cv['cvfileurl'];
}

if($cvname == null){
    header("location:Profile.php?ID=$u_id & s=addcv");
}
else{
$applyjobsql = "INSERT INTO jobapplications(J_ID,U_ID,cvfileurl) VALUES('$j_id','$u_id','$cvname')";
$applyjob = mysqli_query($connectionstring,$applyjobsql) or die("Cannot Apply For This Job!");

header("location:MoreInfoJobs.php?J_ID=$j_id & user=$u_id & field=$f_id");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Apply For Job</title>
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
</style>        
</head>

<body>
<br>
    <center>
    <h1 class="logo">QUICK NOKRI.com</h1>
    </center> 
    <br>    
</body>
</html>