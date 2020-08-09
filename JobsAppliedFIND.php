<?php
include('DBCONNECT.php');
$u_id = $_GET['ID'];

$getappliedjobssql = "SELECT J_ID FROM jobapplications WHERE U_ID = $u_id";
$getappliedjobs = mysqli_query($connectionstring,$getappliedjobssql);

$getappliedjobstatussql = "SELECT Accepted FROM jobapplications WHERE U_ID='$u_id'";
$getappliedjobstatus = mysqli_query($connectionstring,$getappliedjobstatussql);
    
$appli_status = array();
    
while($appl = mysqli_fetch_assoc($getappliedjobstatus)){
        $appli_status[] = $appl["Accepted"];
} 



$rows = mysqli_num_rows($getappliedjobs);

$jobids = array();

$j_ids = array();
$j_titles = array();
$j_descs = array();
$j_salaries = array();
$j_typeids = array();
$j_fieldids = array();
$j_companies = array();

while($ids = mysqli_fetch_array($getappliedjobs)){
    $j_ids[] = $ids['J_ID'];
    
}

for($x = 0;$x<=count($j_ids)-1;$x++){
    $getjobinfoquery = "SELECT * FROM jobs WHERE J_ID= '$j_ids[$x]'";
    $getjobinfo = mysqli_query($connectionstring,$getjobinfoquery);
    
    while($info = mysqli_fetch_assoc($getjobinfo)){
        $j_titles[] = $info['J_TITLE'];
        $j_descs[] = $info['J_DESC'];
        $j_salaries[] = $info['J_SALARY'];
        $j_typeids[] = $info['J_TYPE'];
        $j_fieldids[] = $info['J_FIELD'];
        $j_companies[] = $info['J_COMPANY'];
        
    }
    
}    
  

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Jobs Applied For</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
    <h1 class="logo"><a style="text-decoration:none;" href="JobManiacHomeFIND.php">QUICK NOKRI.com</a></h1>
    </center>
    <br>
    <center>    
<h6><strong><u><?php echo $rows ?></strong></u> Jobs Applied </h6>
</center>  
    <br>
    <?php
  for($c = 0;$c <= $rows - 1 ;$c++){          
?>
    
<div class="jobsearchresults" style=" margin: 0px auto; width:40vw; border:0.1vw solid black; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 3px; border-radius: 0.4vw; padding: 1vw; word-break: break-all; box-sizing: content-box;">
<div>
   <?php
    if($appli_status[$c] == 0){
    $appli_status_name = "Job Application Sent";
    $button_color = "dark";
    }
   elseif($appli_status[$c] == 1){
    $appli_status_name = "Job Application Accepted! Accept Job Offer";
    $button_color = "success";
    }
   elseif($appli_status[$c] == 2){
    $appli_status_name = "Job Application Rejected";
    $button_color = "danger";
    }

    ?>
 
    <h6 hidden=""><?php ?></h6>    
    <h4><strong><?php echo $j_titles[$c] ?></strong></h4>
    <hr>
    <h5><strong><?php echo $j_companies[$c] ?></strong></h5>    
   
    <?php
    $typeid = $j_typeids[$c];                                               
    $gettypenamequery = "SELECT T_NAME FROM jobtype WHERE T_ID = '$typeid'";
    $gettypename = mysqli_query($connectionstring,$gettypenamequery);
    while($n = mysqli_fetch_assoc($gettypename)){
    $typename = $n['T_NAME'];
    }                            
    ?>    
    <h6><?php echo $typename ?></h6>
    
    <?php
    $fieldid = $j_fieldids[$c];                                               
    $getfieldnamequery = "SELECT F_NAME FROM fields WHERE F_ID = '$fieldid'";
    $getfieldname = mysqli_query($connectionstring,$getfieldnamequery);
    while($n = mysqli_fetch_assoc($getfieldname)){
    $fieldname = $n['F_NAME'];
    }
    $curr_jobid = $j_ids[$c];                                
    ?>
    <h6><strong><span class="badge-light"><?php echo $fieldname ?></span></strong></h6>
    <hr>
    <a href="MoreInfoJobs.php?J_ID=<?php echo $j_ids[$c] ?> & user=<?php echo $u_id ?>"><input type="button" class="btn btn-info" value="More Information" style="width: 12vw;"></a>
    <input style="float: right; width: 20vw; border-radius: 0px;" class="btn btn-<?php echo $button_color?>" type="button" value="<?php echo $appli_status_name?>">
    <br>
</div>     
</div>
 
<br>
<?php
}
?> 
<?php include('footer.php');?>  
</body>
</html>