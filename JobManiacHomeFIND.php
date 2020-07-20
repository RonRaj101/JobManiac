<?php
include("DBCONNECT.php");
session_start();

$user = $_SESSION['user'];

$userid = "SELECT ID FROM userprofiles WHERE Name = '$user'";
$useridget = mysqli_query($connectionstring,$userid);

while($id = mysqli_fetch_assoc($useridget)){
    $u_id = $id['ID'];
}


if($user == null){
    header("location:Login.php");
}

$getfieldquery = "SELECT * FROM fields";
$fields = mysqli_query($connectionstring,$getfieldquery);

error_reporting(0);

if(isset($_POST['field'])){
    extract($_POST); 
    $f_id = $_POST['field'];
    echo($f_id);
     header("location:JobSearchResult.php?field=$f_id & user= $u_id ");
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>JOB MANIAC</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<link type="text/css" href="Style.css" rel="stylesheet">
<style>
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
</style>    
 
<script>
$(document).ready(function() {
  const $valueSpan = $('.valueSpan2');
  const $value = $('#customRange11');
  $valueSpan.html($value.val());
  $value.on('input change', () => {
    $valueSpan.html($value.val());
  });
});    
</script>    
</head>

<body style="font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif';" >
    
   
    <br>
     <center>
    <h1 class="logo"><ins>JOB MANIAC</ins></h1>
    </center> 
    <br>
<nav class="navbar navbar-expand-lg" style="border: 1px solid aliceblue; border-radius: 1vw; background-color: aliceblue; ">
  <div class="collapse navbar-collapse" id="navbarNav">
      <center>
    <ul class="navbar-nav">
      <li class="nav-item active" style="margin-left: 15vw;">
        <a class="nav-link" href="#">Saved Job's</a>
        <span class="badge badge-danger"><?php echo $rows;?></span>  
      </li>
      <li class="nav-item active" style="margin-left: 15vw;">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item active" style="margin-left: 15vw;">
        <a class="nav-link" href="Profile.php">Profile Information</a>
      </li>
      <li class="nav-item active" style="margin-left: 15vw;">
        <a class="nav-link" href="LogOut.php">Log Out</a>
      </li>    
    </ul>
        </center>  
  </div>
</nav>

<br>

<br>    
<div class="quicksearchjobs container" style="float:left; width: 400px;">
<br>
   
<form action="" method="post" class="formsearch" style="">
    
<h4><strong><?php echo $user?></strong> is Looking For a Job in </h4> 
<div class="jobsearchform">    
<div class="fieldselect">

<select name="field" class="form-control" style="width:400px;"> 
<?php
while ($fieldata = mysqli_fetch_assoc($fields)) {			 
?>        
 <option value="<?php echo $fieldata['F_ID']?>"><?php echo $fieldata['F_NAME']?></option>
<?php
    }
?>        
</select>

</div>
<div class="searchbutton">    
<input type="submit" class="btn btn-success" value="Search" style="width:100px; margin-left: 1vw;"> 
</div>
</div>    
</form> 

 <br>
</div>
</body>
</html>