<?php
include('DBCONNECT.php');

$u_id = $_GET['ID'];

$getuserdetailsquery = "SELECT profileimgurl,cvfileurl,Purpose FROM userprofiles WHERE ID = '$u_id'";
$getuserdetails = mysqli_query($connectionstring,$getuserdetailsquery);

while($get = mysqli_fetch_assoc($getuserdetails)){
    $ans1  = $get['profileimgurl'];
    $ans2 = $get['cvfileurl'];
    $p = $get['Purpose'];
}

if(!empty($ans1) and !empty($ans2))
{
    
   $verifyquery = "UPDATE userprofiles SET Verified = 1 WHERE ID = '$u_id'";
   $verify = mysqli_query($connectionstring,$verifyquery);    
   header("location:Profile.php?ID=$u_id");
    
    echo"<div class='alert alert-success alert-dismissible'>
    <center><strong>Profile Verified</strong></center>
    </div>";    
}

elseif (empty($ans1) and empty($ans2)){
    header("location:Profile.php?ID=$u_id & s=addboth");

}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Account Verification...</title>
</head>

<body>
    
</body>
</html>