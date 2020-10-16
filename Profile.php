<?php
error_reporting(0);
include('DBCONNECT.php');

$userid = $_GET['ID'];
$error = $_GET['s'];



$getprofileinfoquery = "SELECT * FROM userprofiles WHERE ID=$userid";
$getprofileinfo = mysqli_query($connectionstring,$getprofileinfoquery);

$getprofileinfonav = "SELECT * FROM userprofiles WHERE ID=$userid";
$getpicnav= mysqli_query($connectionstring,$getprofileinfoquery);


while($pic = mysqli_fetch_assoc($getpicnav)){

    $navimgurl = $pic['profileimgurl'];

}

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
            echo "Error in Uploading File!";
        }
        
    }
    else{
        echo "Incorrect Format!";
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


if(isset($_POST['updatedp'])){
    extract($_POST);
    $file = $_FILES['p_dp'];
    $fileName = $_FILES['p_dp']['name'];
    $fileTempLocation = $_FILES['p_dp']['tmp_name'];
    $fileSize = $_FILES['p_dp']['size'];
    $fileError = $_FILES['p_dp']['error'];
    $filetype = $_FILES['p_dp']['type'];
    
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
            echo "<div class='alert alert-success alert-dismissible'>
    <center><strong>Profile Picture Uploaded/Updated</strong></center>
    </div>";
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

if(isset($_POST['cvu'])){
    extract($_POST);
    $file = $_FILES['p_cv'];
    
    $fileName0 = $_FILES['p_cv']['name'];
    $fileTempLocation0 = $_FILES['p_cv']['tmp_name'];
    $fileSize0 = $_FILES['p_cv']['size'];
    $fileError0 = $_FILES['p_cv']['error'];
    $filetype0 = $_FILES['p_cv']['type'];
    
    $filetypeget0 = explode('.',$fileName0);
    $fileEXT0 = strtolower(end($filetypeget0));
    
    $allowedEXT0 = array('jpg','jpeg','png','pdf');
    
    if(in_array($fileEXT0,$allowedEXT0)){
        if($fileError0 === 0){
           
        $File_Name0 = uniqid('',true).".".$fileEXT0;
        $FileGOTO = 'File Uploads/'.$File_Name0;   
        move_uploaded_file($fileTempLocation0,$FileGOTO);   
            
        $cvuploadquery0 = "UPDATE userprofiles SET cvfileurl = '$FileGOTO' WHERE ID = '$userid'";
        $cvupload0 = mysqli_query($connectionstring,$cvuploadquery0) or die('Cannot Upload');    
            
        }
        
        else{
            echo "Error in Uploading File";
        }
        
    }
    else{
        echo "<div class='alert alert-success alert-dismissible'>
    <center><strong>CV Uploaded/Updated</strong></center>
    </div>";
     header("location:Profile.php?ID=$userid?ac=staticBackdrop");    
    }
}

$action = $GET['ac'];



if(isset($_POST['p_name']) and isset($_POST['p_email']) and isset($_POST['p_phone']) and isset($_POST['p_pass']) and isset($_POST['p_sl'])){
    extract($_POST);
    $updatesql = "UPDATE userprofiles SET Name ='$p_name', Email = '$p_email' , Phone = '$p_phone' , Password = '$p_pass', social_link = '$p_sl' WHERE ID ='$userid'";
    $update = mysqli_query($connectionstring,$updatesql) or die('Nahi Horaha');
    if($update){
        header("location:Profile.php?ID=$userid");
    }
    else{
         header("location:Profile.php?ID=$userid");
    }
}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>QUICKNOKRI | Profile </title>
<link rel="shortcut icon" href="logoinv.ico"/>      
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<?php
if($action == 'staticBackdrop'){
?>
<script>
    $('#<?php echo $action?>').modal('show');
</script>
<?php
}
?>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">   
<link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">     
<link type="text/css" href="Style.css" rel="stylesheet">
<link type="text/css" href="all.css" rel="stylesheet">
<style>
    
     .logo{
        font-family: 'Lobster', cursive;
    }

    .table{
         all:none;
    }

   nav ul li{
     padding-right: 20px;
   }

    .dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
  right: 0;
}

.dropdown:hover .dropdown-content {
  display: block;
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

   <br> 
 
 <nav class="navbar navbar-expand-lg navbar-light bg-light display-4" style="font-size:15px;" >
  <a class="navbar-brand" href="#"><img width="50px" height="50px" src="logoinv.png" alt="QuickNokri"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav" style="">
    <ul class="navbar-nav ml-auto" style="float: right!important;">
      <li class="nav-item " style="">
        <a class="nav-link" href="<?php echo $red_url?>"><?php echo $goto?></a> 
      </li>  
      <li class="nav-item " style="">
        <a class="nav-link" href="About.php?ID=<?php echo $user_id?>">About</a>
      </li> 
      <li class="nav-item">
        <div class="dropdown" style="float: right;">
           <center>
           <img id="profileimg" width="35px" height="30px" title="Profile Information" src="<?php echo $navimgurl ?>">
           </center>
           <div class="dropdown-content">
           <img id="" width="75px" height="60px" title="Profile Information" src="<?php echo $navimgurl ?>">
           <br><br>
           <a class="badge badge-light" style="padding:0.75vw;" href="Profile.php?ID=<?php echo $userid?>">Profile Information</a>
           <br>
           <a class="badge badge-light" style="padding: 0.5vw;" href="LogOut.php">Log Out  <img width="15px" height="15px" src="logout.png" alt=""></a>
           </div>
        </div>
      </li>    
    </ul>
  </div>
</nav> 


<br>
<?php 
while($info = mysqli_fetch_assoc($getprofileinfo)){
?>    
<br> 
<?php
if($info['profileimgurl'] == NULL){    
?> 
<img src="profile_none.webp" width="15%" height="20%" style="margin-left: 10px;" alt="..." class="img-thumbnail">

<form enctype="multipart/form-data" method="post" style="width: 200px;" action=""> 

<input style="width:100%; font-size: 15px;" type="file" name="dp" class="form-control-file">
  
<input type="submit" style="width:70%; border-radius: 0vw;" name="uploaddp" value="Upload Image" class="btn btn-dark">
</form>    
<?php
}
else{
   $imgurl = $info['profileimgurl'];  
?>
<img style="margin-left:10px;" src="<?php echo $imgurl?>" width="15%" height="20%" alt="..." class="img-thumbnail">

<?php
    
  }   
?>
    



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


<table class="table table-responsive" style="padding-left: 10px;">
  <thead>
    <tr>
     
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Name</th>
      <td><?php echo $info['Name']?></td>
    </tr>
    <tr>
      <th scope="row">Email</th>
      <td><?php echo $info['Email']?></td>
      
    </tr>
    <tr>
      <th scope="row">Phone Number</th>
      <td colspan="2"><?php echo $info['Phone']?></td>
      
    </tr>
     <tr>
      <th scope="row">Account Type</th>
      <td colspan="2"><?php echo $purpose ?></td>
      
    </tr>
     <tr>
      <th scope="row">Password</th>
      <td colspan="2"><?php echo $info['Password']?></td>
    </tr>

     <tr>
      <th scope="row">Verification Status</th>
      <td colspan="2"><?php echo $v_status?>
      <?php if($info['Verified'] == 0){?>
<a title="Verify your Account to get a Verified Badge" href="ProfileVerification.php?ID=<?php echo $userid?>"> (Verify Account) </a> <?php } else{?><img width="25px" height="25px" title="Verified Account" src="<?php echo $verifiedimg?>"><?php }?>        
      </td>
    </tr>

     <tr>
      <th scope="row">Social Link</th>
        <?php
if(empty($info['social_link'])){  
?>    
 <td id="ans">Link Not Added, Edit to Setup</td>    
<?php
}
else{    
?>
<td id="ans"><?php echo $info['social_link']?></td>     
<?php
}   
?>    
   

    </tr>

    <tr>
      <th scope="row">CV</th>
      <td colspan="2">
          <?php
 while($cv = mysqli_fetch_assoc($checkcv)){
       $cv_name = $cv['cvfileurl'];
   }       
    
 if($cv_name == NULL){  
?>    
<form enctype="multipart/form-data" method="post" action="" style="width:200px;">
<input type="file" class="form-control-file" name="cv" style="width:120%; font-size: 15px;" required>
<input value="Upload" type="submit" name="cvupload" class="btn btn-dark" style="width:55%;  font-size: 12px; border-radius: 0px;">    
</form>    
<?php
   } 
   else{
?> 
  <a target="_blank" href="<?php echo $cv_name?>">Check Your CV</a>     
<?php
  }   
?>    
      </td>
    </tr>
     <tr>
      <th scope="row"></th>
      <td colspan="2"><button class="btn btn-dark" data-toggle="modal" data-target="#staticBackdrop">Edit Profile Information</button></td>
    </tr>
  </tbody>
</table>
<?php
}        
?>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Profile Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
$getinfoquery = "SELECT * FROM userprofiles WHERE ID = '$userid'";
$getinfo = mysqli_query($connectionstring,$getinfoquery);

while($info = mysqli_fetch_assoc($getinfo)){
    $id = $info['ID'];
    $name = $info['Name'];
    $email = $info['Email'];
    $phone = $info['Phone'];
    $purpose = $info['Purpose'];
    $pass = $info['Password'];
    $dp = $info['profileimgurl'];
    $cv = $info['cvfileurl'];
    $social = $info['social_link'];
}
        ?>
        <form action="" method="post" id="edit"></form>
        <form action="" enctype="multipart/form-data" method="post" id="updateimg"></form>
        <form action="" enctype="multipart/form-data" method="post" id="addcv"></form>

<input form="edit" class="form-control" type="hidden" name="p_id" value="<?php echo $id ?>">
<br>
<label>Name</label>    
<input form="edit" class="form-control" type="text" name="p_name" value="<?php echo $name ?>">
<br>   
<label>Email</label>     
<input form="edit" type="text" class="form-control" name="p_email" value="<?php echo $email ?>"></textarea>
<br> 
<label>Phone Number</label>     
<input form="edit" class="form-control" type="number" name="p_phone" value="<?php echo $phone ?>">
<br>
<label>Password</label>     
<input form="edit" class="form-control" type="text" name="p_pass" value="<?php echo $pass ?>">
<br>
    
    
<img class="img-thumbnail" name="dp" src="<?php echo $dp?>" width="40%" height="40%">
<br>
<input form="updateimg"  type="file" name="p_dp" class="form-control-file">        
<input form="updateimg" type="submit" style="width: 140px; border-radius: 0vw;" name="updatedp" value="Update Image" class="btn btn-dark">

<br>    
<br> 
<label>CV File: </label>
    
<a target="_blank" href="<?php echo $cv?>"><?php echo $cv?></a>  
<input form="addcv" type="file" name="p_cv" class="form-control-file"> 
<input form="addcv" type="submit" style="width: 120px; border-radius: 0vw;" name="cvu" value="Update CV" class="btn btn-dark">    
<br><br> 
<label>Social Link</label>     
<input form="edit" class="form-control" placeholder="Add Social Link" type="text" name="p_sl" value="<?php echo $social ?>">
<br>    
    
      </div>
      <div class="modal-footer">
        <button type="button" style="max-width: 200px;" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input form="edit" class="btn btn-success" name="editjob" style="width:150px; float: right;" type="submit" value="Confirm Edit">  
      </div>
    </div>
  </div>
</div>
<br>
<?php
include('footer.php');    
?>    
</body>
</html>