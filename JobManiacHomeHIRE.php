<?php
include("DBCONNECT.php");
session_start();

$user = $_SESSION['user'];

if($user == null){
    header("location:Login.php");
}

$getid = "SELECT ID FROM userprofiles WHERE Name = '$user'";
$idresult = mysqli_query($connectionstring,$getid);

while($row = mysqli_fetch_assoc($idresult)){
    $id = $row['ID'];
}

$getuserauthsql = "SELECT Purpose FROM userprofiles WHERE ID='$id'";
$getuserauth = mysqli_query($connectionstring,$getuserauthsql);

while($a = mysqli_fetch_assoc($getuserauth)){
    $auth = $a['Purpose'];
}

if($auth == 1){
    header("location:JobManiacHomeFIND.php");
}

else{
    echo "";
}

$getprofiledetailsquery = "SELECT * FROM userprofiles WHERE ID='$id'";
$getprofiledetails = mysqli_query($connectionstring,$getprofiledetailsquery);

while($pic = mysqli_fetch_assoc($getprofiledetails)){
    $imgurl = $pic['profileimgurl'];
}

$_SESSION['id'] = $id;

$getfieldquery = "SELECT * FROM fields";
$fields = mysqli_query($connectionstring,$getfieldquery);


if(isset($_POST['title']) and isset($_POST['desc']) and isset($_POST['salary']) and isset($_POST['type']) and isset($_POST['field']) and isset($_POST['org']) and $id != null){
    extract($_POST);
    $addjobquery = "INSERT INTO jobs(J_TITLE,J_DESC,J_SALARY,J_TYPE,J_FIELD,J_COMPANY,J_CREATOR) values('$title','$desc','$salary','$type','$field','$org','$id')";
    $joblist = mysqli_query($connectionstring,$addjobquery);
    
    echo('<div class="alert alert-info alert-dismissible">
    <center><strong>Job Listing Created Successfully</strong></center>
    </div>');
    
}

$getunseenjobs = "SELECT * FROM jobs WHERE J_CREATOR = '$id' AND Seen = 0 ";
$unseen = mysqli_query($connectionstring,$getunseenjobs);

$rowsunread = mysqli_num_rows($unseen);

$gettotaljobs = "SELECT * FROM jobs WHERE J_CREATOR = '$id'";
$total = mysqli_query($connectionstring,$gettotaljobs);

$rowstotal = mysqli_num_rows($total);

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
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">     
<link type="text/css" href="Style.css" rel="stylesheet"> 
<style>
     .logo{
        font-family: 'Lobster', cursive;
    }
     a{
        color: green;
        text-decoration: none;
    }
    
    a:hover{
        color: greenyellow;
        border-bottom: 2px solid lawngreen;
        text-decoration: none;
    }
    
    nav ul li{
        padding: 0.5vw;
        
    }
    
    nav{
        height: 10px;
    }
    
     #profileimg{
        border-radius: 01vw;
    }
    
  
</style>    
</head>

<body style="font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif';" >
    
    
   <header style=" width: 98vw;">
<a href="JobManiacHomeHIRE.php"><h1 style=" width: 25vw; padding: 1vw; float: left;" class="logo">QUICK NOKRI.com</h1></a>
    
<nav class="navbar navbar-expand-lg" style=" margin-right: 4vw; background-color: aliceblue; display: block; float: right; flex-flow: nowrap;">
  <div class="collapse navbar-collapse" id="navbarNav">
      <center>
   
    <ul class="navbar-nav">   
      <li class="nav-item active" style="">
        <a class="nav-link" href="EmployerListings.php">Your Job Listings
          <span class="badge badge-info"><?php echo $rowstotal;?></span>    
    <span class="badge badge-danger"><?php echo $rowsunread;?></span>
          </a> 
      </li>
      <li class="nav-item active" style="">
        <a class="nav-link" href="About.php?ID=<?php echo $id?>">About</a>
      </li>
        <li class="nav-item active" style="">
        <a class="nav-link" href="AcceptedCandidates.php?ID=<?php echo $id?>">Accepted Candidates</a>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <img id="profileimg" width="35px" height="37px;" title="Profile Information" src="<?php echo $imgurl?>">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="Profile.php?ID=<?php echo $id?>">Profile</a>
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
<br>    
 <center>   
<h5>Welcome, <strong><?php echo $_SESSION['user']?></strong></h5>
 </center>     
<br>
    <div class="create-job container" style="box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 5px; width:60w; margin:0px auto;">
        <br>
    <center>    
    <h3>Create Job Listing</h3> 
    <hr>    
 </center> 
        
    
        
    <form method="post" action="" style="padding:1vw; ">    
       <br> 
    <input type="text" class="form-control" style="width:250px;" name="title" placeholder="Job Title" required>
  <br>
    <textarea style="width: 350px;" cols="100" rows="10" class="form-control form-text" placeholder="Job Description" name="desc" required></textarea>
    <br>
    <input type="number" class="form-control" id="paisa" style="width:250px;" name="salary" placeholder="Salary(RS/Month)" required>   
<br>
    <?php
    $getjobtypequery = "SELECT * FROM jobtype";
    $getjobtype = mysqli_query($connectionstring,$getjobtypequery);
    ?>    
    <select id="jtype" class="form-control" style="width: 250px;" name="type" required>
        <option selected disabled>Job Type</option>
         <?php
         while($types = mysqli_fetch_assoc($getjobtype)){
         ?>    
        <option value="<?php echo $types['T_ID']?>"><?php echo $types['T_NAME']?></option>
         <?php
         }
         ?>    
    </select> 
        <br>
<select name="field" class="form-control" style="width: 250px;"> 
     <option selected disabled>Field of Job</option>
     <?php
     while ($fieldata = mysqli_fetch_assoc($fields)) {			 
     ?>        
     <option value="<?php echo $fieldata['F_ID']?>"><?php echo $fieldata['F_NAME']?></option>
     <?php
         }
     ?>        
</select>
    <br>    
    <input type="text" class="form-control" style="width:300px;" name="org" placeholder="Organization">
        <hr>
    <input type="submit" class="btn btn-success" style="width:200px;" value="Create Job Listing">
    </form> 
    <br>    
    </div>  
    
    <br>
    <br>

<?php include('footer.php');?>      
</body>
</html>