<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>UnSaving...</title>
</head>

<body>
<?php
include("DBCONNECT.php");
    
$j_id = $_GET['J_ID'];     
$u_id = $_GET['U_ID'];

echo $j_id,$u_id;    

$sql = "DELETE FROM savedjobs WHERE J_ID = '$j_id' AND U_ID = '$u_id'"; 
$val = mysqli_query($connectionstring,$sql) or die("NOT POSSIBLE");
     

    header("location:JobManiacHomeFIND.php?unsaved=1");
    echo(' <script>alert("Data Deleted")</script> ');

    
       
?>
</body>
</html>