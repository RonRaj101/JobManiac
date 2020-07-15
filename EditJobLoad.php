<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
<?php
include("DBCONNECT.php");
include("EmployerListings.php");   
    
$job_id = $_GET['J_ID'];

$user_id = $id;
    
header('location:EmployerListings.php?J_ID=$job_id');   
?>
<script>
document.getElementById('#myModal').style.display = 'block';
</script>   

</body>
</html>