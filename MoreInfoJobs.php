<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Additional Information</title>
</head>

<body>
<?php
include('DBCONNECT.php');
include('JobSearchResult.php');

$job_id = $_GET['J_ID']; 
    
$getjobinfoquery = "SELECT * FROM jobs WHERE J_ID = '$job_id'";
$getjobinfo = mysqli_query($connectionstring,$getjobinfoquery);
?>
  
<div style=" margin-right: 5vw; float: right; width: 40vw; background-color: white; border-radius: 0.2vw;" id="jobadditionalinfo">
<?php
while($info = mysqli_fetch_assoc($getjobinfo)){
    $a = $info['J_ID'];
    $b = $info['J_TITLE'];
    $c = $info['J_DESC'];
    $d = $info['J_SALARY'];
    $e = $info['J_FIELD'];
    $f = $info['J_COMPANY'];
    $g = $info['J_CREATOR'];
    $h = $info['J_TYPE'];
}    
?>
<div id="info" style="margin-left: 1vw; padding: 1vw;">    
<h3>Be a <i><?php echo $h?></i> <strong><?php echo $b?></strong></h3>
<h5>At <strong><?php echo $f?></strong></h5>  
<hr>     
<h6>Job Description: <strong><i><?php echo $c?></i></strong></h6> 
<h5>Work in the Field of <Strong><?php echo $e?></Strong></h5>
<h4>With a starting salary of <strong><?php echo $d?></strong> Rs/Month</h4>    
<hr>
<input class="btn btn-success" type="button" value="Apply For Job">   
</div>    
<?php

?>   
</div>    
</body>
</html>