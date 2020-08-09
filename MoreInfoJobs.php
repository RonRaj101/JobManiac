<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Additional Information</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">     
<link type="text/css" href="Style.css" rel="stylesheet">
<style>
.logo{
        font-family: 'Lobster', cursive;
    }    
</style>    
</head>

<body>
    <br>
     <center>
    <h1 class="logo">QUICK NOKRI.com</h1>
    </center> 
    <br>    
<?php
include('DBCONNECT.php');

$job_id = $_GET['J_ID']; 
$user = $_GET['user'];    
    
$getjobinfoquery = "SELECT * FROM jobs WHERE J_ID = '$job_id'";
$getjobinfo = mysqli_query($connectionstring,$getjobinfoquery);
    
$getjobapplsql = "SELECT A_ID FROM jobapplications WHERE J_ID = '$job_id' AND U_ID = '$user'";
$getjobappl = mysqli_query($connectionstring,$getjobapplsql);

$jobappl_bin = mysqli_num_rows($getjobappl);    
?>
<br><br><br>    
<div style="box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 3px; width: 50vw; margin: 0px auto; background-color: white; border-radius: 0.2vw;" id="jobadditionalinfo">
<?php
if($getjobinfo != NULL){    
while($info = mysqli_fetch_assoc($getjobinfo)){
?>
<div id="info" style=" padding: 1.5vw;">
    
<h3><strong><?php echo $info['J_TITLE'] ?></strong></h3>
<hr> 
<h5>At <strong><?php echo $info['J_COMPANY'];?></strong></h5>      
<h6>"<strong><i><?php echo $info['J_DESC'];?></i></strong>"</h6>
<?php
    
?>    
<h5>Starting Salary of <strong><?php echo $info['J_SALARY']; ?></strong> Rs/Month</h5>
<?php
$typeid = $info['J_TYPE'];                                               
$gettypenamequery = "SELECT T_NAME FROM jobtype WHERE T_ID = '$typeid'";
$gettypename = mysqli_query($connectionstring,$gettypenamequery);
while($n = mysqli_fetch_assoc($gettypename)){
    $typename = $n['T_NAME'];
}                                               
?>    
<i><?php echo $typename ?></i>
<?php
$fieldid = $info['J_FIELD'];                                               
$getfieldnamequery = "SELECT F_NAME FROM fields WHERE F_ID = '$fieldid'";
$getfieldname = mysqli_query($connectionstring,$getfieldnamequery);
while($n = mysqli_fetch_assoc($getfieldname)){
    $fieldname = $n['F_NAME'];
}         
?>    
<h5><Strong><?php echo $fieldname ?></Strong></h5>    
<hr>
<?php
if($jobappl_bin == 0){    
?>    
<a href="JobApplication.php?ID=<?php echo $user?> & J_ID=<?php echo $job_id?> & field = <?php echo $fieldid?>"><input class="btn btn-success" style="width: 15vw; float: right;" type="button" value="Apply For Job"></a>
<?php
}
elseif($jobappl_bin == 1){                                               
?>
<a><input class="btn btn-dark" style=" border-radius: 0vw; width: 15vw; float: right;" type="button" value="Already Applied For This Job"></a>    
<?php
   } 
?>  
<a href="JobManiacHomeFIND.php?field=<?php echo $fieldid?>"><input type="button" style="width: 5vw; float: left;" class="btn btn-dark" value="<<"></a> 
<br>    
</div>
   
<?php
}
}
else{
    echo "";
}    

?>   
</div>     
</body>
</html>