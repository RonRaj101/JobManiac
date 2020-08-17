<?php
include('DBCONNECT.php');
$j_id = $_GET['J_ID'];
$u_id = $_GET['U_ID'];

$reactivatesql = "UPDATE jobs SET Active=1 WHERE J_ID='$j_id' and J_CREATOR='$u_id'";
$reactivate = mysqli_query($connectionstring,$reactivatesql);

header('location:EmployerListings.php?status=ra');

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reactivating...</title>
</head>

<body>
</body>
</html>