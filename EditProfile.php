<?php
include('DBCONNECT.php');
$u_id = $_GET['ID'];

$getinfoquery = "SELECT * FROM userprofiles WHERE ID = '$u_id'";
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
            
        $dpuploadquery = "UPDATE userprofiles SET profileimgurl = '$FileDestination' WHERE ID = '$u_id'";
        $dpupload = mysqli_query($connectionstring,$dpuploadquery) or die('Cannot Upload');    
            echo "<div class='alert alert-success alert-dismissible'>
    <center><strong>Profile Picture Uploaded/Updated</strong></center>
    </div>";
            header("location:EditProfile.php?ID=$u_id");
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
            
        $cvuploadquery0 = "UPDATE userprofiles SET cvfileurl = '$FileGOTO' WHERE ID = '$u_id'";
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
     header("location:EditProfile.php?ID=$u_id");    
    }
}


if(isset($_POST['p_name']) and isset($_POST['p_email']) and isset($_POST['p_phone']) and isset($_POST['p_pass']) and isset($_POST['p_sl'])){
    extract($_POST);
    $updatesql = "UPDATE userprofiles SET Name ='$p_name', Email = '$p_email' , Phone = '$p_phone' , Password = '$p_pass', social_link = '$p_sl' WHERE ID ='$u_id'";
    $update = mysqli_query($connectionstring,$updatesql) or die('Nahi Horaha');
    if($update){
        header("location:Profile.php?ID=$u_id");
    }
    else{
         header("location:Profile.php?ID=$u_id");
    }
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Profile Information</title>
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
<center>    
<a href="Profile.php?ID=<?php echo $u_id?>"><h1 style=" text-decoration: none; padding-top: 1vw; width: 25vw;" class="logo">QUICK NOKRI.com</h1></a>
</center>
<br>
<div style=" margin:0px auto; width: 500px;">   
    <form action="" method="post" id="edit" ></form>
    <form action="" enctype="multipart/form-data" method="post" id="updateimg"></form>
    <form action="" enctype="multipart/form-data" method="post" id="addcv"></form>
<br>    
<center>    
<hr>     
<h3>Edit Profile Information</h3>
</center>    
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
    
    
<img name="dp" src="<?php echo $dp?>" width="124px" height="164px">
<br><br>    
<input form="updateimg" style="width: 15vw;" type="file" name="p_dp" class="form-control-file">        
<input form="updateimg" type="submit" style="width: 8vw; border-radius: 0vw;" name="updatedp" value="Update Image" class="btn btn-dark">

<br>    
<br> 
<label>CV File: </label>
    
<a target="_blank" href="<?php echo $cv?>"><?php echo $cv?></a>  
<input form="addcv" type="file" name="p_cv" class="form-control-file"> 
<input form="addcv" type="submit" style="width: 10vw; border-radius: 0vw;" name="cvu" value="Update/Upload CV" class="btn btn-dark">    
<br><br> 
<label>Social Link</label>     
<input form="edit" class="form-control" placeholder="Add Social Link" type="text" name="p_sl" value="<?php echo $social ?>">
<br>    
<input form="edit" class="btn btn-success" name="editjob" style="width:150px; float: right;" type="submit" value="Confirm Edit">  

<br>    
<a href="Profile.php?ID=<?php echo $u_id?>"><input type="button" class="btn btn-dark" value="Go Back" style="width: 150px; float: left;"></a>
<br>    
<hr>    
</div>
<?php include('footer.php');?>    
</body>
</html>