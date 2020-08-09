<?php
error_reporting(0);
include('DBCONNECT.php');

$userid = $_GET['ID'];
$error = $_GET['s'];



$getprofileinfoquery = "SELECT * FROM userprofiles WHERE ID=$userid";
$getprofileinfo = mysqli_query($connectionstring,$getprofileinfoquery);





if(isset($_POST['uploaddp'])){
    $file = $_FILES['dp'];
    
    $fileName = $_FILES['dp']['name'];
    $fileTempLocation = $_FILES['dp']['tmp_name'];
    $fileSize = $_FILES['dp']['size'];
    $fileError = $_FILES['dp']['error'];
    $filetype = $_FILES['dp']['type'];
    
    $filetypeget = explode('.',$fileName);
    $fileEXT = strtolower(end($filetypeget));
    
    $allowedEXT = array('jpg','jpeg','png');
    
    if(in_array($fileEXT,$allowedEXT)){
        if($fileError === 0){
           
        $FileEncName = uniqid('',true).".".$fileEXT;  
        $FileDestination = 'Image Uploads/'.$FileEncName; 
        move_uploaded_file($fileTempLocation,$FileDestination);   
            
        $dpuploadquery = "UPDATE userprofiles SET profileimgurl = '$FileDestination' WHERE ID = '$userid'";
        $dpupload = mysqli_query($connectionstring,$dpuploadquery) or die('Cannot Upload');    
        header("location:Profile.php?ID=$userid");    
        }
        else{
            echo "Error in Uploading File";
        }
        
    }
    else{
        echo "";
    }
}

if(isset($_POST['cvupload'])){
    $file = $_FILES['cv'];
    
    $fileName0 = $_FILES['cv']['name'];
    $fileTempLocation0 = $_FILES['cv']['tmp_name'];
    $fileSize0 = $_FILES['cv']['size'];
    $fileError0 = $_FILES['cv']['error'];
    $filetype0 = $_FILES['cv']['type'];
    
    $filetypeget0 = explode('.',$fileName0);
    $fileEXT0 = strtolower(end($filetypeget0));
    
    $allowedEXT0 = array('jpg','jpeg','png','pdf');
    
    if(in_array($fileEXT0,$allowedEXT0)){
        if($fileError0 === 0){
           
        $File_Name = uniqid('',true).".".$fileEXT0;
        $FileGOTO = 'File Uploads/'.$File_Name;   
        move_uploaded_file($fileTempLocation0,$FileGOTO);   
            
        $dpuploadquery0 = "UPDATE userprofiles SET cvfileurl = '$FileGOTO' WHERE ID = '$userid'";
        $dpupload0 = mysqli_query($connectionstring,$dpuploadquery0) or die('Cannot Upload');    
        header("location:Profile.php?ID=$userid");    
        }
        
        else{
            echo "Error in Uploading File";
        }
        
    }
    else{
        echo "";
    }
}

$getredirectsql = "SELECT Purpose FROM userprofiles WHERE ID ='$userid'";
$getredirect = mysqli_query($connectionstring,$getredirectsql);

while($url = mysqli_fetch_assoc($getredirect)){
    $p_id = $url['Purpose'];
}

if($p_id == 0){
    $red_url = "JobManiacHomeHIRE.php";
    $goto = "Create Job Listing";
}
elseif($p_id == 1){
    $red_url = "JobManiacHomeFIND.php";  
    $goto = "Find Jobs";
}

$checkcvquery = "SELECT cvfileurl FROM userprofiles WHERE ID='$userid'";
$checkcv = mysqli_query($connectionstring,$checkcvquery);





?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Profile Information</title>
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
    
    table tr td{
        padding: 1vw;
    }
    
    #ans{
        color: #616161;
        
    }
    
    #ans a {
    
    }
    
    #profile-display{
        width: 13vw;
        height: 30vh;
        border: 1px solid black;
        border-radius: 0.1vw;
        background-color: #BBBBBB;
    }
</style>        
</head>

<body>
   <?php 
    if($error == 'adddp'){
    ?>
    <div class="alert alert-danger alert-dismissible">
    <center><strong>You Need to be Verified to Apply For A Job </strong></center>
    </div>
    <?php 
     }
    elseif($error == 'addboth'){
    ?>
    <div class="alert alert-danger alert-dismissible">
    <center><strong>You Need to Add a Profile Picture & CV to be Verified </strong></center>
    </div>
    <?php
    }
    ?>
 <header style=" width: 98vw;">
     
<a href="<?php echo $red_url?>"><h1 style=" padding-top: 1vw; width: 25vw; padding-left: 1vw; float: left;" class="logo">QUICK NOKRI.com</h1></a>
    
<nav class="navbar navbar-expand-lg" style=" background-color: aliceblue; display: block; float: right; flex-flow: nowrap;">
  <div class="collapse navbar-collapse" id="navbarNav">
      <center> 
    <ul class="navbar-nav">
      <li class="nav-item active" style="">
        <a class="nav-link" href="<?php echo $red_url?>"><?php echo $goto?></a> 
      </li>
      <li class="nav-item active" style="">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item active" style="">
        <a class="nav-link" href="LogOut.php">Log Out</a>
      </li>    
    </ul>
        </center>  
  </div>
</nav>
</header>    
<br>    
<br>
<hr>
<br>
<?php 
while($info = mysqli_fetch_assoc($getprofileinfo)){
?>    
 
<center>   
<h3>Profile Information</h3> 

<br>    
   

<br> 
<?php
if($info['profileimgurl'] == NULL){    
?> 
<form enctype="multipart/form-data" method="post" action="">    
<input style="width: 15vw; padding-left: 1vw;" type="file" name="dp" class="form-control-file">
<br>    
<input type="submit" style="width: 8vw; border-radius: 0vw;" name="uploaddp" value="Upload Image" class="btn btn-dark">
</form>    
<?php
}
else{
   $imgurl = $info['profileimgurl'];  
?>
<img src="<?php echo $imgurl?>" width="190px" height="225px">    
<?php
    
  }   
?>
    
<br><br> 
<?php
 while($cv = mysqli_fetch_assoc($checkcv)){
       $cv_name = $cv['cvfileurl'];
   }       
    
 if($cv_name == NULL){  
?>    
<form enctype="multipart/form-data" method="post" action="">
<input type="file" class="form-control-file" name="cv" style="width: 15vw; padding-left: 1.5vw;" required>
<input value="Upload Your CV" type="submit" name="cvupload" class="btn btn-dark" style="width: 12vw; border-radius: 0vw;">    
</form>    
<?php
   } 
   else{
?> 
  <a target="_blank" href="<?php echo $cv_name?>">Check Your CV</a>     
<?php
  }   
?>    
</center>    
<br>
<?php
if($info['Purpose'] == 1){
    $purpose = "Job Seeker Account";
}  
elseif($info['Purpose'] == 0){
    $purpose = "Employer Account";
}                                                   
?>    
<?php
if($info['Verified'] == 0){
    $v_status = "Not Verified";
}

    
elseif($info['Verified'] == 1){
    $v_status = "Verified";
    $verifiedimg = "verified.png";
}                                                   
                                                   
?>        
<br>
<table border="1" style=" width: 75vw;  margin: 0px auto;">
<th>Name</th>
<th>Email</th> 
<th>Phone Number</th> 
<th>Account Type</th>
<th>Password</th> 
<th>Verification</th> 
<th>Social Link</th>    
<tr>
<td id="ans"><h4><?php echo $info['Name']?></h4></td>
<td id="ans"><h4><?php echo $info['Email']?></h4></td> 
<td id="ans"><h4><?php echo $info['Phone']?></h4></td>
<td id="ans"> <h4><?php echo $purpose ?></h4></td> 
<td id="ans"><h4><?php echo $info['Password']?></h4></td>
<td id="ans"><h4><?php echo $v_status?></h4></td>
<?php
if(empty($info['social_link'])){  
?>    
 <td id="ans"><h4>Link Not Added</h4> Edit to Setup</td>    
<?php
}
else{    
?>
<td id="ans"><h4><?php echo $info['social_link']?></h4></td>     
<?php
}   
?>    
   
<td><a href="EditProfile.php?ID=<?php echo $userid?>">Edit</a></td> 
<td style="width: 9vw;"><center>
<?php if($info['Verified'] == 0){?>
<a title="Verify your Account to get a Verified Badge" href="ProfileVerification.php?ID=<?php echo $userid?>">Verify Account </a> <?php } else{?><img width="32px" height="32px" title="Verified Account" src="<?php echo $verifiedimg?>"><?php }?></center></td>    
</tr>    



   
 
</table>    
<?php
}        
?>
<br>
<?php
include('footer.php');    
?>    
</body>
</html>