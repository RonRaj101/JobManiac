<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Deleting..</title>
</head>

<body>
<?php
include("DBCONNECT.php");
    
$id = $_GET['J_ID'];

$sql = "DELETE FROM jobs WHERE J_ID = '$id'"; 
$val = $connectionstring -> query ($sql);
     
if($val){
    
    header('Location:EmployerListings.php');
    echo('<script>alert("Data Deleted")</script>');
}
    
?>        
</body>
</html>