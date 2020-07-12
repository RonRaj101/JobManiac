<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Saving...</title>
</head>

<body>
<?php 
include("DBCONNECT.php");
    
$u_id = $_GET['U_ID'];  
$j_id = $_GET['J_ID'];    

$savejobquery = "INSERT INTO savedjobs(J_ID,U_ID) VALUES('$u_id','$j_id')";
$savejob = mysqli_query($connectionstring,$savejobquery) or die("Cannot Perform Query");
    
echo("<script> alert('Job Saved') </script>");
header("location:JobManiacHomeFIND.php");    
?>    
</body>
</html>