<?php 
include("DBCONNECT.php");

$j_id = $_GET['J_ID'];     
$u_id = $_GET['U_ID'];  
   
$savejobquery = "INSERT INTO savedjobs(S_ID,J_ID,U_ID,Seen) VALUES (NULL,'$j_id','$u_id','0')";
$savejob = mysqli_query($connectionstring,$savejobquery) or die('Cannot Perform Query');

header("location:JobManiacHomeFIND.php?saved=1");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Saving...</title>
<script>

</script>   
</head>

<body>

    
    
</body>
</html>