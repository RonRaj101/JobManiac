<?php
include('DBCONNECT.php');
    
$user_id = $_GET['user']; 

$getprofiledetailsquery = "SELECT * FROM userprofiles WHERE ID='$user_id'";
$getprofiledetails = mysqli_query($connectionstring,$getprofiledetailsquery);

while($pic = mysqli_fetch_assoc($getprofiledetails)){
    $imgurl = $pic['profileimgurl'];
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Saved Jobs</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">    
    
<link type="text/css" href="Style.css" rel="stylesheet">

<style>
    
      
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
        height: 3vh;
    }
    
      
    #profileimg{
        border-radius: 01vw;
    }
</style>        
</head>

<body>
 <header style=" width: 98vw;">
<a href="JobManiacHomeFIND.php"><h1 style=" width: 25vw; padding: 1vw; float: left;" class="logo">QUICK NOKRI.com</h1></a>
    
<nav class="navbar navbar-expand-lg" style=" background-color: aliceblue; display: block; float: right; flex-flow: nowrap;">
  <div style="margin-right: 3vw;" class="collapse navbar-collapse" id="navbarNav">
      <center> 
    <ul class="navbar-nav">
      <li class="nav-item active" style="">
        <a class="nav-link" href="JobSearchResult.php?ID=<?php echo $user_id?>">Advanced Job Search</a> 
      </li>    
      <li class="nav-item active" style="">
        <a class="nav-link" href="JobManiacHomeFIND.php">Search For Jobs</a> 
      </li>
      <li class="nav-item active" style="">
        <a class="nav-link" href="#">About</a>
      </li>
          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <img id="profileimg" width="35px" height="37px;" title="Profile Information" src="<?php echo $imgurl?>">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="Profile.php?ID=<?php echo $user_id?>">Profile</a>
          <a class="dropdown-item" href="LogOut.php">Log Out <img width="24px" height="24px" src="logout.png"></a>        
        </div>
      </li>    
    </ul>  
        </center>  
  </div>
</nav>
</header>    
<br>
<br>    
<br>    
<hr>    
<?php


$get = "SELECT * FROM savedjobs WHERE U_ID = '$user_id'";
$exec = mysqli_query($connectionstring,$get);
    
$rows = mysqli_num_rows($exec);

$getjobidquery = "SELECT J_ID FROM savedjobs WHERE U_ID = '$user_id'";    
$getjobid = mysqli_query($connectionstring,$getjobidquery);
    
$j_ids = array();
$j_titles = array();
$j_descs = array();
$j_salaries = array();
$j_typeids = array();
$j_fieldids = array();
$j_companies = array();
   
    
while($ids = mysqli_fetch_array($getjobid)){
    $j_ids[] = $ids['J_ID'];
}


for($x = 0;$x<=count($j_ids)-1;$x++){
    
    $getjobinfoquery = "SELECT * FROM jobs WHERE J_ID= '$j_ids[$x]' AND Active='1'";
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
<br>
<center>    
<h6><strong><u><?php echo $rows ?></strong></u> Jobs Saved </h6>
  <p class="text-muted">Cannot Find a Particular Job? It May Have Been Removed or have Found A Candidate.</p>    
</center>  
<br> 
<?php
  for($c = 0;$c <= $rows - 1 ;$c++){          
?>

    
<div class="jobsearchresults" style=" margin: 0px auto; width:40vw; border:0.1vw solid black; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 3px; border-radius: 0.4vw; padding: 1vw; word-break: break-all; box-sizing: content-box;">
<div>
   
    <a style="float: right;" href="Unsave.php?J_ID=<?php echo $j_ids[$c]?> & U_ID=<?php echo $user_id ?>"><h5>Unsave</h5></a>
 
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
    ?>
    <h6><strong><span class="badge-light"><?php echo $fieldname ?></span></strong></h6>
    <hr>
    <a href="MoreInfoJobs.php?J_ID=<?php echo($j_ids[$c]) ?> & user=<?php echo $user_id ?>"><input type="button" class="btn btn-info" value="More Info" style="width: 12vw;"></a>
    <br>
</div>     
</div>
 
<br>
<?php
}   
?> 
<br>    
<?php include('footer.php');?>  
    
        
</body>
</html>