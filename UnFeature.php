<?php
include("DBCONNECT.php");
$j_id = $_GET['J_ID'];

$unfeaturesql = "UPDATE jobs SET Featured = '0' WHERE J_ID='$j_id'";
$unfeature = mysqli_query($connectionstring,$unfeaturesql);

header('location:EmployerListings.php?f=2');

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Un-Feature Job Listing</title>
</head>

<body>
</body>
</html>