<?php
include("DBCONNECT.php");
$job_id = $_GET['J_ID'];

$getjobinfoquery = "SELECT * FROM jobs WHERE J_ID = '$job_id'";
$getjobinfo = mysqli_query($connectionstring,$getjobinfoquery);

while($info = mysqli_fetch_assoc($getjobinfo)){
    $id = $info['J_ID'];
    $title = $info['J_TITLE'];
    $desc = $info['J_DESC'];
    $salary = $info['J_SALARY'];
    $type_id = $info['J_TYPE'];
    $fieldid = $info['J_FIELD'];
    $company = $info['J_COMPANY'];
}

$getjobtypename = "SELECT * FROM jobtype WHERE T_ID = '$type_id'";
$jobtypename = mysqli_query($connectionstring,$getjobtypename);
while($n = mysqli_fetch_assoc($jobtypename)){
    $typename = $n['T_NAME'];
}

$getfieldnamequery = "SELECT F_NAME FROM fields WHERE F_ID = '$fieldid'";
$getfieldname = mysqli_query($connectionstring,$getfieldnamequery);

while($row = mysqli_fetch_assoc($getfieldname)){
    $field = $row['F_NAME'];
}

$getallfieldsquery = "SELECT * FROM fields";
$getallfields = mysqli_query($connectionstring,$getallfieldsquery);

if(isset($_POST['j_title']) and isset($_POST['j_desc']) and isset($_POST['j_salary']) and isset($_POST['j_types']) and isset($_POST['j_field']) and isset($_POST['j_org'])){
    extract($_POST);
    $updatesql = "UPDATE jobs SET J_TITLE='$j_title', J_DESC = '$j_desc' , J_SALARY = '$j_salary' , J_TYPE = '$j_types', J_FIELD = '$j_field', J_COMPANY = '$j_org' WHERE J_ID ='$job_id'";
    $update = mysqli_query($connectionstring,$updatesql) or die('Nahi Horaha');
    if($update){
        header("location:EmployerListings.php?status=1");
    }
    else{
         header("location:EmployerListings.php?status=0");
    }
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>QUICKNOKRI | Edit Job</title>
<link rel="shortcut icon" href="logoinv.ico"/>      
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> 
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">    
<link type="text/css" href="Style.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet"> 
<link type="text/css" href="all.css" rel="stylesheet">
<style>
 .logo{
        font-family: 'Lobster', cursive;
    }
        
</style>    
</head>
<body style="font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif';" >
<div style=" margin:0px auto; width: 500px;">   
<form action="" method="post" >
<br>    
<center>    
<a href="EmployerListings.php"><h1 class="logo">QUICK NOKRI.com</h1></a>
<hr>     
<h3>Edit Job Posting</h3>
</center>    
<input class="form-control" type="hidden" name="j_id" value="<?php echo $id ?>">
<br>
<label>Job Title:</label>    
<input class="form-control" type="text" name="j_title" value="<?php echo $title ?>">
<br>   
<label>Job Description:</label>     
<textarea rows="7" class="form-control" name="j_desc"><?php echo $desc ?></textarea>
<br> 
<label>Job Salary:</label>     
<input class="form-control" type="number" name="j_salary" value="<?php echo $salary ?>">
<br>
<label>Job Type:</label>     
 <?php
    $getjobtypequery = "SELECT * FROM jobtype";
    $getjobtype = mysqli_query($connectionstring,$getjobtypequery);
    ?>    
    <select class="form-control" style="width: 250px;" name="j_types" required>
        <option style="color:#FF0004;" value="<?php echo $type_id?>"><?php echo $typename?><option>
         <?php
         while($types = mysqli_fetch_assoc($getjobtype)){
         ?>    
         <option value="<?php echo $types['T_ID']?>"><?php echo $types['T_NAME']?></option>
         <?php
         }
         ?>    
    </select> 
<br>  
<label>Job Field:</label>     
<select name="j_field" class="form-control" style="">
<option style="color:#FF0004;" value="<?php echo $fieldid?>"><?php echo $field?></option>
<?php
while($values = mysqli_fetch_assoc($getallfields)){    
?>
<option value="<?php echo $values['F_ID'] ?>"><?php echo $values['F_NAME'] ?></option>    
<?php
}
?>    
</select>
<br> 
<label>Company:</label>     
<input class="form-control" name="j_org" type="text" value="<?php echo $company ?>">
<br>
<input  class="btn btn-success" name="editjob" style="width:150px; float: right;" type="submit" value="Confirm Edit">
   
</form>
<a href="EmployerListings.php"><input type="button" class="btn btn-dark" value="Go Back" style="width: 150px; float: left;"></a> 
<hr>    
</div>    

<br>    
</body>
</html>