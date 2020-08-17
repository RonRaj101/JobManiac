<?php
include('DBCONNECT.php');
$u_id = $_GET['ID'];

$GetJobssql = "SELECT * FROM jobs WHERE J_CREATOR='$u_id'";
$GetJobs = mysqli_query($connectionstring,$GetJobssql);

$jobids = array();
$employee_ids = array();

 while($gj = mysqli_fetch_assoc($GetJobs)){
    $jobids[] = $gj['J_ID'];
}
    

for($x = 0;$x<count($jobids);$x++){

$GetAccepted_cand_sql = "SELECT * FROM jobapplications WHERE Accepted = 1 AND J_ID='$jobids[$x]'";
$GetAccepted_cand = mysqli_query($connectionstring,$GetAccepted_cand_sql);

while($e = mysqli_fetch_assoc($GetAccepted_cand)){
    $employee_ids[] = $e['U_ID'];
    $acceptedjobids[] = $e['J_ID'];
}

    
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Accepted Candidates</title>
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
     <br>
     <center>
<h1 class="logo"><a style="text-decoration: none;" href="EmployerListings.php">QUICK NOKRI.com</a></h1>  
 </center> 
<br>    
   <?php
    for($c = 0;$c<count($employee_ids);$c++){
        
    $getinfosql = "SELECT * FROM userprofiles WHERE ID='$employee_ids[$c]'";
    $getinfo = mysqli_query($connectionstring,$getinfosql);
      
    $getjobinfosql = "SELECT * FROM jobs WHERE J_ID='$acceptedjobids[$c]'";
    $getjobinfo = mysqli_query($connectionstring,$getjobinfosql);
    
    while($j = mysqli_fetch_assoc($getjobinfo)){
        $jobname = $j['J_TITLE'];
    }    
        
    while($i = mysqli_fetch_assoc($getinfo)){
        
   ?> 

   <div id="" style=" margin: 0px auto; width:40vw; height:25vh; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 3px; padding: 1vw; border:2px solid blue;"> 
    <h5>For Job Title: <strong><?php echo $jobname?></strong></h5>    
   <div style="width: 9vw; float: left; border-right:1px solid black;">       
     <img width="65%" height="50%" src="<?php echo $i['profileimgurl']?>"> 
   </div>  
   <div style="width:10vw; float:left; margin-left: 1vw;">   
     <h4><strong><?php echo $i['Name']?></strong></h4>    
      <h5 style=""><?php echo $i['Email']?></h5>
      <h6><?php echo $i['Phone']?></h6>
     <a href="<?php echo $i['cvfileurl']?>" target="_blank"><h6>Check CV</h6></a>   
    </div>
<br><br>
<a href=""><input type="button" class="btn btn-info" style="float: right; width: 17vw; border-radius:0px;" value="Waiting For Employee Approval.." disabled></a>
</div>
 <br>  
   <?php
    }
    }   
   ?>
    
<?php include('footer.php');?>      
</body>
</html>