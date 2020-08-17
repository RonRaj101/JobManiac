<?php
include('DBCONNECT.php');
$j_id = $_GET['J_ID'];
$u_id = $_GET['U_ID'];

$unactivatesql = "UPDATE jobs SET Active=0 WHERE J_ID='$j_id' and J_CREATOR='$u_id'";
$unactivate = mysqli_query($connectionstring,$unactivatesql);

header('location:EmployerListings.php?status=ua');

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>UnActivating</title>
</head>

<body>
</body>
</html>