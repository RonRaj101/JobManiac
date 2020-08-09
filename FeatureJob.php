<?php
include("DBCONNECT.php");
$j_id = $_GET['J_ID'];

$featuresql = "UPDATE jobs SET Featured = '1' WHERE J_ID='$j_id'";
$feature = mysqli_query($connectionstring,$featuresql);

header('location:EmployerListings.php?f=1');

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Featuring Job</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> 
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">    
<link type="text/css" href="Style.css" rel="stylesheet">    
</head>
<style>
.logo{
        font-family: 'Lobster', cursive;
    }  
    
    .col-sm{
        width: 30vw;
        border:0.5vw solid black;
    }
    
    
</style>    
<body>
<br>    
<center>
<a style="text-decoration: none;" href="EmployerListings.php"><h1 class="logo">QUICK NOKRI.com</h1></a>
</center>

</body>
</html>