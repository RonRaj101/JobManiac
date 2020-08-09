<?php
error_reporting(0);
include('DBCONNECT.php');
$j_id = $_GET['J_ID'];
$u_id = $_GET['U_ID'];
$status = $_GET['s'];

$getapplicantsql = "SELECT U_ID FROM jobapplications WHERE J_ID='$j_id'";
$getapplicants = mysqli_query($connectionstring,$getapplicantsql);

$u_ids = array();

while($apps = mysqli_fetch_assoc($getapplicants)){
    $u_ids[] = $apps['U_ID'];
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Job Applicants</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">       
<link type="text/css" href="Style.css" rel="stylesheet">
<style>
  #profileimg{
        border-radius: 01vw;
    }
     .logo{
        font-family: 'Lobster', cursive;
    }
    
     nav a{
        color: green;
    
    }
    
    nav a:hover{
        color: greenyellow;
        border-bottom: 2px solid lawngreen;
    }
    
    nav ul li{
        padding: 0.5vw;
        
    }
    
    nav{
        height: 5vh;
        background-color: aliceblue;
    } 
    
    *{
        box-sizing: border-box;
    }    
</style>    
</head>
<body>
<?php
 if($status == 'a'){   
?> 
 <div class="alert alert-success alert-dismissible">
    <center><strong>Candidate Accepted</strong></center>
    </div>
<?php
   }
   elseif($status == 'na'){    
?> 
<div class="alert alert-success alert-dismissible">
    <center><strong>Candidate's Rejected </strong></center>
    </div>
<?php
   } 
?>     
 <br>
     <center>
<h1 class="logo"><a style="text-decoration: none;" href="EmployerListings.php">QUICK NOKRI.com</a></h1>
 <br>  
 </center>            
         
<div style=" padding: 1vw; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 3px; width: 52vw; height: 102vh; margin: 0px auto; background-color: white; border-radius: 0.2vw; overflow-y: scroll;">
<br>
  
<center>    
 <h3>People Who Applied On Your Job</h3>
 <h6>(You Can Only Select <strong>One</strong> Candidate)</h6>
 <p><ins>Rest Will be Automatically Rejected</ins></p>    

</center>
<br>
<h5>Filter Job Applications</h5>    
<select class="form-control" id="filter-box">
<option value="all">Show All</option>   
<option value="accept">Accepted Candidate</option>
<option value="reject">Rejected Candidate's</option>       
</select> 
<br>    
<button style="width: 13vw;" class="btn btn-secondary" onClick="sh()">Filter Applicants</button>    
<hr>
<br>
 
<?php  
      $ids = array();
      $names = array();
      $emails = array();
      $numbers = array();
      $verifed = array();
      $dpimg = array(); 
      $cvfile = array(); 
      
    
    for($c=0;$c<count($u_ids);$c++){
      $getprofileinfosql = "SELECT * FROM userprofiles WHERE ID='$u_ids[$c]'";
      $getprofileinfo = mysqli_query($connectionstring,$getprofileinfosql);
  
        
      while($info = mysqli_fetch_assoc($getprofileinfo)){
        $ids[] = $info['ID'];   
        $names[] = $info['Name'];
        $emails[] = $info['Email'];
        $numbers[] = $info['Phone'];
        $verified[] = $info['Verified'];
        $dpimg[] = $info['profileimgurl'];
        $cvfile[] = $info['cvfileurl']; 
    }    
    }  
?>
<?php
for($x = 0;$x<count($u_ids);$x++){
$employee_id = $ids[$x];    
$getapplicationstatussql = "SELECT Accepted FROM jobapplications WHERE U_ID = '$ids[$x]' AND J_ID='$j_id'";
$getapplicationstatus = mysqli_query($connectionstring,$getapplicationstatussql);

while($appl_status = mysqli_fetch_assoc($getapplicationstatus)){
    $acp = $appl_status['Accepted'];
}
 
if($acp == 0){
  $size_hor = "40vw";
  $size_box = "15vw";
  $border = "2px solid green";
  $box_id = 'SC';    
}     
    
if($acp == 1){
  $size_hor = "47vw";
  $size_box = "15vw";
  $border = "2px solid blue"; 
  $box_id = 'CA';    
} 
elseif($acp == 2){
    $size_hor = "35vw";
    $size_box = "12vw";
    $border = "2px solid red";
    $box_id = 'CR';
}    
    
?>
<div id="<?php echo $box_id?>" style=" margin: 0px auto; width:<?php echo $size_hor?>; height:20vh; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 3px; padding: 1vw; border:<?php echo $border?>;">   
<div style="width: 9vw; float: left; border-right:1px solid black;">       
<img width="100px" height="120px" src="<?php echo $dpimg[$x]?>"> 
</div>
<div style="width:<?php echo $size_box?>; float:left; margin-left: 1vw;">   
<h4><strong><?php echo $names[$x]?></strong></h4>    
<h5 style=""><?php echo $emails[$x]?></h5>
<h6><?php echo $numbers[$x]?></h6>
<a href="<?php echo $cvfile[$x]?>" target="_blank"><h6>Check CV</h6></a>   
</div>
<?php 
error_reporting(0);        
if($acp == 0){        
?> 
<br><br>
<a href="AcceptCandidate.php?ID=<?php echo $ids[$x]?> & J_ID=<?php echo $j_id?>"><input type="button" class="btn btn-success" style="float: right; width: 10vw; border-radius:0px;" value="Select Candidate"></a>
<?php
}
elseif($acp == 1){
?> 
<br><br>
<input type="button" class="btn btn-info" style="display: inline;float: right; width: 10vw; border-radius:0px;" value="Candidate Selected" disabled>  
<?php
} 
elseif($acp == 2){    
?>
<br><br>    
<input type="button" class="btn btn-danger" style="float: right; width: 10vw; border-radius:0px;" value="Candidate Rejected" disabled> 
<?php
}
?>    
    
</div>
    
<hr>    
<?php
    }
?> 
   
</div>
<script>
function sh(){    
var selectboxval = document.getElementById('filter-box');
if(selectboxval.value == "all"){
    document.getElementById('SC').style.display = 'block';
    document.getElementById('CA').style.display = 'block';
    document.getElementById('CR').style.display = 'block';
}
else if(selectboxval.value = "accept"){
    document.getElementById('SC').style.display = 'none';
    document.getElementById('CR').style.display = 'none';
    document.getElementById('CA').style.display = 'block';
    
} 
else if(selectboxval.value = "reject"){
    document.getElementById('SC').style.display = 'none';
    document.getElementById('CA').style.display = 'none';
    document.getElementById('CR').style.display = 'block';
} 
}    
</script>
<?php include('footer.php');?>      
</body>
</html>